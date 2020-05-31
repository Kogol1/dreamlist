@extends('layouts.app')

@section('content')
    <div class="wrapper">

        <div class="row">
            <div class="col-md-8 offset-md-2">

                @if(isset($user))
                    <h1><i class="fas fa-user-edit"></i> {{__('users/createOrUpdate.update')}}</h1>
                    {{ Form::model($user ,['action' => ['UsersController@update', $user->id], 'method' => 'patch', 'files' => true]) }}
                    <div class="message">
                    </div>
                @else
                    <h1><i class="fas fa-user-plus"></i> {{__('users/createOrUpdate.new')}}</h1>
                    {{ Form::open(['action' => 'UsersController@store', 'method' => 'POST']) }}
                @endif
                @if(!isset($user))
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::bsEmail('email', __('users/createOrUpdate.email'), '', []) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::bsText('password', __('users/createOrUpdate.password'), null, ['class' => 'password']) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    {{ Form::checkbox('admin', 1, 0, ['class' => 'custom-control-input', 'id' => 'switch1']) }}
                                    <label class="custom-control-label" for="switch1">Admin</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <p class="btn btn-success" onclick="generatePassword()">Generate random password</p>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                @else
                    <div class="row">
                        <div class="col-md-2">
                            <div class="user-side">
                                <div class="photo backstretch" style="background-image: url({{$user->picture}});">
                                    <figure>
                                        <img src="{{ Auth::user()->picture }}" alt="Logo">
                                    </figure>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-10">
                            <div class="input-group form-group mt-5">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">Upload new photo</span>
                                </div>
                                <div class="custom-file">
                                    {{Form::file('profile_image',['class' => 'custom-file-input', 'aria-describedby' => 'inputGroupFileAddon01'])}}
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file (Maximum file size is 5MB)</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::bsText('first_name', __('users/createOrUpdate.first_name'), null, []) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::bsText('last_name', __('users/createOrUpdate.last_name'), null, []) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::bsText('address', __('users/createOrUpdate.address'), null, []) }}
                        </div>
                    </div>
                    @if(!isset($user))
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-group">
                                    {{ Form::label(__('users/createOrUpdate.join_date')) }}
                                    {{ Form::bsDate('join_date', __('users/createOrUpdate.join_date'),'',['required' => 'required']) }}
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::bsText('email', __('users/createOrUpdate.email'), null, ['readonly']) }}
                            </div>
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label(__('users/createOrUpdate.prefix')) }}
                            @if(!isset($user))
                                {{ Form::price('bank_account_1', '' , [], []) }}
                            @else
                                {{ Form::price('bank_account_1', ($user->prefix ? $user->prefix : '') , [], []) }}
                            @endif
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            {{ Form::label(__('users/createOrUpdate.bank_account')) }}
                            @if(!isset($user))
                                {{ Form::price('bank_account_2', '', [], ['maxlength' => 10]) }}
                            @else
                                {{ Form::price('bank_account_2', ($user->account_number ? $user->account_number : ''), [], ['maxlength' => 10]) }}
                            @endif
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            {{ Form::label( __('users/createOrUpdate.bank_code')) }}
                            @if(!isset($user))
                                {{ Form::price('bank_account_3', '', ['maxlength' => 4, 'minlength' => 4], []) }}
                            @else
                                {{ Form::price('bank_account_3', ($user->bank_code ? $user->bank_code : ''), ['maxlength' => 4, 'minlength' => 4], []) }}
                            @endif
                        </div>
                    </div>
                </div>
                {{Form::submit(__('users/createOrUpdate.save'), ['class' => 'btn btn-primary'])}}

                {{ Form::close() }}

            </div>
        </div>
    </div>
    <script>
        @if(!isset($user))
        function randomPassword() {
            var chars = "abcdefghijklmnopqrstuvwxyz!@#$%&+-*ABCDEFGHIJKLMNOP1234567890";
            var pass = "";
            for (var x = 0; x < 10; x++) {
                var i = Math.floor(Math.random() * chars.length);
                pass += chars.charAt(i);
            }
            return pass;
        }

        function generatePassword() {
            password.value = randomPassword();
        }

        var fp = flatpickr(".flatpickr", {
            altInput: true,
            altFormat: "d.m.Y",
            dateFormat: "Y-m-d",
            wrap: true
        })
        @else
        $('input[type="file"]').change(function (e) {
            var fileName = e.target.files[0].name;
            $('.custom-file-label').html(fileName);
        });
        @endif
    </script>
@endsection

