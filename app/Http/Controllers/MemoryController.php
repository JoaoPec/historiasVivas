<?php

namespace App\Http\Controllers;

use App\Models\Memory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MemoryController extends Controller
{
    use AuthorizesRequests;

    protected $maxSizes = [
        'image' => 20480, // 20MB
        'video' => 102400, // 100MB
        'audio' => 51200  // 50MB
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $memories = Auth::user()->memories()->latest()->paginate(10);
        return view('memories.index', compact('memories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('memories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate non-file inputs first
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'event_date' => 'nullable|date',
                'category_id' => 'required|exists:categories,id',
                'is_favorite' => 'boolean',
            ]);

            $memory = new Memory($validated);
            $memory->user_id = Auth::id();
            $memory->save();

            // Handle each file separately with individual validation
            $this->handleFileUpload($request, $memory, 'image', 'image', ['jpeg', 'png', 'jpg', 'gif']);
            $this->handleFileUpload($request, $memory, 'video', 'file', ['mp4', 'mov', 'avi']);
            $this->handleFileUpload($request, $memory, 'audio', 'file', ['mp3', 'wav']);

            return redirect()->route('memories.show', $memory)
                ->with('success', 'Memória criada com sucesso!');

        } catch (\Exception $e) {
            \Log::error('Erro ao criar memória: ' . $e->getMessage());
            return back()->withErrors([
                'error' => 'Ocorreu um erro ao salvar a memória. Por favor, tente novamente com arquivos menores.'
            ])->withInput();
        }
    }

    /**
     * Handle file upload with validation and error handling
     */
    protected function handleFileUpload(Request $request, Memory $memory, string $field, string $type, array $mimes)
    {
        \Log::info("handleFileUpload chamado para campo: {$field}");
        \Log::info("hasFile({$field}): " . ($request->hasFile($field) ? 'SIM' : 'NÃO'));
        \Log::info("allFiles keys: " . json_encode(array_keys($request->allFiles())));
        
        // Check if file exists in allFiles but hasFile returns false (file exceeded upload_max_filesize)
        $allFiles = $request->allFiles();
        if (isset($allFiles[$field]) && !$request->hasFile($field)) {
            $uploadMaxSize = $this->parseSize(ini_get('upload_max_filesize'));
            \Log::warning("Campo {$field} existe em allFiles mas hasFile retorna false - arquivo provavelmente excedeu upload_max_filesize ({$uploadMaxSize} bytes = " . ini_get('upload_max_filesize') . ")");
            throw new \Exception("O arquivo de {$field} é muito grande. O limite atual é " . ini_get('upload_max_filesize') . ". Por favor, ajuste o php.ini (upload_max_filesize e post_max_size) ou use um arquivo menor.");
        }
        
        if (!$request->hasFile($field)) {
            \Log::info("Arquivo {$field} não encontrado na requisição");
            return;
        }

        try {
            $file = $request->file($field);
            \Log::info("Arquivo {$field} encontrado: " . $file->getClientOriginalName() . " (" . round($file->getSize() / (1024 * 1024), 2) . "MB)");
            
            // Check if file is valid first
            if (!$file->isValid()) {
                $errorCode = $file->getError();
                $errorMessages = [
                    UPLOAD_ERR_INI_SIZE => 'O arquivo excede o tamanho máximo permitido pelo servidor.',
                    UPLOAD_ERR_FORM_SIZE => 'O arquivo excede o tamanho máximo permitido pelo formulário.',
                    UPLOAD_ERR_PARTIAL => 'O arquivo foi enviado parcialmente.',
                    UPLOAD_ERR_NO_FILE => 'Nenhum arquivo foi enviado.',
                    UPLOAD_ERR_NO_TMP_DIR => 'Falta uma pasta temporária.',
                    UPLOAD_ERR_CANT_WRITE => 'Falha ao escrever o arquivo no disco.',
                    UPLOAD_ERR_EXTENSION => 'Uma extensão PHP parou o upload do arquivo.',
                ];
                $errorMessage = $errorMessages[$errorCode] ?? "Erro desconhecido (código: {$errorCode})";
                \Log::warning("Arquivo {$field} inválido: " . $errorMessage);
                throw new \Exception("Erro ao fazer upload: {$errorMessage}");
            }

            // Validate file size
            $maxSizeBytes = $this->maxSizes[$field] * 1024 * 1024; // Convert MB to bytes
            $fileSize = $file->getSize();
            
            if ($fileSize > $maxSizeBytes) {
                $fileSizeMB = round($fileSize / (1024 * 1024), 2);
                \Log::warning("Arquivo {$field} muito grande: {$fileSizeMB}MB (máximo: {$this->maxSizes[$field]}MB)");
                throw new \Exception("O arquivo é muito grande ({$fileSizeMB}MB). Tamanho máximo permitido: {$this->maxSizes[$field]}MB");
            }

            // Validate file extension
            $extension = strtolower($file->getClientOriginalExtension());
            if (!in_array($extension, $mimes)) {
                \Log::warning("Extensão do arquivo {$field} não permitida: " . $extension . " (permitidas: " . implode(', ', $mimes) . ")");
                throw new \Exception("Extensão do arquivo (.{$extension}) não permitida. Extensões permitidas: " . implode(', ', $mimes));
            }

            // Delete old file if exists
            $oldPath = $memory->{$field . '_media_path'};
            if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
                \Log::info("Arquivo antigo {$field} deletado: " . $oldPath);
            }

            // Ensure directory exists
            $directory = "memories/{$field}s";
            if (!Storage::disk('public')->exists($directory)) {
                Storage::disk('public')->makeDirectory($directory, 0755, true);
                \Log::info("Diretório criado: {$directory}");
            }

            // Sanitize filename to avoid issues with special characters
            $originalName = $file->getClientOriginalName();
            $sanitizedName = preg_replace('/[^a-zA-Z0-9._-]/', '_', pathinfo($originalName, PATHINFO_FILENAME));
            $sanitizedName .= '.' . $extension;
            
            \Log::info("Nome original: {$originalName}, Nome sanitizado: {$sanitizedName}");

            // Store new file with sanitized name
            $path = $file->storeAs($directory, $sanitizedName, 'public');
            
            if (!$path) {
                \Log::error("Falha ao salvar arquivo {$field}: caminho não retornado pelo Storage");
                throw new \Exception("Falha ao salvar o arquivo. Por favor, tente novamente.");
            }

            // Verify file was actually saved
            if (!Storage::disk('public')->exists($path)) {
                \Log::error("Arquivo {$field} não encontrado após salvar: " . $path);
                throw new \Exception("Falha ao verificar o arquivo salvo. Por favor, tente novamente.");
            }

            // Update memory with new path
            $memory->{$field . '_media_path'} = $path;
            $memory->save();
            
            \Log::info("Arquivo {$field} salvo com sucesso: " . $path . " (" . round($fileSize / (1024 * 1024), 2) . "MB)");
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::warning("Erro de validação ao fazer upload do {$field}: " . $e->getMessage());
            throw $e; // Re-throw validation exceptions
        } catch (\Exception $e) {
            \Log::error("Erro ao fazer upload do {$field}: " . $e->getMessage() . " | Trace: " . $e->getTraceAsString());
            throw $e; // Re-throw to show error to user
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Memory $memory)
    {
        $this->authorize('view', $memory);
        
        $memory->load('category');
        
        return view('memories.show', compact('memory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Memory $memory)
    {
        $this->authorize('update', $memory);
        $categories = Category::all();
        return view('memories.edit', compact('memory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Memory $memory)
    {
        try {
            $this->authorize('update', $memory);

            \Log::info("Update de memória iniciado. ID: {$memory->id}");
            \Log::info("Arquivos na requisição: " . json_encode(array_keys($request->allFiles())));
            \Log::info("Tamanho POST: " . ($request->server('CONTENT_LENGTH') ?? 'N/A') . " bytes");
            \Log::info("upload_max_filesize: " . ini_get('upload_max_filesize'));
            \Log::info("post_max_size: " . ini_get('post_max_size'));
            
            // Check if POST data was truncated
            $contentLength = $request->server('CONTENT_LENGTH');
            if ($contentLength && $contentLength > 0) {
                $postMaxSize = $this->parseSize(ini_get('post_max_size'));
                if ($contentLength > $postMaxSize) {
                    \Log::error("POST data excede post_max_size: {$contentLength} > {$postMaxSize}");
                    return back()->withErrors([
                        'error' => 'O tamanho total dos dados enviados excede o limite permitido. Tente enviar arquivos menores ou um de cada vez.'
                    ])->withInput();
                }
            }
            
            // Log all request data for debugging
            \Log::info("Request has video: " . ($request->hasFile('video') ? 'SIM' : 'NÃO'));
            
            // Check if file upload failed due to size limits (file exceeded upload_max_filesize before reaching PHP)
            $uploadMaxSize = $this->parseSize(ini_get('upload_max_filesize'));
            $postMaxSize = $this->parseSize(ini_get('post_max_size'));
            
            \Log::info("Limites PHP - upload_max_filesize: " . ini_get('upload_max_filesize') . " ({$uploadMaxSize} bytes), post_max_size: " . ini_get('post_max_size') . " ({$postMaxSize} bytes)");
            
            // Check if file exists in allFiles but hasFile returns false (file exceeded upload_max_filesize)
            $allFiles = $request->allFiles();
            if (isset($allFiles['video']) && !$request->hasFile('video')) {
                $fileSizeMB = round($contentLength / 1024 / 1024, 2);
                $uploadMaxMB = ini_get('upload_max_filesize');
                \Log::warning("Campo 'video' existe em allFiles mas hasFile retorna false - arquivo de {$fileSizeMB}MB excedeu upload_max_filesize ({$uploadMaxMB})");
                return back()->withErrors([
                    'video' => "O arquivo de vídeo ({$fileSizeMB}MB) é muito grande. O limite atual do PHP é {$uploadMaxMB}. Por favor, ajuste o php.ini (upload_max_filesize e post_max_size) ou use um arquivo menor."
                ])->withInput();
            }

            // Validate non-file inputs first
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'event_date' => 'nullable|date',
                'category_id' => 'required|exists:categories,id',
                'is_favorite' => 'boolean',
            ]);

            $memory->fill($validated);
            $memory->save();

            // Handle each file separately with individual try-catch to prevent one failure from stopping others
            try {
                $this->handleFileUpload($request, $memory, 'image', 'image', ['jpeg', 'png', 'jpg', 'gif']);
            } catch (\Exception $e) {
                \Log::error("Erro ao fazer upload de imagem: " . $e->getMessage());
                // Continue with other files
            }

            try {
                $this->handleFileUpload($request, $memory, 'video', 'file', ['mp4', 'mov', 'avi']);
            } catch (\Exception $e) {
                \Log::error("Erro ao fazer upload de vídeo: " . $e->getMessage());
                return back()->withErrors([
                    'video' => $e->getMessage()
                ])->withInput();
            }

            try {
                $this->handleFileUpload($request, $memory, 'audio', 'file', ['mp3', 'wav']);
            } catch (\Exception $e) {
                \Log::error("Erro ao fazer upload de áudio: " . $e->getMessage());
                // Continue with other files
            }

            return redirect()->route('memories.show', $memory)
                ->with('success', 'Memória atualizada com sucesso!');

        } catch (\Exception $e) {
            \Log::error('Erro ao atualizar memória: ' . $e->getMessage() . " | Trace: " . $e->getTraceAsString());
            return back()->withErrors([
                'error' => 'Ocorreu um erro ao atualizar a memória: ' . $e->getMessage()
            ])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Memory $memory)
    {
        try {
            $this->authorize('delete', $memory);

            // Delete media files
            foreach (['image', 'video', 'audio'] as $type) {
                $path = $memory->{$type . '_media_path'};
                if ($path) {
                    Storage::disk('public')->delete($path);
                }
            }

            $memory->delete();

            return redirect()->route('memories.index')
                ->with('success', 'Memória excluída com sucesso!');
        } catch (\Exception $e) {
            \Log::error('Erro ao excluir memória: ' . $e->getMessage());
            return back()->withErrors([
                'error' => 'Ocorreu um erro ao excluir a memória. Por favor, tente novamente.'
            ]);
        }
    }

    public function favorites()
    {
        $memories = Auth::user()->memories()->where('is_favorite', true)->latest()->paginate(10);
        return view('memories.favorites', compact('memories'));
    }

    /**
     * Parse PHP size string (e.g., "50M") to bytes
     */
    protected function parseSize($size)
    {
        $unit = preg_replace('/[^bkmgtpezy]/i', '', $size);
        $size = preg_replace('/[^0-9\.]/', '', $size);
        if ($unit) {
            return round($size * pow(1024, stripos('bkmgtpezy', $unit[0])));
        } else {
            return round($size);
        }
    }
}
