@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Каталог товаров</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($goods as $good)
            <div class="col">
                <div class="card">
                    <img src="{{$good->image ? asset("assets/".$good->image) : "https://dummyimage.com/450x300/dee2e6/6c757d.jpg"}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <a href="{{ route('catalog.category', ['name' => $good->name]) }}">
                            <h5 class="card-title">
                                {{ $good->name }}
                            </h5>
                        </a>
                        <p class="card-text">{{$good->content}}</p>
                        @if(\Illuminate\Support\Facades\Auth::user() && (\Illuminate\Support\Facades\Auth::user()->hasRole('admin')))
                        <a href="#" class="btn btn-primary">Обновить</a>
                        <form action="{{ route('product.delete', $good->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Удалить продукт</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
@section('footer')
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Магазин канцелярских
                принадлежностей "Чертила" 202
            </p>
        </div>
    </footer>
@endsection
