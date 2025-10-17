<section id="produtos" class="py-16 bg-gray-50 transition-colors duration-300">
    <div class="max-w-screen-xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-10 text-gray-800">Produtos em Destaque</h2>

        <div class="flex flex-col md:flex-row items-center justify-between mb-8 gap-4">
            <div class="w-full md:w-1/2">
                <input type="text" id="searchInput" onkeyup="filterProducts()"
                    placeholder="Pesquisar por nome..."
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none transition">
            </div>

            <div>
                <select id="categoryFilter" onchange="filterProducts()"
                    class="px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none transition">
                    <option value="">Todas Categorias</option>
                    <option value="Smartphones">Smartphones</option>
                    <option value="Computadores">Computadores</option>
                    <option value="Acessórios">Acessórios</option>
                    <option value="Relógios">Relógios</option>
                </select>
            </div>
        </div>

        <div id="productsGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ([
                ['nome' => 'iPhone 14', 'categoria' => 'Smartphones', 'preco' => '1.200.000 AKZ', 'imagem' => 'https://via.placeholder.com/300'],
                ['nome' => 'Macbook Pro', 'categoria' => 'Computadores', 'preco' => '2.800.000 AKZ', 'imagem' => 'https://via.placeholder.com/300'],
                ['nome' => 'AirPods Pro', 'categoria' => 'Acessórios', 'preco' => '180.000 AKZ', 'imagem' => 'https://via.placeholder.com/300'],
                ['nome' => 'Apple Watch', 'categoria' => 'Relógios', 'preco' => '250.000 AKZ', 'imagem' => 'https://via.placeholder.com/300']
            ] as $produto)
                <div data-name="{{ strtolower($produto['nome']) }}" data-category="{{ $produto['categoria'] }}"
                    class="product-card bg-white border border-gray-200 rounded-lg shadow hover:shadow-xl hover:-translate-y-1 transition transform duration-200">
                    <img src="{{ $produto['imagem'] }}" alt="{{ $produto['nome'] }}"
                        class="rounded-t-lg w-full h-48 object-cover">
                    <div class="p-4">
                        <h5 class="text-lg font-semibold mb-1 text-gray-800 truncate">{{ $produto['nome'] }}</h5>
                        <span class="text-sm text-gray-500 block mb-2">{{ $produto['categoria'] }}</span>
                        <p class="text-blue-600 font-bold mb-4">{{ $produto['preco'] }}</p>
                        <div class="flex justify-between">
                            <button onclick="addToCart('{{ $produto['nome'] }}')"
                                class="flex-1 mr-2 text-white bg-green-600 hover:bg-green-700 px-3 py-2 rounded-lg text-sm transition">
                                Adicionar
                            </button>
                            <button data-modal-target="modalProduto" data-modal-toggle="modalProduto"
                                onclick="showProductModal('{{ $produto['nome'] }}', '{{ $produto['preco'] }}', ['{{ $produto['imagem'] }}'])"
                                class="flex-1 ml-2 text-white bg-blue-600 hover:bg-blue-700 px-3 py-2 rounded-lg text-sm transition">
                                Detalhes
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @include('includes.detail-product-modal')
</section>

<script>
    function filterProducts() {
        const search = document.getElementById('searchInput').value.toLowerCase();
        const category = document.getElementById('categoryFilter').value;
        const cards = document.querySelectorAll('.product-card');

        cards.forEach(card => {
            const name = card.getAttribute('data-name');
            const cardCategory = card.getAttribute('data-category');

            const matchName = name.includes(search);
            const matchCategory = category === '' || cardCategory === category;

            if (matchName && matchCategory) {
                card.classList.remove('hidden');
            } else {
                card.classList.add('hidden');
            }
        });
    }
</script>
