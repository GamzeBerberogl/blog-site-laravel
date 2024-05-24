@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ __('Gönderilerim') }}</h1>
    <a href="{{ route('new-post') }}" class="btn btn-primary mb-3">{{ __('Yeni Gönderi Oluştur') }}</a>
    <div class="row">
        @foreach($posts as $post)
        <div class="col-md-4 mb-4 d-flex align-items-stretch">
            <div class="card">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ Str::limit($post->body, 100) }}</p>
                    <div class="mt-auto">
                        <small class="text-muted">
                            {{ __('Kategori') }}: {{ $post->category->name }} |
                            {{ __('Yazar') }}: {{ $post->user->name }}
                        </small>
                        <div class="mt-3">
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-outline-primary btn-sm mt-2">{{ __('Devamını Oku') }}</a>
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-outline-warning btn-sm mt-2">{{ __('Düzenle') }}</a>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm mt-2">{{ __('Sil') }}</button>
                        </form>

                        </div>
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
