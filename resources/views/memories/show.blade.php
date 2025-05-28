<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-teal leading-tight">
                {{ $memory->title }}
            </h2>
            <div class="flex items-center space-x-4">
                @can('update', $memory)
                    <a href="{{ route('memories.edit', $memory) }}" class="text-sm text-teal hover:underline flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Editar
                    </a>
                @endcan
                <a href="{{ route('memories.index') }}" class="text-sm text-teal hover:underline flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Voltar para memórias
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-amber/20">
                <div class="p-6">
                    <!-- Informações Básicas -->
                    <div class="border-b border-amber/10 pb-6 mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="text-lg font-medium text-teal mb-4">Detalhes da Memória</h3>
                                <dl class="space-y-3">
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Data do Acontecimento</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $memory->event_date ? date('d/m/Y', strtotime($memory->event_date)) : 'Não informada' }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Categoria</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $memory->category ? $memory->category->name : 'Não categorizada' }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Status</dt>
                                        <dd class="mt-1 text-sm">
                                            @if($memory->is_favorite)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber text-white">
                                                    Favorita
                                                </span>
                                            @endif
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                            
                            <div>
                                <h3 class="text-lg font-medium text-teal mb-4">Descrição</h3>
                                <p class="text-gray-700 whitespace-pre-line">{{ $memory->description }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Mídia -->
                    <div>
                        <h3 class="text-lg font-medium text-teal mb-4">Mídia</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <!-- Imagem -->
                            @if($memory->image_media_path)
                            <div>
                                <h4 class="text-sm font-medium text-gray-700 mb-2">Imagem</h4>
                                <div class="relative aspect-video bg-gray-100 rounded-lg overflow-hidden">
                                    <img src="{{ Storage::url($memory->image_media_path) }}" 
                                         alt="Imagem da memória" 
                                         class="absolute inset-0 w-full h-full object-cover">
                                </div>
                            </div>
                            @endif

                            <!-- Áudio -->
                            @if($memory->audio_media_path)
                            <div>
                                <h4 class="text-sm font-medium text-gray-700 mb-2">Áudio</h4>
                                <div class="p-4 bg-gray-50 rounded-lg">
                                    <audio controls class="w-full">
                                        <source src="{{ Storage::url($memory->audio_media_path) }}" type="audio/mpeg">
                                        Seu navegador não suporta o elemento de áudio.
                                    </audio>
                                </div>
                            </div>
                            @endif

                            <!-- Vídeo -->
                            @if($memory->video_media_path)
                            <div>
                                <h4 class="text-sm font-medium text-gray-700 mb-2">Vídeo</h4>
                                <div class="relative aspect-video bg-gray-100 rounded-lg overflow-hidden">
                                    <video controls class="absolute inset-0 w-full h-full object-cover">
                                        <source src="{{ Storage::url($memory->video_media_path) }}" type="video/mp4">
                                        Seu navegador não suporta o elemento de vídeo.
                                    </video>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Ações -->
                    @can('delete', $memory)
                    <div class="mt-8 pt-6 border-t border-amber/10">
                        <form action="{{ route('memories.destroy', $memory) }}" method="POST" class="flex justify-end">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors"
                                    onclick="return confirm('Tem certeza que deseja excluir esta memória? Esta ação não pode ser desfeita.')">
                                Excluir Memória
                            </button>
                        </form>
                    </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 