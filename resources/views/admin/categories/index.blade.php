@extends('layouts.app')

@section('content')
<div class="container">
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
                                <th scope="col">Name</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{$category["id"]}}</td>
                                <td>{{$category["name"]}}</td>
                                <td>{{$category["slug"]}}</td>
                                <td>
                                    <a href="{{route("admin.categories.show", $category["id"])}}">
                                        <button class="btn btn-primary" type="button">Visualizza</button>
                                    </a>
                                    <a href="{{route("admin.categories.edit", $category["id"])}}">
                                        <button class="btn btn-warning" type="button">Modifica</button>
                                    </a>
                                    <form action="{{route("admin.categories.destroy", $category["id"])}}" method="POST">
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