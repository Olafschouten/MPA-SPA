@extends('layout')

@extends('navigation')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>User Account</h1>
            <hr>
            <h2>My orders</h2>

{{--            @foreach($orders as $order)--}}
{{--                <p>{{ $order->created_at }}</p>--}}
{{--            @endforeach--}}


{{--//            function cmp($a, $b)--}}
{{--//            {--}}
{{--//                if ($a == $b) {--}}
{{--//                    return 0;--}}
{{--//                }--}}
{{--//                return ($a < $b) ? -1 : 1;--}}
{{--//            }--}}
{{--//--}}
{{--//            $test = (array) $orders;--}}
{{--//--}}
{{--//            usort($test, "cmp");--}}
{{--//--}}
{{--//            foreach ($orders as $key => $value) {--}}
{{--//                echo "$value->created_at";--}}
{{--//                echo "<br>";--}}
{{--//            }--}}


            @foreach($orders as $order)
                <div class="panel panel-default">
                    <div class="panel-body">
                        <ul class="list-group">
                            @foreach($order->cart->items as $item)
                                <li class="list-group-item">
                                    <span class="badge">${{ $item['price'] }}</span>
                                    {{ $item['item']['title'] }} | {{ $item['qty'] }} Units
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="panel-footer">
                        <strong>Total price: ${{ $order->cart->totalPrice }}</strong>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection

@extends('footer')
