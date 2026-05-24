<x-guest-layout>
    <h4 class="mb-3 text-center">Register</h4>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}" required
                autofocus>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}"
                required>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" name="password" class="form-control" required>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control"
                required>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mb-3">

            <label class="form-label">Captcha</label>

            <div class="d-flex align-items-center gap-2">

                <span>{!! captcha_img() !!}</span>

                <button type="button" class="btn btn-sm btn-primary" onclick="refreshCaptcha()">

                    Refresh

                </button>

            </div>

            <input type="text" name="captcha" class="form-control mt-2" placeholder="Enter Captcha">

            @error('captcha')
                <small class="text-danger">{{ $message }}</small>
            @enderror

        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Register</button>
            <a href="{{ route('login') }}" class="btn btn-link">Already registered?</a>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function refreshCaptcha() {
            fetch('/refresh-captcha')
                .then(response => response.json())
                .then(data => {
                    document.querySelector('.d-flex span').innerHTML = data.captcha;
                });
        }
    </script>
</x-guest-layout>
