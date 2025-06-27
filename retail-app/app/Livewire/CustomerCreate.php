<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Customer;

class CustomerCreate extends Component
{
    public $name, $email, $phone;

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'nullable|string|max:20',
        ]);

        Customer::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);

        session()->flash('message', 'Cliente criado com sucesso.');
        return redirect()->route('customers.index');
    }

    public function render()
    {
        return view('livewire.customer-create');
    }
}
