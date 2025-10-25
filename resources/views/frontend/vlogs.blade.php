@extends('layouts.master')
@section('content')
    <section class="w-full h-[60vh] md:h-screen big-hight flex items-center justify-center overflow-hidden"
        style="background-image: url('{{ asset('assets/images/Banners/read_banner.png') }}'); background-size: cover; background-position: center;">
    </section>

    <section class="w-full h-fit">
        <x-vlogs-card :vlogs="$vlogs" :locale="app()->getLocale()" />
    </section>
@endsection
