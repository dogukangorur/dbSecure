@extends("admin.admin_master")
@section("title","Dashboard")
@section("content")


<div class="row">
    <div class="col-12">

    <div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-10" style="width: 100%;">
            <div class="card shadow-red p-3">
                <div class="card-body">
                     <div style="display:flex;flex-direction:column;" class="text-center">
                        <p style="font-size: 20px;">Hoş Geldin <i class="fas fa-face-smile text-danger" style="font-size: 20px;"></i></p>
                        <h4>{{Auth::user()->name}} {{Auth::user()->surname}}</h4>
                     </div>
                     <hr style="color:crimson;">

                     <div class="info">
                                <div class="card text-bg-info m-3 text-center fs-3" style="width: 18rem;">
                                <div class="card-body">
                                    <div><i class="fas fa-key fs-5 mb-2 text-white"></i></div>
                                    <h5 class="card-title text-white">Şifre</h5>
                                    <p class="card-text text-white" id="passNum"></p>
                                </div>
                                </div>

                                <div class="card text-bg-warning text-center m-3 fs-3" style="width: 18rem;">
                                <div class="card-body">
                                <div><i class="fas fa-credit-card fs-5 mb-2 text-white"></i></div>
                                    <h5 class="card-title text-white">Kart</h5>
                                    <p class="card-text text-white" id="cardNum"></p>
                                </div>
                                </div>



                                <div class="card text-bg-danger text-center fs-3  m-3" style="width: 18rem;">
                                <div class="card-body">
                                <div><i class="fas fa-file fs-5 mb-2 text-white"></i></div>
                                    <h5 class="card-title text-white">Dosya</h5>
                                    <p class="card-text text-white" id="fileNum"></p>
                                </div>
                                </div>
                        </div>
                    </div>
                    <hr style="color:crimson;">
                    <div>
                        <p>Şifre</p>
                        <div class="progress" role="progressbar" aria-label="Info example" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-info" id="password" style="width: 50%"></div>
                        </div>
                        <p>Kart</p>
                        <div class="progress" role="progressbar" aria-label="Warning example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-warning" id="cards" style="width: 75%"></div>
                        </div>
                        <p>Dosya</p>
                        <div class="progress" role="progressbar" aria-label="Danger example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-danger" id="files" style="width: 100%"></div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>



<br><br>
           

@section("chart")

<script>
    
    document.addEventListener("DOMContentLoaded", function() {
        fetch('/dashboard/api')
            .then(response => response.json())
            .then(data => {
                let passwordCount = data.passwordCount;
                let fileCount = data.fileCount;
                let cardCount = data.cardCount;
                let total =  passwordCount+fileCount+cardCount;
                document.getElementById("password").style.width=`${(passwordCount/total)*100}%`;
                document.getElementById("cards").style.width=`${(cardCount/total)*100}%`;
                document.getElementById("files").style.width=`${(fileCount/total)*100}%`;

                document.getElementById("passNum").textContent=passwordCount;
                document.getElementById("cardNum").textContent=cardCount;
                document.getElementById("fileNum").textContent=fileCount;

            });
    });
</script>

@endsection

@endsection