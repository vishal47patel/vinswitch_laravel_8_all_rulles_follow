@extends('layouts.mail')
@section('content')
<h3>Dear {{$firstname.' '.$lastname}},</h3>
<h5>This is to inform you that, Your password of account with VinSwitch has been reset by admin. You can login using username and new password given below.</h5>
<h4>Username : {{$username}}</h4>
<h4>Password : {{$password}}</h4>
<p style="text-align:center;">Please <a href="{{$login_link}}" class="btn btn-primary">click here</a> to login in VinSwitch. it will redirect you to login screen.</p>
@endsection
