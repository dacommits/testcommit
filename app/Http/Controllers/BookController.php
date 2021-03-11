<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    
	private $book;
    function __construct (Book $book){
    	$this->book = $book;
    }

    public function save(Request $request ){
    	$requestBody = json_decode($request->getContent());
    	$this->book->create(['name' => $requestBody->name,
    		'author' => $requestBody->author,
    		'year' => $requestBody->year,
            'review' => $requestBody->review]);

    	if ($this->book->where('name', $requestBody->name)->exists()) {
    		return json_encode("Book added successfuly");
    	}
    	
    }

    public function get(){
    	$booksIterable = $this->book->all();
        $books = array();

        foreach ($booksIterable as $book) {
            $books[] = array('name'=> $book->name, 'author' => $book->author, 'year' => $book->year);
        }
    	return json_encode($books);
    }
}
