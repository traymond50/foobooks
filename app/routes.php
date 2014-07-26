<?php

//Home page
Route::get('/', function(){
	return View::make('index');

});

//List books / search results of books
Route::get('/list/{format?}', function($format = 'html'){

	#Instantiating an object of the Library class
	$library = new Library(app_path().'/database/books.json');

	$query = Input::get('query');

	#If there is a query, search the library with that query
	if($query) {
		$books = $library->search($query);
	}
	#Otherwise, just fetch all books
	else {
		$books = $library->get_books();
	}

	#Decide on output method...
	#Default - HTML
	if($format == 'html'){
		return View::make('list')
				->with('books', $books)
				->with('query', $query);
	}

	//JSON
	elseif($format == 'json'){
		return Response::json($books);
	}

	//PDF (Coming soon)
	elseif ($format == 'pdf'){
		return "This is the pdf (Coming soon).";
	}
});




//Display edit form
Route::get('/edit/{title}',function(){

});

//Process edit form
Route::post('/edit/{title}',function(){

});




//Display add form
Route::get('/add', function(){

});

//Process add form
Route::post('/add/', function(){

});


//Debug route: Read in the books.json file
Route::get('/data', function(){

	//Set the path
	$path = app_path().'/database/books.json';

	//Load the json file
	$books = File::get($path);

	//Convert the string of JSON into object
	$books = json_decode($books,true);

	//Output so we can check it out
	return Paste\Pre::render($books,'Books');
});

//check to make sure that database connection is working
Route::get('mysql-test', function(){
	#Use the DB component to select all the databases
	$results = DB::select('SHOW DATABASES;');

	#If the "Pre" package is not installed, you should output using print_r instead
	return Paste\Pre::render($results);
});