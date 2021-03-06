@extends('mail.email-skeleton')

@section('title', 'Fiók aktiválása')

@section('body')
<p><b>Kedves leendő felhasználó!</b></p>

<p>
  Ezt a levelet azért kaptad, mert új fiókot regisztráltál rendszerünkbe.<br/>
  Amennyiben te kezdeményezted, úgy a lenti gomb megnyomásával aktiválhatod a regisztrációd.<br/>
  Ha mégsem te kezdeményezted, úgy levelünket tekintsd tárgytalannak.
</p>

<p style="text-align: center;"><a href="{{ base_url('user/activate/' . $activationHash) }}" style="">Fiók aktiválása</a></p>
@endsection