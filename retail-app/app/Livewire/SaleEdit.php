<?php

namespace App\Livewire;

use App\Models\Sale;
use App\Models\Customer;
use App\Models\Product;
use Livewire\Component;

class SaleEdit extends Component
{
    public $saleId;
    public $customer_id;
    public $items = [];
    public $total = 0;
    public $status;

    public $customers;
    public $products;

    public function mount($id)
    {
        $this->customers = Customer::all();
        $this->products = Product::all();

        $sale = Sale::findOrFail($id);
        $this->saleId = $sale->id;
        $this->customer_id = $sale->customer_id;
        $this->status = $sale->status;
        $this->total = $sale->total;

        // Debug - Verifique a estrutura completa
        logger('Dados da venda:', [
            'raw_items' => $sale->items,
            'raw_data' => $sale->toArray()
        ]);

        // Carrega os itens com tratamento especial para MongoDB
        $this->items = [];

        if (is_array($sale->items)) {
            foreach ($sale->items as $item) {
                $product = Product::find($item['product_id'] ?? null);

                $this->items[] = [
                    'product_id' => $item['product_id'] ?? null,
                    'quantity' => $item['quantity'] ?? 1,
                    'price' => $item['price'] ?? 0,
                    'product_name' => $product->name ?? 'Produto não encontrado'
                ];
            }
        }

        // Se ainda estiver vazio, adiciona um item padrão
        if (empty($this->items)) {
            $this->addItem();
        }
    }

    public function addItem()
    {
        $this->items[] = [
            'product_id' => null,
            'quantity' => 1,
            'price' => 0,
            'product_name' => ''
        ];
    }

    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
        $this->calculateTotal();
    }

    public function updatePrice($index)
    {
        $productId = $this->items[$index]['product_id'] ?? null;

        if ($productId) {
            $product = Product::find($productId);
            if ($product) {
                $this->items[$index]['price'] = $product->price;
                $this->items[$index]['product_name'] = $product->name;
                $this->calculateTotal();
            }
        } else {
            $this->items[$index]['price'] = 0;
            $this->items[$index]['product_name'] = '';
            $this->calculateTotal();
        }
    }

    public function calculateTotal()
    {
        $this->total = collect($this->items)->sum(function ($item) {
            return ($item['quantity'] ?? 0) * ($item['price'] ?? 0);
        });
    }

    public function updated($propertyName)
    {
        if (str_contains($propertyName, 'items.') && str_contains($propertyName, '.quantity')) {
            $this->calculateTotal();
        }
    }

    public function update()
    {
        $this->validate([
            'customer_id' => 'required|exists:customers,_id',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,_id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'status' => 'required|in:pendente,pago,cancelado',
        ]);

        $itemsToSave = collect($this->items)->map(function ($item) {
            $product = Product::findOrFail($item['product_id']);

            return [
                'product_id' => $item['product_id'],
                'product_name' => $product->name,
                'quantity' => (int) $item['quantity'],
                'price' => (float) $item['price'],
                'subtotal' => (float) ($item['quantity'] * $item['price'])
            ];
        })->toArray();

        Sale::find($this->saleId)->update([
            'customer_id' => $this->customer_id,
            'items' => $itemsToSave,
            'total' => $this->total,
            'status' => $this->status,
        ]);

        session()->flash('success', 'Venda atualizada com sucesso!');
        return redirect()->route('sales.index');
    }

    public function render()
    {
        return view('livewire.sale-edit');
    }
}
