<div class="p-4 min-h-screen">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-white">Editar Cliente</h2>

        <a href="{{ route('customers.index') }}" class="text-gray-300 hover:text-white flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Voltar
        </a>
    </div>

    <div class="bg-gray-800 rounded-lg shadow-lg p-6 max-w-2xl mx-auto">
        <form wire:submit.prevent="update" class="space-y-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Nome *</label>
                <input wire:model="name" type="text" id="name"
                       class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email *</label>
                <input wire:model="email" type="email" id="email"
                       class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('email') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-300 mb-2">Telefone</label>
                <input wire:model="phone" type="text" id="phone"
                       class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('phone') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end gap-4 pt-4">
                <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium flex items-center gap-2 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                    Atualizar Cliente
                </button>
                <a href="{{ route('customers.index') }}" class="px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white rounded-lg font-medium transition-colors">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
