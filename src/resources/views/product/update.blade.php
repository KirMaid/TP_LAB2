@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <form method="POST" action="{{ route('product.store') }}">
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
                    <label class="form-label" for="brand">Brand</label>
                    <input class="form-control" type="text" id="brand" name="brand" value="{{$product->brand}}">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="category">Category</label>
                    <input class="form-control" type="text" id="category" name="category" value="{{$product->category}}">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="content">Content</label>
                    <textarea class="form-control" id="content" name="content">{{$product->content}}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="price">Price</label>
                    <input class="form-control" type="number" id="price" name="price" value="{{$product->price}}">
                </div>
                <input class="btn btn-primary" type="submit" value="Submit">
            </form>
            <button id="generateDesc" class="btn btn-primary">Сгенерировать описание</button>
        </div>
    </div>
@endsection
@section('footer')
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">
                Copyright &copy; Магазин канцелярских
                принадлежностей "Чертила" 2024
            </p>
        </div>
    </footer>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('#generateDesc').click(function(){
            $.ajax({
                url: '/add-product/generate-description',
                type: 'GET',
                success: function(data){
                    $('#content').val(data.description);
                },
                error: function(error){
                    console.log(error);
                }
            });
        });
    });
</script>
