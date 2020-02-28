<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Customer;
use App\Order;
use App\OrderDetails;
use App\Payment;
use App\Shipping;
use PDF;
class OrderController extends Controller
{
    public function ManageOrder(){
        $orders = DB::table('orders')
            ->join('customers','orders.customer_id','=','customers.id')
            ->join('payments','orders.id','=','payments.order_id')
            ->select('orders.*','customers.first_name','customers.last_name','payments.payment_type','payments.payment_status')
            ->get();
           // return $orders;
        return view('admin.order.manage_order',['orders'=>$orders]);
    }
    public function ViewOrderDetail($id){
        $order = Order::find($id);
        $customer = Customer::find($order->customer_id);
        $shipping = Shipping::find($order->shipping_id);
        $orderDetails = OrderDetails::where('order_id' , $order->id)->get();
        $payment = Payment::where('order_id' , $order->id)->first();
        return view('admin.order.view_order_details',[
            'order' => $order,
            'customer' => $customer,
            'shipping' => $shipping,
            'orderDetails' => $orderDetails,
            'payment' => $payment
        ]);
    
    }
    public function ViewOrderInvoice($id){
        $order = Order::find($id);
        $customer = Customer::find($order->customer_id);
        $shipping = Shipping::find($order->shipping_id);
        $orderDetails = OrderDetails::where('order_id' , $order->id)->get();
        $payment = Payment::where('order_id' , $order->id)->first();
        return view('admin.order.view_order_invoice',[
            'order' => $order,
            'customer' => $customer,
            'shipping' => $shipping,
            'orderDetails' => $orderDetails,
            'payment' => $payment
        ]);

    }
    public function DownloadOrderInvoice($id){
        $order = Order::find($id);
        $customer = Customer::find($order->customer_id);
        $shipping = Shipping::find($order->shipping_id);
        $orderDetails = OrderDetails::where('order_id' , $order->id)->get();
        $payment = Payment::where('order_id' , $order->id)->first();
        
        $pdf = PDF::loadView('admin.order.download_invoice',[
            'order' => $order,
            'customer' => $customer,
            'shipping' => $shipping,
            'orderDetails' => $orderDetails,
            'payment' => $payment
        ])->setPaper('a4');

		return $pdf->stream('invoice.pdf');
        //return view('');
    }
}
