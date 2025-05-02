@extends("admin.admin_master")
@section("title","Dosyalar")
@section("content")
@section("csrf") <meta name="csrf-token" content="{{ csrf_token() }}">   @endsection
<div class="row">
    <div class="col-12">
        <br>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <h3 class="text-danger">DOSYALAR</h3>
        <hr class="text-danger">
    </div>
</div>
<br><br>

<div class="row">
    <div class="col-12">
                            
    <div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-10" style="width: 100%;">
            <div class="card shadow-red">
                <div class="card-body">
                    <div class="table-responsive mb-4">
                        <table class="table table-borderless " style="text-align:center">
                        @if(count($files)>0)
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Dosya Adı</th>
                                            <th>Oluşturma Tarihi</th>
                                            <th></th>
                                            
                                        </tr>
                                    </thead>
                            <tbody>

                            
                                       @foreach($files as $index => $file)
                                        <tr >
                                            <td>{{$index+1}}</td>
                                            <td>{{$file->dosya_orj_adi}}</td>
                                            <td>{{date("d-m-Y H:i:s",strtotime($file->created_at))}}</td>
                                            <td>
                                                
                                                <a href="{{route('file_delete',['id'=>$file->id])}}"><i class="fas fa-trash mx-3"style="color: crimson;font-size:25px"></a></i>
                                                <a href="{{route('file_download',['id'=>$file->id])}}"><i class="fas fa-download mx-3" style="color: crimson;font-size:25px"></a></i>
                                            </td>
                                        </tr>
                                        @endforeach

                             @else

                            <tr><td colspan="4" ><h4 class="my-4">DOSYA BULUNMAMAKTADIR.</h4></td></tr>


                             @endif
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

@section("Ajax")
<script>

</script>
@endsection


@endsection