<?php

namespace App\Livewire;

use App\Models\Sale;
use App\Models\Customer;
use App\Models\Product;
use Livewire\Component;

class SaleCreate extends Component
{
    public $customer_id;
    public $items = [];
    public $total = 0;
    public $status = 'pendente';

    public $customers;
    public $products;

    public function mount()
    {
        $this->customers = Customer::all();
        $this->products = Product::all();
        $this->addItem();
    }

    public function addItem()
    {
        $this->items[] = [
            'product_id' => '',
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
        $productId = $this->items[$index]['product_id'];

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

    public function save(){
        $this->validate([
            'customer_id' => 'required|exists:customers,_id',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,_id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'status' => 'required|in:pendente,pago,cancelado',
        ]);

        $itemsArray = collect($this->items)->map(function ($item) {
            return [
                'product_id' => $item['product_id'],
                'product_name' => Product::find($item['product_id'])->name,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'subtotal' => $item['quantity'] * $item['price']
            ];
        })->toArray();

        Sale::create([
            'customer_id' => $this->customer_id,
            'items' => $itemsArray,
            'total' => $this->total,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Venda registrada com sucesso!');
        return redirect()->route('sales.index');
    }

    public function render()
    {
        return view('livewire.sale-create');
    }
}
