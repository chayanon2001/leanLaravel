@extends('layouts.app')
@section('title', 'Edit Article')
@section('content')
    <h2 class="text text-center py-2">Edit Article</h2>
    <form method="POST" action="{{route('update',$blog->id)}}">
        @csrf
        <div class=" form-group">
            <label for="title">Article title</label>
            <input type="text" name="title" class="form-control" value="{{$blog->title}}">
        </div>
        @error('title')
        <div class="my-2">
            <span class="text text-danger">{{$message}}</span>
        </div>
            
        @enderror
        <div class=" form-group">
            <label for="content">Article Content</label>
            <textarea name="content" cols="30" rows="5" class="form-control" id="content">"{{$blog->content}}"</textarea>
        </div>
        @error('content')
        <div class="my-2">
            <span class="text text-danger">{{$message}}</span>
        </div>
            
        @enderror
        <input type="submit" value="Update" class="btn btn-primary my-2">
        <a href="/author/blog" class="btn btn-warning">All Articles</a>
    </form>
    
    <script type="module">
        import {
            ClassicEditor,
            Essentials,
            Bold,
            Italic,
            Font,
            Paragraph
        } from 'ckeditor5';
    
        ClassicEditor
            .create( document.querySelector( '#content' ), {
                plugins: [ Essentials, Bold, Italic, Font, Paragraph ],
                toolbar: {
                    items: [
                        'undo', 'redo', '|', 'bold', 'italic', '|',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
                    ]
                }
            } )
            .catch( error=>{
                console.error(error);
            });
    </script>
@endsection
