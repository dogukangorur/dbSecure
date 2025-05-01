@extends("admin.admin_master")
@section("title","Cards")

@section("content")

<div class="row">
    <div class="col-12">
    </div>
</div>
<div class="row">
    <div class="col-12">
        <h3 class="text-danger">KART EKLE</h3>
        <hr class="text-danger">
    </div>
</div>


<div class="row">
    <div class="col-12">

        <div class="container my-4">
            <div class="row justify-content-center">
                <div class="col-md-10" style="width: 100%;">
                    <div class="card shadow-red p-5">
                        <div class="card-body">
                            <div class="cards justify-content-center flex-column align-items-center">
                                <div class="card text-bg-danger mb-3 mx-1" style="max-width:80%">
                                    <form action="{{route('card.create')}}" method="POST">
                                        @csrf
                                        <div class="card-header d-flex justify-content-between align-items-center">

                                            <div class="card-adi">
                                                <input type="text" name="cardName" id="cardName" style="width:80%" max=50 min=1 required>
                                            </div>
                                            <div class="card-options">
                                                <button type="submit" class="btn"><i class="fas fa-floppy-disk text-white" style="height: 25px;"></i></button>
                                            </div>
                                        </div>
                                        <div class="card-body">

                                            <h5 class="card-title py-4 text-center" id="card_number">
                                                <p class="card-text text-center mb-0">KART NUMARASI</p><br>
                                                <input type="text" name="cardNo" id="cardNo" style="width:80%" maxlength="16" maxlength="16" pattern="[0-9]{16}" required>
                                            </h5>
                                            <div class="card-footer bg-transparent d-flex justify-content-around">
                                                <div class="text-center">
                                                    <p class="card-text text-center mb-0">SKT</p>
                                                    <input type="text" name="cardSkt" id="cardSkt" style="width:80%" minlength="5" maxlength="5" pattern="[0-9]{2}/[0-9]{2}" required>
                                                </div>
                                                <div class="text-center">
                                                    <p class="card-text text-center mb-0">CVV</p>
                                                    <input type="text" name="cardCvv" id="cardCvv" style="width:80%" minlength="3" maxlength="3" pattern="[0-9]{3}" required>

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @endsection