@extends('mail.email-skeleton')

@section('title', 'Jelszó megváltoztatása')

@section('body')
<p>Kedves felhasználó!</p>
<p>
  Ezt a levelet azért kaptad, mert új jelszót szeretnél beállítani magadnak.<br/>
  Amennyiben te kezdeményezted, úgy a lenti gomb megnyomásával át fogunk irányítani oldalunkra, ahol megváltoztathatod régi jelszavad.<br>
  Ha mégsem te kezdeményezted, úgy nincs semmi dolgod.
</p>

<p style="text-align: center;"><a href="{{ base_url('authentication/change_password/' . $changeHash) }}" style="">Jelszó megváltoztatása</a></p>
@endsection