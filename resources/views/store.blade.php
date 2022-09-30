@extends('layouts.app')
@section('title', trans('general.store'))
@section('content')


<div class="container">
    <div class="row">
        @if(Auth::check())
            @if($isDev || $isManager)
                <div class="col-md-6">
                    <h1>{{trans('store.store')}}</h1> 
                    <hr />
                </div>
                <div class="col-md-6 text-right">
                    <h1><button type="button" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i></button></h1> 
                    <hr />
                </div>
            @else
                <div class="col-md-12">
                    <h1>{{trans('store.store')}}</h1> 
                    <hr />
                </div>
            @endif
        @else
            <div class="col-md-12">
                <h1>{{trans('store.store')}}</h1> 
                <hr />
            </div>
        @endif
        <div class="col-md-12">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></div>
                    <input type="text" class="form-control disabled" placeholder="{{trans('general.search')}}" disabled>
                    <span class="input-group-btn"><button class="btn btn-primary disabled" type="button" disabled>{{trans('general.search')}}</button></span>
                </div>
            </div>
            <br />
        </div>
        <div class="col-md-12 text-right">
            <select class="selectpicker disabled" title="{{trans('store.sort_by')}}" disabled>
            </select>
        </div>
        <div class="col-md-12">
            <br />
        </div>
        <div class="col-md-3">
            <ul>
                <h3>{{trans('store.filter_by')}}:</h3>
                <hr />
                <h4 class="text-warning">{{trans('general.feature_coming_soon')}}</h4>
                <h4 class="hidden">{{trans('store.categories')}}:</h4>
                <h4 class="hidden">{{trans('store.prices')}}:</h4>
            </ul>
        </div>
        @if($displayedItemCount)
            <div class="col-md-9">
                <div class="row">
                    @if($items)
                        @foreach($items as $key => $item)
                            @if(!$item->isHidden)
                                <div class="col-md-4 panel panel-default" style="max-height:450px; height:450px">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <img class="img-rounded" src="{{$item->picture}}" style="max-width:250px; max-height:250px; height:250px;">
                                            </div>
                                            <div class="col-md-6 text-left">
                                                <br />
                                                <h5>{{$item->name}}</h5>
                                                <br />
                                                @if($item->isAvailable)
                                                    <p>{{$item->price != "0.00" ? $item->price . 'C$' : trans('store.free')}}</p>
                                                    @endif
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <br />
                                                @if($item->isAvailable)
                                                    <button class="btn btn-success">{{trans('store.available')}}</button>
                                                @else
                                                    <button class="btn btn-danger disabled" disabled>{{trans('store.not_available')}}</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
            </div>
        </div>
        <div class="col-md-12 text-center">
        <br />
            <button class="btn btn primary disabled" disabled>{{trans('store.more_item')}}</button>
        </div>
        @else
            <div class="col-md-9">
                <h3 class="text-center">{{trans('store.no_item_available')}}</h3>
            </div>
        @endif
    </div>
</div>
@stop