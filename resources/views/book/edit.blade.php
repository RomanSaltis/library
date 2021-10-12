@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Redagavimas</div>

               <div class="card-body">
                 
            <form method="POST" action="{{route('book.update',$book)}}">
                <div class="form-group">
                        <label>Pavadinimas</label>
                        <input type="text" name="book_title" class="form-control" value="{{old('book_title',$book->title)}}">
                        <small class="form-text text-muted">Title</small>
                </div>
                <div class="form-group">
                        <label>Puslapiai</label>
                        <input type="number" name="book_pages" class="form-control" value="{{old('book_pages',$book->pages)}}">
                        <small class="form-text text-muted">pages</small>
                </div>
                <div class="form-group">
                        <label>Isbn</label>
                        <input type="text" name="book_isbn" class="form-control" value="{{old('book_isbn',$book->isbn)}}">
                        <small class="form-text text-muted">isbn</small>
                </div>
                <div class="form-group">
                        <label>Aprašymas</label>
                        <textarea name="book_about" id="summernote" class="form-control" value="{{old('book_about', $book->about)}}">></textarea>
                        <small class="form-text text-muted">about</small>
                </div>
                <div class="form-group">
                        <label>Autorius</label>
                           <select name="author_id" class="form-control">
                              @foreach ($authors as $author)
                                    <option value="{{$author->id}}" @if($author->id == $book->author_id) selected @endif>
                                       {{$author->name}} {{$author->surname}} 
                                    </option>
                              @endforeach
                           </select>
                              <small class="form-text text-muted">Author</small>
                     </div>
                
                  @csrf
                  <button class="btn btn-success" type="submit">Atnaujinti</button>
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
