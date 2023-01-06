<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Package</title>
    <meta name="description" content="This is an example of a meta description.">
    @isset($cssPath)
        <style>{!! file_get_contents($cssPath) !!}</style>
    @endisset
</head>
<body>
<div class="tl-container">
    <div class="tl-header">
        <div class="flex flex-col flex-grow justify-center relative">
            <div>
               {{--icon--}}
            </div>
            <p class="text-2xl text-black mt-10 text-center font-bold">{{ __('Danke! Dein Demo-Termin wurde erfolgreich gebucht') }}</p>
        </div>
        <div class="flex-shrink-0 flex items-center justify-center space-x-4">
            <a type="button" href="{{ config('impersonate.take_redirect_to') }}">
                {{ __('Okay') }}
            </a>
        </div>
    </div>
</div>
</body>
</html>
