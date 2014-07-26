@extends('_master')

@section('title')
	Add a new book
@stop

@section('content')
	<h1>Add a new Book</h1>

	{{ Form::open(array('url' => '/add', 'method' => 'POST')) }}

		Author: {{ Form::text('author') }} <br>
		Title: {{ Form::text('title')}} <br>
		Published (YYYY): {{ Form::text('published_date') }} <br>
		Cover URL:  {{ Form::text('cover') }} <br>
		Purchase URL: {{ Form::text(('purchase_link')) }} <br>

		{{ Form::submit('Save!') }}

	{{ Form::close() }}

@stop