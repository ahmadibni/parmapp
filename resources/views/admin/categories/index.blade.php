<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row w-full justify-between items-center">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Categories') }}
            </h2>
            <a href="{{ route('admin.categories.create') }}"
                class="px-5 py-2 font-bold bg-indigo-700 text-white rounded-full">Add
                Category</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex flex-col gap-5 overflow-hidden p-10 shadow-sm sm:rounded-lg">

                @forelse ($categories as $category)
                    <div class="item-card flex flex-row justify-between items-center">
                        <img src="{{ Storage::url($category->icon) }}" alt="" class="w-[50px]">
                        <h3 class="text-xl font-bold text-indigo-950">{{ $category->name }}</h3>
                        <div class="flex flex-row items-center gap-2">
                            <a href="{{ route('admin.categories.edit', $category) }}"
                                class="px-5 py-2 font-bold bg-indigo-700 text-white rounded-full">Edit</a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="px-5 py-2 font-bold bg-red-700 text-white rounded-full">Delete</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-10">
                        <h3 class="text-xl font-bold text-gray-600">{{ __('No categories found!') }}</h3>
                        <p class="text-gray-500 mt-2">{{ __('Add a new category to get started.') }}</p>
                    </div>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>
