@extends('layouts.app')
@section('title', 'Edit profile')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10">
            <h1>{{trans('profile.profile_edit')}}<a href="/{{app()->getLocale()}}/profile/show/{{$id}}" class="push-right btn btn-primary">{{trans('profile.show')}}</a></h1>
            <hr />
        </div>
        <div class="col-md-12">
            <h3>{{trans('profile.profile_info')}}</h3>
            <br />
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="username">{{trans('profile.username')}}</label>
                        <input type="text" class="form-control" id="username" placeholder="Username" value="{{$username}}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-6">
                        <label for="avatar">{{trans('profile.avatar')}}</label>
                        <input class="form-control" id="selectAvatar" type="file" />
                    </div>
                    <div class="col-md-6 text-center">
                        <img class="img img-circle user-status status-{{$state}}" id="avatar" src="{{$avatarURL}}" width="100px"/>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">{{trans('profile.email')}}</label>
                        <input type="email" class="form-control" id="email" placeholder="Email" value="{{$email}}" />
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="firstname">{{trans('profile.firstname')}}</label>
                        <input type="text" class="form-control" id="firstname" placeholder="Firstname" value="{{$firstname}}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lastname">{{trans('profile.lastname')}}</label>
                        <input type="text" class="form-control" id="lastname" placeholder="Lastname" value="{{$lastname}}" />
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="country">{{trans('profile.country')}}</label>
                        <input type="text" class="form-control" id="country" placeholder="Country" value="{{$country}}" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-12 text-right">
                <button type="submit" id="submit" class="btn btn-primary">{{trans('generic.submit')}}</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

$(document).ready(function() {
    

    $('#submit').click(function() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/profile/edit',
            method: 'POST',
            data: {
                'username': $('#username').val(),
                'email': $('#email').val(),
                'firstname': $('#firstname').val(),
                'lastname': $('#lastname').val(),
                'birthdate': $('#birthdate').val(),
                'gender': $('#gender').val(),
                'country': $('#country').val(),
                'theme': $('#theme').val(),
                'showFirstname': $('#showFirstname').is(':checked'),
                'showLastname': $('#showLastname').is(':checked'),
                'showGender': $('#showGender').is(':checked'),
                'showBirthdate': $('#showBirthdate').is(':checked'),
                'showAge': $('#showAge').is(':checked'),
                'avatar' : $('#avatar').attr('src'),
            },
            beforeSend: function() {
                $('#submit').addClass('disabled');
                $('#submit').attr('disabled', '');
            },
            success: function() {
                toastr.success('Editing success', 'You\'re profile have been saved successfuly. If you changed the theme, the change will be applied on the next page you visit.')
                $('#submit').removeClass('disabled');
                $('#submit').removeAttr('disabled', '');
            },
            error: function (error) {
                toastr.error('An error occured', 'An error occured while trying to edit your profil try again later.')
                $('#submit').removeClass('disabled');
                $('#submit').removeAttr('disabled', '');
                console.log(error);
            }
        })
    });

const input = document.getElementById("selectAvatar");
const avatar = document.getElementById("avatar");

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
    avatar.src = base64;
};

input.addEventListener("change", (e) => {
    uploadImage(e);
});
});
</script>
@stop
