<div x-show="showModalProd" x-transition
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">

    <!-- Conteúdo da Modal -->
    <div class="bg-white rounded-lg shadow-lg max-w-4xl w-full p-6" @click.away.stop>

        <!-- Header -->
        <div class="flex justify-between items-center border-b pb-3">
            <h3 class="text-xl font-semibold text-gray-900">
                {{ $product_id != null ? 'Editar' : 'Adicionar' }} Produto
            </h3>
            <button @click="showModalProd = false; " class="text-gray-500 hover:text-gray-900 text-lg font-bold">
                ✕
            </button>
        </div>

        <!-- Body -->
        <div class="mt-4 space-y-4 text-gray-600">
            <form class="mx-auto">
                <div class="flex flex-col md:flex-row gap-4 mb-5">
                    <!-- Nome -->
                    <div class="w-full md:w-1/2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">
                            Descrição <span class="text-red-600">*</span>
                        </label>
                        <input type="text" id="name" wire:model="name"
                            class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Nome do Cliente" />
                        @error('name')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- preco -->
                    <div class="w-full md:w-1/2" x-data="{}">
                        <label for="taxpayer" class="block mb-2 text-sm font-medium text-gray-900">
                            Preço <span class="text-red-600">*</span>
                        </label>
                        <input type="text" id="price" wire:model="price"
                            x-mask:dynamic="$money($input, '.', '',2)"
                            class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="0.00" />
                        @error('price')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col md:flex-row gap-4 mb-5">


                    <div class="w-full md:w-1/2" x-data="{}">
                        <label for="taxpayer" class="block mb-2 text-sm font-medium text-gray-900">
                            Quantidade <span class="text-red-600">*</span>
                        </label>
                        <input type="text" id="price" wire:model="qtd"
                            x-mask:dynamic="$money($input, '.', '',2)"
                            class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="0.00" />
                        @error('qtd')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Categoria -->
                    <div class="w-full md:w-1/2">
                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900">Categoria<span
                                class="text-red-500">*</span></label>
                        <div class="flex my-2 rounded-lg overflow-hidden shadow-sm">
                            <div class="flex-1">
                                <select id="category"
                                    class="w-full border border-r-0 rounded-l-lg px-3 py-2 focus:ring-0 focus:outline-none">
                                    <option value="">Selecionar Categoria...</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- este botão já não é re-renderizado pelo Livewire --}}
                            <button type="button" @click="showModalCategory = true"
                                class="bg-gray-900 hover:bg-gray-700 text-white px-3 rounded-r-lg flex items-center justify-center">
                                <i class="fas fa-plus-circle"></i>
                            </button>
                        </div>
                        @error('category_id')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>












                </div>

                <div class="flex flex-col md:flex-row gap-4 mb-5" x-data="{
                    tax: @entangle('tax'),
                    reason_id: @entangle('reason_id'),
                    disableReason: false
                }" x-init="$watch('tax', value => {
                    let numeric = parseFloat(
                        (value || '0').toString().replace(/\./g, '').replace(',', '.')
                    );
                
                    this.disableReason = numeric > 0;
                
                    if (this.disableReason) {
                        @this.set('reason_id', null); // limpar campo
                    }
                })
                
                // Verifica o valor inicial no carregamento
                let numeric = parseFloat(
                    (tax || '0').toString().replace(/\./g, '').replace(',', '.')
                );
                this.disableReason = numeric > 0;">
                    <!-- Type -->
                    <div class="w-full md:w-1/2">
                        <label for="type" class="block mb-2 text-sm font-medium text-gray-900 ">Tipo (Produto ou
                            Serviço)</label>
                        <select id="type" wire:model='type'
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                            <option selected value="unit">Produto</option>
                            <option value="service">Serviço</option>

                        </select>
                        @error('type')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Taxa/IVA -->
                    <div class="w-full md:w-1/2">
                        <label for="tax" class="block mb-2 text-sm font-medium text-gray-900">
                            Taxa/Iva <span class="text-red-600">*</span>
                        </label>
                        <input type="text" id="tax" wire:model.live="tax"
                            class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="0.00" />
                        @error('tax')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                        <div class="flex items-center space-x-2 mt-2">
                            <span class="text-sm text-gray-600 font-medium">Regime atual:</span>
                            <span class="bg-blue-100 text-blue-800 text-sm font-semibold px-2 py-1 rounded-lg">
                                {{ auth()->user()->company->regime }}
                            </span>
                        </div>
                    </div>
                </div>


                <!-- Razões de isenção -->
                <div class="w-full mb-5">
                    <label for="reason_id" class="block mb-2 text-sm font-medium text-gray-900">Motivo de Isenção de
                        IVA</label>
                    <select id="reason_id" wire:model="reason_id" x-bind:disabled="this.disableReason"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="">==Selecionar==</option>
                        @forelse ($taxReasons as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @empty
                            <option selected value="unit">Não Disponível</option>
                        @endforelse
                    </select>
                    @error('reason_id')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Footer -->
                <div class="flex justify-end mt-6 space-x-3">
                    <button type="button" @click="showModalProd = false"
                        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                        Cancelar
                    </button>
                    <button type="button" wire:click="saveProd" wire:loading.attr="disabled" @click.stop
                        class="bg-gray-900 text-white px-4 py-2 rounded hover:bg-gray-700 flex items-center justify-center">
                        <svg wire:loading wire:target="save" class="animate-spin h-4 w-4 text-white"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                        <span>Salvar</span>

                    </button>
                </div>
            </form>
        </div>

    </div>


</div>
<script>
    initSelect2('#category', 'category_id', null);
    initSelect2('#subcategory', 'subcategory_id', null)
    initSelect2('#category_modal_subcategory', 'category_id', null)
</script>
