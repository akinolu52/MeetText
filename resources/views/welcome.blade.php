<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Sign up</title>
</head>

<body>
<div class="container">
    <div class="side-hero"></div>
    <div class="sign-up-section">
        <h1 class="logo">MeeText</h1>
        <div class="form-section">
            <div class="form-heading">
                <h3>Get started absolutely free.</h3>
                <p class="headline">Get simple easy text notifications of meetups around you!.</p>
            </div>
            <form action="{{ route('submitPhone') }}" class="sign-up-form" method="post">
                {{ csrf_field() }}
                <div class="input-wrapper">
                    <label for="email" class="form__label" style="line-height: 30px; font-size: 15px;">PHONE NUMBER</label>
                    <input type="tel" name="phone" class="form__input" required placeholder="08000000000" value="08102058382">
                </div>
                <div class="button-wrapper">
                    <button type="submit" class="btn facebook">Register with Facebook</button>
                    <a href="{{ route('social.login', 'facebook') }}" class="btn ">sign In</a>
                </div>
            </form>
            {{--<div class="button-wrapper">
                <a href="{{ route('social.login', 'facebook') }}" class="btn facebook">Continue with Facebook</a>--}}
            <footer>
                <p>By clicking "Continue" I agree to MeeText's Terms of Service and Privacy Policy.</p>
            </footer>
        </div>


    </div>
</div>

</body>

</html>