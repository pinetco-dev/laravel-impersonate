<h1>can_be_impersonated.blade.php</h1>

@canImpersonate
<a href="{{ route('impersonate', $user) }}">Impersonate this user</a>
@endCanImpersonate
