@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@if ($flg =='adminInsert'){{ __('ユーザー登録') }} @else {{ __('ユーザー編集') }} @endif</div>

                <div class="card-body">
                @if ($flg == 'admin')
                    <form method="POST" action="{{ route('account.edit') }}">
                @elseif($flg == 'adminInsert')
                    <form method="POST" action="{{ route('account.regist') }}">
                @else
                    <form method="POST" action="{{ route('user.account.edit')}}">
                @endif
                @csrf

                {{--ユーザー情報更新（システム管理者用）--}}

                    @if(isset($data))
                        @if ($data->role == 1 && $flg == 'admin')
                        @can ('system-only')
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('HN') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $data->name }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('メールアドレス') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $data->email }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('権限') }}</label>

                                <div class="col-md-6">
                                    <select name='role' class="form-control">
                                        <option value="1" @if($data->role==1) selected @endif>システム管理者</option>
                                        <option value="5" @if($data->role==5) selected @endif>管理者</option>
                                        <option value="10" @if($data->role==10) selected @endif>一般ユーザー</option>
                                    </select>   
                                </div>
                            </div>
                        @endcan
                            <div class="btnLink">
                                <a href="{{ route('account.index') }}" >{{ __('戻る') }}</a>
                                @can ('system-only')
                                <button type="submit" class="linkbtn">
                                    {{ __('更新') }}
                                </button>
                                @endcan
                            </div>

                {{--ユーザー情報更新（管理者用）--}}
                        @else
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('HN') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $data->name }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('メールアドレス') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $data->email }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @can ('admin-higher')
                            @if ($flg == 'admin')
                                <div class="form-group row">
                                    <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('権限') }}</label>

                                    <div class="col-md-6">
                                        <select name='role' class="form-control">
                                            <option value="5" @if($data->role==5) selected @endif>管理者</option>
                                            <option value="10" @if($data->role==10) selected @endif>一般ユーザー</option>
                                        </select>   
                                    </div>
                                </div>
                            @endif

                            @endcan
                                <div class="btnLink">
                                    @if($flg == 'admin')
                                    <a href="{{ route('account.index') }}" >{{ __('戻る') }}</a>
                                    @else
                                    <a href="{{ route('home') }}" >{{ __('戻る') }}</a>
                                    @endif
                                    <button type="submit" class="linkbtn">
                                        {{ __('更新') }}
                                    </button>
                                </div>
                        @endif

                {{--ユーザー登録--}}
                    @else
                        @if ($flg == 'adminInsert')
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('HN') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('メールアドレス') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('権限') }}</label>

                            <div class="col-md-6">
                                <select name='role' class="form-control">
                                    <option value="5">管理者</option>
                                    <option value="10" selected>一般ユーザー</option>
                                </select>   
                            </div>
                        </div>
                        

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('新しいパスワード') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('パスワード（確認用）') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                            <div class="btnLink">
                                <a href="{{ route('account.index') }}" >{{ __('戻る') }}</a>
                                <button type="submit" class="linkbtn">
                                    {{ __('登録') }}
                                </button>
                            </div>
                        @endif
                    @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
