<?php

namespace App\Livewire;

use App\Models\Sale;
use Livewire\Component;

class SaleIndex extends Component
{
    public $sales;

    public function mount()
    {
        $this->sales = Sale::with('customer')->get();
    }

    public function delete($id)
    {
        Sale::find($id)?->delete();
        $this->sales = Sale::with('customer')->get();
        session()->flash('message', 'Venda deletada.');
    }

    public function render()
    {
        return view('livewire.sale-index');
    }
}
