@extends('layouts.app')

@section('title', $dberita->judul)

@section('content')
    <main class="mb-4">
        <section class="hero">
            <div class="container position-relative">
                <h1 class="text-white">{{ $dberita->judul }}</h1>
            </div>
        </section>

        <section class="container">
            <div class="card shadow-lg border-0 content-card p-4">
                <div class="section-content">
                    <div id="carouselExampleIndicators" class="carousel slide d-none d-md-block" data-bs-ride="carousel">
                        <div class="carousel-indicators mb-3 gap-2">
                            @foreach ($gambar as $key => $item)
                                <button type="button" data-bs-target="#carouselExampleIndicators"
                                    data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"
                                    aria-current="{{ $key == 0 ? 'true' : '' }}" aria-label="Slide {{ $key + 1 }}">
                                </button>
                            @endforeach
                        </div>

                        <div class="carousel-inner">
                            @foreach ($gambar as $item)
                                <div class="carousel-item single-slider {{ $loop->first ? 'active' : '' }}"
                                    style="
                                        background-image: url('https://sumselprov.go.id/storage/{{ substr($item, 7) }}');
                                        height: 600px;
                                        background-position: center center;
                                        background-size: cover;
                                        background-repeat: no-repeat;
                                        position: relative;
                                        z-index: 1;
                                    ">
                                </div>
                            @endforeach
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </button>
                    </div>

                    <div id="carouselExampleIndicators1" class="carousel slide d-block d-md-none" data-bs-ride="carousel">
                        <div class="carousel-indicators gap-2">
                            @foreach ($gambar as $key => $item)
                                <button type="button" data-bs-target="#carouselExampleIndicators1"
                                    data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"
                                    aria-current="{{ $key == 0 ? 'true' : '' }}" aria-label="Slide {{ $key + 1 }}">
                                </button>
                            @endforeach
                        </div>

                        <div class="carousel-inner">
                            @foreach ($gambar as $item)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}" style="height: 100%">
                                    <img src="https://sumselprov.go.id/storage/{{ substr($item, 7) }}"
                                        style="width: 100%; display:block; object-fit: cover;">
                                </div>
                            @endforeach
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators1"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators1"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </button>
                    </div>

                    <div class="blog__content-11 p-relative transition-3" style="text-align: justify">
                        <div class="d-flex col">
                            <i class="flaticon-calendar me-2"></i>
                            {{ \Carbon\Carbon::parse($dberita->tanggal)->isoFormat('dddd, D MMMM Y') }}
                        </div>

                        <p class="mt-3" style="font-size: 20px; text-align: justify">
                            {!! $dberita->isi !!}
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
