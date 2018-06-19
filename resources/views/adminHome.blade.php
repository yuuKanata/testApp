@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                        <div class="form-group row mb-0">
                            
                                    <div class="btnLink">
                                        <a href="{{ route('account.index') }}" >{{ __('ユーザー管理') }}</a>
                                    </div>

                                    <div class="btnLink">
                                        <a href="{{ route('account.regist') }}" >{{ __('ユーザー登録') }}</a>
                                    </div>

                                    <div class="btnLink">
                                        <a href="{{ route('entry.view') }}" >{{ __('記事管理') }}</a>
                                    </div>
                            
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection