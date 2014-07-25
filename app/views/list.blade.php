@extends ('_master')

@section('head')
	<link rel='stylesheet' href='css/foobooks.css' type='text/css'>
@stop

@section('title')
	All your Books
@stop

@section('content')

	View as:
		<a href='/list/json' target='_blank'>JSON</a>
		<a href='/list/pdf' target='_blank'>PDF</a>

	<br><br>

	@foreach($books as $title => $book)

		<section>
			<img class='cover' src='{{ $book['cover'] }}'>

			<h2>{{ $title}}</h2>

			Author: {{ $book['author']}}

			<p>

			Published: {{ $book['published']}}

			</p>

			<p>
				Tags:
				<br>
				@foreach($book['tags'] as $tag)
						{{$tag}}<br>
				@endforeach
			</p>

		</section>
	
	@endforeach

@stop