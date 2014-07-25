<?php

//Home page
Route::get('/', function(){
	return View::make('index');

});

//List books / search results of books
Route::get('/list/{format?}', function($format = 'html'){

	// Set the path
	$path = app_path().'/database/books.json';

	// Load the json file
	$books = File::get($path);
 
	// Convert the string of JSON into object
	$books = json_decode($books,true);

	//Default - HTML
	if($format == 'html'){
		return View::make('list')->with('books',$books);
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