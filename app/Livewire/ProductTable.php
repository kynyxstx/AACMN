<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;

class ProductTable extends Component
{
    use WithPagination;

    public $product_name = '';
    public $quantity = '';
    public $price = '';
    public $condition = ''; // This will store the selected condition
    public $description = '';

    protected $paginationTheme = 'tailwind';
    protected $perPage = 2;

    protected $rules = [
        'product_name' => 'required|string|max:255',
        'quantity' => 'required|integer|min:1',
        'price' => 'required|numeric|min:0',
        'condition' => 'required|string',
        'description' => 'nullable|string|max:1000',
    ];

    protected $messages = [
        'product_name.required' => 'The product name is required.',
        'product_name.max' => 'The product name must not exceed 255 characters.',
        'quantity.required' => 'The quantity is required.',
        'quantity.integer' => 'The quantity must be a valid number.',
        'quantity.min' => 'The quantity must be at least 1.',
        'price.required' => 'The price is required.',
        'price.numeric' => 'The price must be a valid number.',
        'condition.required' => 'The condition is required.',
        'condition.in' => 'The condition must be one of the following: New, Second Hand, Old.',
        'description.max' => 'The description must not exceed 1000 characters.',
    ];

    public function addProduct()
    {
        $this->validate();

        Product::create([
            'product_name' => $this->product_name,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'condition' => $this->condition,
            'description' => $this->description,
        ]);

        $this->reset(['product_name', 'quantity', 'price', 'condition', 'description']);
        session()->flash('message', 'Product added successfully!');
    }

    public function render()
    {
        return view('livewire.product-table', [
            'products' => Product::paginate($this->perPage),
        ]);
    }
}
