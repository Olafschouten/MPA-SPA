<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Category;
use App\Order;
use App\Product;
use Egulias\EmailValidator\Warning\ObsoleteDTEXT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // Get all products
    public function show()
    {
        return view('products', [
            'products' => Product::getProducts()
        ]);
    }

    // Get product with categories
    public function showProducts($id)
    {
        return view('showProduct', [
            'products' => Product::getProduct($id),
            'categories' => Category::getSpecificCategories($id),
        ]);
    }

    // Add item to the cart in the session or if not exist, make it
    public function getAddToCart(Request $request, $id)
    {
        $product = Product::find($id);
        $cart = new Cart();
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);

        return redirect()->back();
    }

    // Remove one item from the cart in the session
    public function getReduceByOne($id)
    {
        $cart = new Cart();
        $cart->reduceOne($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        return redirect()->route('product.shoppingCart');
    }

    // Remove all items from the cart in the session
    public function getRemoveItem($id)
    {
        $cart = new Cart();
        $cart->removeItem($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        return redirect()->route('product.shoppingCart');
    }

    // Increase item by one from the cart in the session
    public function getIncreaseByOne(Request $request, $id)
    {
        // Finds item
        $product = Product::find($id);
        // Make new Cart class from existing cart ----------
        $cart = new Cart();
        // Add item with item id to the existing cart
        $cart->add($product, $product->id);

        // If no cart exists make and or update existing cart in session
        $request->session()->put('cart', $cart);

        // Returns to page
        return redirect()->back();
    }

    // Get data from the current cart in the session
    public function getCart()
    {
        // If cart exists, return it to te view
        if (!Session::has('cart')) {
            return view('shop.shopping-cart', ['products' => null]);
        }
        // Make class form existing cart
        $cart = new Cart();
        return view('shop.shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    // Return to view with data form the cart in the session, otherwise return to the shopping cart.
    public function getCheckout()
    {
        if (!Session::has('cart')) {
            return view('shop.shopping-cart');
        }
        $cart = new Cart();
        $total = $cart->totalPrice;
        return view('shop.checkout', ['total' => $total]);
    }

    // Return to view if al required input fields are filled, otherwise return to view (and try again)
    public function postCheckout(Request $request)
    {
        if (!Session::has('cart')) {
            return redirect()->route('shop.shoppingCart');
        }
        $cart = new Cart();

        $order = new Order();
        $order->cart = serialize($cart);
        $order->address = $request->input('address');
        $order->name = $request->input('firstName');

        Auth::user()->orders()->save($order);

        Session::forget('cart');
        return redirect()->route('home.welcome')->with('success', 'Successfully purchased products!');
    }
}
