@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Modifica profilo</div>

                <div class="card-body">
                    <form method="POST" action="{{ action('UserController@editUpdate') }}">
                       <input type="hidden" name="_method" value="put">
                       
                       @method('put')
                       
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ trans('custom.name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $user->name) }}" autofocus>
                                
                                @if ($errors->has('name'))
                                   <span class="invalid-feedback">
                                       <strong>{{ $errors->first('name') }}</strong>
                                   </span>
                                @endif

                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">Surname</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" value="{{ old('surname', $user->surname) }}" autofocus>
                                
                                @if ($errors->has('surname'))
                                   <span class="invalid-feedback">
                                       <strong>{{ $errors->first('surname') }}</strong>
                                   </span>
                                @endif

                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="nickname" class="col-md-4 col-form-label text-md-right">Nickname</label>

                            <div class="col-md-6">
                                <input id="nickname" type="text" class="form-control{{ $errors->has('nickname') ? ' is-invalid' : '' }}" name="nickname" value="{{ old('nickname', $user->nickname) }}" autofocus>
                                
                                @if ($errors->has('nickname'))
                                   <span class="invalid-feedback">
                                       <strong>{{ $errors->first('nickname') }}</strong>
                                   </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email', $user->email) }}">
                                
                                @if ($errors->has('email'))
                                   <span class="invalid-feedback">
                                       <strong>{{ $errors->first('email') }}</strong>
                                   </span>
                                @endif


                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Conferma
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection