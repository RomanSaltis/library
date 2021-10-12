<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Author;
use Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //    $books = Book::all();
       $books = Book::orderBy('title')->orderBy('author_id')->get();
       $creators = Author::all();
       return view('book.index', ['books' => $books, 'creators' => $creators]);
    }

    public function indexSpecifics(Request $request)
    {
        $order = $request->order;
        $filter = $request->filter;
        $books = Book::all();

        if($order != 0){
            $books = $books->sortBy($order);
                        
        }
        if($filter != 0){
               $books = $books->where('author_id','=',$filter); 
            }
    //    $books = Book::orderBy('surname')->orderBy('name')->get();
       $creators = Author::all();
       return view('book.index', ['books' => $books, 'creators' => $creators]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all();
       return view('book.create', ['authors' => $authors]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
       $request->book_title =  ucwords(strtolower($request->book_title));
       
        $validator = Validator::make($request->all(),
            [
                'book_title' => ['required', 'min:2', 'max:30'],
                'book_pages' => ['required', 'numeric', 'min:1', 'max:300000'],
                'book_isbn' => ['required', 'numeric', 'min:1', 'max:99999999999999'],
                'book_about' => ['required', 'min:2', 'max:10000'],
                
            ],
            [
                'book_title.required' => 'Pavadinimas privalomas',
                'book_title.min' => 'Pavadinimas per trumpas',
                'book_title.max' => 'Pavadinimas per ilgas',

                'book_pages.required' => 'Laukas "Puslapiai " privalomas',
                'book_pages.numeric' => 'Laukas "Puslapiai " turi būti užpildytas skaičiais',
                'book_pages.min' => 'Laukas "Puslapiai " reikšmė per maža',
                'book_pages.max' => 'Laukas "Puslapiai " reikšmė per didelė',

                'book_isbn.required' => 'Laukas "Isbn " privalomas',
                'book_isbn.numeric' => 'Laukas "Isbn " turi būti užpildytas skaičiais',
                'book_isbn.min' => 'Lauko "Isbn " reikšmė per maža',
                'book_isbn.max' => 'Lauko "Isbn " reikšmė per didelė',

                'book_about.required' => 'Laukas "Aprašymas " privalomas',
                'book_about.min' => 'Lauko "Aprašymas " reikšmė per maža',
                'book_about.max' => 'Lauko "Aprašymas " reikšmė per didelė',

                'book_registered.required' => 'Laukas "Klube registruotas" privalomas',
                'book_registered.numeric' => 'Laukas "Klube registruotas" turi būti užpildytas skaičiais',
                'book_registered.min' => 'Lauko "Klube registruotas" reikšmė per maža',
                'book_registered.max' => 'Lauko "Klube registruotas" reikšmė per didelė',


            ]
        );
    if ($validator->fails()) {
        $request->flash();
        return redirect()->back()->withErrors($validator);
    }     



       $book = new Book;
       $book->title = $request->book_title;
       $book->pages = $request->book_pages;
       $book->isbn = $request->book_isbn;
       $book->about = $request->book_about;
       $book->author_id = $request->author_id;
       $book->save();
       return redirect()->route('book.index')->with('success_message', 'Sekmingai įrašytas.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $authors = Author::all();
       return view('book.edit', ['book' => $book, 'authors' => $authors]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
$request->book_title =  ucwords(strtolower($request->book_title));
       
        $validator = Validator::make($request->all(),
            [
                'book_title' => ['required', 'min:2', 'max:30'],
                'book_pages' => ['required', 'numeric', 'min:1', 'max:300000'],
                'book_isbn' => ['required', 'numeric', 'min:1', 'max:99999999999999'],
                'book_about' => ['required', 'min:2', 'max:10000'],
                
            ],
            [
                'book_title.required' => 'Pavadinimas privalomas',
                'book_title.min' => 'Pavadinimas per trumpas',
                'book_title.max' => 'Pavadinimas per ilgas',

                'book_pages.required' => 'Laukas "Puslapiai " privalomas',
                'book_pages.numeric' => 'Laukas "Puslapiai " turi būti užpildytas skaičiais',
                'book_pages.min' => 'Laukas "Puslapiai " reikšmė per maža',
                'book_pages.max' => 'Laukas "Puslapiai " reikšmė per didelė',

                'book_isbn.required' => 'Laukas "Isbn " privalomas',
                'book_isbn.numeric' => 'Laukas "Isbn " turi būti užpildytas skaičiais',
                'book_isbn.min' => 'Lauko "Isbn " reikšmė per maža',
                'book_isbn.max' => 'Lauko "Isbn " reikšmė per didelė',

                'book_about.required' => 'Laukas "Aprašymas " privalomas',
                'book_about.min' => 'Lauko "Aprašymas " reikšmė per maža',
                'book_about.max' => 'Lauko "Aprašymas " reikšmė per didelė',

                'book_registered.required' => 'Laukas "Klube registruotas" privalomas',
                'book_registered.numeric' => 'Laukas "Klube registruotas" turi būti užpildytas skaičiais',
                'book_registered.min' => 'Lauko "Klube registruotas" reikšmė per maža',
                'book_registered.max' => 'Lauko "Klube registruotas" reikšmė per didelė',


            ]
        );
    if ($validator->fails()) {
        $request->flash();
        return redirect()->back()->withErrors($validator);
    }     



       $book->title = $request->book_title;
       $book->pages = $request->book_pages;
       $book->isbn = $request->book_isbn;
       $book->about = $request->book_about;
       $book->author_id = $request->author_id;
       $book->save();
       return redirect()->route('book.index')->with('success_message', 'Sėkmingai pakeistas.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
       return redirect()->route('book.index')->with('success_message', 'Sekmingai ištrintas.');
    }
}
