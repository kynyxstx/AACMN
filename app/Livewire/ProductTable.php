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

    // Variables for edit modal
    public $isEditModalOpen = false;
    public $editProductId;

    // Variables for delete modal
    public $isDeleteModalOpen = false;
    public $deletingProductId;

    protected $paginationTheme = 'tailwind';
    protected $perPage = 2;

    protected $rules = [
        'product_name' => 'required|string|max:255',
        'quantity' => 'required|integer|min:1',
        'price' => 'required|numeric|min:0',
        'condition' => 'required|string',
        'description' => 'nullable|string|max:1000',
    ];

    protected $listeners = ['refreshProducts' => '$refresh'];

    public function mount()
    {
        $this->resetPage();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    protected $messages = [
        'product_name.required' => 'The product name is required.',
        'product_name.max' => 'The product name must not exceed 255 characters.',
        'quantity.required' => 'The quantity is required.',
        'quantity.integer' => 'The quantity must be a valid number.',
        'quantity.min' => 'The quantity must be at least 1.',
        'price.required' => 'The price is required.',
        'price.numeric' => 'The price must be a valid number.',
        'condition.required' => 'The condition is required.',
        'description.max' => 'The description must not exceed 1000 characters.',
    ];

    // Close modal method for cancel/close buttons
    public function closeModal()
    {
        $this->isEditModalOpen = false;
        $this->isDeleteModalOpen = false;
        $this->reset(['product_name', 'quantity', 'price', 'condition', 'description', 'editProductId']);
    }

    // Save product method (handles add or update logic)
    public function saveProduct()
    {
        if ($this->editProductId) {
            // Update existing product
            $this->updateProduct();
        } else {
            // Add new product
            $this->addProduct();
        }
    }

    public function addProduct()
    {
        try {
            $this->validate();

            Product::create([
                'product_name' => $this->product_name,
                'quantity' => $this->quantity,
                'price' => $this->price,
                'condition' => $this->condition,
                'description' => $this->description,
            ]);

            $this->closeModal();
            session()->flash('message', 'Product added successfully!');
        } catch (\Exception $e) {
            session()->flash('error', 'There was an error adding the product.');
            \Log::error('Error adding product: ' . $e->getMessage());
        }
    }

    public function openEditModal($productId)
    {
        $product = Product::find($productId);

        if ($product) {
            $this->editProductId = $productId;
            $this->product_name = $product->product_name;
            $this->quantity = $product->quantity;
            $this->price = $product->price;
            $this->condition = $product->condition;
            $this->description = $product->description;

            $this->isEditModalOpen = true;
        } else {
            session()->flash('error', 'Product not found.');
        }
    }

    public function updateProduct()
    {
        try {
            $validatedData = $this->validate();

            $product = Product::find($this->editProductId);
            if ($product) {
                $product->update($validatedData);
                $this->closeModal();
                session()->flash('message', 'Product updated successfully!');
            } else {
                session()->flash('error', 'Product not found.');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Error updating product.');
            \Log::error('Error updating product: ' . $e->getMessage());
        }
    }

    public function openDeleteModal($productId)
    {
        $this->deletingProductId = $productId;
        $this->isDeleteModalOpen = true;
    }

    public function deleteProduct()
    {
        try {
            $product = Product::find($this->deletingProductId);

            if ($product) {
                $product->delete();
                $this->closeModal();
                session()->flash('message', 'Product deleted successfully!');
            } else {
                session()->flash('error', 'Product not found.');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Error deleting product.');
            \Log::error('Error deleting product: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.product-table', [
            'products' => Product::paginate($this->perPage),
        ]);
    }
}
