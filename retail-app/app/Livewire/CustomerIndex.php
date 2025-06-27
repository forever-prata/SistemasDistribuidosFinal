<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Customer;

class CustomerIndex extends Component
{
    public $customers;

    public function mount()
    {
        $this->customers = Customer::all();
    }

    public function delete($id)
    {
        Customer::find($id)?->delete();
        $this->customers = Customer::all();
        session()->flash('message', 'Cliente deletado.');
    }

    public function render()
    {
        return view('livewire.customer-index');
    }
}
