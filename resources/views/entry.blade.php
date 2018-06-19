@extends('layouts.app')

@section('content')
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

                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection