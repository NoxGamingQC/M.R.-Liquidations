@extends('layouts.app')
@section('title', $name)
@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>{{$name}}</h1>
            <hr />
            <div class="col-md-9">
                <p class="text-justify">{{$description}}</p>
            </div>
            <div class="col-md-3">
                @if ($picture)
                    <img src="{{$picture}}" width="100%" />
                @else
                    <img src="/img/no-image.png" width="100%" />
                @endif
            </div>
            <div class="col-md-12">
                <hr />
            </div>
            <div class="col-md-6">
                <h4><b>{{trans('store.price')}}: {{$price}} C$</b></h4>
            </div>
            <div class="col-md-6">
                @if($isAvailable)
                    @if($stock)
                        <h4><b>{{trans('store.stock')}}: {{$stock}} {{trans('store.item_left')}}</b></h4>
                    @else
                        <h4><b>{{trans('store.stock')}}: <span class="text-danger">{{trans('store.not_available')}}</span></b></h4>
                    @endif
                @else
                    <h4><b>{{trans('store.stock')}}: {{trans('store.item_not_available')}}</b></h4>
                @endif
            </div>
        </div>
    </div>
</div>
@stop