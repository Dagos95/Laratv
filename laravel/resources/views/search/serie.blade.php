@extends('layouts/app')


@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Search</div>

        <div class="card-body">
            {{--<form method="get" action="{{ route('search.serie') }}"></form>   entrambe i form rimandano la stessa action al search --}} {{-- questo è il commento che permette di non farl oleggere a laravel --}}
            <form method="get" action="{{ action('SearchController@serie') }}">
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
                       <td>First aired</td>
                       <td>Banner</td>
                       <td>&nbsp;</td>
                   </tr>
               </thead>
                <tbody>
                   @foreach ($series as $serie)
                    <tr>
                        <td>{{ $serie->seriesName }}</td>  <!-- Permette di inserire -->
                    {{-- <td>{{ date('d/m/Y', strtotime($serie->firstAired)) }}</td> --}}
                        <td>{{ Carbon\Carbon::parse($serie->firstAired)->format('d/m/Y') }}</td>  
                        <td><img src="https://www.thetvdb.com/banners/{{ $serie->banner }}" class="img-fluid"></td>
                        <td class="col-action">

                          @if (auth()->user()->series->contains('thetvdb_id', $serie->id))    {{-- series lo prende dentro User.php - permette di far scomparire il simbolo --}}

                          <a href="{{ action('UserController@unfollowSerie', [ $serie->id ]) }}" class="btn btn-danger">
                              <i class="fa fa-minus"></i>
                          </a>

                          @else
                           <a class="btn btn-info btn-sm" href="{{ action('UserController@followSerie', [ $serie->id ]) }}">
                              <i class="fa fa-plus"></i>
                           </a>

                           @endif

                        </td>
                        <td><a href="#">Cancella</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>


        </div>
    </div>
</div>
@endsection
