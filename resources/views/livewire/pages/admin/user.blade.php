<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            {{ __('Utilizadores') }}
        </h2>
    </x-slot>
    <div class="w-full p-4 sm:p-6 lg:p-8 bg-gray-50">
    <div class="max-w-8xl mx-auto bg-white rounded-2xl shadow-sm overflow-hidden">
        <!-- Header -->
        <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200">
            <div class="flex items-center space-x-2">
                <input 
                    type="text" 
                    wire:model.live="search"
                    placeholder="Pesquisar usuário..."
                    class="w-64 rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                >
            </div>
            <div>
                <button 
                    wire:click="openCreateModal"
                    class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition"
                >
                    <i class="fas fa-plus"></i> Adicionar
                </button>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-100 text-gray-800 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3">#</th>
                        <th class="px-6 py-3">Nome</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">Função</th>
                        <th class="px-6 py-3 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($users as $user)
                        <tr>
                            <td class="px-6 py-3">{{ $user->id }}</td>
                            <td class="px-6 py-3 font-medium">{{ $user->name }}</td>
                            <td class="px-6 py-3">{{ $user->email }}</td>
                            <td class="px-6 py-3">{{ $user->role }}</td>
                            <td class="px-6 py-3 text-right">
                                <button wire:click="edit({{ $user->id }})" class="text-blue-600 hover:underline mr-2">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <button wire:click="delete({{ $user->id }})" class="text-red-600 hover:underline">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                Nenhum usuário encontrado
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Footer -->
        <div class="px-6 py-4 border-t border-gray-200">
            {{-- {{ $users->links() }} --}}
        </div>
    </div>
</div>

</div>
