<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    

</head>
<body>
<br/>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">            
            <div class="panel-body">
            <div class="">
                <table>
                    <tr >
                        <td>
                            <table>
                                <tr>
                                    <td><h1>Invoice</h1>
                                
                                    </td>
                                    
                                    <td>
                                        Invoice #: 0000{{$order->id}}<br>
                                        Created: {{ $order->created_at }}<br>
                                        Due: {{ $order->order_total}}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                    <tr >
                        <td colspan="2">
                            <table>
                                <tr>
                                    <td>
                                <h4>Shipping Info</h4>
                                        {{ $shipping->full_name}}<br>
                                        {{$shipping->address}}<br>
                                                               
                                    
                                    <h4>Billing Info</h4>
                                    {{$customer->first_name.' '.$customer->last_name}}<br>
                                    {{$customer->email_address}}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr >
                <td>
                    Payment Method
                </td>
                
                <td>
                {{$payment->payment_type}} #
                </td>
            </tr>
            
            <tr >
                <td>
                {{$payment->payment_type}}<br><br><br>
                </td>
                
                <td>
                    {{ $order->order_total}}
                    <br><br><br>
                </td>
            </tr>
            
            <tr >
                <td>
                   <strong>Item</strong>
                </td>
                
                <td>
                    <strong>Price X Quantity</strong>
                </td>
                <td>
                    
                </td>
            </tr>
                     @foreach($orderDetails as $orderDetail)
                     <tr>

                        <td>{{$orderDetail->product_name}} </td>
                        <td>{{$orderDetail->product_price}} X {{$orderDetail->product_quantity}} = {{$orderDetail->product_price*$orderDetail->product_quantity}} </td>
                        </tr>

                        @endforeach
                        <tr class="total">
            
            <td>
            <td><strong>Total</strong> : {{$order->order_total}}</td>
            </td>
        </tr>
                </table>
            </div>
            </div>
        </div>
    </div>
</div>    
</body>
</html>
