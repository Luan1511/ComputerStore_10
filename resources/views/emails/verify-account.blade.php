<h3>Hi: {{ $account->name}}</h3>
<p>
    Thank you for using our website.
</p>

<p>
    <a href="{{route('verify', $account->email)}}" style="display: inline-block; padding: 7px 25px; color:#2737c3;">Click here to verify your account</a>
</p>
