@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Įrašykite knygą</div>

               <div class="card-body">
                 
            <form method="POST" action="{{route('book.store')}}">

                    <div class="form-group">
                        <label>Pavadinimas</label>
                        <input type="text" name="book_title"  class="form-control" value="{{old('book_title')}}">
                        <small class="form-text text-muted">title</small>
                    </div>
                    <div class="form-group">
                        <label>Puslapiai</label>
                        <input type="number" name="book_pages"  class="form-control"value="{{old('book_pages')}}">
                        <small class="form-text text-muted">pages</small>
                    </div>
                    <div class="form-group">
                        <label>Isbn</label>
                        <input type="text" name="book_isbn"  class="form-control"value="{{old('book_isbn')}}">
                        <small class="form-text text-muted">isbn</small>
                    </div>
                    <div class="form-group">
                        <label>Aprašymas</label>
                        <textarea name="book_about" id="summernote" class="form-control" value="{{old('book_about')}}"></textarea>
                        <small class="form-text text-muted">about</small>
                    </div>
                    <div class="form-group">
                        <label>Autorius</label>
                        <select name="author_id" class="form-control">
                           @foreach ($authors as $author)
                              <option value="{{$author->id}}">{{$author->name}} {{$author->surname}}</option>
                           @endforeach
                        </select>
                        <small class="form-text text-muted">Author</small>
                     </div>
                    
                    
                    @csrf
                  <button class="btn btn-success" type="submit">Įrašyti</button>
            </form>


               </div>
           </div>
       </div>
   </div>
</div>


<script>
$(document).ready(function() {
   $('#summernote').summernote();
 });
</script>


@endsection

