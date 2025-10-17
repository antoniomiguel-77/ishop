<div x-data="{ showModalProd: false, showModalCategory: false, showModalSubcategory: false }" x-init="document.addEventListener('closeModal', () => { showModal = false }),
    document.addEventListener('closeModalCategory', () => { showModalCategory = false }),
    document.addEventListener('closeModalSubcategory', () => { showModalSubcategory = false })">

    @livewire('admin.subcategory')

    <div class="mt-6">
        <h3 class="text-gray-700 text-3xl font-medium">Meus Artigos/Serviços</h3>

        <!-- Filtros e botão -->
        <div class="mt-3 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <!-- Filtro e pesquisa -->
            <div class="flex flex-col sm:flex-row sm:items-center gap-2">
                <!-- Select -->
                <div class="relative w-full sm:w-48">
                    <select wire:model.live.debounce.100ms="perPage"
                        class="appearance-none h-full rounded border block w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option value="5">5 Registros</option>
                        <option value="20">20 Registros</option>
                        <option value="50">50 Registros</option>
                    </select>

                </div>

                <!-- Campo de pesquisa -->
                <div class="relative w-full sm:w-96">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                        <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                            <path
                                d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                            </path>
                        </svg>
                    </span>
                    <input placeholder="Pesquisar por, descrição, categoria e subcategoria"
                        wire:model.live.debounce.100ms="search" type="search" id="search"
                        class="appearance-none rounded border border-gray-400 block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:outline-none focus:bg-white focus:placeholder-gray-600 focus:text-gray-700" />
                </div>
            </div>

            <!-- Botão de adição -->
            <button @click="showModalProd = true;$wire.clearField()" type="button"
                class="px-4 py-2 text-sm font-medium bg-gray-900 text-white rounded hover:bg-gray-700 transition duration-150">
                Novo Artigo
            </button>

        </div>

        <!-- Tabela -->
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                <table class="min-w-full w-full leading-normal table-auto">
                    <thead>
                        <tr>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Categoria
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Nome
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Preço Unitário <br> <span class="text-[8px] text-center text-red-700">(Sem Iva)</span>
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Preço Unitário <br> <span class="text-[8px] text-center text-red-700">(Com Iva)</span>
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Tipo
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Taxa/Iva
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Ações
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($products as $item)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm truncate max-w-xs">
                                    <span class="uppercase">{{ $item->category->name }}
                                    </span>
                                    <br>
                                    <strong>Sub.:</strong> <span>{{ $item->subcategory->name }}</span> <br>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm truncate max-w-xs">
                                    <span class="uppercase">{{ $item->name }}</span> <br>
                                    <strong>{{ $item->code }} </strong>

                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <strong>@Money($item->price)</strong>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <strong>@Money($item->price_with_tax)</strong>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm break-words max-w-xs">
                                    <span>{{ $item->type == 'unit' ? 'Unidade' : 'Serviço' }}</span><br>
                                    @if ($item->type == 'service')
                                        <strong>Retenção:{{ $item->retention }}</span>
                                    @endif
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm break-words max-w-xs">
                                    {{ $item->tax }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex flex-col sm:flex-row gap-1">
                                        <button @click="showModalProd = true;" wire:click="edit({{ $item->id }})"
                                            type="button"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded hover:bg-gray-800 hover:text-white focus:ring-2 focus:ring-gray-700">
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                            </svg>
                                        </button>

                                        <button type="button" wire:click="confirm({{ $item->id }})"
                                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded hover:bg-red-500 hover:text-white focus:ring-2 focus:ring-red-700">
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7"
                                    class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                    Nenhum produto/artigo encontrado.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Paginação -->
                <div x-transition.opacity.duration.300ms
                    class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
                    {{-- Paginação --}}
                    {{ $products->links('components.custom-pagination') }}
                </div>
            </div>
        </div>

        @livewire('admin.category')
        @include('livewire.admin.modals.product')
    </div>
</div>


<script>
    document.addEventListener('resetSelect2', () => {
        $("#category").val(null).trigger("change");
        $("#subcategory").val(null).trigger("change")
        $("#category_modal_subcategory").val(null).trigger("change")
    })

    document.addEventListener('editSubcategory', (event) => {
        let categoryId = event.detail;
        $("#category_modal_subcategory").val(categoryId).trigger("change")
    })

    document.addEventListener('editProd', (event) => {
        let [categoryId, subcategoryId] = event.detail;
        $("#category").val(categoryId).trigger("change");
        $("#subcategory").val(subcategoryId).trigger("change")
    })
</script>
