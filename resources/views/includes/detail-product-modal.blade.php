{{-- 🪄 MODAL DETALHES DO PRODUTO --}}
<div id="modalProduto" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-3xl max-h-full">
        <div class="relative bg-white rounded-lg shadow-lg ">
            {{-- Botão Fechar --}}
            <button type="button"
                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 
                rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center"
                data-modal-hide="modalProduto">
                <i class="fa fa-times-circle text-red-500"></i>
            </button>

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div id="carouselProduto" class="relative w-full" data-carousel="static">
                    <!-- Carousel wrapper -->
                    <div class="relative h-64 overflow-hidden rounded-lg md:h-80">
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="https://via.placeholder.com/400" class="absolute block w-full h-full object-cover"
                                alt="Imagem do produto">
                        </div>
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="https://via.placeholder.com/400?text=Imagem+2"
                                class="absolute block w-full h-full object-cover" alt="Imagem do produto">
                        </div>
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="https://via.placeholder.com/400?text=Imagem+3"
                                class="absolute block w-full h-full object-cover" alt="Imagem do produto">
                        </div>
                    </div>

                    <!-- Slider controls -->
                    <button type="button"
                        class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                        data-carousel-prev>
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/50 group-hover:bg-white/70">
                            <svg class="w-4 h-4 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </span>
                    </button>
                    <button type="button"
                        class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                        data-carousel-next>
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/50 group-hover:bg-white/70">
                            <svg class="w-4 h-4 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </span>
                    </button>
                </div>

                {{-- 📝 Detalhes do Produto --}}
                <div class="flex flex-col justify-between">
                    <div>
                        <h3 id="modalNome" class="text-2xl font-bold text-gray-900  mb-2">
                            Nome do Produto
                        </h3>
                        <p id="modalPreco" class="text-blue-600 text-xl font-semibold mb-4">
                            0,00 AKZ
                        </p>
                        <p id="modalDescricao" class="text-gray-600  text-sm mb-4">
                            Descrição breve do produto, materiais, especificações, etc.
                        </p>
                    </div>

                    <div class="flex items-center space-x-3 mt-4">
                        <input type="number" id="modalQuantidade" min="1" value="1"
                            class="w-20 border rounded-lg px-2 py-2 focus:ring-green-500 focus:border-green-500  ">
                        <button
                            class="flex-1 bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700 transition">
                            Comprar Agora
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
