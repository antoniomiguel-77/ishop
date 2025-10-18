{{-- 🛒 MODAL DE CHECKOUT --}}
<div wire:ignore.self id="checkoutModal" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 overflow-y-auto">
    <div class="relative w-full max-w-5xl max-h-[95vh]">
        <div class="bg-white rounded-xl shadow-2xl p-8 overflow-y-auto max-h-[95vh]">

            {{-- Botão fechar --}}
            <button type="button" class="absolute top-5 right-5 text-gray-500 hover:text-gray-900"
                data-modal-hide="checkoutModal">
                <i class="fa fa-times text-2xl"></i>
            </button>

            <h2 class="text-3xl font-bold text-gray-800 mb-6">Seu Carrinho de Compras</h2>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Lista de produtos --}}
                <div class="lg:col-span-2 divide-y divide-gray-200">
                    @forelse($cartItems as $item)
                        <div class="flex items-center py-4">
                            <img src="{{ $this->getMainImage($item->id) ?? asset('ishop-without-bg.png') }}"
                                alt="{{ $item->name }}" class="w-24 h-24 object-cover rounded-lg mr-4">
                            <div class="flex-1">
                                <h3 class="text-gray-900 font-semibold">{{ $item->name }}</h3>
                                <p class="text-gray-500 text-sm">Preço: @Money($item->price)</p>
                                <div class="flex items-center space-x-2 mt-2">
                                    <input type="number" min="1"
                                        wire:input="updateQuantity({{ $item->id }}, $event.target.value)"
                                        wire:model="qtd.{{ $item->id }}"
                                        class="w-20 border rounded px-2 py-1 text-sm focus:ring-green-500 focus:border-green-500">

                                </div>
                            </div>
                            <div class="ml-4 text-right">
                                <p class="text-gray-900 font-semibold">@Money((float)$subtotal[$item->id])</p>
                                <button wire:click="removeItem({{ $item->id }})"
                                    class="text-red-500 hover:text-red-700 text-sm mt-1">
                                    Remover
                                </button>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-10">O carrinho está vazio.</p>
                    @endforelse
                </div>

                {{-- Resumo e total --}}
                <div class="bg-gray-50 rounded-lg p-6 flex flex-col justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Resumo do Pedido</h3>
                        <ul class="divide-y divide-gray-200">
                            @foreach($cartItems as $item)
                                <li class="py-2 flex justify-between text-gray-700">
                                    <span>{{ $item->name }} x {{ $item->quantity }}</span>
                                    <span>@Money((float)$subtotal[$item->id])</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- Total --}}
                    <div
                        class="mt-6 border-t border-gray-200 pt-4 flex justify-between items-center text-lg font-bold text-gray-900">
                        <span>Total:</span>
                        <span class="text-green-600">@Money($total)</span>
                    </div>

                    {{-- Botão finalizar compra --}}
                    <div class="mt-6">
                        <button wire:click="checkout" wire:loading.attr="disabled"
                            class="w-full bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition flex items-center justify-center">
                            <i wire:loading wire:target="checkout" class="fa fa-spinner fa-spin mr-2"></i>
                            Finalizar Compra
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>