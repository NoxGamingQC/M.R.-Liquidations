@extends('layouts.app')
@section('title', $name)
@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-10">
                    <input class="form-control input-lg" type="text" value="{{$name}}">
                </div>
                <div class="col-md-2">
                    <a href="" class="text-right btn btn-success btn-lg disabled" disabled>{{trans('general.save')}}</a>
                </div>
            </div>
            <hr />
            <div class="col-md-9">
                <textarea class="form-control" rows="20">{{$description}}</textarea>
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
                <label>{{trans('store.isAvailable')}}: <input type="checkbox" {{$isAvailable ? 'checked' : ''}} /></label>
                <br />
                <label>{{trans('store.isHidden')}}: <input type="checkbox" {{$isHidden ? 'checked' : ''}} /></label>
            </div>
            <div class="col-md-12">
                <hr />
            </div>
            <div class="col-md-6">
                <h4><b>{{trans('store.price')}}: <input type="text" class="form-control" value="{{$price}}"></b></h4>
            </div>
            <div class="col-md-6">
                <h4><b>{{trans('store.stock')}}: <input type="text" class="form-control" value="{{$stock}}">
            </div>
            <div class="col-md-12">
                <hr />
            </div>
            <div class="col-md-12">
                <h3>{{trans('store.item_pictures')}}</h3>
                <span class="text-warning">{{trans('store.check_radio_feature_picture')}} <input type="radio" name="reference" checked></span>
                <hr />
                <div class="row">
                    @foreach($pictures as $key => $value)
                        <div class="col-md-4 panel panel-default text-center">
                            <div class="col-md-6 text-left">
                                <br />
                                <input type="radio" id="{{$value->id}}" name="item_pictures" value="{{$value->id}}" {{$value->isFeatured ? 'checked' : ''}}>
                            </div>
                            <div class="col-md-6 text-right">
                                <br />
                                <button class="btn btn-danger "><i class="fa fa-times" area-hidden="true"></i></button>
                            </div>
                            <img src="{{$value->picture}}" width="100%" />
                        </div>
                    @endforeach
                     <div class="col-md-12 panel panel-default text-center">
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
        </div>
    </div>
</div>
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", () => {
    $('#addNewItem').on('click', function() {
        $.ajax({
            url: "/management/item/edit",
            method: "post",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: $('#itemID').val(),
                picture: $('#itemPicture').attr('src')
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