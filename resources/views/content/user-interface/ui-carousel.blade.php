@extends('layouts/contentNavbarLayout')

@section('title', 'Carousel - UI elements')

@section('content')
<div class="row g-6">
    <!-- Bootstrap carousel -->
    <div class="col-md">
        <h5 class="mb-6">Bootstrap carousel</h5>

        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('assets/img/elements/3.png') }}" alt="First slide" />
                    <div class="carousel-caption d-none d-md-block">
                        <h3>First slide</h3>
                        <p>Eos mutat malis maluisset et, agam ancillae quo te, in vim congue pertinacia.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('assets/img/elements/4.png') }}" alt="Second slide" />
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Second slide</h3>
                        <p>In numquam omittam sea.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('assets/img/elements/5.png') }}" alt="Third slide" />
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Third slide</h3>
                        <p>Lorem ipsum dolor sit amet, virtute consequat ea qui, minim graeco mel no.</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
    </div>
    <!-- Bootstrap crossfade carousel -->
    <div class="col-md">
        <h5 class="mb-6">Bootstrap crossfade carousel (dark)</h5>

        <div id="carouselExampleDark" class="carousel carousel-dark slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('assets/img/elements/7.png') }}" alt="First slide" />
                    <div class="carousel-caption d-none d-md-block">
                        <h3>First slide</h3>
                        <p>Eos mutat malis maluisset et, agam ancillae quo te, in vim congue pertinacia.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('assets/img/elements/8.png') }}" alt="Second slide" />
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Second slide</h3>
                        <p>In numquam omittam sea.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('assets/img/elements/10.png') }}" alt="Third slide" />
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Third slide</h3>
                        <p>Lorem ipsum dolor sit amet, virtute consequat ea qui, minim graeco mel no.</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleDark" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleDark" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
    </div>
</div>
@endsection