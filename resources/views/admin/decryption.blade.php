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
        <h3 class="text-danger">DECRYPTION</h3>
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
                                    <input class="form-control border border-danger border-1 " type="text" id="decKey" name="decKey" required placeholder="Anahtar Değeri Giriniz">
                                </div>

                                <div class="mb-3">
                                    <textarea class="form-control border border-danger border-1 " placeholder="Şifre Giriniz" name="decArea" id="decArea" rows="5"></textarea>
                                </div>
                                <div class="mb-3">
                                    <div class="mb-3">
                                        <select class="form-select form-control border border-danger border-1" aria-label="Default select example">
                                            <option selected>Dosya Türü</option>
                                            @foreach($fileTypes as $type)
                                            <option value="{{$type->ad}}">{{substr($type->ad,1)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 text-center">
                                    <button type="button" class="btn btn-dark text-danger" onclick="coz()" style="width:200px;">Çözümle</button>
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
    function coz() {
        var decKey = document.getElementById("decKey");
        var fileType = document.querySelector('.form-select').value;
        var formData = new FormData();
        formData.append("decArea", decArea.value);
        formData.append("decKey", decKey.value);
        formData.append("fileType", fileType);
        formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
        if (decArea.value == "" || decKey.value == "") {
            if (decKey.value == "") {
                toastr.error("Lütfen Anahtar Kelime Giriniz !");
                return;
            } else {
                toastr.error("Lütfen Şifre Alanını Doldurun !");
                return;
            }

        }
        $.ajax({
            url: "/decryption",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (String(response.data).trim() == "hata") {

                    toastr.error("Hatalı Key Girdiniz !!!");
                } else {
                    if ([".jpg", ".jpeg", ".png", ".pdf", ".docx", ".xlsx"].includes(response.file_type)) {
                        let img = document.createElement("img");
                        img.src = "data:image/" + response.file_type + ";base64," + response.file_content;
                        img.style.maxWidth = "500px"; // Önizleme için
                        document.body.appendChild(img);

                        // Resmi indirme işlemi
                        let link = document.createElement("a");
                        link.href = img.src;
                        link.download = response.file_name;
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                    }
                    // 📄 Eğer dosya bir metin dosyasıysa
                    else {
                        let blob = new Blob([response.file_content], {
                            type: "text/plain"
                        });

                        let link = document.createElement("a");
                        link.href = URL.createObjectURL(blob);
                        link.download = response.file_name;
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                    }
                }
            },
            error: function(xhr) {
                toastr.error("Hata");
            }
        });
    }
</script>
@endsection


@endsection