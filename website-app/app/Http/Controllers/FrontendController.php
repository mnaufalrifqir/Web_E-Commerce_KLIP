<?php

namespace App\Http\Controllers;

use Exception;
use Midtrans\Snap;
use App\Models\Cart;
use Midtrans\Config;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CheckoutRequest;
use App\Models\TransactionItem;


class FrontendController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with(['galleries'])->latest()->get();
        return view('pages.frontend.index', compact('products'));
    }

    public function details(Request $request, $slug)
    {
        $product = Product::with(['galleries'])->where('slug', $slug)->firstOrFail();
        return view('pages.frontend.details', compact('product'));
    }

    public function cartDelete(Request $request, $id)
    {
        $item = Cart::findOrFail($id);

        $item->delete();

        return redirect('cart');
    }
    public function cartAdd(Request $request, $id)
    {
        Cart::create([
            'users_id' => Auth::user()->id,
            'products_id' => $id
        ]);
        return redirect('cart');
    }

    public function cart(Request $request)
    {
        $carts = Cart::with(['product.galleries'])->where('users_id', Auth::user()->id)->get();

        return view('pages.frontend.cart', compact('carts'));
    }

    public function checkout(CheckoutRequest $request)
    {
        $data = $request->all();

        // Get Carts data
        $carts = Cart::with(['product'])->where('users_id', Auth::user()->id)->get();

        // Add to Transaction data

        $data['url'] = $request->file('url')->store('public/transaksi');
        $data['users_id'] = Auth::user()->id;
        $data['total_price'] = $carts->sum('product.price');

        // Create Transaction
        $transaction = Transaction::create($data);

        // Create Transaction item
        foreach ($carts as $cart) {
            $items[] = TransactionItem::create([
                'transactions_id' => $transaction->id,
                'users_id' => $cart->users_id,
                'products_id' => $cart->products_id,
            ]);
        }

        // Delete cart after transaction
        Cart::where('users_id', Auth::user()->id)->delete();
        return view('pages.frontend.success');
    }

    public function success(Request $request)
    {
        return view('pages.frontend.success');
    }
}
