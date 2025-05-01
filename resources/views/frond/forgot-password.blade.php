@extends('frond.frond_master')
@section("title","Giris")
@section("content")


<div class="login">
<form method="POST" action="{{ route('dogrulama.kontrol') }}" class="my-4">
        @csrf
        <div>
            <label for="dogrulama" >Email</label><br><br>
            <input id="dogrulamaKodu" class="form-control bg-transparent" type="text" name="email" value="{{ old('email') }}"   required  />
        </div>

        <div class="flex items-center justify-end mt-4">
        <button type="submit" class="btn btn-outline-danger w-100"> Gönder</button><br><br>
            
        </div>

    </form>
</div>

@endsection