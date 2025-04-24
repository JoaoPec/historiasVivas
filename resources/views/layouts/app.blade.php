<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórias Vivas - Preservando memórias que importam</title>
    <meta name="description" content="Um sistema para guardar memórias fundamentais para pessoas com Alzheimer e demência.">
    
    <!-- Heroicons -->
    <script src="https://unpkg.com/heroicons@1.0.6/outline/index.js"></script>

    <!-- Configuração opcional -->
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
<body class="bg-gray-100 text-gray-800">
    @yield('content')
</body>
</html>
