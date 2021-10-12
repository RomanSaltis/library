@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Autorių sąrašas</div>

               <div class="card-body">


              <table class="table">
                          <tr>
                              <th>Vardas</th>
                              <th>Pavardė</th>
                              @auth
                              <th>Edit</th>
                              <th>Delete</th>
                              @endauth
                          </tr>
                        @foreach ($authors as $author)
                            <tr>
                                <td>{{$author->name}}</td>
                                <td>{{$author->surname}}</td>
                                @auth                             
                                <td><a class="btn btn-primary" href="{{route('author.edit',[$author])}}">Redaguoti</a></td>   
                                <td>
                                <form method="POST" action="{{route('author.destroy', $author)}}">
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



