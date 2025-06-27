<div class="p-4 min-h-screen">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-white">Cadastrar Novo Cliente</h2>

        <a href="{{ route('customers.index') }}" class="text-gray-300 hover:text-white flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Voltar
        </a>
    </div>

    <div class="bg-gray-800 rounded-lg shadow-lg p-6 max-w-2xl mx-auto">
        <form wire:submit.prevent="save" class="space-y-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Nome *</label>
                <input wire:model="name" type="text" id="name" placeholder="Nome completo"
                       class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email *</label>
                <input wire:model="email" type="email" id="email" placeholder="Email válido"
                       class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('email') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-300 mb-2">Telefone</label>
                <input wire:model="phone" type="text" id="phone" placeholder="(00) 00000-0000"
                       class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('phone') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end gap-4 pt-4">
                <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium flex items-center gap-2 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Salvar Cliente
                </button>
                <a href="{{ route('customers.index') }}" class="px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white rounded-lg font-medium transition-colors">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
