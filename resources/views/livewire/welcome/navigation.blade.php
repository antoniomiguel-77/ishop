{{-- NAVBAR --}}
    <nav class="bg-white/80 backdrop-blur-md border-b shadow-sm fixed w-full z-20 top-0 left-0">
        <div class="max-w-screen-xl mx-auto px-4 py-3 flex items-center justify-between">
            {{-- 🏪 Logo --}}
            <a href="/" class="flex items-center gap-2">
                <span class="text-2xl font-bold text-blue-600">iShop</span>
            </a>

            {{-- 📌 Links centrais --}}
            <div class="hidden md:flex items-center gap-6 text-sm font-medium text-gray-600">
                <a href="#produtos" class="hover:text-blue-600 transition">Produtos</a>
                <a href="#sobre" class="hover:text-blue-600 transition">Sobre Nós</a>
                <a href="#contacto" class="hover:text-blue-600 transition">Contactos</a>
            </div>

            {{-- 🔐 Ações de autenticação --}}
            <div class="flex items-center gap-3">
                <a href="/login" class="text-gray-700 hover:text-blue-600 font-medium text-sm transition">
                    Entrar
                </a>
                <a href="/register"
                    class="bg-blue-600 text-white text-sm font-medium px-4 py-2 rounded-lg shadow-sm hover:bg-blue-700 transition">
                    Registrar
                </a>
            </div>
        </div>
    </nav>