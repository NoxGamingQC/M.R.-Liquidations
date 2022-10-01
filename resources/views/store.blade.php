@extends('layouts.app')
@section('title', trans('general.store'))
@section('content')
@include('modals.show_item')

<div class="container">
    <div class="row">
        @if(Auth::check())
            @if($isDev || $isManager)
                @include('modals.edit_item')
                @include('modals.add_item')
                <div class="col-md-6">
                    <h1>{{trans('store.store')}}</h1> 
                    <hr />
                </div>
                <div class="col-md-6 text-right">
                    <h1><button type="button" class="btn btn-success" data-toggle="modal" data-target="#addItemModal"><i class="fa fa-plus" aria-hidden="true"></i></button></h1> 
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
            <span class="text-danger"><b>{{trans('general.soon_in_english')}}<b></span>
            <span class="text-info"><b>**Les items listé ci-dessous sont disponible pour le ramassage à l'entrepôt gratuitement ou en livraison pour les villes et villages suivant: Shawinigan (15C$), Grand'Mère (15C$), Saint-Georges-de-Champlain (15C$), Saint-Boniface-de-Shawinigan (15C$), Shawinigan-Sud (15C$) et Trois-Rivières (20C$). Les livraisons vers Trois-Rivières se font les lundis seulement. Livraison gratuite avec tout achat de 250C$ ou plus.**<b></span>
            <hr />
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon bg-info"><i class="fa fa-search" aria-hidden="true"></i></div>
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
                                            <input type="hidden" id="name-{{$item->id}}" value="{{$item->name}}">
                                            <input type="hidden" id="description-{{$item->id}}" value="{{$item->description}}">
                                            <input type="hidden" id="price-{{$item->id}}" value="{{$item->price}}">
                                            <input type="hidden" id="stock-{{$item->id}}" value="{{$item->stock}}">
                                            <input type="hidden" id="isAvailable-{{$item->id}}" value="{{$item->isAvailable}}">
                                            <input type="hidden" id="isHidden-{{$item->id}}" value="{{$item->isHidden}}">
                                            <input type="hidden" id="picture-{{$item->id}}" value="{{$item->picture}}">
                                            @if(Auth::check())
                                                @if($isDev || $isManager)
                                                    <div class="col-md-12 text-right">
                                                        <button id="{{$item->id}}" type="button" class="btn-edit-item btn btn-warning" data-toggle="modal" data-target="#editItemModal"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                                    </div>
                                                @endif
                                            @endif
                                            <div class="col-md-12 text-center">
                                                <img class="img-rounded" src="{{$item->picture ? $item->picture : '/img/no-image.png'}}" style="max-width:250px; max-height:250px; height:250px;">
                                            </div>
                                            <div class="col-md-6 text-left">
                                                <br />
                                                <h5>{{$item->name}}</h5>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <br />
                                                @if($item->isAvailable)
                                                    <p>{{$item->price != "0.00" ? $item->price . 'C$' : trans('store.free')}}</p>
                                                    <br />
                                                    <button id="{{$item->id}}" type="button" class="btn-show-item btn btn-success" data-toggle="modal" data-target="#showItemModal">{{trans('store.available')}}</button>
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
<script>
document.addEventListener("DOMContentLoaded", () => {
    $('.btn-edit-item').on('click', function() {
        var id = $(this).attr('id');
        var name = $('#name-' + id).val();
        var description = $('#description-' + id).val();
        var price = $('#price-' + id).val();
        var stock = $('#stock-' + id).val();
        var isAvailable = $('#isAvailable-' + id).val() ? true : false;
        var isHidden = $('#isHidden-' + id).val() ? true : false;

        
        $('#editItemID').val(id);
        $('#editItemName').val(name);
        $('#editItemDescription').val(description);
        $('#editItemPrice').val(price);
        $('#editItemStock').val(stock);
        $('#editItemIsAvailable').attr('checked', isAvailable);
        $('#editItemisHidden').attr('checked', isHidden);
    });

    $('.btn-show-item').on('click', function() {
        var id = $(this).attr('id');
        var name = $('#name-' + id).val();
        var description = $('#description-' + id).val();
        var price = $('#price-' + id).val();
        var stock = $('#stock-' + id).val();
        var picture = $('#picture-' + id).val() ? $('#picture-' + id).val() : '';

        
        $('#showItemID').val(id);
        $('#showItemName').html(name);
        $('#showItemDescription').html(description);
        $('#showItemPrice').html(price);
        $('#showItemStock').html(stock);
        $('#showItemPicture').attr('src', picture);
    });
});

</script>
@stop