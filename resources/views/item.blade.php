@extends('layouts.app')
@section('title', $name)
@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-10">
                    <h1>{{$name}}</h1>
                </div>
                <div class="col-md-2">
                <br />
                    <a href="/{{app()->getLocale()}}/store" class="text-right btn btn-danger">{{trans('store.back_to_store')}}</a>
                </div>
            </div>
            <hr />
            <div class="col-md-9">
                <p class="text-justify">{{$description}}</p>
            </div>
            <div class="col-md-3">
                @if ($picture)
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
                                    <li data-target="#itemCarousel" data-slide-to="{{count($pictures) + 1}}"></li>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <img src="{{$picture}}"/>
                            </div>
                            @foreach($pictures as $key => $value)
                                <div class="item">
                                    <img src="{{$value->picture}}" />
                                </div>
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