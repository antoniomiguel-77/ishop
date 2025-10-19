<section id="produtos" class="py-16 bg-gray-50 transition-colors duration-300">
    <div class="max-w-screen-xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-10 text-gray-800">Produtos em Destaque</h2>

        <div class="flex flex-col md:flex-row items-center justify-between mb-8 gap-4">
            <div class="w-full md:w-1/2">
                <input type="text" id="searchInput" wire:model.live.200ms="search" placeholder="Pesquisar por nome..."
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none transition">
            </div>

            <div>
                <select id="categoryFilter" wire:model.live.200ms="category"
                    class="px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none transition">
                    <option value="0">Todas Categorias</option>
                    @forelse($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @empty
                        <option value="">Nenhum Categoria Encontrada</option>
                    @endforelse
                </select>
            </div>
        </div>

        <div id="productsGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">


            @forelse($products as $prod)
                <div data-name="{{ strtolower($prod->name) }}" data-category="{{ $prod->category->name }}"
                    class="product-card bg-white border border-gray-200 rounded-lg shadow hover:shadow-xl hover:-translate-y-1 transition transform duration-200">
                    <img src="{{ $this->getMainImage($prod->id) == null ? asset('ishop-without-bg.png') : $this->getMainImage($prod->id) }}"
                        alt="{{ $prod->name }}" class="rounded-t-lg w-full h-48 object-cover">
                    <div class="p-4">
                        <h5 class="text-lg font-semibold mb-1 text-gray-800 truncate">{{ $prod->name }}</h5>
                        <span class="text-sm text-gray-500 block mb-2">{{ $prod->category->name }}</span>
                        <p class="text-blue-600 font-bold mb-4">@Money($prod->priceWithTax)</p>
                        <span
                            class="inline-flex items-center mb-2 justify-center px-3 py-1 text-sm font-semibold text-white bg-blue-600 rounded-full">
                            Qtd: {{ $prod->quantity }}
                        </span>
                        <div class="flex justify-between">
                            <button type="button" wire:click="addToCar({{ $prod->id }})" wire:loading.attr="disabled"
                                wire:target="addToCar({{ $prod->id }})"
                                class="flex-1 mr-2 text-white bg-green-600 hover:bg-green-700 px-3 py-2 rounded-lg text-sm transition">
                                <i wire:loading wire:target="addToCar({{ $prod->id }})" class="fa fa-spinner fa-spin"></i>
                                Adicionar
                            </button>
                            <button data-modal-target="modalProduto" data-modal-toggle="modalProduto"
                                wire:click="getDetail({{ $prod->id }})"
                                class="flex-1 ml-2 text-white bg-blue-600 hover:bg-blue-700 px-3 py-2 rounded-lg text-sm transition">
                                Detalhes
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div>
                    <h2>Nenhum Produto Encontrado</span>
                </div>
            @endforelse
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