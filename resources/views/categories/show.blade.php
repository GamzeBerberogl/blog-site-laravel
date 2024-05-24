@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $category->name }} {{ __('Kategorisindeki Gönderiler') }}</h1>
    <div class="row">
        @foreach($posts as $post)
        <div class="col-md-4 mb-4 d-flex align-items-stretch">
            <div class="card">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ Str::limit($post->body, 100) }}</p>
                    <div class="mt-auto">
                        <small class="text-muted">
                            {{ __('Yazar') }}: {{ $post->user->name }}
                        </small>
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-outline-primary btn-sm mt-3">{{ __('Devamını Oku') }}</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $posts->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
