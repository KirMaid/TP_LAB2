@extends('layouts.app')
@section('header')
    <header>
        <div class="container my-3">
            <img src= "{{ asset('assets/images/main_banner.png') }}" class="img-fluid" alt="banner"/>
        </div>
    </header>
@endsection
@section('content')
<div class="container">
    @if(session()->has('coupon'))
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <div>
                Применённый промокод:  <strong>{{ session()->get('coupon.code') }}</strong>
            </div>
            <form method="POST" action="{{ route('coupon.remove') }}">
                @csrf
                <button type="submit" class = "btn">Удалить</button>
            </form>
        </div>
    @endif
    @if($isBirthday)
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </symbol>
                <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                </symbol>
                <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </symbol>
            </svg>
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                <div>
                    Сегодня ваш день рождения! Специально для вас скидка 10% на всё!
                </div>
            </div>
    @endif
    <form class="card p-2 mb-3" action="{{ route('coupon.apply') }}">
        @csrf
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Промо-код" required>
            <button type="submit" class="btn btn-outline-dark">Применить</button>
        </div>
    </form>
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
        @foreach ($products as $product)
            <div class="col mb-5">
                <div class="card h-100">
                    @if($product->oldPrice)
                        <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Скидка</div>
                    @endif
                    <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                    <div class="card-body p-4">
                        <div class="text-center">
                            <h5 class="fw-bolder">{{ $product->name}}</h5>
                            <div class="d-flex justify-content-center small text-warning mb-2">
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                            </div>
                            @if($product->oldPrice)
                                <span class="text-muted text-decoration-line-through">{{ $product->oldPrice}} руб.</span>
                            @endif
                            {{ $product->price}} руб.
                        </div>
                    </div>
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center">
                            <a class="btn btn-outline-dark mt-auto" href="#">В корзину</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
@section('footer')
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Магазин канцелярских принадлежностей "Чертила" 2024</p></div>
</footer>
@endsection
