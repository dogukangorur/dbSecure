@extends("admin.admin_master")
@section("title","Encryption")
@section("content")
@section("csrf")
<meta name="csrf-token" content="{{ csrf_token() }}"> @endsection
<div class="row">
    <div class="col-12">
        <br>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <h3 class="text-danger">ENCRYPTION</h3>
        <hr class="text-danger">
    </div>
</div>


<div class="row">
    <div class="col-12">

        <div class="container my-4">
            <div class="row justify-content-center">
                <div class="col-md-10" style="width: 100%;">
                    <div class="card shadow-red">
                        <div class="card-body">

                            <div class="file">
                                <div class="mb-3">
                                    <input class="form-control border border-danger border-1" type="file" id="formFile" name="encFile" required>
                                </div>
                                <div class="mb-3">
                                    <input class="form-control border border-danger border-1" type="text" id="formKey" name="encKey" required placeholder="Anahtar Değeri Giriniz">
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control border border-danger border-1" id="encArea" rows="5" disabled readonly></textarea>
                                </div>
                                <div class="mb-3 text-center">
                                    <button type="button" class="btn btn-dark text-danger" onclick="sifrele()" style="width:200px;">Şifrele</button>
                                    <button type="submit" class="btn btn-danger" onclick="sifreleKaydet()" style="width:200px;">Şifrele ve Kaydet</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section("Ajax")
<script>
    function sifrele() {
        var encArea = document.getElementById("encArea");
        var file = document.getElementById("formFile").files[0];
        var key = document.getElementById("formKey").value;
        var formData = new FormData();
        formData.append("encFile", file);
        formData.append("encKey", key);
        formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
        if (!file) {
            toastr.error("Lütfen Dosya Yükleyinz !");
            return;
        }
        $.ajax({
            url: "/encryption",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $("#encArea").val(response.data);
            },
            error: function(xhr) {
                toastr.error("Hata");
            }
        });
    }

    function sifreleKaydet() {
        var encArea = document.getElementById("encArea");
        var file = document.getElementById("formFile").files[0];
        var key = document.getElementById("formKey").value;
        var formData = new FormData();
        formData.append("encFile", file);
        formData.append("encKey", key);
        formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
        if (!file) {
            toastr.error("Lütfen Dosya Yükleyinz !");
            return;
        }
        $.ajax({
            url: "/api/files",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                toastr.success(response.data);
            },
            error: function(xhr) {
                toastr.error("Hata");
            }
        });
    }
</script>
@endsection


@endsection