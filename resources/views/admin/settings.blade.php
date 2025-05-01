@extends("admin.admin_master")
@section("title","Ayarlar")
@section("content")


                <div class="row">
                    <div class="col-12">
                    @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                    @include('profile.partials.update-password-form')
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                    @include('profile.partials.delete-user-form')
                    </div>
                </div>
    @endsection


    