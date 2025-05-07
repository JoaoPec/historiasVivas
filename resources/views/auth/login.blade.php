<x-guest-layout>
    <div class="flex min-h-screen flex-col items-center justify-center px-6 py-12">
        <div class="mb-6 flex items-center gap-2">
            <img src="{{ asset('images/logo-historias-vivas.png') }}" alt="Histórias Vivas Logo" class="h-12 w-auto">
            <span class="text-2xl font-bold text-teal">Histórias Vivas</span>
        </div>
        
        <div class="w-full max-w-md">
            <div class="rounded-lg border border-amber/20 bg-white p-8 shadow-md">
                <h2 class="mb-6 text-center text-2xl font-bold text-teal">Entrar</h2>
                
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    
                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('E-mail')" />
                        <x-text-input id="email" class="mt-1 block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Senha')" />
                        <x-text-input id="password" class="mt-1 block w-full" type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-amber/20 text-teal shadow-sm focus:ring-teal" name="remember">
                            <span class="ml-2 text-sm text-gray-700">{{ __('Lembrar-me') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm font-medium text-teal hover:underline" href="{{ route('password.request') }}">
                                {{ __('Esqueceu a senha?') }}
                            </a>
                        @endif
                    </div>

                    <div>
                        <x-primary-button class="w-full justify-center">
                            {{ __('Entrar') }}
                        </x-primary-button>
                    </div>
                </form>
                
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        {{ __('Não tem uma conta?') }}
                        <a href="{{ route('register') }}" class="font-medium text-teal hover:underline">
                            {{ __('Registre-se') }}
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
