@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ユーザー情報') }}</div>

                <div class="card-body">
                    <table>
                        <tr>
                            <td>名前</td>
                            <td>{{$data->name}}</td>
                        </tr>
                        <tr>
                            <td>メールアドレス</td>
                            <td>{{$data->email}}</td>
                        </tr>
                    </table>
                    <div class="btnLink">
                        <form action='{{ route('user.account.edit')}}' method="get">
                        <a href="{{ route('home') }}" >{{ __('戻る') }}</a>
                        <button type="submit" class="linkbtn mginL">
                            {{ __('情報更新') }}
                        </button>
                        <a href="{{ route('passedit') }}" class="mginL">{{ __('パスワード変更') }}</a>
                        </form>
                    </div>
                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
