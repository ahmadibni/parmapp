<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row w-full justify-between items-center">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ Auth::user()->hasRole('owner') ? __('Apotek Orders') : __('My Transactions') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex flex-col gap-5 overflow-hidden p-10 shadow-sm sm:rounded-lg">

                @forelse ($product_transactions as $transaction)
                    <div class="item-card flex flex-row justify-between items-center">
                        <div>
                            <p class="text-base text-slate-500">
                                Name
                            </p>
                            <h3 class="text-xl font-bold text-indigo-950">
                                {{ $transaction->user->name }}
                            </h3>
                        </div>
                        <div class="flex flex-row item-center gap-4">
                            <img src="#" alt="" class="w-[50px]">
                            <div>
                                <p class="text-base text-slate-500">
                                    Total Transactions
                                </p>
                                <h3 class="text-xl font-bold text-indigo-950">
                                    Rp. {{ number_format($transaction->total_amount, 0, ',', '.') }}
                                </h3>
                            </div>
                        </div>
                        <div>
                            <p class="text-base text-slate-500">
                                Date
                            </p>
                            <h3 class="text-xl font-bold text-indigo-950">
                                {{ $transaction->created_at }}
                            </h3>
                        </div>

                        @if ($transaction->is_paid)
                            <span class="py-1 px-3 bg-green-500 rounded-full">
                                <p class="text-sm text-white font-bold uppercase">
                                    Approved
                                </p>
                            </span>
                        @else
                            <span class="py-1 px-3 bg-orange-500 rounded-full">
                                <p class="text-sm text-white font-bold uppercase">
                                    Pending
                                </p>
                            </span>
                        @endif

                        <div class="flex flex-row items-center gap-2">
                            <a href="{{ route('product-transactions.show', $transaction) }}"
                                class="px-5 py-2 font-bold bg-indigo-700 text-white rounded-full">
                                View Details
                            </a>
                        </div>
                    </div>
                    <hr class="my-3">
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
