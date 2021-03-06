<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Category;
use App\Order;
use App\Product;
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

    // Get product with categories.
    // Returns to Product page.
    public function showProducts($id)
    {
        return view('showProduct', [
            'product' => Product::getProduct($id),
            'categories' => Category::getSpecificCategories($id),
        ]);
    }

    // Add item to the cart in the session or if not exist, make it.
    public function getAddToCart(Request $request, $id)
    {
        $product = Product::find($id);

        // Check if product is in stock.
        if ($product->quantity >= 1) {
            // Changes the value of the item in the database.
            Product::decrementQuantity($id, 1);

            $cart = new Cart();
            $cart->add($product, $product->id);

            $request->session()->put('cart', $cart);

            return redirect()->back();
        } else {
            return redirect()->back()->with('out_of_stock', 'No more items in stock of this product.');
        }
    }

    // Remove one item from the cart in the session.
    public function getReduceByOne($id)
    {
        Product::incrementQuantity($id, 1);

        $cart = new Cart();
        $cart->reduceOne($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        return redirect()->route('product.shoppingCart');
    }

    // Remove all items from the cart in the session.
    public function getRemoveItem($id)
    {
        $cart = new Cart();
        Product::incrementQuantity($id, array_values($cart->items)[0]['qty']);
        $cart->removeItem($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        return redirect()->route('product.shoppingCart');
    }

    // Increase item by one from the cart in the session.
    public function getIncreaseByOne(Request $request, $id)
    {
        $product = Product::find($id);

        // Make new Cart class from existing cart.
        $cart = new Cart();

        // Checks if there are enough items left of that product.
        if ($product->quantity >= 1) {
            // Finds item.
            $product = Product::find($id);

            // Changes the value of the item in the database.
            Product::decrementQuantity($id, 1);

            // Add item with item id to the existing cart.
            $cart->add($product, $product->id);

            // If no cart exists make and or update existing cart in session.
            $request->session()->put('cart', $cart);

            // Returns to page.
            return redirect()->back();
        } else {
            // Returns to page with a message.
            return redirect()->back()->with('Stock_empty', 'No more items in stock');
        }
    }

    // Get data from the current cart in the session.
    public function getCart()
    {
        // If cart exists, return it to te view.
        if (!Session::has('cart')) {
            return view('shop.shopping-cart', ['products' => null]);
        }
        // Make class form existing cart.
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

    // Return to view if al required input fields are filled, otherwise return to view (and try again).
    public function postCheckout(Request $request)
    {
        if (!Session::has('cart')) {
            return redirect()->route('shop.shoppingCart');
        }

        if ($request->input('firstName') == null) {
            return redirect()->back();
        } else {
            $cart = new Cart();

            $order = new Order();
            $order->cart = serialize($cart);
            $order->name = $request->input('firstName');
            $order->lastName = $request->input('lastName');
            $order->email = $request->input('email');
            $order->address = $request->input('address');
            $order->zip = $request->input('zip');

            Auth::user()->orders()->save($order);

            $this->updateQuantity($cart);

            Session::forget('cart');
            return redirect()->route('home.welcome')->with('success', 'Successfully purchased products!');
        }
    }

    // Function to get te items out of the db to update the current quantity
    public function updateQuantity($cart)
    {
        $stored_items = $cart->items;
        foreach ($stored_items as $stored_item) {
            Product::decrementQuantity(array_values($stored_item)[2]['id'], $stored_item['qty']);
        }
    }

    // Cancels the checkout and returns the value of items back to the database
    public function cancelCheckout()
    {
        // Gets data from the logged in user and takes all the items in the session.
        print_r();
        die();
        // Return to products view with a messages.
    }
}
