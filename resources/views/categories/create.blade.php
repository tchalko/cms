{{--@extends('layouts.app')--}}
{{--@section('content')--}}
    {{--<h1 class="text-center my-5">Create Categories</h1>--}}
    {{--<div class="row justify-content-center">--}}
        {{--<div class="col-md-8">--}}
            {{--<div class="card card-default">--}}
                {{--<div class="card-header">Create new category</div>--}}
                {{--<div class="card-body">--}}
                    {{--@if($errors->any())--}}
                        {{--<div class="alert alert-danger">--}}
                            {{--<ul class="list-group">--}}
                                {{--@foreach($errors->all() as $error)--}}
                                    {{--<li class="list-group-item">{{$error}}</li>--}}
                                {{--@endforeach--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                    {{--@endif--}}
                    {{--<form action="/store-categories" method="POST">--}}
                        {{--@csrf--}}
                        {{--<div class="form-group">--}}
                            {{--<input type="text" class="form-control" placeholder="Name" name="name">--}}
                        {{--</div>--}}
                        {{--<div class="form-group text-center">--}}
                            {{--<button type="submit" class="btn btn-success">Create Category</button>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--@endsection--}}

@extends('layouts.app')
@section('title')
    {{ isset($category) ? 'Edit Category' : 'Create Category' }}
@endsection
@section('content')
    {{--<div class="row justify-content-center">--}}
    {{--<div class="col-md-8">--}}
    <div class="card card-default">
        <div class="card-header">{{ isset($category) ? 'Edit Category' : 'Create Category' }}</div>
        <div class="card-body">
            @include('partials.errors')
            <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" method="POST">
                @csrf
                @if(isset($category))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" class="form-control" name="name" value="{{isset($category) ? $category->name : ''}}">
                </div>
                <div class="form-group">
                    <button class="btn btn-success">{{isset($category) ? 'Update Category' : 'Add Category'}}</button>
                </div>
            </form>
        </div>
    </div>
    {{--</div>--}}
    {{--</div>--}}
@endsection
