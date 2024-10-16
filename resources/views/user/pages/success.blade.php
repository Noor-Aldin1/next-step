@extends('user.index')

@section('content')
    <div class="container">
        <div class="py-5 text-center">
            <h2>🎉 Payment Successful! 🎉</h2>
            <p>Welcome aboard! Your payment is confirmed, and we're thrilled to have you in our community—get ready for an
                exciting journey ahead!</p>



            <div class="row justify-content-center py-4">
                <div class="col-auto">
                    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
                    <dotlottie-player src="https://lottie.host/78265ed4-d34c-4576-ad1a-0db65ff34b13/UHu9ZyxyzP.json"
                        background="transparent" speed="1" style="width: 400px; height: 400px;" loop
                        autoplay></dotlottie-player>
                </div>
            </div>

            <a href="{{ route('home') }}" class="btn btn-primary">🌟 Back to Home 🌟</a>
        </div>

    </div>
@endsection
