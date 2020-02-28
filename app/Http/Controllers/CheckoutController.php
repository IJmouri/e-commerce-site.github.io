<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Shipping;
use Illuminate\Http\Request;
use Session;
use Mail;
use Cart;
use App\Order;
use App\Payment;
use App\OrderDetails;
class CheckoutController extends Controller
{
    public function index()
    {
        return view('front-end.checkout.checkout_content');
    }
    public function customerSignUp(Request $request){
        $this->validate($request,[
            'email_address' =>'email|unique:customers,email_address'
        ]);

        $customer = new Customer();
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->email_address = $request->email_address;
        $customer->password = bcrypt($request->password);
        $customer->phone_number = $request->phone_number;
        $customer->address = $request->address;
        $customer->save();

        //return 'success';

        $customerId = $customer->id;
        Session::put('customerId',$customerId);
        Session::put('customerName',$customer->first_name.' '.$customer->last_name);

        $data = $customer->toArray();
        Mail::send('front-end.mails.confirmation_mail', $data, function ($message) use ($data) {
            $message->to($data['email_address']);
            $message->subject('Confirmation mail');
        });
        return redirect('/checkout/shipping');
    }
    public function shippingForm() {
        $customer = Customer::find(Session::get('customerId'));
        return view('front-end.checkout.shipping', ['customer'=>$customer]);
    }
    public function SaveShippingInfo(Request $request){
        $shipping = new Shipping();
        $shipping -> full_name = $request->full_name;
        $shipping -> email_address = $request->email_address;
        $shipping -> phone_number = $request->phone_number;
        $shipping -> address = $request->address;
        $shipping->save();

        Session::put('shippingId',$shipping->id);

        return redirect('/checkout/payment');

    }
    public function PaymentForm()
    {
        return view('front-end.checkout.payment');
        
    }
    public function OrderSave(Request $request){
        $paymentType = $request->payment_type;
        if($paymentType == "Cash"){
            $order = new Order();
            $order->customer_id = Session::get('customerId');
            $order->shipping_id = Session::get('shippingId');
            $order->order_total = Session::get('OrderTotal');
            $order->save();

            $payment = new Payment();
            $payment->order_id=$order->id;
            $payment->payment_type = $paymentType;
            $payment->save();

            $cartContent = cart::content();
            foreach($cartContent as $cartContent){
                $orderDetail = new OrderDetails();
                $orderDetail -> order_id=$order->id;
                $orderDetail -> product_id = $cartContent->id;
                $orderDetail -> product_name = $cartContent->name;
                $orderDetail -> product_price = $cartContent->price;
                $orderDetail -> product_quantity = $cartContent->qty;
                $orderDetail->save();

            }
            Cart::destroy();
            return "s";
            return redirect('');

        }
        else if($paymentType == "Paypal"){

        }
        else if($paymentType == "Bkash"){

        }
    }
    public function CustomerLogin(Request $request){
        $customer = Customer::where('email_address',$request->email_address)->first();
       // return $customer->password;
        if (password_verify($request->password,$customer->password)) {
            
            Session::put('customerId',$customer->id);
            Session::put('customerName',$customer->first_name.' '.$customer->last_name);
            
            return redirect('checkout/shipping');
        } else {
            return redirect('checkout')->with('message','Password Incorrect');

        }
    }
    public function DirectCustomerLogin(){
        return view('front-end.customer.customer_login');
    }
    public function CustomerLogout(){
        Session::forget('customerId');
        Session::forget('customerName');
        return redirect('/');
    }
}
