<div x-show="showModalGallery" x-transition
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">

    <!-- Conteúdo da Modal -->
    <div class="bg-white rounded-lg shadow-lg max-w-4xl w-full p-6" @click.away.stop>

        <!-- Header -->
        <div class="flex justify-between items-center border-b pb-3">
            <h3 class="text-xl font-semibold text-gray-900">
                Galeria de Imagens
            </h3>
            <button @click="showModalGallery = false" class="text-gray-500 hover:text-gray-900 text-lg font-bold">
                <i class="fa fa-times-circle"></i>
            </button>
        </div>

        <!-- Body -->
        <div class="mt-4 space-y-4 text-gray-600">

            <!-- Upload -->
            <div class="space-y-2">
                <label class="block mb-1 text-sm font-semibold text-gray-700">Selecionar Imagens</label>

                <!-- Container customizado do input -->
                <div class="flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-lg p-6 cursor-pointer hover:border-blue-500 hover:bg-gray-50 transition"
                    x-data @click="$refs.fileInput.click()">
                    <svg class="w-12 h-12 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M16 12l-4-4-4 4m4-4v12" />
                    </svg>
                    <p class="text-gray-500 text-sm">Clique aqui para carregar as imgagens que deseja enviar</p>
                    <input type="file" wire:model="images" multiple class="hidden" x-ref="fileInput">
                </div>

                @error('images.*')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror

                <!-- Progress Bar elegante -->
                <div wire:loading wire:target="images" class="mt-2">
                    <p class="text-sm text-gray-600 mb-1">Enviando imagens...</p>
                    <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                        <div class="bg-blue-600 h-3 rounded-full transition-all duration-500 ease-out"
                            style="width: {{ $uploadProgress ?? 0 }}%">
                        </div>
                    </div>
                </div>
            </div>


            <!-- Lista de Imagens Salvas -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-4">
                @forelse ($existingImages as $img)
                    <div class="relative border rounded-lg p-2 flex flex-col">
                        <img src="{{ $img->image }}" alt="Imagem"
                            class="w-full h-32 md:h-40 object-cover rounded-lg">

                        <!-- Toggle is_main_image e botão remover -->
                        <div class="flex justify-between items-center mt-2">
                            <label class="flex items-center space-x-2 text-sm">
                                <input data-id="{{ $img->id }}" type="checkbox"
                                    wire:click="toggleMainImage({{ $img->id }})"
                                    {{ $img->is_main_image ? 'checked' : '' }}
                                    class="form-checkbox h-4 w-4 main-image-checkbox">
                                <span>Tornar principal</span>
                            </label>

                            <button wire:click="confirmDelete({{ $img->id }})"
                                class="text-red-500 hover:text-red-700 text-sm">
                                Remover
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-gray-400 w-[100%] ">Nenhuma Imagem</div>
                @endforelse
            </div>


        </div>

        <!-- Footer -->
        <div class="flex justify-end mt-6 space-x-3">
            <button type="button" @click="showModalGallery = false"
                class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                Cancelar
            </button>
            <button type="button" wire:click="uploadImages" wire:loading.attr="disabled"
                class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                <svg wire:loading wire:target="uploadImages" class="animate-spin h-4 w-4 text-white"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                </svg>
                <span>Salvar</span>
            </button>
        </div>
    </div>

</div>


<script>
    document.addEventListener('updatedCheck', (event) => {

        const id = event.detail[0]['id'];

        document.querySelectorAll('.main-image-checkbox').forEach(cb => {
            cb.checked = false;
        });


        const selected = document.querySelector(`.main-image-checkbox[data-id="${id}"]`);
        if (selected) selected.checked = true;
    });
</script>
