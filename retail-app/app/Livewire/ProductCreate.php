<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductCreate extends Component
{
    public $name, $price, $stock, $description;

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        Product::create([
            'name' => $this->name,
            'price' => $this->price,
            'stock' => $this->stock,
            'description' => $this->description,
        ]);

        session()->flash('message', 'Produto criado com sucesso.');
        return redirect()->route('products.index');
    }

    public function render()
    {
        return view('livewire.product-create');
    }
}

