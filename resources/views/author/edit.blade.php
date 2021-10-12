@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Redagavimas</div>

               <div class="card-body">
                 
            <form method="POST" action="{{route('author.update',$author)}}">
                <div class="form-group">
                        <label>Vardas</label>
                        <input type="text" name="author_name" class="form-control" value="{{old('author_name',$author->name)}}">
                        <small class="form-text text-muted">Name</small>
                </div>
                <div class="form-group">
                        <label>Pavardė</label>
                        <input type="text" name="author_surname" class="form-control" value="{{old('author_surname',$author->surname)}}">
                        <small class="form-text text-muted">Surname</small>
                        
                </div>
                
                  @csrf
                  <button class="btn btn-success" type="submit">Atnaujinti</button>
            </form>


               </div>
           </div>
       </div>
   </div>
</div>
@endsection
