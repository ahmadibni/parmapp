<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Parma</title>
    <link rel="shortcut icon" href="{{ asset('assets/svgs/logo-mark.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>

<body>

    <div class="flex flex-col items-center px-6 py-10 min-h-dvh">
        <img src="{{ asset('assets/svgs/logo.svg') }}" class="mb-[53px]" alt="">
        <form method="POST" action="{{ route('register') }}"
            class="mx-auto max-w-[345px] w-full p-6 bg-white
            rounded-3xl mt-auto" id="deliveryForm">
            @csrf
            <div class="flex flex-col gap-5">
                <p class="text-[22px] font-bold">
                    New Account
                </p>
                <!-- Full Name -->
                <div class="flex flex-col gap-2.5">
                    <label for="fullname" class="text-base font-semibold">Full Name</label>
                    <input type="text" name="name" id="fullname__" class="form-input"
                        style="background-image: url('{{ asset('assets/svgs/ic-profile.svg') }}');"
                        placeholder="Write your full name">
                </div>
                <!-- Email Address -->
                <div class="flex flex-col gap-2.5">
                    <label for="email" class="text-base font-semibold">Email Address</label>
                    <input type="email" name="email" id="email__" class="form-input"
                        style="background-image: url('{{ asset('assets/svgs/ic-email.svg') }}');"
                        placeholder="Your email address">
                </div>
                <!-- Password -->
                <div class="flex flex-col gap-2.5">
                    <label for="password" class="text-base font-semibold">Password</label>
                    <input type="password" name="password" id="password__" class="form-input"
                        style="background-image: url('{{ asset('assets/svgs/ic-lock.svg') }}');"
                        placeholder="Protect your password">
                </div>
                <!-- Confirm Password -->
                <div class="flex flex-col gap-2.5">
                    <label for="password_confirmation" class="text-base font-semibold">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="confirm-password__" class="form-input"
                        style="background-image: url('{{ asset('assets/svgs/ic-lock.svg') }}');"
                        placeholder="Protect your password">
                </div>
                <button type="submit"
                    class="inline-flex text-white font-bold text-base bg-primary rounded-full whitespace-nowrap px-[30px] py-3 justify-center items-center">
                    Create My Account
                </button>
            </div>
        </form>
        <a href="{{ route('login') }}" class="font-semibold text-base mt-[30px] underline">
            Sign In to My Account
        </a>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</body>

</html>
