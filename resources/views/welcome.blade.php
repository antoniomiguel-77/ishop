<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>iShop - Loja Online</title>

    {{-- Vite / Tailwind --}}
    @vite('resources/css/app.css')

    {{-- Flowbite --}}
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    {{-- Font Awesome (usar apenas 1 import para performance) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/fontawesome.min.css" />

    {{-- CSS customizado --}}
    <style>
        html {
            scroll-behavior: smooth;
        }

        @keyframes floating {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .floating {
            animation: floating 2s ease-in-out infinite;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 antialiased">

    @include('livewire.welcome.navigation')

    {{-- 🛒 Botões Flutuantes (Carrinho + WhatsApp) --}}
    <div class="fixed bottom-5 right-5 flex flex-col gap-3 z-50">
        {{-- Carrinho --}}
        <button
            class="relative flex items-center justify-center w-14 h-14 rounded-full bg-blue-600 text-white shadow-lg hover:bg-blue-700 transition transform hover:scale-105 focus:outline-none">
            <i class="fa-solid fa-cart-shopping text-xl"></i>
            <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs font-semibold rounded-full px-2 py-0.5"
                id="nav-cart-badge">
                0
            </span>
        </button>

        {{-- WhatsApp --}}
        <a href="https://wa.me/244900000000" target="_blank"
            class="flex items-center justify-center w-14 h-14 rounded-full bg-green-500 text-white shadow-lg hover:bg-green-600 transition transform hover:scale-105 focus:outline-none">
            <i class="fa-brands fa-whatsapp text-2xl"></i>
        </a>
    </div>



    {{-- HERO --}}
    <header class="bg-gray-100 pt-24 pb-16">
        <div class="max-w-screen-xl mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">Bem-vindo à <span
                    class="text-blue-600">iShop</span></h1>
            <p class="text-gray-600 mb-6 max-w-2xl mx-auto">Produtos tecnológicos de qualidade, entrega rápida e preços
                competitivos.</p>
            <a href="#produtos"
                class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">Explorar
                Produtos</a>
        </div>
    </header>

    {{-- SOBRE --}}
    <section id="sobre" class="bg-white py-16">
        <div class="max-w-screen-xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Sobre Nós</h2>
                <p class="text-gray-600 leading-relaxed">
                    A <span class="text-blue-600 font-semibold">iShop</span> nasceu para facilitar o acesso à tecnologia
                    em Angola.
                    Trabalhamos com marcas confiáveis e envio para todo o país.
                </p>
            </div>
            <div class="flex justify-center">
                <img src="{{ asset('about.png') }}" alt="Loja iShop"
                    class="rounded-2xl shadow-lg w-64 h-64 object-cover floating">
            </div>
        </div>
    </section>



    {{-- PRODUTOS (Livewire) --}}
    <main id="produtos" class="py-16">
        <div class="max-w-screen-xl mx-auto px-4">
            @livewire('pages.site.product')
        </div>
    </main>

    {{-- CONTACTO --}}
    @livewire('pages.site.contact')

    {{-- FOOTER --}}
    <footer class="bg-white border-t border-gray-200 mt-16">
        <div class="max-w-screen-xl mx-auto px-4 py-10 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">iShop</h3>
                <p class="text-gray-500 text-sm">Produtos originais, entrega rápida e suporte dedicado.</p>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Links</h3>
                <ul class="space-y-2 text-gray-600 text-sm">
                    <li><a href="#produtos" class="hover:text-blue-600 transition">Produtos</a></li>
                    <li><a href="#sobre" class="hover:text-blue-600 transition">Sobre Nós</a></li>
                    <li><a href="#contacto" class="hover:text-blue-600 transition">Fale Connosco</a></li>
                    <li><a href="#" class="hover:text-blue-600 transition">Termos & Condições</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Contacto</h3>
                <ul class="space-y-2 text-gray-600 text-sm">
                    <li>📍 Luanda, Angola</li>
                    <li>📞 +244 945 532 271</li>
                    <li>✉️ suporte@ishop.com</li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-200 text-center py-4 text-sm text-gray-500">
            © <span id="year"></span> iShop. Todos os direitos reservados.
        </div>
    </footer>
</body>

</html>
