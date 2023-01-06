<x-mail::message>
# @lang('Hello :creator', ['creator' => $creator->name]),

@lang('You have requested for impersonation of <b>:impersonate</b>.',['impersonate' => $impersonateUser->name])<br>
@lang('To login, Please click following button:')

<x-mail::button :url="$link">
    @lang('Impersonate login')
</x-mail::button>

@lang('This impersonate link will expire in :minutes minutes.',['minutes' => $impersonateLifetime])

@lang('If you did not request for impersonation, no further action is required.')

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
