<div class="row">
    
    @foreach($user->series as $serie)
       <div class="col-md-3">
          <a href="{{ action('SerieController@show', [$serie->id]) }}">
           <img src="{{ $serie->poster_url ?: 'http://via.placeholder.com/340x500'}}" class="img-fluid" alt="">
           <h5>{{ $serie->title }}</h5>
          </a>
       </div>
    @endforeach
    
</div>