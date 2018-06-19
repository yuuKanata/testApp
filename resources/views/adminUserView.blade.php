@extends('layouts.app')


@section('content')
@if (session('status'))<div class="alert alert-success" role="alert" onclick="this.classList.add('hidden')">{{ session('status') }}</div>@endif
<div class="container">
    <div class="card">
        <div class="card-header"><h2>ユーザー一覧</h2></div>
        <div class="card-body">
            <table>
                <tr>
                    <th>ユーザー名</th>
                    <th>メールアドレス</th>
                    <th>権限</th>
                    <th></th>
                    @can('system-only')
                    <th></th>
                    <th></th>
                    @endcan
                </tr>
            @foreach($data as $d)
                <tr>
                    <td>{{$d->name}}</td>
                    <td>{{$d->email}}</td>
                    <td>
                        @if ($d->role == 1)
                            システム管理者
                        @elseif ($d->role <10)
                            管理者
                        @else
                            一般ユーザー
                        @endif
                    </td>
                    <td>
                        @if($d->role ==1)
                        @can('system-only')
                        <div class="btnLink">
                            <a href="{{ route('account.edit') }}/{{$d->id}}" >{{ __('ユーザー編集') }}</a>
                        </div>
                        @endcan
                        @else
                        <div class="btnLink">
                            <a href="{{ route('account.edit') }}/{{$d->id}}" >{{ __('ユーザー編集') }}</a>
                        </div>
                        @endif
                    </td>
                    @can('system-only')
                    <td>
                        <div class="btnLink">
                            <a href="{{ route('userpass') }}/{{$d->id}}" >{{ __('パスワード変更') }}</a>
                        </div>
                    </td>
                    <td>
                        @if($d ->role ==1)
                        @else
                        <div class="btnLink">
                            <form method="POST" action="{{ route('account.index') }}/delete/{{$d->id}}">
                                @csrf
                            <button type="submit" class="linkbtn btn-primary">
                                    {{ __('ユーザー削除') }}
                                </button>
                            </form>
                        </div>
                        @endif
                    </td>
                    @endcan
                </tr>
            @endforeach
            </table>                      
        </div>
    </div>
</div>
@endsection