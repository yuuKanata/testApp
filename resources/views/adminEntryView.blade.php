@extends('layouts.app')


@section('content')
@if (session('status'))<div class="alert alert-success" role="alert" onclick="this.classList.add('hidden')">{{ session('status') }}</div>@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                @foreach($data as $d)
                <div class="card-header"><h2>{{$d->title}}</h2> <div class="author">投稿者 {{$d->name}}</div>
                    <div class="created">
                        {{$d->a_created}}
                    </div>
                </div>

                <div class="card-body">
                        <span class="econt">{{$d->body}}</span>
                    
                        <div class="created">    
                            
                            <form class="upbtn" method="POST" action="{{ route('entry.del') }}/{{$d->articles_id}}">
                            @csrf
                                <input type="hidden" value="{{$d->articles_id}}" name="a_id"/>
                                <button class="linkbtn btn-primary" type="submit">
                                    {{ __('削除') }}
                                </button>
                            </form>
                            <form class="upbtn" method="get" action="{{ route('entry.edit') }}/{{$d->articles_id}}">
                            @csrf
                                <input type="hidden" value="{{$d->articles_id}}" name="a_id"/>
                                <button class="linkbtn btn-primary" type="submit">
                                    {{ __('編集') }}
                                </button>
                            </form>

                        </div>
                    

                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection