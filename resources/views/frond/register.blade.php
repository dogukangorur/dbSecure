@extends('frond.frond_master')
@section("title", "Kayıt Ol")
@section("content")

<div class="login">
    <form method="POST" action="{{ route('register') }}" class="my-4">
        @csrf

        <div class="row" style="max-width: 520px;">
            <div class="col-md-6 mb-3">
                <label for="name">Ad</label>
                <input id="name" class="form-control bg-transparent" type="text" name="name" value="{{ old('name') }}" required autofocus />
                @error('name')
                    <em class="text-danger">{{ $message }}</em>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="surname">Soyad</label>
                <input id="surname" class="form-control bg-transparent" type="text" name="surname" value="{{ old('surname') }}" required />
                @error('surname')
                    <em class="text-danger">{{ $message }}</em>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="number">Telefon</label>
                <input id="number" class="form-control bg-transparent" type="text" name="number" value="{{ old('number') }}" maxlength="11" required />
                @error('number')
                    <em class="text-danger">{{ $message }}</em>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="email">Email</label>
                <input id="email" class="form-control bg-transparent" type="email" name="email" value="{{ old('email') }}" required />
                @error('email')
                    <em class="text-danger">{{ $message }}</em>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="password">Şifre</label>
                <input id="password" class="form-control bg-transparent" type="password" name="password" required />
                @error('password')
                    <em class="text-danger">{{ $message }}</em>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="password_confirmation">Şifre (Tekrar)</label>
                <input id="password_confirmation" class="form-control bg-transparent" type="password" name="password_confirmation" required />
                @error('password_confirmation')
                    <em class="text-danger">{{ $message }}</em>
                @enderror
            </div>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-outline-danger w-100">Kayıt Ol</button>
            <br><br>
            <a href="{{ route('login') }}">Zaten üye misin? Giriş yap</a>
        </div>
    </form>
</div>

@endsection
