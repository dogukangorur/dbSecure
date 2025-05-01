@extends('frond.frond_master')
@section("title","Anasayfa")
@section("content")

<div class="options mt-4">
<em style="color: white;font-size:20px;"> "Sadece sizin bildiğiniz bir dünya."</em>
</div>


<div class="options mt-4">
    <a href="{{route('login')}}" class="btn btn-danger mx-2">GIRIS</a>
    <a href="{{route('register')}}" class="btn btn-outline-danger mx-2">KAYIT OL</a>
</div>

<!-- Features -->
<section class="py-5 d-flex justify-content-center" id="features">
    <div class=" mb-2 mt-2 p-5 text-center kart wow fadeInUp" data-wow-duration="1s">
        <div class="feature text-white rounded-3 mb-3"><i class="bi bi-lock" style="color: white;"></i></div>
        <h2 class="h5 league-spartan-font" style="color: white;">Güvenilir</h2>
    </div>
    <div class=" mb-2 mt-2 p-5   text-center kart wow fadeInUp" data-wow-duration="1.7s">
        <div class="feature  text-white rounded-3 mb-3"><i class="bi bi-gem" style="color: white;"></i></div>
        <h2 class="h5 league-spartan-font" style="color: white;">Destek</h2>
    </div>
    <div class=" mb-2 mt-2 p-5 text-center kart wow fadeInUp" data-wow-duration="2s">
        <div class="feature  text-white rounded-3 mb-3"><i class="fas fa-cloud" style="color: white;"></i></div>
        <h2 class="h5 league-spartan-font" style="color: white;">Bulut</h2>
    </div>
</section>
@endsection