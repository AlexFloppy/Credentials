@extends(Config::get('views.default', 'layouts.default'))

@section('title')
Edit {{ $user->first_name.' '.$user->last_name }}
@stop

@section('controls')
<div class="row">
    <div class="col-xs-6">
        <p class="lead">
            @if($user->id == Sentry::getUser()->id)
                Currently editing your profile:
            @else
                Currently editing {{ $user->getName() }}'s profile:
            @endif  
        </p>
    </div>
    <div class="col-xs-6">
        <div class="pull-right">
            &nbsp;<a class="btn btn-success" href="{{ URL::route('users.show', array('users' => $user->getId())) }}"><i class="fa fa-file-text"></i> Show User</a>
            &nbsp;<a class="btn btn-warning" href="#suspend_user" data-toggle="modal" data-target="#suspend_user"><i class="fa fa-ban"></i> Suspend User</a>
            @if (Sentry::check() && Sentry::getUser()->hasAccess('admin'))
                &nbsp;<a class="btn btn-inverse" href="#reset_user" data-toggle="modal" data-target="#reset_user"><i class="fa fa-lock"></i> Reset Password</a>
                &nbsp;<a class="btn btn-danger" href="#delete_user" data-toggle="modal" data-target="#delete_user"><i class="fa fa-times"></i> Delete</a>
            @endif
        </div>
    </div>
</div>
<hr>
@stop

@section('content')
<div class="well">
    <?php
    $form = array('url' => URL::route('users.update', array('users' => $user->getId())),
        'method' => 'PATCH',
        'button' => 'Save User',
        'defaults' => array(
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'email' => $user->getEmail(),
    ));
    foreach($groups as $group) {
        $form['defaults']['group_'.$group->id] = ($user->inGroup($group));
    }
    ?>
    @include('users.form')
</div>
@stop

@section('messages')
@include('users.suspend')
@if (Sentry::check() && Sentry::getUser()->hasAccess('admin'))
    @include('users.reset')
    @include('users.delete')
@endif
@stop

@section('css')
{{ Asset::styles('form') }}
@stop

@section('js')
{{ Asset::scripts('form') }}
@stop
