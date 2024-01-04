@extends('layouts.app')

@section('content')
<div class="container">
    <form class="card p-2">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Промо-код">
            <button type="submit" class="btn btn-secondary">Выкупить</button>
        </div>
    </form>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
