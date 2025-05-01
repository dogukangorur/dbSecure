@extends('frond.frond_master')
@section("title","Giris")
@section("content")


<div class="login">
<form method="POST" action="{{ route('dogrulama') }}" class="my-4">
        @csrf
        <!-- Email Address -->
        <div>
            <label for="dogrulama" >Doğrulama Kodu</label><br>
            <input id="dogrulamaKodu" class="form-control bg-transparent" type="text" name="dogrulamaKodu" value="{{ old('dogrulamaKodu') }}"   required autofocus autocomplete="username" />
        </div>
        <!-- Password -->
        <div class="mt-4">
            <label for="password">Password</label><br>

            <input id="password" class="form-control bg-transparent"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
                            @if($errors->has("email") && $errors->first("email"))
                            <em class="text-danger">Email veya sifre hatali</em>
                            @endif
        </div>

        <div class="flex items-center justify-end mt-4">
        <button type="submit" class="btn btn-outline-danger w-100"> Doğrula</button><br><br>
            
        </div>

    </form>
</div>

@endsection

