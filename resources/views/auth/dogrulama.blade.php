@extends('frond.frond_master')
@section("title","Giris")
@section("content")


<div class="login">
<form method="POST" action="{{ route('dogrulama.kontrol') }}" class="my-4">
        @csrf
        <!-- Email Address -->
        <div style="margin-bottom: 15px;">
            <strong style="color: white;">Kalan Süre: 00:<span id="timer">60</span> saniye</strong>
        </div>
        <div>
            <label for="dogrulama" >Doğrulama Kodu</label><br><br>
            <input id="dogrulamaKodu" class="form-control bg-transparent" type="text" name="kod" value="{{ old('kod') }}"   required  />
        </div>

        <div class="flex items-center justify-end mt-4">
        <button type="submit" class="btn btn-outline-danger w-100"> Doğrula</button><br><br>
            
        </div>

    </form>
</div>

@endsection

@section("javascript")
<script>
let kalanSure = 60;
    const timerElement = document.getElementById('timer');

    const interval = setInterval(() => {
        kalanSure--;
        timerElement.textContent = kalanSure;

        if (kalanSure <= 0) {
            clearInterval(interval);
            // AJAX logout isteği atılıyor
            fetch("/logout", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": '{{ csrf_token() }}',
                    "Content-Type": "application/json"
                }
            }).then(() => {
                window.location.href = "{{ route('login') }}";
            });
        }
    }, 1000);
</script>


@endsection
