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
        'image' => 2048, // 2MB
        'video' => 8192, // 8MB
        'audio' => 5120  // 5MB
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
        if ($request->hasFile($field)) {
            try {
                $file = $request->file($field);
                
                // Validate file
                $request->validate([
                    $field => [
                        'required',
                        $type,
                        'mimes:' . implode(',', $mimes),
                        'max:' . $this->maxSizes[$field]
                    ]
                ]);

                if ($file->isValid()) {
                    // Delete old file if exists
                    $oldPath = $memory->{$field . '_media_path'};
                    if ($oldPath) {
                        Storage::disk('public')->delete($oldPath);
                    }

                    // Store new file
                    $path = $file->store("memories/{$field}s", 'public');
                    $memory->{$field . '_media_path'} = $path;
                    $memory->save();
                }
            } catch (\Exception $e) {
                \Log::warning("Erro ao fazer upload do {$field}: " . $e->getMessage());
                // Continue with other files even if one fails
            }
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

            // Handle each file separately
            $this->handleFileUpload($request, $memory, 'image', 'image', ['jpeg', 'png', 'jpg', 'gif']);
            $this->handleFileUpload($request, $memory, 'video', 'file', ['mp4', 'mov', 'avi']);
            $this->handleFileUpload($request, $memory, 'audio', 'file', ['mp3', 'wav']);

            return redirect()->route('memories.show', $memory)
                ->with('success', 'Memória atualizada com sucesso!');

        } catch (\Exception $e) {
            \Log::error('Erro ao atualizar memória: ' . $e->getMessage());
            return back()->withErrors([
                'error' => 'Ocorreu um erro ao atualizar a memória. Por favor, tente novamente com arquivos menores.'
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
}
