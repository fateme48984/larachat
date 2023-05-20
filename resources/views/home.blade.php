@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row">
       <div class="col-md-3">
           <div class="users">
               <h5>Users</h5>
               <ul class="list-group list-chat-item">
                   <li class="ckat-user-list">
                       <a href="#">
                           Hamid
                       </a>
                   </li>
               </ul>
           </div>
       </div>
       <div class="col-md-9">
           <h1>
               Message Section
           </h1>

           <p class="lead">
               Select user from the list to begin conversation.
           </p>
       </div>
   </div>
</div>
@endsection
