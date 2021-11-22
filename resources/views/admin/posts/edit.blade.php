@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Aggiungi post</div>
                <div class="card-body">
                    <form action="{{route("admin.posts.update", $post["id"])}}" method="POST">
                        @csrf
                        @method("PUT")
                        <div class="form-group">
                          <label for="title">Titolo</label>
                          <input type="text" class="form-control @error("title") is-invalid @enderror" name="title" id="title" placeholder="Inserire il titolo" value="{{old("title") ? old("title") : $post["title"]}}">
                            @error('title')
                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="content">Contenuto</label>
                            <textarea class="form-control @error("content") is-invalid @enderror" name="content" id="content" cols="30" rows="10" placeholder="Inserire il contenuto">{{old("content") ? old("content") : $post["content"]}}</textarea>
                            @error('content')
                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category">Categoria</label>
                            <select name="category_id" class="form-control @error("category_id") is-invalid @enderror">
                                <option value="">-- Seleziona una categoria --</option>
                                @foreach ($categories as $category)
                                    @if (old("category_id") == $category["id"])
                                    <option selected value="{{$category["id"]}}">{{$category["name"]}}</option>
                                    @elseif(isset($post["category"]) && $post["category"]["id"] == $category["id"])
                                    <option selected value="{{$category["id"]}}">{{$category["name"]}}</option>
                                    @else
                                    <option value="{{$category["id"]}}">{{$category["name"]}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <p>Tags</p>
                            @foreach ($tags as $tag)
                            <div class="custom-control custom-checkbox">
                                <input {{$post["tags"]->contains($tag["id"]) ? "checked" : null}} name="tags[]" value="{{$tag["id"]}}" type="checkbox" class="custom-control-input" id="tag-{{$tag["id"]}}">
                                <label class="custom-control-label" for="tag-{{$tag["id"]}}">{{$tag["name"]}}</label>
                            </div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary">Salva</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection