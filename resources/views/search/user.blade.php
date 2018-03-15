@extends('layouts/app')


@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Search</div>
        
        <div class="card-body">
            {{--<form method="get" action="{{ route('search.user') }}"></form>   entrambe i form rimandano la stessa action al search --}} {{-- questo è il commento che permette di non farl oleggere a laravel --}}
            <form method="get" action="{{ action('SearchController@user') }}">
               <div class="input-group-append">
                  <input type="text" id="q" class="form-control" name="q" value="{{ request('q') }}" placeholder="Search">
                   <button class="btn btn-outline-secondary" type="submit">Search</button>
               </div>
               {{-- {{ csrf_field() }} --}} {{-- Il token  possibile non metterlo quando il form ha il metodo get --}}
            </form>
            
            <table class="table">
               <thead>
                   <tr>
                       <td>Name</td>
                       <td>Surname</td>
                       <td>Nickname</td>
                       <td>Email</td>
                       <td>Richiesta d'amicizia</td>
                       <td>&nbsp;</td>
                       <td>&nbsp;</td>
                   </tr>
               </thead>
                <tbody>
                   @foreach ($users as $user)  
                    <tr>
                        <td>{{ $user->name }}</td>  <!-- Permette di inserire -->
                        <td>{{ $user->surname }}</td>
                        <td>{{ $user->nickname }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="col-action">
                        
                        @if (!auth()->user()->followed->contains('id', $user->id))
                        
                        
                         
                         {{-- Utente non seguito --}}
                          <a class="btn btn-info" href="{{ action('UserController@follow', [$user->id]) }}">
                             <i class="fa fa-user-plus"></i> 
                          </a>
                          
                          @else
                          
                          {{-- Utente seguito --}}
                          <a class="btn btn-danger" href="{{ action('UserController@unfollow', [$user->id]) }}">
                             <i class="fa fa-user-times"></i> 
                          </a>
                          
                          @endif
                          
                        </td>
                        <td><a href="#">Modifica</a></td>
                        <td><a href="#">Cancella</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
               {{ $users->appends( request()->all() )->links() }}  <!-- Permette di far cambiare pagina (crea i numeri delle pagine disponibili in base agli utenti registrati nel database) ATTENZIONE: se il numero degli utenti sono minori o uguali a 5, non appare l'impaginazione -->
        </div>
    </div>
</div>
@endsection