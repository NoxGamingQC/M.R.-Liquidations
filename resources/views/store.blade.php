@extends('layouts.app')
@section('title', 'Welcome')
@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>{{trans('store.store')}}</h1>
            <hr />
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></div>
                    <input type="text" class="form-control" placeholder="{{trans('general.search')}}">
                    <span class="input-group-btn"><button class="btn btn-primary" type="button">{{trans('general.search')}}</button></span>
                </div>
            </div>
            <br />
        </div>
        <div class="col-md-12 text-right">
            <select class="selectpicker" title="{{trans('store.sort_by')}}">
            </select>
        </div>
        <div class="col-md-12">
            <br />
        </div>
        <div class="col-md-3">
            <ul>
                <h3>{{trans('store.filter_by')}}:</h3>
                <hr />
                <h4>{{trans('store.categories')}}:</h4>
                <h4>{{trans('store.prices')}}:</h4>
            </ul>
        </div>
        @if($displayedItemCount)
            <div class="col-md-9">
                <div class="row">
                    @if($items)
                        @foreach($items as $key => $item)
                            @if(!$item->isHidden)
                                <div class="col-md-4 panel panel-default text-center">
                                    <div class="panel-body">
                                        <img class="img-circle" src="{{$item->picture}}" width="100px">
                                        <br />
                                        <p>{{$item->name}}</p>
                                        <p>{{$item->price}}C$</p>
                                        @if($item->isAvailable)
                                            <button class="btn btn-success">{{trans('store.available')}}</button>
                                        @else
                                            <button class="btn btn-danger disabled" disabled>{{trans('store.not_available')}}</button>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
            </div>
        </div>
        <div class="col-md-12 text-center">
        <br />
            <button class="btn btn primary">{{trans('store.more_item')}}</button>
        </div>
        @else
            <div class="col-md-9">
                <h3 class="text-center">{{trans('store.no_item_available')}}</h3>
            </div>
        @endif
    </div>
</div>
@stop