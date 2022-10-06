@extends('layouts.app')
@section('title', trans('general.store'))
@section('content')
@include('modals.show_item')

<div id="searchBarContainer" class="col-md-{{$isDev || $isManager ? '9' : '12'}}">
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-addon bg-info"><i class="fa fa-search" aria-hidden="true"></i></div>
            <input type="text" class="search-bar form-control" placeholder="{{trans('general.search')}}" >
            <span class="input-group-btn"><button id="searchBtn" class="btn btn-primary" type="button">{{trans('general.search')}}</button></span>
        </div>
    </div>
    <br />
</div>
@if(Auth::check())
    @if($isDev || $isManager)
        @include('modals.edit_item')
        @include('modals.add_item')
        <div class="col-md-3 text-right">
            <button type="button" class=" btn-add-item btn btn-success" data-toggle="modal" data-target="#addItemModal"><i class="fa fa-plus" aria-hidden="true"></i></button>
        </div>
    @endif
@endif
<div id="searchResultContainer" class="col-md-12" hidden>
    <div style="z-index:1; position: absolute;">
        <div class="col-md-offset-3 col-md-6 panel panel-default">
            <div class="panel-body">
                <div id="searchResult">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12 text-right">
    <br />
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
        @guest
            <h4 class="text-warning">{{trans('general.feature_coming_soon')}}</h4>
        @endguest
        @auth
            @if(Auth::user()->isManager || Auth::user()->isDev)
                <h4>{{trans('store.management')}}:</h4>
                <ul>
                    <li>{{trans('store.displayed_items')}} ({{$displayedItemCount}})</li>
                    <li>{{trans('store.hidden_items')}} ({{$hiddenItemCount}})</li>
                    <li>{{trans('store.available_items')}} ({{$availableItemCount}})</li>
                    <li>{{trans('store.not_available_items')}} ({{$notAvailableItemCount}})</li>
                </ul>
            @else
                <h4 class="text-warning">{{trans('general.feature_coming_soon')}}</h4>
            @endif
        @endauth
        <h4 class="hidden">{{trans('store.categories')}}:</h4>
        <h4 class="hidden">{{trans('store.prices')}}:</h4>
    </ul>
</div>
@if($currentItemCount)
    <div class="col-md-9">
        <div class="row">
            @if($items)
                @foreach($items as $key => $item)
                    <div class="col-md-4 panel {{$item->isHidden ? 'panel-disabled' : 'panel-default'}}" style="max-height:450px; height:450px">
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
                                        <div class="col-md-12">
                                            <br />
                                        </div>
                                    @endif
                                @endif
                                <div class="col-md-12 text-center">
                                        @if($item->picture)
                                        <img class="img-rounded {{$item->isHidden ? 'disabled' : ''}}" src="{{$item->picture}}" style="max-width:250px; max-height:250px; height:250px;">
                                    @else
                                        <img class="{{$item->isHidden ? 'disabled' : ''}}" src="/img/no-image.png" width="100%">
                                    @endif
                                </div>
                                <div class="col-md-6 text-left">
                                    <br />
                                    <h5 class="limit-text-length" title="{{$item->name}}">{{$item->name}}</h5>
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
                @endforeach
            @endif
    </div>
</div>
<div class="col-md-offset-3 col-md-9 text-center">
<br />
    @if($currentPage != 1)
        <a class="btn btn-default" href="/{{app()->getLocale()}}/store/{{$currentPage - 1}}">{{trans('store.last_page')}}</a>
    @endif
    @for($i = 1; $i <= $pageCount; $i++)
        @if($i == 6 && $pageCount > 11)
            <button class="btn btn-default">...<button>
            {{$i = ($pageCount - 6)}}
        @endif
        <a class="btn btn-default" href="/{{app()->getLocale()}}/store/{{$i}}">{{$i}}</a>
    @endfor
    @if($currentPage != ($pageCount))
        <a class="btn btn-default" href="/{{app()->getLocale()}}/store/{{$currentPage + 1}}">{{trans('store.next_page')}}</a>
    @endif
