<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use App\Models\ProductTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ProductTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('buyer')) {
            $productTransactions = $user->productTransactions()->with('transactionDetails')->get();
        } else {
            $productTransactions = ProductTransaction::with('transactionDetails')->get();
        }
        return view('admin.product_transactions.index', [
            'product_transactions' => $productTransactions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'post_code' => 'required|integer',
            'phone_number' => 'required|integer',
            'notes' => 'required|string',
            'proof' => 'required|image|mimes:png,jpg'
        ]);

        DB::beginTransaction();

        try {
            $subTotalCents = 0;
            $deliveryFeeCents = 25000 * 100;

            $carts = $user->carts()->with('product')->get();

            foreach ($carts as $cart) {
                $subTotalCents += $cart->product->price * 100;
            }

            $ppnCents = (int)round(11 * $subTotalCents / 100);
            $insuranceCents = (int)round(23 * $subTotalCents / 100);
            $grandTotalCents = $subTotalCents + $ppnCents + $insuranceCents + $deliveryFeeCents;

            $grandTotal = $grandTotalCents / 100;

            $validated['user_id'] = $user->id;
            $validated['total_amount'] = $grandTotal;
            $validated['is_paid'] = false;

            if ($request->hasFile('proof')) {
                $proofPath = $request->file('proof')->store('transaction_proofs', 'public');
                $validated['proof'] = $proofPath;
            }

            $newProductTransaction = ProductTransaction::create($validated);

            foreach ($carts as $cart) {
                TransactionDetail::create([
                    'product_transaction_id' => $newProductTransaction->id,
                    'product_id' => $cart->product_id,
                    'total_amount' => $cart->product->price,
                ]);
                $cart->delete();
            }

            DB::commit();

            return redirect()->route('product-transactions.index');
        } catch (\Exception $e) {
            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['System error! ' . $e->getMessage()]
            ]);

            throw $error;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductTransaction $productTransaction)
    {
        $productTransaction = ProductTransaction::with('transactionDetails.product')->find($productTransaction->id);
        return view('admin.product_transactions.details', [
            'product_transaction' => $productTransaction
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductTransaction $productTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductTransaction $productTransaction)
    {
        $productTransaction->update([
            'is_paid' => true
        ]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductTransaction $productTransaction)
    {
        //
    }
}
