@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Įrašykite autorių</div>

               <div class="card-body">
                 
            <form method="POST" action="{{route('author.store')}}">

                    <div class="form-group">
                        <label>Vardas</label>
                        <input type="text" name="author_name"  class="form-control" value="{{old('author_name')}}">
                        <small class="form-text text-muted">name</small>
                    </div>
                    <div class="form-group">
                        <label>Pavardė</label>
                        <input type="text" name="author_surname"  class="form-control"value="{{old('author_surname')}}">
                        <small class="form-text text-muted">surname</small>
                    </div>
                    
                    
                    @csrf
                  <button class="btn btn-success" type="submit">Įrašyti</button>
            </form>


               </div>
           </div>
       </div>
   </div>
</div>
@endsection

