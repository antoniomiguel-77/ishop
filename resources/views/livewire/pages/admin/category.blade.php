<div>
    <!-- Modal -->
    <div x-show="showModalCategory" x-transition id="categoryModal"
        class="fixed inset-0 z-[9999] flex items-center justify-center bg-black bg-opacity-50" style="display: none;">

        <!-- Conteúdo da Modal -->
        <div class="bg-white rounded-lg shadow-lg max-w-3xl w-full p-6 overflow-y-auto max-h-screen" @click.away.stop>
            <!-- Header -->
            <div class="flex justify-between items-center border-b pb-3">
                <h3 class="text-xl font-semibold text-gray-900">
                    {{-- {{ $category_id != null ? 'Editar' : 'Adicionar' }} Categoria --}}
                </h3>
                <button @click="showModalCategory = false"
                    class="text-gray-500 hover:text-gray-900 text-lg font-bold">✕</button>
            </div>

            <!-- Formulário -->
            <div class="mt-4 space-y-4 text-gray-600">
                <form class="mx-auto">
                    <div class="flex flex-col md:flex-row gap-4 mb-5">
                        <!-- Nome -->
                        <div class="w-full">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">
                                Nome <span class="text-red-600">*</span>
                            </label>
                            <input type="text" id="name" wire:model="name"
                                class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Informe a categoria" />
                            @error('name')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Botões -->
                    <div class="flex justify-end mt-4 space-x-3">


                        <button type="button"
                            @click="
                        @this.set('category_id', null);
                        @this.set('name', null)"
                            class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                            Cancelar
                        </button>
                        <button type="button" wire:click="saveCategory" wire:loading.attr="disabled" @click.stop
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

            <!-- Tabela de Categorias com Busca -->
            <div class="mt-8 border-t pt-4">
                <h4 class="text-lg font-medium text-gray-800 mb-4">Categorias Existentes</h4>

                <!-- Campo de Busca -->
                <div class="mb-4">
                    <input type="text" wire:model.live="search"
                        class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                        placeholder="Procurar categoria..." />
                </div>

                <!-- Tabela -->
                <div class="overflow-x-auto rounded-lg border border-gray-200 overflow-auto h-[30vh]">
                    <table class="min-w-full bg-white divide-y divide-gray-200 text-sm text-left text-gray-600">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 font-medium text-gray-900">Nome</th>
                                <th class="px-6 py-3 font-medium text-gray-900 text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 ">
                            @forelse($categories ?? [] as $category)
                                <tr>
                                    <td class="px-6 py-4">{{ $category->name }}</td>
                                    <td class="px-6 py-4 text-right space-x-2">

                                        <button type="button" wire:click="edit({{ $category->id }})"
                                            class="text-blue-600 hover:underline mr-2">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                        <button type="button" wire:click="confirm({{ $category->id }})"
                                            class="text-red-600 hover:underline">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="px-6 py-4 text-center text-gray-500">Nenhuma categoria
                                        encontrada.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
