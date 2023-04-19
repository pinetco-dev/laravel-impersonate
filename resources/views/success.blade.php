<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Impersonation') }}</title>
</head>
<style type="text/css">
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    img {
        max-width: 100%;
    }

    a {
        text-decoration: none;
    }

    .banner-block {
        height: 100vh;
        display: flex;
        font-size: 16px;
        overflow: hidden;
        align-items: center;
        flex-direction: column;
        background-color: #fff;
    }

    .banner-center {
        width: 100%;
        margin: auto;
        max-width: 650px;
        text-align: center;
        padding: 24px 40px;
        color: #34475b;
        box-shadow: 0 0px 3px rgb(52 71 91 / 30%);
        border-radius: 12px;
    }

    .banner-title {
        font-size: 36px;
        margin: 16px 0;
    }

    .text-green {
        color: #1691ae !important;
    }

    .banner-desc-upper > p > .text-green {
        font-weight: 600;
    }

    .banner-center p {
        font-size: 22px;
    }

    .banner-desc-upper {
        margin-bottom: 20px;
    }

    .banner-desc-upper a {
        font-weight: 600;
        color: #34475b;
    }

    .banner-desc-middle p {
        margin-bottom: 10px;
    }

    .banner-desc-middle p:last-child {
        margin-bottom: 0px;
    }

    .go-back-sec {
        margin-top: 20px;
    }

    @media all and (max-width: 767px) {
        .banner-block {
            padding: 20px;
        }

        .banner-title {
            font-size: 28px;
            margin: 12px 0;
        }

        .banner-center p {
            font-size: 18px;
        }
    }
</style>

<body>
<div class="banner-block">
    <div class="banner-center">
        <div class="banner-image">
            <h1 class="banner-title">{{ __('Help is on the way') }}</h1>
        </div>
        <div class="banner-desc-upper">
            <p>
                {{ __('Thank you for your request to use the impersonation.') }}
            </p>
        </div>
        <div class="banner-desc-middle">
            <p>
                For security reasons, we require users to login via a unique link that will be sent to <a
                    href="mailto:{{ $authUser->email }}">{{ $authUser->email }}</a>.
                Please check your spam folder if you don't receive the email within 15 minutes.

            </p>
            <p>
                Please check your inbox for the login link and proceed with caution when impersonating another user's
                account.
            </p>

            <p class="go-back-sec">
                <a href="{{ config('impersonate.after_request_redirection') }}"
                   class="text-green">{{ __('Go back') }}
                </a>
            </p>
        </div>
    </div>
</div>
</body>

</html>
