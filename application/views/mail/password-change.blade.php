@extends('mail.email-skeleton')

@section('title', 'Jelszó megváltoztatása')

@section('body')
<p><b>Kedves felhasználó!</b></p>

<p>Ezt a levelet azért kaptad, mert új jelszót szeretnél beállítani magadnak.</p>

<p>Amennyiben te kezdeményezted, úgy a lenti gomb megnyomásával át fogunk irányítani oldalunkra, ahol megváltoztathatod régi jelszavad.</p>

<p>Ha mégsem te kezdeményezted, úgy nincs semmi dolgod.</p>

<p style="text-align: center; margin-top: 32px;"><a href="{{ base_url('authentication/change_password/' . $changeHash) }}" style="text-decoration: none; padding: 5px 15px; display: inline-block; background: #d53746; color: #ffffff;">Jelszó megváltoztatása</a></p>
@endsection