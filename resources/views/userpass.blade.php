@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">パスワード再設定</div>

                <div class="card-body">
                    <p>ログインメールアドレス({{$data->email}})</p>
                    <form method="POST" action="{{ route('upass') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="oldpassword" class="col-md-4 col-form-label text-md-right">{{ __('現在のパスワード') }}</label>

                            <div class="col-md-6">
                                <input id="oldpassword" type="password" class="form-control{{ Session::has('passerror') ? ' is-invalid' : '' }}" name="oldpassword" required>

                                @if (session('passerror'))
                                    <span class="invalid-feedback">
                                        <strong>{{ session('passerror') }}</strong>
                                    </span>
                                @endif
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
                                <button type="submit" class="linkbtn btn-primary" onclick="history.back();">
                                    {{ __('戻る') }}
                                </button>

                                <button type="submit" class="linkbtn btn-primary">
                                    {{ __('更新') }}
                                </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
