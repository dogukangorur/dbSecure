</div>
</main>
<footer class="py-4 mt-auto bg-black mt-5">
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
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('admin/js/scripts.js') }}"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script
<script src="{{ asset('admin/assets/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('admin/assets/demo/chart-bar-demo.js') }}"></script>> -->
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
<script src="{{ asset('admin/js/datatables-simple-demo.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(document).ready(function() {
        $('.loader').addClass('hidden');
        $(".datatable-info").remove();
        $('label:contains("entries per page")').contents().filter(function() {
            return this.nodeType === 3;
        }).remove();
        $(".datatable-selector").remove();
        $(".datatable-input").attr("placeholder","Ara...");
      
      });
</script>
@yield("Ajax")
@yield("chart")
</body>

</html>