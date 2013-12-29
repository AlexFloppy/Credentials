@extends(Config::get('views.email', 'layouts.email'))

@section('content')
<p>An admin from <a href="{{ $url }}">{{ Config::get('platform.name') }}</a> has created you an account.</p>
<p>Here is your temporary password:</p>
<blockquote>{{ $password }}</blockquote>
<p>You should change it to something more memorable on the account page after you login.</p>
@stop
