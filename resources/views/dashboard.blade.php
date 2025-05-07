<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <div class="text-sm text-gray-600">
                Bem-vindo, {{ Auth::user()->name }}!
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-900 text-lg font-semibold mb-2">Total de Memórias</div>
                        <div class="text-3xl font-bold text-indigo-600">0</div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-900 text-lg font-semibold mb-2">Memórias Favoritas</div>
                        <div class="text-3xl font-bold text-indigo-600">0</div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-900 text-lg font-semibold mb-2">Memórias com Mídia</div>
                        <div class="text-3xl font-bold text-indigo-600">0</div>
                    </div>
                </div>
            </div>

            <!-- Recent Memories Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Memórias Recentes</h3>
                        <a href="{{ route('memories.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition-colors">
                            Nova Memória
                        </a>
                    </div>
                    <div class="space-y-4">
                        <div class="text-gray-600 text-center py-8">
                            Nenhuma memória encontrada. Comece criando sua primeira memória!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
