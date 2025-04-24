<?

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar - Histórias Vivas</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        cream: '#FFF8E7',
                        amber: {
                            DEFAULT: '#F5A623',
                            light: '#FFDEA3',
                            dark: '#D68C00'
                        },
                        teal: {
                            DEFAULT: '#2A7D6B',
                            light: '#3A9D89',
                            dark: '#1A5D4B'
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-cream font-sans text-gray-800 min-h-screen flex flex-col">
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
                    
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nome Completo</label>
                        <input type="text" id="name" name="name" required class="mt-1 block w-full rounded-md border border-amber/20 px-3 py-2 shadow-sm focus:border-teal focus:outline-none focus:ring-1 focus:ring-teal">
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                        <input type="email" id="email" name="email" required class="mt-1 block w-full rounded-md border border-amber/20 px-3 py-2 shadow-sm focus:border-teal focus:outline-none focus:ring-1 focus:ring-teal">
                    </div>
                    
                    <div>
                        <label for="relationship" class="block text-sm font-medium text-gray-700">Relação com o Paciente</label>
                        <select id="relationship" name="relationship" required class="mt-1 block w-full rounded-md border border-amber/20 px-3 py-2 shadow-sm focus:border-teal focus:outline-none focus:ring-1 focus:ring-teal">
                            <option value="">Selecione...</option>
                            <option value="paciente">Paciente</option>
                            <option value="filho">Filho(a)</option>
                            <option value="conjuge">Cônjuge</option>
                            <option value="cuidador">Cuidador(a)</option>
                            <option value="outro">Outro</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                        <input type="password" id="password" name="password" required class="mt-1 block w-full rounded-md border border-amber/20 px-3 py-2 shadow-sm focus:border-teal focus:outline-none focus:ring-1 focus:ring-teal">
                    </div>
                    
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Senha</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required class="mt-1 block w-full rounded-md border border-amber/20 px-3 py-2 shadow-sm focus:border-teal focus:outline-none focus:ring-1 focus:ring-teal">
                    </div>
                    
                    <div>
                        <button type="submit" class="w-full rounded-md bg-teal px-4 py-2 text-white hover:bg-teal-dark focus:outline-none focus:ring-2 focus:ring-teal focus:ring-offset-2">
                            Registrar
                        </button>
                    </div>
                </form>
                
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Já tem uma conta? 
                        <a href="{{ route('login') }}" class="font-medium text-teal hover:underline">
                            Entrar
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
                Voltar para a página inicial
            </a>
        </div>
    </div>
</body>
</html>
