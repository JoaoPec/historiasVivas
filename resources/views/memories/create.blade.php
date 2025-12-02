<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-teal leading-tight">
                {{ __('Nova Memória') }}
            </h2>
            <a href="{{ route('memories.index') }}" class="text-sm text-teal hover:underline flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Voltar para memórias
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-amber/20">
                <div class="p-6">
                    <form method="POST" action="{{ route('memories.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- Informações Básicas -->
                        <div class="border-b border-amber/10 pb-6">
                            <h3 class="text-lg font-medium text-teal mb-4">Informações Básicas</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Título -->
                                <div>
                                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Título da Memória <span class="text-red-500">*</span></label>
                                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                                        class="w-full rounded-md border-amber/20 focus:border-teal focus:ring focus:ring-teal/20 transition-colors"
                                        placeholder="Ex: Aniversário de 15 anos">
                                    @error('title')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Data -->
                                <div>
                                    <label for="event_date" class="block text-sm font-medium text-gray-700 mb-1">Data do Acontecimento <span class="text-red-500">*</span></label>
                                    <input type="date" name="event_date" id="event_date" value="{{ old('event_date') }}" required
                                        class="w-full rounded-md border-amber/20 focus:border-teal focus:ring focus:ring-teal/20 transition-colors">
                                    @error('event_date')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Categoria -->
                                <div>
                                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Categoria <span class="text-red-500">*</span></label>
                                    <select name="category_id" id="category_id" required
                                        class="w-full rounded-md border-amber/20 focus:border-teal focus:ring focus:ring-teal/20 transition-colors">
                                        <option value="">Selecione uma categoria</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Opções Adicionais -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Opções</label>
                                    <div class="flex items-center">
                                        <input type="checkbox" name="is_favorite" id="is_favorite" value="1" {{ old('is_favorite') ? 'checked' : '' }}
                                            class="rounded border-amber/20 text-teal focus:ring-teal/20">
                                        <label for="is_favorite" class="ml-2 text-sm font-medium text-gray-700">Marcar como favorita</label>
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500">Memórias favoritas aparecem em destaque no painel</p>
                                </div>
                            </div>
                        </div>

                        <!-- Descrição -->
                        <div class="border-b border-amber/10 pb-6">
                            <h3 class="text-lg font-medium text-teal mb-4">Descrição da Memória</h3>
                            
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Descrição Detalhada <span class="text-red-500">*</span></label>
                                <textarea name="description" id="description" rows="6" required
                                    class="w-full rounded-md border-amber/20 focus:border-teal focus:ring focus:ring-teal/20 transition-colors"
                                    placeholder="Descreva os detalhes desta memória...">{{ old('description') }}</textarea>
                                <p class="mt-1 text-xs text-gray-500">Inclua detalhes importantes que ajudem a lembrar deste momento</p>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Mídia -->
                        <div class="border-b border-amber/10 pb-6">
                            <h3 class="text-lg font-medium text-teal mb-4">Mídia</h3>
                            
                            <div class="space-y-6">
                                <!-- Imagem -->
                                <div>
                                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Imagem</label>
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed border-amber/20 rounded-md">
                                        <div class="space-y-1 text-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-amber" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600">
                                                <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-teal hover:text-teal-dark focus-within:outline-none">
                                                    <span>Carregar imagem</span>
                                                    <input id="image" name="image" type="file" class="sr-only" accept="image/*" onchange="validateFileSize(this, 2)">
                                                </label>
                                                <p class="pl-1">ou arraste e solte</p>
                                            </div>
                                            <p class="text-xs text-gray-500">
                                                PNG, JPG, GIF até 2MB
                                            </p>
                                        </div>
                                    </div>
                                    <div id="image-preview" class="mt-2 hidden">
                                        <p class="text-sm font-medium text-teal">Imagem selecionada:</p>
                                        <p id="image-name" class="text-sm text-gray-700"></p>
                                    </div>
                                    @error('image')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Áudio -->
                                <div>
                                    <label for="audio" class="block text-sm font-medium text-gray-700 mb-1">Áudio</label>
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed border-amber/20 rounded-md">
                                        <div class="space-y-1 text-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-amber" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600">
                                                <label for="audio" class="relative cursor-pointer bg-white rounded-md font-medium text-teal hover:text-teal-dark focus-within:outline-none">
                                                    <span>Carregar áudio</span>
                                                    <input id="audio" name="audio" type="file" class="sr-only" accept="audio/*" onchange="validateFileSize(this, 5)">
                                                </label>
                                                <p class="pl-1">ou arraste e solte</p>
                                            </div>
                                            <p class="text-xs text-gray-500">
                                                MP3, WAV até 5MB
                                            </p>
                                        </div>
                                    </div>
                                    <div id="audio-preview" class="mt-2 hidden">
                                        <p class="text-sm font-medium text-teal">Áudio selecionado:</p>
                                        <p id="audio-name" class="text-sm text-gray-700"></p>
                                    </div>
                                    @error('audio')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Vídeo -->
                                <div>
                                    <label for="video" class="block text-sm font-medium text-gray-700 mb-1">Vídeo</label>
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed border-amber/20 rounded-md">
                                        <div class="space-y-1 text-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-amber" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600">
                                                <label for="video" class="relative cursor-pointer bg-white rounded-md font-medium text-teal hover:text-teal-dark focus-within:outline-none">
                                                    <span>Carregar vídeo</span>
                                                    <input id="video" name="video" type="file" class="sr-only" accept="video/*" onchange="validateFileSize(this, 100)">
                                                </label>
                                                <p class="pl-1">ou arraste e solte</p>
                                            </div>
                                            <p class="text-xs text-gray-500">
                                                MP4, MOV, AVI até 100MB
                                            </p>
                                        </div>
                                    </div>
                                    <div id="video-preview" class="mt-2 hidden">
                                        <p class="text-sm font-medium text-teal">Vídeo selecionado:</p>
                                        <p id="video-name" class="text-sm text-gray-700"></p>
                                    </div>
                                    @error('video')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Botões -->
                        <div class="flex justify-end space-x-3 pt-4">
                            <a href="{{ route('memories.index') }}" class="px-4 py-2 rounded-md border border-amber text-amber hover:bg-amber hover:text-white transition-colors">
                                Cancelar
                            </a>
                            <button type="submit" class="px-4 py-2 rounded-md bg-teal text-white hover:bg-teal-dark transition-colors">
                                Salvar Memória
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        function validateFileSize(input, maxSizeMB) {
            const maxSize = maxSizeMB * 1024 * 1024; // Convert to bytes
            const file = input.files[0];
            
            if (file) {
                if (file.size > maxSize) {
                    const actualSize = formatFileSize(file.size);
                    const maxSizeFormatted = formatFileSize(maxSize);
                    alert(`O arquivo é muito grande!\n\nTamanho do arquivo: ${actualSize}\nTamanho máximo permitido: ${maxSizeFormatted}`);
                    input.value = ''; // Clear the input
                    
                    // Hide preview
                    const previewId = input.id + '-preview';
                    const preview = document.getElementById(previewId);
                    if (preview) {
                        preview.classList.add('hidden');
                    }
                    return false;
                }
                
                // Show file size in preview
                const previewId = input.id + '-name';
                const preview = document.getElementById(previewId);
                if (preview) {
                    preview.textContent = `${file.name} (${formatFileSize(file.size)})`;
                }
            }
            return true;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const setupFileInput = (inputId, previewId, nameId) => {
                const input = document.getElementById(inputId);
                const preview = document.getElementById(previewId);
                const name = document.getElementById(nameId);

                if (input && preview && name) {
                    const dropZone = input.closest('.border-dashed');
                    
                    // Drag and drop handling
                    dropZone.addEventListener('dragover', (e) => {
                        e.preventDefault();
                        dropZone.classList.add('border-teal', 'bg-teal/5');
                    });

                    dropZone.addEventListener('dragleave', (e) => {
                        e.preventDefault();
                        dropZone.classList.remove('border-teal', 'bg-teal/5');
                    });

                    dropZone.addEventListener('drop', (e) => {
                        e.preventDefault();
                        dropZone.classList.remove('border-teal', 'bg-teal/5');
                        
                        const files = e.dataTransfer.files;
                        if (files.length > 0) {
                            input.files = files;
                            const event = new Event('change');
                            input.dispatchEvent(event);
                        }
                    });

                    // File selection handling
                    input.addEventListener('change', function() {
                        if (this.files && this.files[0]) {
                            preview.classList.remove('hidden');
                        } else {
                            preview.classList.add('hidden');
                        }
                    });
                }
            };

            // Setup file inputs
            setupFileInput('image', 'image-preview', 'image-name');
            setupFileInput('audio', 'audio-preview', 'audio-name');
            setupFileInput('video', 'video-preview', 'video-name');
        });

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const submitButton = form.querySelector('button[type="submit"]');
            const originalButtonText = submitButton.innerHTML;

            form.addEventListener('submit', function() {
                // Desabilita o botão
                submitButton.disabled = true;
                
                // Adiciona o loading
                submitButton.innerHTML = `
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Salvando...
                `;
            });
        });
    </script>
</x-app-layout>
