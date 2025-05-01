<!-- Footer-->
        <!-- Jquery JS-->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{asset('frond/js/scripts.js')}}"></script>
        <script src="{{asset('frond/lib/wow/wow.min.js')}}"></script>
        <script src="{{asset('frond/lib/OwlCarousel/dist/owl.carousel.min.js')}}"></script>

        <script>
            $(document).ready(function(){
            $('.loader').addClass('hidden');
            new WOW().init();
            });
        </script>
        @yield("javascript")
    </body>
</html>