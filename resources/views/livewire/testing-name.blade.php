
<div class="flex flex-col items-center ">
@if (session()->has('message'))
    <div class="flex justify-center">
        <div class="mt-4 px-6 py-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800 w-full max-w-md flex items-center" role="alert">
            <svg class="flex-shrink-0 inline w-5 h-5 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span>{{ session('message') }}</span>
        </div>
    </div>
@endif
<div class="mb-2">
    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
    <input wire:model="name" type="text" id="first_name" 
        class="bg-gray-50 border {{ $errors->has('name') ? 'border-red-500 text-red-600' : 'border-gray-300 text-gray-900' }} text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 {{ $errors->has('name') ? 'dark:border-red-500 dark:text-red-500' : '' }}" 
        placeholder="Name" required />

</div>
@error('name')
        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
            <span class="font-medium"></span> {{ $message }}
        </p>
    @enderror
             
    <div class="mb-2">
    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
    <input wire:model="email" type="text" id="email" 
        class="bg-gray-50 border {{ $errors->has('email') ? 'border-red-500 text-red-600' : 'border-gray-300 text-gray-900' }} text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 {{ $errors->has('email') ? 'dark:border-red-500 dark:text-red-500' : '' }}" 
        placeholder="Email" required />   
    </div>
@error('email')
        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
            <span class="font-medium"></span> {{ $message }}
        </p>
    @enderror
   
    <div class="mb-2">
    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
    <input wire:model="password" type="password" id="password" 
        class="bg-gray-50 border {{ $errors->has('password') ? 'border-red-500 text-red-600' : 'border-gray-300 text-gray-900' }} text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 {{ $errors->has('password') ? 'dark:border-red-500 dark:text-red-500' : '' }}" 
        placeholder="Password" required />    
</div>
@error('password')
        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
            <span class="font-medium"></span> {{ $message }}
        </p>
    @enderror

<div class="mb-5">
        <button wire:click ="register" class="relative inline-flex items-center justify-center p-0.5 mt-6 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-red-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200 dark:focus:ring-cyan-800">
<span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
Register
</span>
</div>

    
<div class="relative w-full overflow-x-auto">
<br><br><h1 style="text-align: center;">Registered Users</h1><br>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-600">
        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
            <tr>
                <th scope="col" class="px-6 py-3 rounded-s-lg">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3 rounded-e-lg">
                </th>
            </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
           <tr>
            <td class="py-2 px-4 border-t border-gray-200">{{$user->name}}</td>
            <td class="py-2 px-4 border-t border-gray-200">{{$user->email}}</td>
          </tr>
        @endforeach
        </tbody>
    </table>
</div>


</div>