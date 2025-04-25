<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CetinScope - Çetinkaya Beauty Cilt Analizi</title>
    <meta name="description" content="Çetinkaya Beauty'nin yapay zeka destekli ücretsiz cilt analizi platformu. Fotoğraflarınızı yükleyin, detaylı cilt analizinizi alın.">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #f8bbd0 0%, #e1bee7 100%);
        }

        .container-custom {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .btn-primary {
            background-color: #ec407a;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #d81b60;
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(236, 64, 122, 0.3);
        }

        .card {
            background-color: white;
            border-radius: 1rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #ec407a;
            box-shadow: 0 0 0 3px rgba(236, 64, 122, 0.2);
            outline: none;
        }

        .input-file-label {
            background-color: #f3f4f6;
            border: 2px dashed #d1d5db;
            border-radius: 0.5rem;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .input-file-label:hover {
            border-color: #ec407a;
            background-color: #fce7f3;
        }

        .spinner {
            border: 4px solid rgba(0, 0, 0, 0.1);
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border-left-color: #ec407a;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Modal Styles */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 50;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .modal.show {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            background-color: white;
            border-radius: 1rem;
            padding: 2rem;
            max-width: 500px;
            width: 90%;
            text-align: center;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            transform: translateY(20px);
            transition: all 0.3s ease;
        }

        .modal.show .modal-content {
            transform: translateY(0);
        }

        .loading-animation {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .loading-dots {
            display: flex;
            justify-content: center;
            margin: 1rem 0;
        }

        .loading-dots .dot {
            width: 12px;
            height: 12px;
            margin: 0 4px;
            border-radius: 50%;
            background-color: #ec407a;
            animation: pulse 1.5s infinite ease-in-out;
        }

        .loading-dots .dot:nth-child(2) {
            animation-delay: 0.2s;
        }

        .loading-dots .dot:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(0.8) translate(-60%, -60%);
                opacity: 0.5;
            }

            50% {
                transform: scale(1.2) translate(-40%, -40%);
                opacity: 1;
            }
        }

        @keyframes rotate {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

    <!-- Livewire -->
    @livewireStyles
</head>

<body>
    <header class="gradient-bg text-white py-4 shadow-md">
        <div class="container-custom flex flex-col md:flex-row justify-between items-center">
            <a href="{{ route('home') }}" class="text-2xl font-bold mb-2 md:mb-0">
                <span class="text-white">Cetin</span><span class="text-pink-900">Scope</span>
            </a>
            <div class="text-center md:text-right">
                <h1 class="text-lg font-medium">Çetinkaya Beauty</h1>
                <p class="text-sm opacity-90">Yapay Zeka Destekli Cilt Analizi</p>
            </div>
        </div>
    </header>

    <main class="py-10">
        <div class="container-custom">
            @yield('content')
        </div>
    </main>

    <footer class="bg-gray-800 text-white py-8">
        <div class="container-custom">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <h2 class="text-xl font-bold mb-2">Çetinkaya Beauty</h2>
                    <p class="text-gray-400 text-sm">Profesyonel cilt bakımı ve güzellik hizmetleri</p>
                </div>
                <div class="text-center md:text-right">
                    <p class="text-sm text-gray-400">
                        © {{ date('Y') }} Çetinkaya Beauty. Tüm hakları saklıdır.
                    </p>
                    <p class="text-sm text-gray-500 mt-1">
                        Powered by <a href="{{ route('home') }}" class="hover:text-pink-300">CetinScope</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @livewireScripts
</body>

</html>