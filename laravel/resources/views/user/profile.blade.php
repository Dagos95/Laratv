@extends('layouts/app')


@section('content')
  <div class="container">
      <div class="card">
          <div class="card-header">Profilo 
             <a href="{{ action('UserController@edit') }}" class="btn btn-secondary pull-right btn-sm"> {{-- Bottone per far mandare l'utente nella pagina del profilo di modifica --}}
               <i class="fa fa-pencil"></i>
             </a>
          </div>
          
          <div class="card-body">
              <table class="table">
                  <tbody>
                      <tr>
                          <th>Nome</th>
                          <td>{{ $user->name }} {{ $user->surname }}</td>
                      </tr>
                      <tr>
                          <th>Nickname</th>
                          <td>{{ $user->nickname }}</td>
                      </tr>
                      <tr>
                          <th>Email</th>
                          <td>{{ $user->email }}</td>
                      </tr>
                      <tr>
                          <th>Followers</th>
                          <td>{{ $user->followers->count() }}</td>
                      </tr>
                      <tr>
                          <th>Followed</th>
                          <td>{{ $user->followed->count() }}</td>
                      </tr>
                  </tbody>
                  
                  @include('user/_series')
                  
              </table>
          </div>
      </div>
  </div>
  @endsection