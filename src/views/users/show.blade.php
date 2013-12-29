@extends(Config::get('views.default', 'layouts.default'))

@section('title')
{{ $user->getName() }}
@stop

@section('controls')
<div class="row">
    <div class="col-xs-6">
        <p class="lead">
            @if($user->id == Sentry::getUser()->id)
                Currently showing your profile:
            @else
                Currently showing {{ $user->getName() }}'s profile:
            @endif  
        </p>
    </div>
    <div class="col-xs-6">
        <div class="pull-right">
            @if (Sentry::check() && Sentry::getUser()->hasAccess('admin'))
                &nbsp;<a class="btn btn-info" href="{{ URL::route('users.edit', array('users' => $user->getId())) }}"><i class="fa fa-pencil-square-o"></i> Edit User</a>
            @endif
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
<h3>User Profile</h3>
<div class="well clearfix">
    <div class="hidden-xs">
        <div class="col-xs-6">
            @if ($user->first_name)
                <p><strong>First Name:</strong> {{ $user->getFirstName() }} </p>
            @endif
            @if ($user->last_name)
                <p><strong>Last Name:</strong> {{ $user->getLastName() }} </p>
            @endif
            <p><strong>Email:</strong> {{ $user->getEmail() }}</p>
        </div>
        <div class="col-xs-6">
            <div class="pull-right">
                <p><em>Account Created: {{ $user->getCreatedAt()->diffForHumans() }}</em></p>
                <p><em>Account Updated: {{ $user->getUpdatedAt()->diffForHumans() }}</em></p>
                @if ($user->getActivatedAt())
                    <p><em>Account Activated: {{ $user->getActivatedAt()->diffForHumans() }}</em></p>
                @else
                    <p><em>Account Activated: Not Activated</em></p>
                @endif
            </div>
        </div>
    </div>
    <div class="visible-xs">
        <div class="col-xs-12">
            @if ($user->first_name)
                <p><strong>First Name:</strong> {{ $user->getFirstName() }} </p>
            @endif
            @if ($user->last_name)
                <p><strong>Last Name:</strong> {{ $user->getLastName() }} </p>
            @endif
            <p><strong>Email:</strong> {{ $user->getEmail() }}</p>
            <p><strong>Account Created:</strong> {{ $user->getCreatedAt()->diffForHumans() }}</p>
            <p><strong>Account Updated:</strong> {{ $user->getUpdatedAt()->diffForHumans() }}</p>
            @if ($user->getActivatedAt())
                <p><strong>Account Activated:</strong> {{ $user->getActivatedAt()->diffForHumans() }}</p>
            @else
                <p><strong>Account Activated:</strong> Not Activated</p>
            @endif
        </div>
    </div>
</div>
<hr>
<h3>User Group Memberships</h3>
<div class="well">
    <ul>
    @if (count($user->getGroups()) >= 1)
        @foreach ($user->getGroups() as $group)
            <li>{{ $group['name'] }}</li>
        @endforeach
    @else
        <li>No Group Memberships.</li>
    @endif
    </ul>
</div>
<hr>
<h3>User Object</h3>
<div>
    <pre>{{ var_dump($user) }}</pre>
</div>
@stop

@section('messages')
@include('users.suspend')
@if (Sentry::check() && Sentry::getUser()->hasAccess('admin'))
    @include('users.reset')
    @include('users.delete')
@endif
@stop
