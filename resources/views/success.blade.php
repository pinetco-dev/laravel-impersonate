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

    .banner-image svg{
        max-width: 100px;
        height: auto;
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
            <svg width="339" height="389" viewBox="0 0 339 389" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5.1344 118.161L159.688 3.49531C166.005 -1.19269 174.654 -1.16203 180.938 3.56997L333.148 118.161H5.1344Z" fill="#353545"/>
                <path d="M327.505 338.625H10.7773C4.82532 338.625 0 333.8 0 327.848V127.442C0 121.49 4.82532 116.664 10.7773 116.664H327.505C333.457 116.664 338.283 121.49 338.283 127.442V327.848C338.283 333.8 333.457 338.625 327.505 338.625Z" fill="#353545"/>
                <path d="M323.01 131.346L287.463 158.866L286.997 159.226L258.156 181.546L237.33 197.666L193.957 231.24L185.61 237.706L180.97 234.88C173.717 230.44 164.583 230.48 157.357 234.96L152.743 237.826L145.437 232.2L100.57 197.666L79.6232 181.546L50.6365 159.226L45.3299 155.146L14.4099 131.346H323.01Z" fill="white"/>
                <path d="M326.357 323.693L185.61 237.706L180.97 234.88C173.717 230.44 164.583 230.48 157.357 234.96L152.743 237.826L14.4099 323.693L145.437 232.2L156.957 224.16C164.917 218.226 175.837 218.226 183.81 224.16L193.957 231.24L326.357 323.693Z" fill="#22222F"/>
                <path d="M323.009 30.8638H14.4045V131.352H323.009V30.8638Z" fill="white"/>
                <path d="M287.466 82.3691H45.3272V66.2531H287.466V82.3691Z" fill="#DCEEF4"/>
                <path d="M287.466 120.8H45.3272V104.684H287.466V120.8Z" fill="#DCEEF4"/>
                <path d="M287.463 143.12V158.866L286.996 159.226H50.6365L45.3298 155.146V143.12H287.463Z" fill="#DCEEF4"/>
                <path d="M258.157 181.547L237.33 197.667H100.57L79.6232 181.547H258.157Z" fill="#DCEEF4"/>
                <path d="M219.888 338.625C219.888 365.968 197.721 388.135 170.378 388.135C143.036 388.135 120.869 365.968 120.869 338.625C120.869 311.283 143.036 289.116 170.378 289.116C197.721 289.116 219.888 311.283 219.888 338.625Z" fill="#34E0A2"/>
                <path d="M149 340.155L164.672 355.828L199.5 321" stroke="white" stroke-width="8.7069" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <h1 class="banner-title">{{ __('Help is on the way') }}</h1>

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
