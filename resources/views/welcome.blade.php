<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Histórias Vivas') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-cream font-sans text-gray-800 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="sticky top-0 z-50 w-full border-b border-amber/20 bg-cream/95 backdrop-blur">
        <div class="container mx-auto px-4 flex h-16 items-center justify-between">
            <div class="flex items-center gap-2">
                <img src="{{ asset('images/logo-historias-vivas.png') }}" alt="Histórias Vivas Logo" class="h-10 w-auto">
                <span class="text-xl font-bold text-teal">Histórias Vivas</span>
            </div>
            <nav class="hidden md:flex items-center gap-6 text-sm">
                <a href="#features" class="transition-colors hover:text-teal">
                    Recursos
                </a>
                <a href="#how-it-works" class="transition-colors hover:text-teal">
                    Como Funciona
                </a>
                <a href="#testimonials" class="transition-colors hover:text-teal">
                    Depoimentos
                </a>
            </nav>
            <div class="flex items-center gap-4">
                <a href="{{ route('login') }}" class="px-4 py-2 rounded-md border border-amber text-amber hover:bg-amber hover:text-white transition-colors">
                    Entrar
                </a>
                <a href="{{ route('register') }}" class="px-4 py-2 rounded-md bg-amber text-white hover:bg-amber-dark transition-colors">
                    Registrar
                </a>
            </div>
        </div>
    </header>

    <main class="flex-1">
        <!-- Hero Section -->
        <section class="w-full py-12 md:py-24 lg:py-32 bg-gradient-to-b from-amber-light/30 to-cream">
            <div class="container mx-auto px-4 md:px-6">
                <div class="grid gap-6 lg:grid-cols-2 lg:gap-12 items-center">
                    <div class="flex flex-col justify-center space-y-4">
                        <div class="space-y-2">
                            <h1 class="text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl lg:text-6xl text-teal">
                                Preservando memórias que importam
                            </h1>
                            <p class="max-w-[600px] text-gray-700 md:text-xl/relaxed lg:text-base/relaxed xl:text-xl/relaxed">
                                Um espaço seguro para guardar e acessar memórias fundamentais para pessoas com Alzheimer e demência.
                            </p>
                        </div>
                        <div class="flex flex-col gap-2 min-[400px]:flex-row">
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-6 py-3 rounded-md bg-amber text-white font-medium hover:bg-amber-dark transition-colors">
                                Comece Agora
                            </a>
                            <a href="#how-it-works" class="inline-flex items-center justify-center px-6 py-3 rounded-md border border-amber text-amber font-medium hover:bg-amber hover:text-white transition-colors">
                                Saiba Mais
                            </a>
                        </div>
                    </div>
                    <div class="mx-auto lg:mr-0 flex items-center justify-center">
                        <div class="relative w-full max-w-[500px] aspect-square rounded-full bg-amber-light/30 p-4">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <img src="{{ asset('images/logo-historias-vivas.png') }}" alt="Histórias Vivas Logo" class="w-48 h-48">
                            </div>
                            <div class="absolute top-10 right-10 bg-white p-3 rounded-xl shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-teal" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="absolute bottom-10 left-10 bg-white p-3 rounded-xl shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-teal" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div class="absolute bottom-20 right-20 bg-white p-3 rounded-xl shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-teal" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" />
                                </svg>
                            </div>
                            <div class="absolute top-20 left-20 bg-white p-3 rounded-xl shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-teal" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="w-full py-12 md:py-24 lg:py-32">
            <div class="container mx-auto px-4 md:px-6">
                <div class="flex flex-col items-center justify-center space-y-4 text-center">
                    <div class="space-y-2">
                        <h2 class="text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl text-teal">Recursos Principais</h2>
                        <p class="max-w-[900px] text-gray-700 md:text-xl/relaxed lg:text-base/relaxed xl:text-xl/relaxed">
                            Projetado especialmente para cuidadores e familiares de pessoas com Alzheimer e demência.
                        </p>
                    </div>
                </div>
                <div class="mx-auto grid max-w-5xl grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 mt-12">
                    <div class="flex flex-col items-center space-y-2 rounded-lg border border-amber/20 p-6 shadow-sm">
                        <div class="rounded-full bg-amber-light/50 p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-teal" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-teal">Informações Fundamentais</h3>
                        <p class="text-center text-gray-700">
                            Mantenha informações essenciais sempre acessíveis para orientação diária.
                        </p>
                    </div>
                    <div class="flex flex-col items-center space-y-2 rounded-lg border border-amber/20 p-6 shadow-sm">
                        <div class="rounded-full bg-amber-light/50 p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-teal" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-teal">Múltiplos Formatos</h3>
                        <p class="text-center text-gray-700">
                            Guarde memórias em texto, fotos, vídeos e áudios para uma experiência completa.
                        </p>
                    </div>
                    <div class="flex flex-col items-center space-y-2 rounded-lg border border-amber/20 p-6 shadow-sm">
                        <div class="rounded-full bg-amber-light/50 p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-teal" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-teal">Fases da Vida</h3>
                        <p class="text-center text-gray-700">
                            Organize memórias por períodos como infância, juventude, casamento e aposentadoria.
                        </p>
                    </div>
                    <div class="flex flex-col items-center space-y-2 rounded-lg border border-amber/20 p-6 shadow-sm">
                        <div class="rounded-full bg-amber-light/50 p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-teal" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-teal">Memórias Favoritas</h3>
                        <p class="text-center text-gray-700">
                            Destaque as memórias mais importantes para acesso rápido e frequente.
                        </p>
                    </div>
                    <div class="flex flex-col items-center space-y-2 rounded-lg border border-amber/20 p-6 shadow-sm">
                        <div class="rounded-full bg-amber-light/50 p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-teal" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-teal">Acesso Compartilhado</h3>
                        <p class="text-center text-gray-700">
                            Permita que familiares e cuidadores contribuam com memórias importantes.
                        </p>
                    </div>
                    <div class="flex flex-col items-center space-y-2 rounded-lg border border-amber/20 p-6 shadow-sm">
                        <div class="rounded-full bg-amber-light/50 p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-teal" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-teal">Interface Acessível</h3>
                        <p class="text-center text-gray-700">
                            Design simples e intuitivo, pensado para facilitar o uso por todos.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works Section -->
        <section id="how-it-works" class="w-full py-12 md:py-24 lg:py-32 bg-amber-light/20">
            <div class="container mx-auto px-4 md:px-6">
                <div class="flex flex-col items-center justify-center space-y-4 text-center">
                    <div class="space-y-2">
                        <h2 class="text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl text-teal">Como Funciona</h2>
                        <p class="max-w-[900px] text-gray-700 md:text-xl/relaxed lg:text-base/relaxed xl:text-xl/relaxed">
                            Um processo simples para preservar e acessar memórias importantes.
                        </p>
                    </div>
                </div>
                <div class="mx-auto grid max-w-5xl grid-cols-1 gap-8 md:grid-cols-3 mt-12">
                    <div class="flex flex-col items-center space-y-4">
                        <div class="flex h-16 w-16 items-center justify-center rounded-full bg-amber text-white">
                            <span class="text-2xl font-bold">1</span>
                        </div>
                        <h3 class="text-xl font-bold text-teal">Crie uma Conta</h3>
                        <p class="text-center text-gray-700">
                            Registre-se com informações básicas e convide familiares para contribuir.
                        </p>
                    </div>
                    <div class="flex flex-col items-center space-y-4">
                        <div class="flex h-16 w-16 items-center justify-center rounded-full bg-amber text-white">
                            <span class="text-2xl font-bold">2</span>
                        </div>
                        <h3 class="text-xl font-bold text-teal">Adicione Memórias</h3>
                        <p class="text-center text-gray-700">
                            Cadastre momentos importantes em diferentes formatos e categorias.
                        </p>
                    </div>
                    <div class="flex flex-col items-center space-y-4">
                        <div class="flex h-16 w-16 items-center justify-center rounded-full bg-amber text-white">
                            <span class="text-2xl font-bold">3</span>
                        </div>
                        <h3 class="text-xl font-bold text-teal">Acesse Quando Precisar</h3>
                        <p class="text-center text-gray-700">
                            Consulte informações fundamentais e memórias importantes a qualquer momento.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section id="testimonials" class="w-full py-12 md:py-24 lg:py-32">
            <div class="container mx-auto px-4 md:px-6">
                <div class="flex flex-col items-center justify-center space-y-4 text-center">
                    <div class="space-y-2">
                        <h2 class="text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl text-teal">Depoimentos</h2>
                        <p class="max-w-[900px] text-gray-700 md:text-xl/relaxed lg:text-base/relaxed xl:text-xl/relaxed">
                            Veja como o Histórias Vivas tem ajudado famílias.
                        </p>
                    </div>
                </div>
                <div class="mx-auto grid max-w-5xl grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 mt-12">
                    <div class="flex flex-col justify-between space-y-4 rounded-lg border border-amber/20 p-6 shadow-sm">
                        <div>
                            <p class="text-gray-700">
                                "O Histórias Vivas tem sido fundamental para manter minha mãe conectada com suas memórias mais
                                importantes. A interface é simples e ela consegue usar sozinha."
                            </p>
                        </div>
                        <div>
                            <p class="font-medium text-teal">Maria S.</p>
                            <p class="text-sm text-gray-600">Filha de paciente com Alzheimer</p>
                        </div>
                    </div>
                    <div class="flex flex-col justify-between space-y-4 rounded-lg border border-amber/20 p-6 shadow-sm">
                        <div>
                            <p class="text-gray-700">
                                "Como cuidador, posso adicionar fotos e vídeos importantes que ajudam na orientação diária. A seção
                                de informações fundamentais é extremamente útil."
                            </p>
                        </div>
                        <div>
                            <p class="font-medium text-teal">Carlos P.</p>
                            <p class="text-sm text-gray-600">Cuidador profissional</p>
                        </div>
                    </div>
                    <div class="flex flex-col justify-between space-y-4 rounded-lg border border-amber/20 p-6 shadow-sm">
                        <div>
                            <p class="text-gray-700">
                                "Toda a família contribui com memórias, e isso tem ajudado muito meu pai a se sentir conectado com
                                sua história, mesmo nos dias mais difíceis."
                            </p>
                        </div>
                        <div>
                            <p class="font-medium text-teal">Ana L.</p>
                            <p class="text-sm text-gray-600">Filha de paciente com demência</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="w-full py-12 md:py-24 lg:py-32 bg-amber-light/30">
            <div class="container mx-auto px-4 md:px-6">
                <div class="flex flex-col items-center justify-center space-y-4 text-center">
                    <div class="space-y-2">
                        <h2 class="text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl text-teal">
                            Comece a Preservar Memórias Hoje
                        </h2>
                        <p class="max-w-[900px] text-gray-700 md:text-xl/relaxed lg:text-base/relaxed xl:text-xl/relaxed">
                            Crie uma conta gratuita e comece a guardar as memórias que realmente importam.
                        </p>
                    </div>
                    <div class="flex flex-col gap-2 min-[400px]:flex-row">
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-6 py-3 rounded-md bg-teal text-white font-medium hover:bg-teal-dark transition-colors">
                            Registrar Agora
                        </a>
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-6 py-3 rounded-md border border-teal text-teal font-medium hover:bg-teal hover:text-white transition-colors">
                            Já tenho uma conta
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="w-full border-t border-amber/20 py-6 md:py-0">
        <div class="container mx-auto px-4 flex flex-col items-center justify-between gap-4 md:h-24 md:flex-row">
            <div class="flex items-center gap-2">
                <img src="{{ asset('images/logo-historias-vivas.png') }}" alt="Histórias Vivas Logo" class="h-8 w-6">
                <p class="text-sm text-gray-600">© 2025 Histórias Vivas. Todos os direitos reservados.</p>
            </div>
            <div class="flex gap-4">
                <a href="#" class="text-sm text-gray-600 hover:text-teal hover:underline">
                    Termos de Uso
                </a>
                <a href="#" class="text-sm text-gray-600 hover:text-teal hover:underline">
                    Política de Privacidade
                </a>
                <a href="#" class="text-sm text-gray-600 hover:text-teal hover:underline">
                    Contato
                </a>
            </div>
        </div>
    </footer>
</body>
</html>
