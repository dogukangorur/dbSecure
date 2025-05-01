@extends("admin.admin_master")
@section("title","Cards")

@section("content")

<div class="row">
    <div class="col-12">
    </div>
</div>
<div class="row">
    <div class="col-12">
        <h3 class="text-danger">ŞİFRE EKLE</h3>
        <hr class="text-danger">
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="container my-4">
            <div class="row justify-content-center">
                <div class="col-md-10" style="width: 100%;">
                    <div class="card shadow-red p-3">
                        <div class="card-body">
                            <div class="cards justify-content-center flex-column align-items-center">
                                <div class="card text-bg-danger mb-3 mx-1 " style="max-width:80%">
                                    <form action="{{route('password.create')}}" method="POST">
                                        @csrf
                                        <div class="card-header d-flex justify-content-between align-items-center">

                                            <div class="card-adi">
                                                <input type="text" name="passwordName" id="passwordName" style="width:80%" max=50 min=1 required>
                                            </div>
                                            <div class="card-options">
                                                <button type="submit" class="btn"><i class="fas fa-floppy-disk text-white" style="height: 25px;"></i></button>
                                            </div>
                                        </div>
                                        <div class="card-body">

                                            <h5 class="card-title py-4 text-center" id="card_number">
                                                <p class="card-text text-center mb-0">KULLANICI ADI</p><br>
                                                <input type="text" name="userName" id="userName" style="width:80%" max=50 min=1 required>
                                            </h5>



                                            <h5 class="card-title py-4 text-center" id="card_number">
                                                <p class="card-text text-center mb-0">ŞİFRE</p><br>
                                                <input type="text" name="passwordNo" id="passwordNo" style="width:80%" required>
                                            </h5>
                                            <div class="card-footer bg-transparent d-flex justify-content-around">
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