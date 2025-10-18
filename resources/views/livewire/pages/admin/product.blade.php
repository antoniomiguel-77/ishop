<div x-data="{ showModalProd: false, showModalCategory: false,showModalGallery:false }" x-init="document.addEventListener('closeModal', () => { showModalProd = false }),
    document.addEventListener('closeModalCategory', () => { showModalCategory = false })">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            {{ __('Produtos') }}
        </h2>
    </x-slot>

    <div class="w-full p-4 sm:p-6 lg:p-8 bg-gray-50">
        <div class="max-w-8xl mx-auto bg-white rounded-2xl shadow-sm overflow-hidden">
            <!-- Header -->
            <div
                class="flex flex-col sm:flex-row justify-between gap-3 sm:items-center px-4 sm:px-6 py-4 border-b border-gray-200">
                <!-- Filtros e Pesquisa -->
                <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
                    <!-- Select Registros -->
                    <select wire:model.live.debounce.100ms="perPage"
                        class="rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm w-full sm:w-auto">
                        <option value="5">5 Registros</option>
                        <option value="20">20 Registros</option>
                        <option value="50">50 Registros</option>
                    </select>

                    <!-- Campo de pesquisa -->
                    <div class="relative w-full sm:w-72">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                            <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                                <path
                                    d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                                </path>
                            </svg>
                        </span>
                        <input type="search" wire:model.live.debounce.100ms="search"
                            placeholder="Pesquisar por descrição"
                            class="pl-8 pr-2 py-2 rounded-lg w-full border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                    </div>
                </div>

                <!-- Botão adicionar -->
                <div class="w-full sm:w-auto">
                    <button @click="showModalProd = true; $wire.clearField()"
                        class="w-full sm:w-auto inline-flex justify-center items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                        <i class="fas fa-plus-circle"></i>
                        <span>Novo Produto</span>
                    </button>
                </div>
            </div>


            <!-- Tabela -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-700">
                    <thead class="bg-gray-100 text-gray-800 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-3">Categoria</th>
                            <th class="px-6 py-3">Nome</th>
                            <th class="px-6 py-3">Preço (S/IVA)</th>
                            <th class="px-6 py-3">Preço (C/IVA)</th>
                            <th class="px-6 py-3">Quantidade</th>
                            <th class="px-6 py-3">Tipo</th>
                            <th class="px-6 py-3">Taxa</th>
                            <th class="px-6 py-3 text-right">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($products ?? [] as $item)
                            <tr>
                                <td class="px-6 py-3 truncate">
                                    <span class="uppercase font-medium">{{ $item->category->name ?? '-' }}</span>
                                </td>
                                <td class="px-6 py-3">
                                    <span class="uppercase font-medium">{{ $item->name }}</span><br>
                                    <small class="text-gray-500">{{ $item->code }}</small>
                                </td>
                                <td class="px-6 py-3 font-medium">@Money($item->price)</td>
                                <td class="px-6 py-3 font-medium">@Money($item->price_with_tax)</td>
                                <td class="px-6 py-3 font-medium">{{ (int) $item->quantity }}</td>
                                <td class="px-6 py-3">
                                    {{ $item->type == 'unit' ? 'Unidade' : 'Serviço' }}
                                    @if ($item->type == 'service')
                                        <br><small class="text-gray-500">Retenção: {{ $item->retention }}%</small>
                                    @endif
                                </td>
                                <td class="px-6 py-3">{{ $item->tax }}%</td>
                                <td class="px-6 py-3 text-right">
                                    <button @click="showModalProd = true;" wire:click="edit({{ $item->id }})"
                                        class="text-blue-600 hover:underline mr-2">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <button wire:click="confirm({{ $item->id }})"
                                        class="text-red-600 hover:underline">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                     <button @click="showModalGallery = true" wire:click="setProductId({{ $item->id }})"
                                        class="text-blue-600 hover:underline">
                                        <i class="fa-solid fa-images"></i>
                                    </button>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                    Nenhum produto/artigo encontrado
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Footer -->
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $products->links('components.custom-pagination') }}
            </div>
        </div>
    </div>

    @include('includes.product')
    @livewire('pages.admin.category')
    @livewire('pages.admin.gallery')
</div>


<script>
    document.addEventListener('resetSelect2', () => {
        $("#category").val(null).trigger("change");
        $("#category_modal_subcategory").val(null).trigger("change")
    })

    document.addEventListener('editProd', (event) => {
        let [categoryId, subcategoryId] = event.detail;
        $("#category").val(categoryId).trigger("change");
    })
</script>
