@extends('layouts.app')

@section('content')
<div class="hero-section">
    <h1 class="hero-title">HAZ TU PEDIDO</h1>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            @include('form-pedidos')
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .hero-section {
        position: relative;
        height: 400px;
        /*background-image: url('{{ asset('images/restaurant-bg.jpg') }}');*/
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }
    
    .hero-title {
        color: white;
        font-size: 4rem;
        font-weight: bold;
        z-index: 1;
        text-align: center;
    }
</style>
@endsection

@section('scripts')
@stack('scripts')
@endsection