@extends("admin.admin_master")
@section("title","Şifreler")

@section("content")

<div class="row">
    <div class="col-12">
        <a href="{{route('password.create.page')}}" class="btn btn-danger float-end"><i class="fa-solid fa-plus"></i> YENİ</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <h3 class="text-danger">ŞİFRELER</h3>
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
                    <div class="table-responsive mb-4">
                        <table class="table table-borderless " style="text-align:center">
                                    <thead>
                                        <tr>
                                            <th>Şifre Adı</th>
                                            <th>Kullanıcı Adı</th>
                                            <th>Şifre</th>
                                            <th></th>
                                            
                                        </tr>
                                    </thead>
                            <tbody>
                                        @foreach($passwords as $password)

                                        <tr >
                                            <td>{{$password->sifre_adi}}</td>
                                            <td><p class="card-title py-2 text-center user-name" data-id="{{$password->id}}">**********</p></td>
                                            <td><p class="card-title py-2 text-center password-number" data-id="{{$password->id}}">**********</p></td>
                                            <td>
                                            <div class="card-options">
                    <button class="btn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{$password->id}}">
                        <i class="fas fa-trash text-danger"></i>
                    </button>
                        <button onclick="dataGonder('{{$password->id}}')" id="goster-{{$password->id}}" status="false" class="btn" data-id="{{$password->id}}"><i class="fa-solid fa-eye text-danger"></i></button>
                    </div>

                                            </td>
                                        </tr>


                                                   <!-- Silme Onay Modali -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Kartı Sil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Bu kartı silmek istediğinizden emin misiniz?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">İptal</button>
                <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Sil</a>
            </div>
        </div>
        </div>
    </div>
                                        @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
</div>

@endsection

@section("Ajax")

<script>
    function dataGonder(passwordId) {
        var button = $('#goster-' + passwordId);
        var status = button.attr('status');

        if (status === "false") {
            $.ajax({
                url: '/passwords/show/' + passwordId,
                type: 'GET',
                success: function(data) {
                    if (data.error) {
                        alert(data.error);
                        return;
                    }
                    $('[data-id="' + passwordId + '"].user-name').text(data.kullaniciAdi);
                    $('[data-id="' + passwordId + '"].password-number').text(data.sifre);
                    
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Hatası:', error);
                    alert("Kart bilgileri alınırken hata oluştu!");
                }
            });
            button.attr('status', 'true');
        } else {
            $.ajax({
                url: '/passwords/show/' + passwordId,
                type: 'GET',
                success: function(data) {
                    if (data.error) {
                        alert(data.error);
                        return;
                    }
                    $('[data-id="' + passwordId + '"].password-number').text("**********");
                    $('[data-id="' + passwordId + '"].user-name').text("**********");
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Hatası:', error);
                    alert("Kart bilgileri alınırken hata oluştu!");
                }
            });
            button.attr('status', 'false');
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        let deleteModal = document.getElementById("deleteModal");
        let confirmDeleteBtn = document.getElementById("confirmDeleteBtn");

        deleteModal.addEventListener("show.bs.modal", function (event) {
            let button = event.relatedTarget; // Butonu al
            let passwordId = button.getAttribute("data-id"); // Kart ID’sini al

            // Silme işlemini tetikleyecek URL'yi güncelle
            confirmDeleteBtn.setAttribute("href", "{{ route('password.delete', '') }}/" + passwordId);
        });
    });



</script>

@endsection