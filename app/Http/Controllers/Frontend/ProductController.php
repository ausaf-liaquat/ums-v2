<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ProductPurchased;
use App\Models\Order;
use App\Models\Products\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductController extends Controller
{
    /**
     * Retrieves the view for the index page of the frontend.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function medicalSupplies()
    {
        $data = [
            'products' => Product::whereMfTypeId(1)->where('status', 1)->get()
        ];
        return view('frontend.medical-supplies', $data);
    }
    /**
     * Retrieves the view for the index page of the frontend.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function medicalUniforms()
    {
        $data = [
            'products' => Product::whereMfTypeId(2)->where('status', 1)->get()
        ];
        return view('frontend.medical-uniforms', $data);
    }


    /**
     * Privacy Policy Page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function details($slug)
    {
        $data = [
            'product'=>Product::whereSlug($slug)->first()
        ];
        return view('frontend.product-details', $data);
    }

    /**
     * Terms & Conditions Page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function buy(Request $request, Product $product)
    {
        // dd($request->all());
        session()->put($request->only([
            'quantity', 'size', 'color', 'product_id',
        ]));
        return redirect()->route('product.checkout', ['slug' => $product->slug]);
    }

    /**
     * Checkout.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function checkout($slug, Request $request)
    {
        $data = [
            'product' => Product::whereSlug($slug)->first(),
        ];
        return view('frontend.product-checkout', $data);
    }

    /**
     * Terms & Conditions Page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function checkoutStore(Request $request)
    {
        session()->put([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'address'=>$request->address,
            'city'=>$request->city_id,
            'state'=>$request->state_id,
            'zip_code'=>$request->zip_code,
        ]);
        return redirect()->route('product.checkout.stripe');

    }

    public function checkoutStripe()
    {
        // dd(Session::all());

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $product = Product::find(session()->get('product_id'));
        $lineItems = [];
        $totalPrice =  $product->price;
        // foreach ($products as $product) {

        $lineItems[] = [
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => $product->title,
                    'images' => [json_decode($product->image)[0]],
                ],
                'unit_amount' => $totalPrice * 100,
            ],
            'quantity' => session('quantity'),
        ];
        // }

        // dd($product, session()->all());
        $session = Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout-product.success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => route('checkout-product.cancel', [], true),
        ]);
        $grand_total = $totalPrice * session('quantity');
        $order = Order::create([
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'session_id' => $session->id,
            'status' => 'unpaid',
            'grand_total' => $grand_total,
            'product_price'=>$product->price,
            'item_count' => session('quantity'),
            'product_id' => $product->id,
            'payment_status' => 0,
            'payment_method' => null,
            'first_name' => session('first_name'),
            'last_name' => session('last_name'),
            'color' => session('color'),
            'size' => session('size'),
            'email' => session('email'),
            'phone_number' => session('phone'),
            'notes' => session('message'),
            'address' => session('address'),
            'city' => session('city'),
            'state' => session('state'),
            'zip_code' => session('zip_code'),
        ]);
        // session()->forget(['date', 'cid', 'first_name', 'last_name', 'email', 'phone', 'message']);
        return view('layouts.stripe-redirect', compact('session', 'product', 'order'));
    }

    public function checkoutStripeSuccess(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $sessionId = $request->get('session_id');

        try {
            $session = Session::retrieve($sessionId);
            if (!$session) {

                throw new NotFoundHttpException();
            }
            // $customer = \Stripe\Customer::retrieve($session->customer);

            $order = Order::where('session_id', $session->id)->first();
            if (!$order) {

                throw new NotFoundHttpException();
            }
            if ($order->status === 'unpaid') {
                $order->status = 'paid';
                $order->save();
            }
           $product = Product::find($order->product_id);
        //    Mail::to($order->email)->send(new ProductPurchased($product,$order));

            session()->flush();
            return view('frontend.product-success',compact('product','order'));
        } catch (\Exception $e) {
            // dd($e->getMessage());
            throw new NotFoundHttpException();
        }
    }
    public function checkoutStripeCancel(Request $request)
    {
        session()->flush();
        return view('frontend.product-cancel');
    }
}
