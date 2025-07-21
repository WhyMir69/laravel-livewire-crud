<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ProductManager extends Component
{
    use WithPagination, WithFileUploads;

    public $product_code = '';
    public $name = '';
    public $quantity = '';
    public $price = '';
    public $description = '';
    public $image;
    public $currentImage = '';
    public $editingProductId = null;
    public $showModal = false;
    public $showDetailsModal = false;
    public $selectedProduct = null;

    protected $rules = [
        'product_code' => 'required|string|max:255',
        'name' => 'required|string|max:255',
        'quantity' => 'required|integer|min:0',
        'price' => 'required|numeric|min:0',
        'description' => 'required|string',
        'image' => 'nullable|image|max:2048', // max 2MB
    ];

    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function show(Product $product)
    {
        $this->selectedProduct = $product;
        $this->showDetailsModal = true;
    }

    public function store()
    {
        $rules = $this->rules;
        if ($this->editingProductId) {
            $rules['product_code'] = 'required|string|max:255|unique:products,product_code,' . $this->editingProductId;
        } else {
            $rules['product_code'] = 'required|string|max:255|unique:products,product_code';
        }

        $this->validate($rules);

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('products', 'public');
        }

        if ($this->editingProductId) {
            $product = Product::find($this->editingProductId);
            
            // Delete old image if new one is uploaded
            if ($imagePath && $product->image) {
                Storage::disk('public')->delete($product->image);
            }
            
            $product->update([
                'product_code' => $this->product_code,
                'name' => $this->name,
                'quantity' => $this->quantity,
                'price' => $this->price,
                'description' => $this->description,
                'image' => $imagePath ?: $product->image,
            ]);
            session()->flash('message', 'Product updated successfully!');
        } else {
            Product::create([
                'product_code' => $this->product_code,
                'name' => $this->name,
                'quantity' => $this->quantity,
                'price' => $this->price,
                'description' => $this->description,
                'image' => $imagePath,
            ]);
            session()->flash('message', 'Product created successfully!');
        }

        $this->resetForm();
        $this->showModal = false;
    }

    public function edit(Product $product)
    {
        $this->editingProductId = $product->id;
        $this->product_code = $product->product_code;
        $this->name = $product->name;
        $this->quantity = $product->quantity;
        $this->price = $product->price;
        $this->description = $product->description;
        $this->currentImage = $product->image;
        $this->showModal = true;
    }

    public function delete(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        session()->flash('message', 'Product deleted successfully!');
    }

    public function removeImage()
    {
        $this->image = null;
        $this->currentImage = '';
    }

    public function resetForm()
    {
        $this->product_code = '';
        $this->name = '';
        $this->quantity = '';
        $this->price = '';
        $this->description = '';
        $this->image = null;
        $this->currentImage = '';
        $this->editingProductId = null;
        $this->resetValidation();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function closeDetailsModal()
    {
        $this->showDetailsModal = false;
        $this->selectedProduct = null;
    }

    public function render()
    {
        $products = Product::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.product-manager', compact('products'));
    }
}
