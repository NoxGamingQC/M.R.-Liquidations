@extends('layouts.app')
@section('title', trans('shopping_cart.my_cart'))
@section('content')

@if(count($shoppingCart) > 0)
<div class="row">
    <div class="col-md-12">
        <div class="row">
            @foreach($shoppingCart as $key => $item)
            <div class="col-md-2">
                @if($item->picture)
                    <a href="/store/item/{{$item->item_id}}"><img src="{{$item->picture}}" width="80%" /></a>
                @else
                    <a href="/store/item/{{$item->item_id}}"><img src="/img/no-image.png" width="80%" /></a>
                @endif
            </div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-8 text-left">
                            <h4><a class="text-link" href="/store/item/{{$item->item_id}}">{{$item->name}}</a></h4>
                        </div>
                        <div class="col-md-4 text-right">
                            <h4><b>${{$item->price}}</b></h4>
                        </div>
                    </div>
                    <p>{{trans('shopping_cart.quantity')}}: {{$item->quantity}}&nbsp&nbsp | <a class="btn btn-link" href="/profile/cart/remove/{{$item->id}}"><small>{{trans('shopping_cart.delete')}}</small></a> | <a class="btn btn-link disabled" disabled><small>{{trans('shopping_cart.save_for_later')}}</small></a></p>
                </div>
                <div class="col-md-12">
                    <hr />
                </div>
            @endforeach
            <div class="col-md-12">
                <div class="text-right">
                    <h4>{{trans('shopping_cart.subtotal')}} ({{count($shoppingCart)}} {{trans('shopping_cart.item')}}): <b>${{$total}}</b></h4>
                </div>
                <div class="text-right">
                    <h4>{{trans('shopping_cart.tps')}}: <b>${{number_format($total * 0.05, 2)}}</b></h4>
                </div>
                <div class="text-right">
                    <h4>{{trans('shopping_cart.tvq')}}: <b>${{number_format($total * 0.09975, 2)}}</b></h4>
                </div>
                <div class="text-right">
                    <h4>{{trans('shopping_cart.total')}}: <b>${{number_format($total + ($total * 0.05) + ($total * 0.09975), 2)}}</b></h4>
                </div>
                <div class="text-right">
                    <hr />
                    <h4><a type="button" class="btn btn-success btn-lg disabled" disabled>{{trans('shopping_cart.buy')}} ({{count($shoppingCart)}} {{trans('shopping_cart.item')}})</a></h4>
                </div>
            </div>
        </div>
    </div>
</div>
@else
    <div class="col-md-12 text-center">
        <h3>{{trans('shopping_cart.no_content_cart')}}</h3>
    </div>
@endif

@endsection
