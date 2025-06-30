<div class="p-4 min-h-screen">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-white">Registrar Nova Venda</h2>

        <a href="{{ route('sales.index') }}" class="text-gray-300 hover:text-white flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Voltar
        </a>
    </div>

    <div class="bg-gray-800 rounded-lg shadow-lg p-6 max-w-4xl mx-auto">
        <form wire:submit.prevent="save" class="space-y-6">
            <!-- Customer Selection -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Cliente *</label>
                <select wire:model="customer_id" class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Selecione um cliente</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->_id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
                @error('customer_id') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Items Section -->
            <div class="space-y-4">
                <label class="block text-sm font-medium text-gray-300">Itens da Venda</label>

                @foreach ($items as $index => $item)
                <div class="flex gap-4 items-end bg-gray-700 p-3 rounded-lg">
                    <div class="flex-1">
                        <label class="block text-xs text-gray-400 mb-1">Produto *</label>
                        <select wire:model="items.{{ $index }}.product_id"
                                wire:change="updatePrice({{ $index }})"
                                class="w-full px-3 py-2 bg-gray-600 border border-gray-500 rounded text-white focus:ring-1 focus:ring-blue-500">
                            <option value="">Selecione um produto</option>
                            @foreach($products as $product)
                                <option value="{{ $product->_id }}" data-price="{{ $product->price }}">
                                    {{ $product->name }} (R$ {{ number_format($product->price, 2, ',', '.') }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-24">
                        <label class="block text-xs text-gray-400 mb-1">Quantidade *</label>
                        <input type="number" wire:model="items.{{ $index }}.quantity"
                               min="1"
                               wire:change="calculateTotal"
                               class="w-full px-3 py-2 bg-gray-600 border border-gray-500 rounded text-white focus:ring-1 focus:ring-blue-500">
                    </div>
                    <div class="w-32">
                        <label class="block text-xs text-gray-400 mb-1">Preço Unit.</label>
                        <input type="number" step="0.01" wire:model="items.{{ $index }}.price"
                               readonly
                               class="w-full px-3 py-2 bg-gray-600 border border-gray-500 rounded text-white cursor-not-allowed">
                    </div>
                    <button type="button" wire:click="removeItem({{ $index }})"
                            class="text-red-400 hover:text-red-300 p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </div>
                @endforeach

                <button type="button" wire:click="addItem"
                        class="text-blue-400 hover:text-blue-300 flex items-center gap-1 mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Adicionar Item
                </button>
            </div>

            <!-- Status Selection -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Status *</label>
                <select wire:model="status" class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="pendente">Pendente</option>
                    <option value="pago">Pago</option>
                    <option value="cancelado">Cancelado</option>
                </select>
                @error('status') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end pt-4">
                <button type="submit"
                        class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium flex items-center gap-2 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Salvar Venda (R$ {{ number_format($total, 2, ',', '.') }})
                </button>
            </div>
        </form>
    </div>
</div>
