<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Validator;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::all();
       return view('author.index', ['authors' => $authors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('author.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->author_name =  ucwords(strtolower($request->author_name));
       $request->author_surname =  ucwords(strtolower($request->author_surname));

        $validator = Validator::make($request->all(),
            [
                'author_name' => ['required', 'min:2', 'max:30'],
                'author_surname' => ['required', 'min:2', 'max:30'],
            ],
            [
                'author_name.required' => 'Autoriaus vardas privalomas',
                'author_name.min' => 'Autoriaus vardas per trumpas',
                'author_name.max' => 'Autoriaus vardas per ilgas',

                'author_surname.required' => 'Autoriaus pavardė privaloma',
                'author_surname.min' => 'Autoriaus pavardė per trumpa',
                'author_surname.max' => 'Autoriaus pavardė per ilga',
            ]
        );
       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }



        $author = new Author;
        $author->name = $request->author_name;
        $author->surname = $request->author_surname;
        $author->save();
        return redirect()->route('author.index')->with('success_message', 'Sekmingai įrašytas.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        return view('author.edit', ['author' => $author]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
       $request->author_name =  ucwords(strtolower($request->author_name));
       $request->author_surname =  ucwords(strtolower($request->author_surname));

    $validator = Validator::make($request->all(),
            [
                'author_name' => ['required', 'min:2', 'max:30'],
                'author_surname' => ['required', 'min:2', 'max:30'],
            ],
            [
                'author_name.required' => 'Autoriaus vardas privalomas',
                'author_name.min' => 'Autoriaus vardas per trumpas',
                'author_name.max' => 'Autoriaus vardas per ilgas',

                'author_surname.required' => 'Autoriaus pavardė privaloma',
                'author_surname.min' => 'Autoriaus pavardė per trumpa',
                'author_surname.max' => 'Autoriaus pavardė per ilga',
            ]
        );
       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }

    
       $author->name = $request->author_name;
       $author->surname = $request->author_surname;
       $author->save();
       return redirect()->route('author.index')->with('success_message', 'Sėkmingai pakeistas.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        if($author->authorBooks->count()){
            return redirect()->route('author.index')->with('info_message', ' '.$author->name. ' '.$author->surname. " ".'trinti negalima, nes turi narių.');

       }
       $author->delete();
       return redirect()->route('author.index')->with('success_message', ' '.$author->name. ' '.$author->surname. " ".'Sekmingai ištrintas.');
    }
}
