<div class="flex flex-col items-center p-10">
    <h1 style="text-align: center; font-size: 2em;" class="mb-4">PRODUCTS</h1>

    @if (session()->has('message'))
        <div class="flex justify-center">
            <div class="mt-4 px-6 py-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800 w-full max-w-md flex items-center"
                role="alert">
                <svg class="flex-shrink-0 inline w-5 h-5 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span>{{ session('message') }}</span>
            </div>
        </div>
    @endif

    <div class="mb-2" style="width: 400px;">
        <label for="product_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
            Name</label>
        <input wire:model="product_name" type="text" id="product_name"
            class="bg-gray-50 border {{ $errors->has('product_name') ? 'border-red-500 text-red-600' : 'border-gray-300 text-gray-900' }} text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 {{ $errors->has('product_name') ? 'dark:border-red-500 dark:text-red-500' : '' }}"
            placeholder="Enter Product Name" required />
    </div>
    @error('product_name')
        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
    @enderror

    <div class="mb-2" style="width: 400px;">
        <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity</label>
        <input wire:model="quantity" type="number" id="quantity"
            class="bg-gray-50 border {{ $errors->has('quantity') ? 'border-red-500 text-red-600' : 'border-gray-300 text-gray-900' }} text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 {{ $errors->has('quantity') ? 'dark:border-red-500 dark:text-red-500' : '' }}"
            placeholder="Enter Quantity" required />
    </div>
    @error('quantity')
        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
    @enderror

    <div class="mb-2" style="width: 400px;">
        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
        <input wire:model="price" type="number" id="price"
            class="bg-gray-50 border {{ $errors->has('price') ? 'border-red-500 text-red-600' : 'border-gray-300 text-gray-900' }} text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 {{ $errors->has('price') ? 'dark:border-red-500 dark:text-red-500' : '' }}"
            placeholder="Enter Price" required />
    </div>
    @error('price')
        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
    @enderror

    <!-- Condition Field -->
    <div class="mb-2" style="width: 400px;">
        <label for="condition" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Condition</label>
        <select wire:model="condition" id="condition"
            class="bg-gray-50 border {{ $errors->has('condition') ? 'border-red-500 text-red-600' : 'border-gray-300 text-gray-900' }} text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 {{ $errors->has('condition') ? 'dark:border-red-500 dark:text-red-500' : '' }}"
            required>
            <option>Select Condition</option>
            <option value="new">New</option>
            <option value="old">Old</option>
            <option value="second_hand">Second Hand</option>
        </select>
    </div>
    @error('condition')
        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
    @enderror


    <!-- Description Field -->
    <div class="mb-2" style="width: 400px;">
        <label for="description"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
        <textarea wire:model="description" id="description" rows="3"
            class="bg-gray-50 border {{ $errors->has('description') ? 'border-red-500 text-red-600' : 'border-gray-300 text-gray-900' }} text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 {{ $errors->has('description') ? 'dark:border-red-500 dark:text-red-500' : '' }}"
            placeholder="Enter Description"></textarea>
    </div>
    @error('description')
        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
    @enderror

    <div class="mb-5">
        <button wire:click="addProduct" type="button"
            class="relative inline-flex items-center justify-center p-0.5 mt-6 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-red-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200 dark:focus:ring-cyan-800"
            wire:loading.attr="disabled">
            <span
                class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                <span wire:loading.remove>Add Product</span>
                <span wire:loading>Adding...</span>
            </span>
        </button>
        <div wire:loading role="status" class="flex items-center">
            <svg aria-hidden="true" class="inline w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                    fill="currentColor" />
                <path
                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                    fill="currentFill" />
            </svg>
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <div class="mt-8 p-10 w-full">
        <h1 style="text-align: center; font-size: 2em;">Product List</h1>
        <br>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-600">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                <tr>
                    <th scope="col" class="px-6 py-3">Product Name</th>
                    <th scope="col" class="px-6 py-3">Quantity</th>
                    <th scope="col" class="px-6 py-3">Price</th>
                    <th scope="col" class="px-6 py-3">Condition</th>
                    <th scope="col" class="px-6 py-3">Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td class="py-2 px-4 border-t border-gray-100">{{ $product->product_name }}</td>
                        <td class="py-2 px-4 border-t border-gray-100">{{ $product->quantity }}</td>
                        <td class="py-2 px-4 border-t border-gray-100">{{ $product->price }}</td>
                        <td class="py-2 px-4 border-t border-gray-100">{{ $product->condition }}</td>
                        <td class="py-2 px-4 border-t border-gray-100">{{ $product->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-8 p-10 w-full">
        {{ $products->links() }}
    </div>
</div>