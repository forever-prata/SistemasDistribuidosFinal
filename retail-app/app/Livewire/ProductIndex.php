<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductIndex extends Component
{
    public $products;

    public function mount()
    {
        $this->products = Product::all();
    }

    public function delete($id)
    {
        Product::find($id)?->delete();
        $this->products = Product::all();
        session()->flash('message', 'Produto deletado.');
    }

    public function render()
    {
        return view('livewire.product-index');
    }
}

