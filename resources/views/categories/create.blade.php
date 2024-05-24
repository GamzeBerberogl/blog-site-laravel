@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Category</h1>
    <form method="POST" action="{{ route('categories.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Create Category</button>
    </form>
</div>
@endsection
