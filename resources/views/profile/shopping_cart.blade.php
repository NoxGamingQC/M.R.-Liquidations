@extends('layouts.app')
@section('title', 'My Cart')
@section('content')

@if(count($shoppingCart) > 0)
<div class="row">
    <div class="col-md-12">
        <div class="row">
            @foreach($shoppingCart as $key => $item)
            <div class="col-md-2">
                @if($item->picture)
                    <img src="{{$item->picture}}" width="80%" />
                @else
                    <img src="/img/no-image.png" width="80%" />
                @endif
            </div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-8 text-left">
                            <h4>{{$item->name}}</h4>
                        </div>
                        <div class="col-md-4 text-right">
                            <h4><b>${{$item->price}}</b></h4>
                        </div>
                    </div>
                    <p>Qty: {{$item->quantity}}&nbsp&nbsp | <a class="btn btn-link"><small>Delete</small></a> | <a class="btn btn-link"><small>Save for later</small></a></p>
                </div>
                <div class="col-md-12">
                    <hr />
                </div>
            @endforeach
            <div class="col-md-12">
                <div class="text-right">
                    <h4>Sous-total ({{count($shoppingCart)}} items): <b>${{$total}}</b></h4>
                </div>
                <div class="text-right">
                    <h4>TPS: <b>${{number_format($total * 0.05, 2)}}</b></h4>
                </div>
                <div class="text-right">
                    <h4>TVQ: <b>${{number_format($total * 0.09975, 2)}}</b></h4>
                </div>
                <div class="text-right">
                    <h4>Total: <b>${{number_format($total + ($total * 0.05) + ($total * 0.09975), 2)}}</b></h4>
                </div>
                <div class="text-right">
                    <hr />
                    <h4><a type="button" class="btn btn-success btn-lg">Acheter maintenant</a></h4>
                </div>
            </div>
        </div>
    </div>
</div>
@else
    <div class="col-md-12 text-center">
        <h3>No content in cart</h3>
    </div>
@endif

@endsection