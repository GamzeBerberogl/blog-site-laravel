@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Blog Posts</h1>
    <!-- Subscription Form -->
    <div class="card mt-4 shadow-sm">
        <div class="card-header bg-primary text-white">{{ __('Abone Ol') }}</div>

        <div class="card-body">
            <form method="POST" action="{{ route('subscribe') }}">
                @csrf
                <div class="form-group">
                    <label for="email">{{ __('Posta almak için e-posta adresini kaydet') }}</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <button type="submit" class="btn btn-primary mt-3">{{ __('Gönder') }}</button>
            </form>
        </div>
    </div>

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
