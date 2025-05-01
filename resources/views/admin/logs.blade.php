@extends("admin.admin_master")
@section("title","Logs")

@section("content")

<div class="row">
    <div class="col-12">
        <br>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <h3 class="text-danger">SON GİRİSLER</h3>
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
                            <thead >
                                <tr>
                                    <th>Sıra</th>
                                    <th>Son Giriş Tarihi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($logs as $index => $log)
                                        <tr>
                                            <td>{{$index+1}}</td>
                                            <td>{{date("d-m-Y H:i:s",strtotime($log->login_date))}}</td>
                                        </tr>
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

                                