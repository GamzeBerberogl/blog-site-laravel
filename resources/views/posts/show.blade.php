@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $post->title }}</div>

                <div class="card-body">
                    <p>{{ $post->body }}</p>
                    <p><strong>{{ __('Kategori') }}:</strong> {{ $post->category->name }}</p>
                    <p><strong>{{ __('Yazar') }}:</strong> {{ $post->user->name }}</p>
                    <a href="{{ route('home') }}" class="btn btn-primary">{{ __('Tüm Gönderilere Geri Dön') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
