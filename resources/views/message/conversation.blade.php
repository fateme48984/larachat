@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="users">
                    <h5>Users</h5>
                    <ul class="list-group list-chat-item">

                        @forelse($users as $user)
                            <li class="chat-user-list {{$user->id == $userId ? 'active' : ''}}">
                                <a href={{route('message.conversation',$user->id)}}>
                                    <div class="chat-image">
                                        {!! Helper::makeImageFromName($user->name) !!}
                                        <i class="fa fa-circle user-status-icon user-icon-{{ $user->id }}" title="away"></i>
                                    </div>

                                    <div class="chat-name font-weight-bold">
                                        {{ $user->name }}
                                    </div>
                                </a>
                            </li>
                        @empty

                        @endforelse
                    </ul>
                </div>
            </div>
            <div class="col-md-9 chat-section">
                <div class="chat-header">
                    <div class="chat-image">
                        {!! Helper::makeImageFromName($contactInfo->name) !!}
                    </div>

                    <div class="chat-name font-weight-bold">
                        {{ $contactInfo->name }}
                        <i class="fa fa-circle user-status-head" title="away"
                           id="userStatusHead{{$contactInfo->id}}"></i>
                    </div>
                </div>

                <div class="chat-body">
                    Select user from the list to begin conversation.
                </div>
            </div>
        </div>
    </div>

@endsection
