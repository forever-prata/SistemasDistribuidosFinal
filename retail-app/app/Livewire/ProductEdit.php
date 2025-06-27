<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductEdit extends Component
{
    public $productId;
    public $name, $price, $stock, $description;

    public function mount($id)
    {
        $product = Product::findOrFail($id);
        $this->productId = $product->_id;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->description = $product->description;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        Product::where('_id', $this->productId)->update([
            'name' => $this->name,
            'price' => $this->price,
            'stock' => $this->stock,
            'description' => $this->description,
        ]);

        session()->flash('message', 'Produto atualizado com sucesso.');
        return redirect()->route('products.index');
    }

    public function render()
    {
        return view('livewire.product-edit');
    }
}

