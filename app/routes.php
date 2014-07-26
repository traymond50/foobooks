<?php

//Home page
Route::get('/', function(){
	return View::make('index');

});

//List books / search results of books
Route::get('/list/{format?}', function($format = 'html'){

	$query = Input::get('query');

	#If there is a query, search the library with that query
	if($query) {

		#This is how we did it in class...
		//$books = Book::where('author','LIKE',"%$query%")->get();

		#Here's a better option because it searches across multiple fields
		$books = Book::where('author','LIKE',"%$query%")
					->orWhere('title','LIKE',"%$query%")
					->orWhere('published_date','LIKE',"%$query%")
					->get();
	}
	#Otherwise, just fetch all books
	else {
		$books = Book::all();
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

	return View::make('add');

});

//Process add form
Route::post('/add/', function(){

	//echo Pre::render(Input::all());


	#Instantiate the book model
	$book = new Book();

	$book->title = Input::get('title');
	$book->author = Input::get('author');
	$book->published_date = Input::get('published_date');
	$book->cover = Input::get('cover');
	$book->purchase_link = Input::get('purchase_link');

	#Magic: Eloquent
	$book->save();

	return "Added a new row";
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

# Quickly seed books table for demonstration purposes
Route::get('/seed', function() {

	$query = "INSERT INTO `books` (`created_at`, `updated_at`, `title`, `author`, `published_date`, `cover`, `purchase_link`)
	VALUES
	('2014-07-17 09:15:14','2014-07-17 09:15:14','The Great Gatsby','F. Scott Fiztgerald',1925,'http://img2.imagesbn.com/p/9780743273565_p0_v4_s114x166.JPG','http://www.barnesandnoble.com/w/the-great-gatsby-francis-scott-fitzgerald/1116668135?ean=9780743273565'),
	('2014-07-17 09:15:47','2014-07-17 09:15:47','The Bell Jar','Sylvia Plath',1963,'http://img1.imagesbn.com/p/9780061148514_p0_v2_s114x166.JPG','http://www.barnesandnoble.com/w/bell-jar-sylvia-plath/1100550703?ean=9780061148514'),
	('2014-07-17 09:16:20','2014-07-17 09:16:20','I Know Why the Caged Bird Sings','Maya Angelou',1969,'http://img1.imagesbn.com/p/9780345514400_p0_v1_s114x166.JPG','http://www.barnesandnoble.com/w/i-know-why-the-caged-bird-sings-maya-angelou/1100392955?ean=9780345514400');
	";

	DB::statement($query);

	return $query;

});


//check to make sure that database connection is working
Route::get('mysql-test', function(){
	#Use the DB component to select all the databases
	$results = DB::select('SHOW DATABASES;');

	#If the "Pre" package is not installed, you should output using print_r instead
	return Paste\Pre::render($results);
});

Route::get('/practice-create',function(){

	#Instantiate the book model
	$book = new Book();

	$book->title = 'Moby Dick';
	$book->author = "Herman Melville";
	$book->published_date = 1865;
	$book->cover = "http://www.amazon.com/s/ref=nb_sb_noss_1?url=search-alias%3Daps&field-keywords=moby%20dick&sprefix=moby+%2Caps&rh=i%3Aaps%2Ck%3Amoby%20dick";
	$book->purchase_link ="http://www.amazon.com/Moby-Dick-Herman-Melville/dp/1495266990/ref=sr_1_1?ie=UTF8&qid=1406341735&sr=8-1&keywords=moby+dick";

	#Magic: Eloquent
	$book->save();

	return "Added a new row";
});

Route::get('/practice-read', function(){

	//$book = new Book();

	# Magic : Eloquent
	$books = Book::all();

	#Debugging
	foreach($books as $book) {
		echo $book->title."<br>";
	}
});

Route::get('/practice-update', function(){
	//$book = Book::where('id','LIKE','%$Scott%)->'first();
	//$book = Book::where('id','=',1);

	$book = Book::find(5);

	$book->title = 'Moby Dick or The Whale';

	$book->save();

	echo "You updated the book.";
});

Route::get('/practice-delete', function(){

	$book = Book::find(4);

	$book->delete();

	echo "This book has been deleted";
});