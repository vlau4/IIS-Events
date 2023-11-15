<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
    <header class="text-center">
        <h2 class="text-2xl font-bold uppercase mb-1">
            Login
        </h2>
        <p class="mb-4">Login into your account</p>
    </header>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-6">
            <label for="email" class="inline-block text-lg mb-2">{{ __('Email Address') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>
        </div>

        <div class="mb-6">
            <label for="password" class="inline-block text-lg mb-2">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
            <div class="col-md-6 offset-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>
        </div>

        <div class="mb-6">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"">
                    {{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
        </div>
    </form>
    </x-card>
</x-layout>
