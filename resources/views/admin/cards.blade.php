@extends("admin.admin_master")
@section("title","Cards")

@section("content")

<div class="row">
    <div class="col-12">
        <a href="{{route('card.create.page')}}" class="btn btn-danger float-end"><i class="fa-solid fa-plus"></i> YENİ</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <h3 class="text-danger">KARTLAR</h3>
        <hr class="text-danger">
    </div>
</div>

<div class="row">
    <div class="col-12">

    <div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-10" style="width: 100%;">
            <div class="card shadow-red py-3">
                <div class="card-body">

        <div class="cards">
            @if(count($cards) == 0)
            <div class="cards justify-content-center flex-column align-items-center">
                <div class="card text-bg-danger mb-3 mx-1" style="max-width:80%">
                    <div class="card-body">

                        <h5 class="card-title py-4 text-center" id="card_number">
                            <p class="card-text text-center mb-0">KAYITLI KART BULUNAMADI</p><br>
                            <i class="fas fa-circle-exclamation" style="height: 30px;"></i>
                        </h5>
                        <div class="card-footer bg-transparent d-flex justify-content-around">
                        </div>
                    </div>
                    </form>
                </div>
            </div>

            @else

            @foreach($cards as $card)
            <div class="card text-bg-danger mb-3 mx-1" style="width:25rem" data-id="{{$card->id}}">
                <div class="card-header d-flex justify-content-between">
                    <div class="card-adi">
                        {{$card->kart_adi}}
                    </div>
                    <div class="card-options">
                    <button class="btn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{$card->id}}">
                        <i class="fas fa-trash text-light"></i>
                    </button>
                        <button onclick="dataGonder('{{$card->id}}')" id="goster-{{$card->id}}" status="false" class="btn" data-id="{{$card->id}}"><i class="fa-solid fa-eye text-light"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title py-4 text-center card-number" data-id="{{$card->id}}">{{substr($card->kart_no,0,3)}}*************</h5>

                    <div class="card-footer bg-transparent d-flex justify-content-around">
                        <div>
                            <p class="card-text text-center mb-0">SKT</p>
                            <p class="card-text skt" data-id="{{$card->id}}">**/**</p>
                        </div>
                        <div>
                            <p class="card-text text-center mb-0">CVV</p>
                            <p class="card-text text-center cvv" data-id="{{$card->id}}">***</p>
                        </div>
                    </div>
                </div>
            </div>


    
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
            @endif
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
    function dataGonder(cardId) {
        var button = $('#goster-' + cardId);
        var status = button.attr('status');

        if (status === "false") {
            $.ajax({
                url: '/cards/show/' + cardId,
                type: 'GET',
                success: function(data) {
                    if (data.error) {
                        alert(data.error);
                        return;
                    }
                    $('[data-id="' + cardId + '"].card-number').text(data.no);
                    $('[data-id="' + cardId + '"].skt').text(data.skt);
                    $('[data-id="' + cardId + '"].cvv').text(data.cvv);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Hatası:', error);
                    alert("Kart bilgileri alınırken hata oluştu!");
                }
            });
            button.attr('status', 'true');
        } else {
            $.ajax({
                url: '/cards/show/' + cardId,
                type: 'GET',
                success: function(data) {
                    if (data.error) {
                        alert(data.error);
                        return;
                    }
                    $('[data-id="' + cardId + '"].card-number').text(data.no.substr(0, 3) + "**********");
                    $('[data-id="' + cardId + '"].skt').text("**/**");
                    $('[data-id="' + cardId + '"].cvv').text("***");
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
            let cardId = button.getAttribute("data-id"); // Kart ID’sini al

            // Silme işlemini tetikleyecek URL'yi güncelle
            confirmDeleteBtn.setAttribute("href", "{{ route('card.delete', '') }}/" + cardId);
        });
    });



</script>

@endsection