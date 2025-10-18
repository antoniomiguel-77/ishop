{{-- 🪄 MODAL DETALHES DO PRODUTO --}}
<div wire:ignore.self id="modalProduto" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex justify-center items-center bg-black/50 p-4">
    <div class="relative w-full max-w-5xl max-h-[90vh] overflow-y-auto">
        <div class="bg-white rounded-2xl shadow-xl p-6">

            {{-- Botão Fechar --}}
            <button type="button"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-900 hover:bg-gray-200 rounded-full w-10 h-10 flex items-center justify-center"
                data-modal-hide="modalProduto">
                <i class="fa fa-times-circle text-red-500 text-xl"></i>
            </button>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                {{-- 🖼 Galeria de Imagens --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @forelse($detail->gallery ?? [] as $img)
                        <div class="w-full overflow-hidden rounded-lg">
                            <img src="{{ $img->image }}" alt="Imagem do produto"
                                class="w-full h-64 object-cover rounded-lg transition-transform duration-300 hover:scale-105">
                        </div>
                    @empty
                        <div class="w-full overflow-hidden rounded-lg">
                            <img src="{{ asset('ishop-without-bg.png') }}" alt="Imagem do produto"
                                class="w-full h-64 object-cover rounded-lg">
                        </div>
                    @endforelse
                </div>

                {{-- 📝 Detalhes do Produto --}}
                <div class="flex flex-col justify-between">
                    <div>
                        <h3 id="modalNome" class="text-3xl font-bold text-gray-900 mb-4">
                            {{ $detail->name ?? '' }}
                        </h3>
                        <p id="modalPreco" class="text-blue-600 text-2xl font-semibold mb-4">
                            @Money($detail->priceWithTax ?? 0)
                        </p>
                        <p id="modalDescricao" class="text-gray-700 text-sm mb-6 leading-relaxed">
                            {{ $detail->description ?? '' }}
                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row items-center sm:items-end gap-4 mt-6">
                        <input type="number" id="modalQuantidade" min="1" value="1"
                            class="w-24 border rounded-lg px-3 py-2 focus:ring-green-500 focus:border-green-500">
                        <button
                            class="flex-1 bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition font-semibold">
                            Comprar Agora
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>