<h1>impersonate.blade.php</h1>

@impersonating
<a href="{{ route('impersonate.leave', ['impersonate' => get_impersonate_session_value()]) }}">
    Leave impersonation
</a>
@endImpersonating
