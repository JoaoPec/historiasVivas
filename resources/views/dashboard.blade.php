@php
use Illuminate\Support\Facades\Storage;
@endphp

<x-app-layout>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Auto-submit quando mudar os filtros
                const form = document.getElementById('filters-form');
                const autoSubmitInputs = form.querySelectorAll('input[type="radio"], input[type="checkbox"]');
                
                autoSubmitInputs.forEach(input => {
                    input.addEventListener('change', function() {
                        form.submit();
                    });
                });

                // Auto-submit quando pressionar Enter no campo de busca
                const searchInput = form.querySelector('input[name="search"]');
                if (searchInput) {
                    searchInput.addEventListener('keypress', function(e) {
                        if (e.key === 'Enter') {
                            e.preventDefault();
                            form.submit();
                        }
                    });
                }
            });
        </script>
    @endpush

    @push('styles')
        <style>
            .dropdown-content {
                display: none;
                position: absolute;
                right: 0;
                margin-top: 0.5rem;
                background-color: white;
                border-radius: 0.375rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
                border: 1px solid rgba(251, 191, 36, 0.2);
                z-index: 50;
            }

            .dropdown-content.show {
                display: block;
            }
        </style>
    @endpush

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-teal leading-tight">
                {{ __('Meu Espaço') }}
            </h2>
            <div class="flex items-center gap-4">
                <span class="text-sm text-gray-600">
                    Bem-vindo, {{ Auth::user()->name }}!
                </span>
                <a href="{{ route('memories.create') }}" class="bg-amber hover:bg-amber-dark text-white px-4 py-2 rounded-md transition-colors inline-flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Nova Memória
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-amber/20">
                    <div class="p-6">
                        <div class="flex items-center gap-4">
                            <div class="rounded-full bg-amber-light/50 p-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-teal" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-gray-600 text-sm mb-1">Total de Memórias</div>
                                <div class="text-2xl font-bold text-teal">{{ $totalMemories ?? 0 }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-amber/20">
                    <div class="p-6">
                        <div class="flex items-center gap-4">
                            <div class="rounded-full bg-amber-light/50 p-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-teal" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-gray-600 text-sm mb-1">Favoritas</div>
                                <div class="text-2xl font-bold text-teal">{{ $favoriteMemories ?? 0 }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-amber/20">
                    <div class="p-6">
                        <div class="flex items-center gap-4">
                            <div class="rounded-full bg-amber-light/50 p-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-teal" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-gray-600 text-sm mb-1">Com Mídia</div>
                                <div class="text-2xl font-bold text-teal">{{ $mediaMemories ?? 0 }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-amber/20">
                    <div class="p-6">
                        <div class="flex items-center gap-4">
                            <div class="rounded-full bg-amber-light/50 p-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-teal" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-gray-600 text-sm mb-1">Este Mês</div>
                                <div class="text-2xl font-bold text-teal">{{ $monthlyMemories ?? 0 }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-amber/20 mb-6">
                <div class="p-4">
                    <form action="{{ route('dashboard') }}" method="GET" class="flex flex-wrap gap-4 items-center" id="filters-form">
                        <!-- Search -->
                        <div class="flex-1 min-w-[200px] flex gap-2">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Pesquisar memórias..." class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal focus:ring focus:ring-teal focus:ring-opacity-50">
                            <button type="submit" class="px-4 py-2 bg-amber text-white hover:bg-amber-dark transition-colors rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>

                        <!-- Filters -->
                        <div class="flex gap-2">
                            <div class="relative" x-data="{ open: false }" @click.away="open = false">
                                <button type="button" @click="open = !open" class="filters-button px-4 py-2 rounded-md border border-amber text-amber hover:bg-amber hover:text-white transition-colors inline-flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                                    </svg>
                                    Filtros
                                </button>
                                <div class="dropdown-content" :class="{ 'show': open }">
                                    <div class="p-4 space-y-4">
                                        <!-- Favoritos -->
                                        <div>
                                            <label class="flex items-center gap-2 cursor-pointer">
                                                <input type="checkbox" name="favorite" value="1" {{ request('favorite') ? 'checked' : '' }} class="rounded border-amber/20 text-teal focus:ring-teal/20">
                                                <span class="text-sm">Apenas favoritas</span>
                                            </label>
                                        </div>

                                        <!-- Período -->
                                        <div>
                                            <div class="text-sm font-medium text-gray-700 mb-2">Período</div>
                                            <div class="space-y-2">
                                                <label class="flex items-center gap-2 cursor-pointer">
                                                    <input type="radio" name="time_period" value="today" {{ request('time_period') === 'today' ? 'checked' : '' }} class="border-amber/20 text-teal focus:ring-teal/20">
                                                    <span class="text-sm">Hoje</span>
                                                </label>
                                                <label class="flex items-center gap-2 cursor-pointer">
                                                    <input type="radio" name="time_period" value="week" {{ request('time_period') === 'week' ? 'checked' : '' }} class="border-amber/20 text-teal focus:ring-teal/20">
                                                    <span class="text-sm">Última semana</span>
                                                </label>
                                                <label class="flex items-center gap-2 cursor-pointer">
                                                    <input type="radio" name="time_period" value="month" {{ request('time_period') === 'month' ? 'checked' : '' }} class="border-amber/20 text-teal focus:ring-teal/20">
                                                    <span class="text-sm">Último mês</span>
                                                </label>
                                                <label class="flex items-center gap-2 cursor-pointer">
                                                    <input type="radio" name="time_period" value="year" {{ request('time_period') === 'year' ? 'checked' : '' }} class="border-amber/20 text-teal focus:ring-teal/20">
                                                    <span class="text-sm">Último ano</span>
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Tipo de Mídia -->
                                        <div>
                                            <div class="text-sm font-medium text-gray-700 mb-2">Tipo de Mídia</div>
                                            <div class="space-y-2">
                                                <label class="flex items-center gap-2 cursor-pointer">
                                                    <input type="radio" name="media_type" value="image" {{ request('media_type') === 'image' ? 'checked' : '' }} class="border-amber/20 text-teal focus:ring-teal/20">
                                                    <span class="text-sm">Com imagens</span>
                                                </label>
                                                <label class="flex items-center gap-2 cursor-pointer">
                                                    <input type="radio" name="media_type" value="video" {{ request('media_type') === 'video' ? 'checked' : '' }} class="border-amber/20 text-teal focus:ring-teal/20">
                                                    <span class="text-sm">Com vídeos</span>
                                                </label>
                                                <label class="flex items-center gap-2 cursor-pointer">
                                                    <input type="radio" name="media_type" value="audio" {{ request('media_type') === 'audio' ? 'checked' : '' }} class="border-amber/20 text-teal focus:ring-teal/20">
                                                    <span class="text-sm">Com áudios</span>
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Botões -->
                                        <div class="flex gap-2 pt-2 border-t border-amber/20">
                                            <button type="submit" class="flex-1 px-3 py-1.5 bg-amber text-white hover:bg-amber-dark transition-colors rounded-md text-sm">
                                                Aplicar
                                            </button>
                                            <a href="{{ route('dashboard') }}" class="px-3 py-1.5 border border-amber text-amber hover:bg-amber hover:text-white transition-colors rounded-md text-sm">
                                                Limpar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sort -->
                            <div class="relative" x-data="{ open: false }" @click.away="open = false">
                                <button type="button" @click="open = !open" class="sort-button px-4 py-2 rounded-md border border-amber text-amber hover:bg-amber hover:text-white transition-colors inline-flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                    Ordenar
                                </button>
                                <div class="dropdown-content" :class="{ 'show': open }">
                                    <div class="p-4 space-y-2">
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="radio" name="sort" value="latest" {{ !request('sort') || request('sort') === 'latest' ? 'checked' : '' }} class="border-amber/20 text-teal focus:ring-teal/20">
                                            <span class="text-sm">Mais recentes</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="radio" name="sort" value="oldest" {{ request('sort') === 'oldest' ? 'checked' : '' }} class="border-amber/20 text-teal focus:ring-teal/20">
                                            <span class="text-sm">Mais antigas</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="radio" name="sort" value="title" {{ request('sort') === 'title' ? 'checked' : '' }} class="border-amber/20 text-teal focus:ring-teal/20">
                                            <span class="text-sm">Título (A-Z)</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="radio" name="sort" value="event_date" {{ request('sort') === 'event_date' ? 'checked' : '' }} class="border-amber/20 text-teal focus:ring-teal/20">
                                            <span class="text-sm">Data do evento</span>
                                        </label>
                                        <div class="flex gap-2 pt-2 border-t border-amber/20">
                                            <button type="submit" class="flex-1 px-3 py-1.5 bg-amber text-white hover:bg-amber-dark transition-colors rounded-md text-sm">
                                                Aplicar
                                            </button>
                                            <a href="{{ route('dashboard') }}" class="px-3 py-1.5 border border-amber text-amber hover:bg-amber hover:text-white transition-colors rounded-md text-sm">
                                                Limpar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Memories Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($memories ?? [] as $memory)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-amber/20 hover:shadow-md transition-shadow">
                        <div class="aspect-video bg-gray-100 relative">
                            @if($memory->image_media_path)
                                <img src="{{ Storage::url($memory->image_media_path) }}" alt="{{ $memory->title }}" class="w-full h-full object-cover">
                            @elseif($memory->video_media_path)
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            @else
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                            @if($memory->is_favorite)
                                <div class="absolute top-2 right-2">
                                    <div class="rounded-full bg-amber p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-lg text-teal mb-2">{{ $memory->title }}</h3>
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($memory->description, 100) }}</p>
                            <div class="flex justify-between items-center">
                                <div class="text-sm text-gray-500">
                                    {{ $memory->event_date ? $memory->event_date->format('d/m/Y') : 'Sem data' }}
                                </div>
                                <a href="{{ route('memories.show', $memory) }}" class="text-amber hover:text-amber-dark transition-colors">
                                    Ver mais
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-amber/20">
                            <div class="p-6 text-center">
                                <div class="rounded-full bg-amber-light/50 p-4 w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-teal" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Nenhuma memória encontrada</h3>
                                <p class="text-gray-600 mb-4">Comece sua jornada criando sua primeira memória!</p>
                                <a href="{{ route('memories.create') }}" class="inline-flex items-center gap-2 bg-amber hover:bg-amber-dark text-white px-4 py-2 rounded-md transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                    </svg>
                                    Criar Primeira Memória
                                </a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if(isset($memories) && $memories->hasPages())
                <div class="mt-6">
                    {{ $memories->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>