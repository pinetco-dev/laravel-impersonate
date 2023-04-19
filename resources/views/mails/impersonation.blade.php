<x-mail::message>
# @lang('Hello :creator', ['creator' => $creator->name]),

@lang('We have received your request to impersonate <b>:impersonate</b>.',['impersonate' => $impersonateUser->name])<br>
@lang('To log in as <b>:impersonate</b>, please click the following button:',['impersonate' => $impersonateUser->name])

<x-mail::button :url="$link">
    @lang('Impersonate login')
</x-mail::button>

@lang('Please note that this impersonate link will expire in :minutes minutes. If you did not request this impersonation, please ignore this email and take no further action.',['minutes' => $impersonateLifetime])

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
