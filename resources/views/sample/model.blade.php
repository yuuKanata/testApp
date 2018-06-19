@extends('layouts.app')
@section('content');
	<ul>
		@foreach($data as $d)
		<li>{{$d->name}}</li>
		@endforeach
	</ul>	
@endsection