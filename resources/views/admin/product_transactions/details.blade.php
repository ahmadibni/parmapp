<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row w-full justify-between items-center">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Details') }}
            </h2>

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex flex-col gap-5 overflow-hidden p-10 shadow-sm sm:rounded-lg">

                <div class="item-card flex flex-col gap-y-4 md:flex-row md:justify-between md:items-center">
                    <div class="flex flex-row item-center gap-4">
                        <div>
                            <p class="text-base text-slate-500">
                                Total Transactions
                            </p>
                            <h3 class="text-xl font-bold text-indigo-950">
                                Rp. {{ number_format($product_transaction->total_amount, 0, ',', '.') }}
                            </h3>
                        </div>
                    </div>
                    <div>
                        <p class="text-base text-slate-500">
                            Date
                        </p>
                        <h3 class="text-xl font-bold text-indigo-950">
                            {{ $product_transaction->created_at->format('d F Y') }}
                        </h3>
                    </div>


                    @if ($product_transaction->is_paid)
                        <span class="py-1 px-3 bg-green-500 w-fit rounded-full">
                            <p class="text-sm text-white font-bold uppercase">
                                Approved
                            </p>
                        </span>
                    @else
                        <span class="py-1 px-3 bg-orange-500 w-fit rounded-full">
                            <p class="text-sm text-white font-bold uppercase">
                                Pending
                            </p>
                        </span>
                    @endif


                </div>
                <hr class="my-3">
                <h3 class="text-xl font-bold text-indigo-950">
                    List of items
                </h3>
                <div class="grid-cols-1 md:grid-cols-4 grid gap-x-10">
                    <div class="flex flex-col gap-5 col-span-2">
                        {{-- Product list --}}

                        @foreach ($product_transaction->transactionDetails as $detail)
                            <div class="item-card flex flex-row justify-between items-center">
                                <div class="flex flex-row item-center gap-4">
                                    <img src="{{ Storage::url($detail->product->photo) }}" alt=""
                                        class="w-[50px] h-[50px]">
                                    <div>
                                        <h3 class="text-xl font-bold text-indigo-950 max-w-[220px]">
                                            {{ $detail->product->name }}
                                        </h3>
                                        <p class="text-base text-slate-500">
                                            Rp.{{ number_format($detail->total_amount, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                                <p class="text-lg text-slate-500">
                                    {{ $detail->product->category->name }}
                                </p>
                            </div>
                        @endforeach


                        {{-- Delivery Details --}}
                        <h3 class="text-xl font-bold text-indigo-950">
                            Detail of Delivery
                        </h3>
                        <div class="item-card flex flex-row justify-between items-center">
                            <p class="text-base text-slate-500">
                                Address
                            </p>
                            <h3 class="text-xl font-bold text-indigo-950">
                                {{ $product_transaction->address }}
                            </h3>
                        </div>
                        <div class="item-card flex flex-row justify-between items-center">
                            <p class="text-base text-slate-500">
                                City
                            </p>
                            <h3 class="text-xl font-bold text-indigo-950">
                                {{ $product_transaction->city }}
                            </h3>
                        </div>
                        <div class="item-card flex flex-row justify-between items-center">
                            <p class="text-base text-slate-500">
                                Post Code
                            </p>
                            <h3 class="text-xl font-bold text-indigo-950">
                                {{ $product_transaction->post_code }}
                            </h3>
                        </div>
                        <div class="item-card flex flex-row justify-between items-center">
                            <p class="text-base text-slate-500">
                                Phone Number
                            </p>
                            <h3 class="text-xl font-bold text-indigo-950">
                                {{ $product_transaction->phone_number }}
                            </h3>
                        </div>
                        <div class="item-card flex flex-col justify-between items-start">
                            <p class="text-base text-slate-500">
                                Notes
                            </p>
                            <h3 class="text-lg font-bold text-indigo-950">
                                {{ $product_transaction->notes }}
                            </h3>
                        </div>

                    </div>
                    <div class="flex flex-col gap-5 col-span-2 mt-4 md:items-end">
                        <h3 class="text-xl font-bold text-indigo-950">
                            Proof of transactions
                        </h3>
                        <img src="{{ Storage::url($product_transaction->proof) }}" alt=""
                            class="w-full md:w-[300px] md:h-[400px]">
                    </div>

                </div>
                <hr class="my-3">
                @role('owner')
                    @if ($product_transaction->is_paid)
                        <a href="#" class="px-5 py-2 w-fit bg-indigo-700 font-bold text-white rounded-full">
                            Contact Customer
                        </a>
                    @else
                        <form action="{{ route('product-transactions.update', 2) }}" method="post">
                            @csrf
                            @method('put')
                            <button class="px-5 py-2  bg-indigo-700 font-bold text-white rounded-full">
                                Approve Order
                            </button>
                        </form>
                    @endif
                @endrole

                @role('buyer')
                    <a href="#" class="px-5 py-2 w-fit bg-indigo-700 font-bold text-white rounded-full">
                        Contact Admin
                    </a>
                @endrole

            </div>
        </div>
    </div>
</x-app-layout>
