<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-white">Cadastrar Produto</h2>
        <a href="{{ route('products.index') }}" class="text-gray-300 hover:text-white flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Voltar para lista
        </a>
    </div>

    <div class="bg-gray-800 rounded-xl shadow-md p-6 max-w-2xl mx-auto">
        <form wire:submit.prevent="save" class="space-y-5">
            <div>
                <label class="block text-md font-medium text-gray-300 mb-2">Nome do Produto</label>
                <input wire:model="name" type="text" placeholder="Digite o nome do produto"
                       class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <div class="grid grid-cols-2 gap-5">
                <div>
                    <label class="block text-md font-medium text-gray-300 mb-2">Preço (R$)</label>
                    <input wire:model="price" type="number" step="0.01" placeholder="0,00"
                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-md font-medium text-gray-300 mb-2">Estoque</label>
                    <input wire:model="stock" type="number" placeholder="Quantidade disponível"
                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
            </div>

            <div>
                <label class="block text-md font-medium text-gray-300 mb-2">Descrição</label>
                <textarea wire:model="description" rows="4" placeholder="Detalhes sobre o produto..."
                          class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
            </div>

            <div class="flex justify-end gap-4 pt-4">
                <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium flex items-center gap-2 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Salvar Produto
                </button>
                <a href="{{ route('products.index') }}" class="px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white rounded-lg font-medium transition-colors">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
