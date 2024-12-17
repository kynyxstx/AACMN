<div class="flex flex-col items-center">
    <br>
    <h1 style="text-align: center; font-size: 2em;">Create Account</h1>

    <!-- Flash Message -->
    @if (session()->has('message'))
        <div class="flex justify-center mt-4">
            <div class="mt-4 px-6 py-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800 w-full max-w-md flex items-center"
                role="alert">
                <svg class="flex-shrink-0 w-5 h-5 me-3" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span>{{ session('message') }}</span>
            </div>
        </div>
    @endif

    <!-- Form -->
    <div class="mb-2" style="width: 400px;">
        <form wire:submit.prevent="register">
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-900 dark:text-white">Name</label>
                <input wire:model="name" type="text" id="name" placeholder="Enter Name"
                    class="w-full mt-1 p-2.5 bg-gray-50 border {{ $errors->has('name') ? 'border-red-500 text-red-600' : 'border-gray-300 text-gray-900' }} rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-900 dark:text-white">Email</label>
                <input wire:model="email" type="email" id="email" placeholder="Enter Email"
                    class="w-full mt-1 p-2.5 bg-gray-50 border {{ $errors->has('email') ? 'border-red-500 text-red-600' : 'border-gray-300 text-gray-900' }} rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="password" class="block text-sm font-medium text-gray-900 dark:text-white">Password</label>
                <input wire:model="password" type="password" id="password" placeholder="Enter Password"
                    class="w-full mt-1 p-2.5 bg-gray-50 border {{ $errors->has('password') ? 'border-red-500 text-red-600' : 'border-gray-300 text-gray-900' }} rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                @error('password')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex justify-center mt-6">
                <button type="submit"
                    class="relative inline-flex items-center justify-center p-0.5 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-red-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200 dark:focus:ring-cyan-800">
                    <span
                        class="relative px-6 py-4 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                        Register
                    </span>
                </button>
            </div>

        </form>
    </div>

    <!-- User Table -->
    <div class="mt-12 w-full">
        <h2 style="text-align: center; font-size: 2em;">Registered Users</h2>
        <table class="w-full mt-4 text-sm text-gray-500 dark:text-gray-600">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                <tr>
                    <th class="px-6 py-3">Name</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="py-3 px-6">{{ $user->name }}</td>
                        <td class="py-3 px-6">{{ $user->email }}</td>
                        <td class="py-3 px-6">
                            <button wire:click="openEditModal({{ $user->id }})"
                                class="text-blue-600 hover:underline">Edit</button>
                            <button wire:click="openDeleteModal({{ $user->id }})"
                                class="text-red-600 hover:underline ml-4">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>

    <!-- Edit Modal -->
    @if ($isEditModalOpen)
        <!-- Modal Overlay -->
        <div class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
            <!-- Modal Container -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg max-w-lg w-full">
                <!-- Modal Header -->
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">
                        Edit User
                    </h3>
                    <button wire:click="closeModal" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-400">
                        &#x2715; <!-- Close Icon -->
                    </button>
                </div>

                <!-- Modal Body -->
                <div>
                    <form wire:submit.prevent="updateUser">
                        <!-- Name Input -->
                        <div class="mb-4">
                            <label for="editName"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                            <input wire:model="name" id="editName" type="text" placeholder="Enter Name"
                                class="w-full mt-1 p-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" />
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Email Input -->
                        <div class="mb-4">
                            <label for="editEmail"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                            <input wire:model="email" id="editEmail" type="email" placeholder="Enter Email"
                                class="w-full mt-1 p-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" />
                            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Password Input -->
                        <div class="mb-4">
                            <label for="editPassword"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                            <input wire:model="password" id="editPassword" type="password" placeholder="Enter Password"
                                class="w-full mt-1 p-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" />
                            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Save Button -->
                        <div class="flex justify-end space-x-2">
                            <button type="button" wire:click="closeModal"
                                class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-400">
                                Cancel
                            </button>
                            <button type="submit"
                                class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-400">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Delete Modal -->
    @if ($isDeleteModalOpen)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg w-full text-center">
                <h3 class="text-xl font-semibold mb-4">Confirm Deletion</h3>
                <p>Are you sure you want to delete this user? This action cannot be undone.</p>
                <div class="mt-6 flex justify-center space-x-4">
                    <button wire:click="closeModal" class="px-4 py-2 bg-gray-600 text-white rounded-lg">Cancel</button>
                    <button wire:click="deleteUser" class="px-4 py-2 bg-red-600 text-white rounded-lg">Delete</button>
                </div>
            </div>
        </div>
    @endif
</div>