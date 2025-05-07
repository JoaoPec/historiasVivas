<x-guest-layout>
    <div class="flex min-h-screen flex-col items-center justify-center px-6 py-12">
        <div class="mb-6 flex items-center gap-2">
            <img src="{{ asset('images/logo-historias-vivas.png') }}" alt="Histórias Vivas Logo" class="h-12 w-auto">
            <span class="text-2xl font-bold text-teal">Histórias Vivas</span>
        </div>
        
        <div class="w-full max-w-md">
            <div class="rounded-lg border border-amber/20 bg-white p-8 shadow-md">
                <h2 class="mb-6 text-center text-2xl font-bold text-teal">Criar Conta</h2>
                
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Nome Completo')" />
                        <x-text-input id="name" class="mt-1 block w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('E-mail')" />
                        <x-text-input id="email" class="mt-1 block w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Relationship -->
                    <div>
                        <x-input-label for="relationship" :value="__('Relação com o Paciente')" />
                        <select id="relationship" name="relationship" required class="mt-1 block w-full rounded-md border-amber/20 shadow-sm focus:border-teal focus:ring-teal">
                            <option value="">Selecione...</option>
                            <option value="paciente">Paciente</option>
                            <option value="filho">Filho(a)</option>
                            <option value="conjuge">Cônjuge</option>
                            <option value="cuidador">Cuidador(a)</option>
                            <option value="outro">Outro</option>
                        </select>
                        <x-input-error :messages="$errors->get('relationship')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Senha')" />
                        <x-text-input id="password" class="mt-1 block w-full" type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirmar Senha')" />
                        <x-text-input id="password_confirmation" class="mt-1 block w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div>
                        <x-primary-button class="w-full justify-center">
                            {{ __('Registrar') }}
                        </x-primary-button>
                    </div>
                </form>
                
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        {{ __('Já tem uma conta?') }}
                        <a href="{{ route('login') }}" class="font-medium text-teal hover:underline">
                            {{ __('Entrar') }}
                        </a>
                    </p>
                </div>
            </div>
        </div>
        
        <div class="mt-8">
            <a href="/" class="flex items-center text-sm text-teal hover:underline">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                {{ __('Voltar para a página inicial') }}
            </a>
        </div>
    </div>
</x-guest-layout>
