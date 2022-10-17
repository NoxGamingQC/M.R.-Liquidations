@extends('layouts.app', ['forceTitle' => true])
@section('title', $name)
@section('thumbnail', env('APP_URL') . '/store/item/' . $id . '/thumbnail')
@section('description', $description)
@section('content')
@section('forceTitle', false)

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-{{Auth::check() ? ((Auth::user()->isManager || Auth::user()->isDev) ? '6' : '8') : '8'}}">
                    <h1>{{$name}}</h1>
                </div>
                @auth
                    @if(Auth::user()->isManager || Auth::user()->isDev)
                        <div class="col-md-2">
                            <br />
                            <a href="/{{app()->getLocale()}}/management/item/{{$id}}" class="text-right btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        </div>
                    @endif
                @endauth
                <div class="col-md-2">
                    <br />
                    <a href="https://www.facebook.com/profile.php?id=100075930327806" class="text-right btn btn-success">{{trans('store.buy_now')}}</a>
                </div>
                <div class="col-md-2">
                    <br />
                    <a href="/{{app()->getLocale()}}/store/1" class="text-right btn btn-danger">{{trans('store.back_to_store')}}</a>
                </div>
            </div>
            <hr />
            <div class="col-md-9">
                <p class="text-justify">{{$description}}</p>
            </div>
            <div class="col-md-3">
                @if (count($pictures) > 1)
                    <div id="itemCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            @foreach($pictures as $key => $value)
                                @if($key == 0)
                                    <li data-target="#itemCarousel" data-slide-to="{{$key}}" class="active"></li>
                                @else
                                    <li data-target="#itemCarousel" data-slide-to="{{$key}}"></li>
                                @endif
                            @endforeach
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            @foreach($pictures as $key => $value)
                                @if($key == 0)
                                    <div class="item active">
                                        <img src="{{$value->picture}}" />
                                    </div>
                                @else
                                    <div class="item">
                                        <img src="{{$value->picture}}" />
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <a class="left carousel-control" href="#itemCarousel" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#itemCarousel" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                @else
                    @if(count($pictures) == 1)
                        <img src="{{$pictures[0]->picture}}" width="100%" />
                    @else
                        <img src="/img/no-image.png" width="100%" />
                    @endif
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
