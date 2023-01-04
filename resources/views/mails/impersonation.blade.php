<x-mail::message>
# Introduction

The body of your message.

<x-mail::button :url="$link">
    @lang('Impersonate login')
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
