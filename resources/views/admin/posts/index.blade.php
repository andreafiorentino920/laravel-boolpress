@extends('layouts.app')

@section('content')
<div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                
                <div class="card-body">
                    @if ($message = Session::get("success"))
                        <div class="alert alert-success alert-block">
                            <button class="close" type="button" data-dismiss="alert">x</button>
                            <strong>{{$message}}</strong>
                        </div>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Category</th>
                                <th scope="col">Tags</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                            <tr>
                                <td>{{$post["id"]}}</td>
                                <td>{{$post["title"]}}</td>
                                <td>{{$post["slug"]}}</td>
                                <td>{{isset($post["category"]["name"]) ? $post["category"]["name"] : ""}}</td>
                                <td>
                                    <div class="tag-container d-flex">
                                        @if (count($post["tags"]) > 0)
                                        @foreach ($post["tags"] as $tag)
                                            <span class="badge badge-primary">{{$tag["name"]}}</span>
                                        @endforeach
                                    @endif
                                    </div>
                                </td>
                                <td  class="d-flex">
                                    <a class="p-2" href="{{route("admin.posts.show", $post["id"])}}">
                                        <button class="btn btn-primary p-2" type="button">Visualizza</button>
                                    </a>
                                    <a class="p-2" href="{{route("admin.posts.edit", $post["id"])}}">
                                        <button class="btn btn-warning p-2" type="button">Modifica</button>
                                    </a>
                                    <form class="p-2" action="{{route("admin.posts.destroy", $post["id"])}}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-danger">Elimina</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{route("admin.posts.index")}}">Visualizza tutti i post</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection