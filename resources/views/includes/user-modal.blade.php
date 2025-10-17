<!-- Modal Adicionar/Editar Usuário -->
<div
    x-data="{ open: @entangle('showModal') }"
    x-show="open"
    x-cloak
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
>
    <div class="bg-white rounded-2xl shadow-lg w-full max-w-md p-6 relative animate-fade-in">
        <!-- Botão fechar -->
        <button
            @click="open = false"
            class="absolute top-3 right-3 text-gray-500 hover:text-gray-800"
        >
            <i class="fas fa-times"></i>
        </button>

        <h2 class="text-lg font-bold text-gray-800 mb-4">
            {{ $isEditing ? 'Editar Usuário' : 'Adicionar Usuário' }}
        </h2>

        <div class="space-y-4">
            <div>
                <label class="text-sm text-gray-600">Nome</label>
                <input
                    type="text"
                    wire:model.defer="name"
                    class="w-full mt-1 rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                >
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="text-sm text-gray-600">Email</label>
                <input
                    type="email"
                    wire:model.defer="email"
                    class="w-full mt-1 rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                >
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="text-sm text-gray-600">Função</label>
                <select
                    wire:model.defer="role"
                    class="w-full mt-1 rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                >
                    <option value="">Selecione</option>
                    <option value="Admin">Admin</option>
                    <option value="Gestor">Gestor</option>
                    <option value="Colaborador">Colaborador</option>
                </select>
                @error('role') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="text-sm text-gray-600">Senha</label>
                <input
                    type="password"
                    wire:model.defer="password"
                    class="w-full mt-1 rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="{{ $isEditing ? 'Deixe em branco para não alterar' : '' }}"
                >
                @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="mt-6 flex justify-end gap-3">
            <button
                @click="open = false"
                class="px-4 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300 transition"
            >
                Cancelar
            </button>
            <button
                wire:click="save"
                class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition"
            >
                {{ $isEditing ? 'Salvar Alterações' : 'Adicionar' }}
            </button>
        </div>
    </div>
</div>
