@extends('layouts.app', ['forceTitle' => true])
@section('title', $name)
@section('content')

<input id="id" type="hidden" value="{{$id}}">

<div class="row">
    <div class="col-md-10">
        <input id="name" class="form-control input-lg" type="text" value="{{$name}}">
    </div>
    <div class="col-md-2">
        <button id="saveItem" type="submit" class="text-right btn btn-success btn-lg" >{{trans('general.save')}}</button>
    </div>
</div>
<hr />
<div class="col-md-9">
    <textarea id="description" class="form-control" rows="20">{{$description}}</textarea>
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
    <br />
    <br />
    <label>{{trans('store.isAvailable')}}: <input id="isAvailable" type="checkbox" {{$isAvailable ? 'checked' : ''}} /></label>
    <br />
    <label>{{trans('store.isHidden')}}: <input id="isHidden" type="checkbox" {{$isHidden ? 'checked' : ''}} /></label>
</div>
<div class="col-md-12">
    <hr />
</div>
<div class="col-md-6">
    <div class="form-inline">
        <h4><b>{{trans('store.price')}}: <input id="price" type="text" class="form-control" value="{{$price}}"> C$</b></h4>
    </div>
</div>
<div class="col-md-6">
    <div class="form-inline">
        <h4><b>{{trans('store.stock')}}: <input id="stock" type="text" class="form-control" value="{{$stock}}"> {{trans('store.item_left')}}</b></h4>
    </div>
</div>
<div class="col-md-12">
    <hr />
</div>
<div class="col-md-12">
    <h3>{{trans('store.item_pictures')}}</h3>
    <span class="text-warning">{{trans('store.check_radio_feature_picture')}} <input type="radio" name="reference" checked></span>
    <p class="text-warning">{{trans('store.recommended_picture_ratio')}}</p>
    <hr />
    <div class="row">
        @foreach($pictures as $key => $value)
            <div class="col-md-4 panel panel-default text-center">
                <div class="col-md-6 text-left">
                    <br />
                    <input type="radio" class="featured" name="item_pictures" value="{{$value->id}}" {{$value->isFeatured ? 'checked' : ''}}>
                </div>
                <div class="col-md-6 text-right">
                    <br />
                    <button id="{{$value->id}}" class="delete-picture btn btn-danger"><i class="fa fa-times" area-hidden="true"></i></button>
                </div>
                &nbsp
                <img src="{{$value->picture}}" width="100%" />
                &nbsp
            </div>
        @endforeach
            <div class="col-md-12 panel panel-default text-center">
            <br />
            <h4>{{trans('store.add_picture')}}</h4>
            <div class="col-md-offset-4 col-md-4">
                <input class="form-control disabled" id="itemPictureInput" type="file" accept="image/*" />
                <br />
                <img id="itemPicture" src="" width="100%"/>
                <br />
                <br />
            </div>
            <div class="col-md-offset-4 col-md-4">
            </div>
            </div>
    </div>
</div>
<div class="col-md-12">
    <br />
</div>
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", () => {
    $('#saveItem').on('click', function() {
        var $btnText = $('#saveItem').html();
        $.ajax({
            url: "/management/item/edit",
            method: "post",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: $('#id').val(),
                name: $('#name').val(),
                description: $('#description').val(),
                price: $('#price').val(),
                stock: $('#stock').val(),
                isAvailable: $('#isAvailable').is(':checked'),
                isHidden: $('#isHidden').is(':checked'),
                picture: $('#itemPicture').attr('src'),
                featured: $('.featured:checked').val()
            },
            beforeSend: function() {
                $('#saveItem').attr('disabled', true)
                $('#saveItem').addClass('disabled', true)
                $('#saveItem').html('<i class="fa fa-spinner fa-pulse fa-fw" area-hidden="true"></i>')
            },
            success: function() {
                $('#saveItem').attr('disabled', false)
                $('#saveItem').removeClass('disabled', true)<
                toastr.success('L\'item à été modifier avec succès.', 'Item modifier');
                window.location.reload();
            },
            error: function(error) {
                $('#saveItem').html(btnText);
                $('#saveItem').attr('disabled', false)
                $('#saveItem').removeClass('disabled', true)
                toastr.error('Un problème est survenue', 'Erreur');
            }
        });
    });

    $('.delete-picture').on('click', function() {
        var id = this.id;
        $.ajax({
            url: "/management/item/picture/delete",
            method: "post",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: id,
            },
            success: function() {
                console.log('L\'item à été modifier avec succès.');
                toastr.success('L\'item à été modifier avec succès.', 'Item modifier');
                window.location.reload();
            },
            error: function(error) {
                console.log('Un problème est survenue');
                toastr.error('Un problème est survenue', 'Erreur');
            }
        });
    });

    var itemInput = document.getElementById("itemPictureInput");
    var itemPicture = document.getElementById("itemPicture");

    const convertBase64 = (file) => {
        return new Promise((resolve, reject) => {
            const fileReader = new FileReader();
            fileReader.readAsDataURL(file);

            fileReader.onload = () => {
                resolve(fileReader.result);
            };

            fileReader.onerror = (error) => {
                reject(error);
            };
        });
    };

    const uploadImage = async (event) => {
        const file = event.target.files[0];
        const base64 = await convertBase64(file);
        itemPicture.src = base64;
    };

    itemInput.addEventListener("change", (e) => {
        uploadImage(e);
    });
});
</script>
@stop