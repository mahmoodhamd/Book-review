<?php

namespace App\Http\Controllers;


use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
         $title=$req->input('title');
         $author = $req->input('author');
         $filter=$req->input('filter','');

        //  $books =Book::when(
        //     $title,

        //      fn($query,$title)=> $query->title($title),

        //     // dd($title)
        //     //dd($author)
        //  )
        //  ->get();

        $books = Book::when(
            $title,
            fn($query, $title) => $query->title($title),
        )->when(
            $author,
            fn($query, $author) => $query->author($author),
        );

        $books = match($filter){
          'popular_last_month'=>$books->popularLastMonth(),
          'popular_last_6months'=>$books->popularLast6Months(),
          'highest_rated_last_month'=>$books->highestRatedLastMonth(),
          'highest_rated_last_6months'=>$books->highestRatedLast6Months(),
          default=>$books->latest()

        };
        $books=$books->get();

         return view('books.index',['books'=>$books]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
