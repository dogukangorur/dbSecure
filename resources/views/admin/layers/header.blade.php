<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        @yield("csrf")
        <title>@yield("title") | dbSecure</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="{{ asset('admin/css/styles.css') }}" rel="stylesheet" />
        <link href="{{ asset('admin/css/design.css') }}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        
    </head>
    <div class="loader">
        <div class="spinner-border text-danger" role="status">
                <span class="sr-only"></span>
        </div>
    </div>


    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-black">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="{{route('dashboard')}}">
                <img src="{{asset('img/logo.png')}}" alt="" width="50px" height="50px">
            </a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 " id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        </nav>




        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark bg-black" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading"></div>
                            <a class="nav-link" href="{{route('dashboard')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt" style="color: #bf1818;"></i></div>
                                Anasayfa
                            </a>
                            <a class="nav-link" href="{{route('passwords')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-key" style="color: #bf1818;"></i></div>
                                Şifre
                            </a>
                            <a class="nav-link" href="{{route('cards')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-credit-card" style="color: #bf1818;"></i></div>
                                Kart
                            </a>
                            <a class="nav-link" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <div class="sb-nav-link-icon"><i class="fas fa-file" style="color: #bf1818;"></i></i></div>        
                                Dosyalar
                            </a>
                                <div class="collapse" id="collapseExample">
                                            <a class="nav-link" href="{{route('encryption')}}">
                                                    <div class="sb-nav-link-icon" style="margin-left:10px;"></div>
                                                    Encryption
                                             </a>
                                             <a class="nav-link" href="{{route('decryption')}}">
                                                    <div class="sb-nav-link-icon" style="margin-left:10px;"></div>
                                                    Decryption
                                             </a>
                                             <a class="nav-link" href="{{route('files')}}">
                                                    <div class="sb-nav-link-icon" style="margin-left:10px;"></div>
                                                    Tüm Dosyalar
                                             </a>
                                </div>
                                    
                            <div class="sb-sidenav-menu-heading">Profil</div>
                            <a class="nav-link" href="{{route('profile.edit')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-gear" style="color: #bf1818;"></i></i></div>
                                Ayarlar
                            </a>
                            <a class="nav-link" href="{{route('logs')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-table" style="color: #bf1818;"></i></div>
                                Giriş Geçmişi
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                
                                <a href="route('logout')" class="nav-link"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                                    <div class="sb-nav-link-icon"><i class="fas fa-power-off" style="color: #bf1818;"></i></div>
                                                    {{ __('Çıkış') }}
                                   
                                </a>
                            </form>

                        </div>
                    </div>
            
                </nav>
            </div>
            <div id="layoutSidenav_content" class="bg-content">
                <main>
                    <div class="container-fluid px-4 py-4">