<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row w-full justify-between items-center">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Products') }}
            </h2>
            <a href="{{ route('admin.products.create') }}"
                class="px-5 py-2 font-bold bg-indigo-700 text-white rounded-full">Add
                Products</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex flex-col gap-5 overflow-hidden p-10 shadow-sm sm:rounded-lg">

                @forelse ($products as $product)
                    <div class="item-card flex flex-row justify-between items-center">
                        <div class="flex flex-row item-center gap-4">
                            <img src="{{ Storage::url($product->photo) }}" alt="" class="w-[50px]">
                            <div>
                                <h3 class="text-xl font-bold text-indigo-950">{{ $product->name }}</h3>
                                <p class="text-base text-slate-500">Rp.{{ $product->price }}</p>
                            </div>
                        </div>
                        <p class="text-lg text-slate-500">{{ $product->category->name }}</p>

                        <!-- Button -->
                        <div class="flex flex-row items-center gap-2">
                            <a href="{{ route('admin.products.edit', $product) }}"
                                class="px-5 py-2 font-bold bg-indigo-700 text-white rounded-full">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="px-5 py-2 font-bold bg-red-700 text-white rounded-full">Delete</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-10">
                        <h3 class="text-xl font-bold text-gray-600">{{ __('No products found!') }}</h3>
                        <p class="text-gray-500 mt-2">{{ __('Add a new product to get started.') }}</p>
                    </div>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>
