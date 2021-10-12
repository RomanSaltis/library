@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Knygų sąrašas</div>
                <div class="card-header">
                 <form action="{{route('book.indexSpecifics')}}" method="get">
                   Rūšiavimas
                   <select class="form-control" name="order" id="">
                     <option value="0">rūšiuokite pagal</option>
                     <option value="title">Pavadinimas</option>
                     <option value="pages">Puslapiai</option>
                     <option value="isbn">Isbn</option>
                   </select>
                   Filtravimas
                   <select class="form-control" name="filter" id="">
                     <option value="0">filtruokite pagal</option>
                     @foreach($creators as $creator)
                     <option value="{{$creator->id}}">{{$creator->name}} {{$creator->surname}}</option>
                     @endforeach
                   </select>
                   <button class="btn btn-primary" type="submit">rūšiuokite</button>
                   <a class="btn btn-secondary" href="{{route('book.index')}}">Išvalyti</a>
                 </form>
                 
                </div>

               <div class="card-body">

                  <table class="table">
                          <tr>
                              <th>Pavadinimas</th>
                              <th>Autorius</th>
                              <th>Isbn / Puslapiai</th>
                              <th>Aprašymas</th>
                              @auth
                              <th>Edit</th>
                              <th>Delete</th>
                              @endauth
                          </tr>
                        @foreach ($books as $book)
                            <tr>
                                <td>{{$book->title}}</td>
                                <td>{{$book->bookAuthor->name}} {{$book->bookAuthor->surname}}</td>
                                <td>{{$book->isbn}} / {{$book->pages}}</td>
                                <td>{!! $book->about !!}</td>
                                @auth
                                <td><a class="btn btn-secondary" href="{{route('book.edit',[$book])}}">Redaguoti</a></td>   
                                <td>
                                <form method="POST" action="{{route('book.destroy', $book)}}">
                                    @csrf
                                    <button class="btn btn-warning" type="submit">Ištrinti</button>
                                </form>  
                                </td>
                                @endauth                          
                            </tr>
                        @endforeach
                      </table>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection