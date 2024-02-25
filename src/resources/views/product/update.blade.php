@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center d-flex align-items-center justify-content-center" style="min-height: 82vh;">
            <div class="col">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('product.update', $product->id) }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="image">Image</label>
                        <input class="form-control" type="text" id="image" name="image" value="{{$product->image}}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="name">Name</label>
                        <input class="form-control" type="text" id="name" name="name" value="{{$product->name}}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="content">Content</label>
                        <textarea class="form-control" id="content" name="content">{{$product->content}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="price">Price</label>
                        <input class="form-control" type="number" id="price" name="price" value="{{$product->price}}">
                    </div>
                    <input class="btn btn-primary" type="submit" value="Сохранить">
                </form>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <footer class="py-5 bg-dark" style="min-height: 18vh;">
        <div class="container">
            <p class="m-0 text-center text-white">
                Copyright &copy; Магазин канцелярских
                принадлежностей "Чертила" 2024
            </p>
        </div>
    </footer>
@endsection