</div>
@else
    <div class="col-md-9">
        <h3 class="text-center">{{trans('store.no_item_available')}}</h3>
    </div>
@endif
<script>
document.addEventListener("DOMContentLoaded", () => {
    $('.search-bar').on('keyup', function() {
        var searchTerms = $(this).val();
        if(!searchTerms) {
            $('#searchResultContainer').attr('hidden', true);
            $('#searchResult').children().remove();
        }
    });
    $('#searchBtn').on('click', function() {
        var searchTerms = $('.search-bar').val();

        if(searchTerms) {
            $.ajax({
                url: "/store/item/search",
                method: "get",
                data: {
                    search: searchTerms
                },
                success: function(results) {
                    $('#searchResult').children().remove();
                    if(results && results.length !== 0) {
                        var html = '';
                        results.forEach(function(result, key) {
                            var html = '<a class="search-result" href="/store/item/' + result['id'] + '">' +
                                            '<div class="col-md-12 panel panel-default">' +
                                                '<div class="panel-body">' +
                                                    '<div class="col-md-9">' +
                                                        '<h4>'+ result['name'] +'</h4>'+
                                                        '<p class="limit-text-length">'+ result['description'] +'</p>'+
                                                        '<p><b>'+ result['price'] +'</b></p>'+
                                                    '</div>'+
                                                    '<div class="col-md-3">' +
                                                        '<img src="' + (result['picture'] ? result['picture'] : '/img/no-image.png') + '" width="100%" />'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</a>';
                            $('#searchResult').append(html);
                        });
                        $('#searchResultContainer').removeAttr('hidden');
                    } else {
                        $('#searchResultContainer').attr('hidden', true);
                    }
                },
                error: function(error) {
                    $('#searchResultContainer').attr('hidden', true);
                    console.log('Un problème est survenue');
                    toastr.error('Un problème est survenue', 'Erreur');
                }
            });
        } else {
            $('#searchResultContainer').attr('hidden', true);
            $('#searchResult').children().remove();
        }
    });

    $('.btn-edit-item').on('click', function() {
        var id = $(this).attr('id');
        var name = $('#name-' + id).val();
        var description = $('#description-' + id).val();
        var price = $('#price-' + id).val();
        var stock = $('#stock-' + id).val();
        var isAvailable = $('#isAvailable-' + id).val() ? true : false;
        var isHidden = $('#isHidden-' + id).val() ? true : false;
        var picture = $('#picture-' + id).val() ? $('#picture-' + id).val() : '';
        
        $('#editItemID').val(id);
        $('#editItemName').val(name);
        $('#editItemDescription').val(description);
        $('#editItemPrice').val(price);
        $('#editItemStock').val(stock);
        $('#editItemIsAvailable').attr('checked', isAvailable);
        $('#editItemIsHidden').attr('checked', isHidden);
        $('#itemPicture').attr('src', picture);
        $('#selectItemPicture').val('')
        $('#editItemPage').attr('href', '/management/item/' + id)
    });

    $('.btn-show-item').on('click', function() {
        var id = $(this).attr('id');
        var name = $('#name-' + id).val();
        var description = $('#description-' + id).val();
        var price = $('#price-' + id).val();
        var stock = $('#stock-' + id).val();
        var picture = $('#picture-' + id).val() ? $('#picture-' + id).val() : '';

        if(picture) {
            $('#showItemPicture').removeAttr('hidden');
            $('#noItemPicture').attr('hidden', true);
        } else {
            $('#showItemPicture').attr('hidden', true);
            $('#noItemPicture').removeAttr('hidden');
        }

        
        $('#showItemID').val(id);
        $('#showItemName').html(name);
        $('#showItemDescription').html(description);
        $('#showItemPrice').html(price);
        $('#showItemStock').html(stock);
        $('#showItemPicture').attr('src', picture);
        $('#showItemSeeMoreBtn').attr('href', '/store/item/' + id)
    });

    $('.btn-add-item').on('click', function() {
        $('#addItemPicture').val('')
        $('#newItemPicture').attr('src', '');
    });
});
</script>
@stop