@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <h1>{{$post["title"]}}</h1>
                    @if ($post["category"])
                    <h3>Categoria: {{$post["category"]["name"]}}</h3>
                    @endif
                    @if ($post["tags"])
                    <h3>Tags:</h3>
                    @foreach ($post["tags"] as $tag)
                        <span class="badge badge-primary">{{$tag["name"]}}</span>
                    @endforeach
                    @endif
                    <p>{{$post["content"]}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection