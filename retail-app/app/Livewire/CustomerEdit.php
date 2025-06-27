<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Customer;

class CustomerEdit extends Component
{
    public $customerId;
    public $name, $email, $phone;

    public function mount($id)
    {
        $customer = Customer::findOrFail($id);
        $this->customerId = $customer->_id;
        $this->name = $customer->name;
        $this->email = $customer->email;
        $this->phone = $customer->phone;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
        ]);

        Customer::where('_id', $this->customerId)->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);

        session()->flash('message', 'Cliente atualizado com sucesso.');
        return redirect()->route('customers.index');
    }

    public function render()
    {
        return view('livewire.customer-edit');
    }
}
