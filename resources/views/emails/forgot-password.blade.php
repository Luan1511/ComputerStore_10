<div>
<h3>Hi {{$user->name}}</h3>
<p>
    Thank you for using our website.
</p>
<p>
    <a href="{{route('reset_password', $token)}}" style="display: inline-block; padding: 7px 25px; color:#2737c3;  ">Click here to get new password</a>
</p>

</div>
