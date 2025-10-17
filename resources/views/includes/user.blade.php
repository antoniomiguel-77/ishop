<div 
    x-show="showModalUser"
    x-transition
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
    style="display: none;"
>

    <!-- Conteúdo da Modal -->
    <div class="bg-white rounded-lg shadow-lg max-w-4xl w-full p-6" @click.away.stop>

        <!-- Header -->
        <div class="flex justify-between items-center border-b pb-3">
            <h3 class="text-xl font-semibold text-gray-900">
                {{ $user_id != null ? 'Editar' : 'Adicionar' }} Utilizador
            </h3>
            <button @click="showModalUser = false; " class="text-gray-500 hover:text-gray-900 text-lg font-bold">
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
                            Nome <span class="text-red-600">*</span>
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
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">
                            E-mail <span class="text-red-600">*</span>
                        </label>
                        <input type="email" id="email" wire:model="email"
                            class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="example@gmail.com" />
                        @error('email')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

          

                

                <!-- Footer -->
                <div class="flex justify-end mt-6 space-x-3">
                    <button type="button" @click="showModalProd = false"
                        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                        Cancelar
                    </button>
                    <button type="button" wire:click="saveUser" wire:loading.attr="disabled" @click.stop
                        class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
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
</script>
