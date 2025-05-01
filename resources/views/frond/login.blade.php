@extends('frond.frond_master')
@section("title","Giris")
@section("content")


<div class="login">
<form method="POST" action="{{ route('login') }}" class="my-4">
        @csrf
        <!-- Email Address -->
        <div>
            <label for="email" >Email</label><br>
            <input id="email" class="form-control bg-transparent" type="email" name="email" value="{{ old('email') }}" style="width: 250px;"   required autofocus autocomplete="username" />
        </div>
        <!-- Password -->
        <div class="mt-4">
            <label for="password">Password</label><br>

            <input id="password" class="form-control bg-transparent" style="width: 250px;"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
                    
        </div>
    
        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="
                form-check-input bg-transparent" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Beni Hatırla') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
        <button type="submit" class="btn btn-outline-danger w-100"> Giris</button><br><br>
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Şifreni mi unuttun ?') }}
                </a>
            @endif
            <br><br>
        </div>

    </form>
</div>

@endsection

