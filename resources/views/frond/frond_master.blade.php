@include("frond.layers.header")

    <section class="container-fluid bg-black welcome">
        <div class="container">
            <div class="content">
                <div class="logo">
                    <a href="{{route('welcome')}}">
                        <img src="{{asset('img/logo.png')}}" alt="dbSecure">
                    </a>
                </div>
                <div class="brand mb-2">
                    db<em>Secure</em>
                </div>

@yield("content")
                            <footer class="py-4 mt-auto bg-black">
                                <div class="container px-5">
                                    <div class="row align-items-center justify-content-center  flex-sm-row">
                                        <div class="col-auto">
                                            <div class="small m-0 text-danger">Copyright &copy; dbSecure <?php echo date("Y"); ?></div>
                                        </div>
                                    </div>
                                </div>
                            </footer>
                
                        </div>   
                    </div>
                </section>

@include("frond.layers.footer")
