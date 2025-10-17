<div x-show="showModal" x-cloak x-transition role="dialog" aria-modal="true" aria-labelledby="modalTitle"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">

    <!-- Modal Content -->
    <div class="bg-white rounded-lg shadow-lg max-w-2xl w-full p-6" @click.away.stop>

        <!-- Header -->
        <div class="flex justify-between items-center border-b pb-3">
            <h3 id="modalTitle" class="text-xl font-semibold text-gray-900">
                {{ $user_id != null ? 'Editar' : 'Adicionar' }} Utilizador
            </h3>
            <button @click="showModal = false" aria-label="Fechar"
                class="text-gray-500 hover:text-gray-900 text-lg font-bold">
                ✕
            </button>
        </div>

        <!-- Body -->
        <div class="mt-4 space-y-4 text-gray-600">
            <form class="mx-auto" @submit.prevent="">

                <div class="flex flex-col md:flex-row gap-4 mb-5">
                    <!-- Nome -->
                    <div class="w-full md:w-1/2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">
                            Nome <span class="text-red-600">*</span>
                        </label>
                        <input type="text" id="name" wire:model="name" x-ref="name"
                            class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Nome do Cliente" />
                        @error('name')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="w-full md:w-1/2">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">
                            E-mail
                        </label>
                        <input type="email" id="email" wire:model="email"
                            class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="exemplo@gmail.com" />
                        @error('email')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Password Fields -->
                <div x-data="{ showPassword: false, showConfirm: false }" x-init="$nextTick(() => $refs.name.focus())" class="flex flex-col md:flex-row gap-4 mb-5">
                    <!-- Senha -->
                    <div class="w-full md:w-1/2">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">
                            Senha <span class="text-red-600">*</span>
                        </label>
                        <div class="relative">
                            <input :type="showPassword ? 'text' : 'password'" id="password" wire:model.defer="password"
                                class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pr-10"
                                placeholder="Digite a senha" />
                            <span @click="showPassword = !showPassword"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-600 cursor-pointer">
                                <template x-if="!showPassword">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </template>
                                <template x-if="showPassword">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.965 9.965 0 012.211-3.592M6.18 6.18A9.969 9.969 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.958 9.958 0 01-4.105 5.192M15 12a3 3 0 00-4.243-4.243M3 3l18 18" />
                                    </svg>
                                </template>
                            </span>
                        </div>
                        @error('password')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Confirmar Senha -->
                    <div class="w-full md:w-1/2">
                        <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">
                            Confirmar Senha
                        </label>
                        <div class="relative">
                            <input :type="showConfirm ? 'text' : 'password'" id="password_confirmation"
                                wire:model.defer="password_confirmation"
                                class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pr-10"
                                placeholder="Repita a senha" />
                            <span @click="showConfirm = !showConfirm"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-600 cursor-pointer">
                                <template x-if="!showConfirm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </template>
                                <template x-if="showConfirm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.965 9.965 0 012.211-3.592M6.18 6.18A9.969 9.969 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.958 9.958 0 01-4.105 5.192M15 12a3 3 0 00-4.243-4.243M3 3l18 18" />
                                    </svg>
                                </template>
                            </span>
                        </div>
                        @error('password_confirmation')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Funções -->
                <div x-data="{ roles: @entangle('roles').defer }">
                    <div class="grid md:grid-cols-3 gap-4">
                        @foreach ($roles as $role)
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" :value="`{{ $role->name }}`" x-model="roles"
                                    class="sr-only peer">

                                <div
                                    class="relative w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-blue-600">
                                </div>

                                <span class="ms-2 text-sm font-medium text-gray-900">{{ $role->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>


                <!-- Footer -->
                <div class="flex justify-end mt-6 space-x-3">
                    <button type="button" @click="showModal = false"
                        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                        Cancelar
                    </button>
                    <button type="button" wire:click="save" wire:loading.attr="disabled"
                        class="bg-gray-900 text-white px-4 py-2 rounded hover:bg-gray-700 flex items-center justify-center">
                        <svg wire:loading wire:target="save" class="animate-spin h-4 w-4 text-white mr-2"
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
