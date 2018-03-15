<div class="row">
    
    @foreach($user->series as $serie)
       <div class="col-md-3">
           <img src="{{ $serie->poster_url ?: 'http://via.placeholder.com/340x500'}}" class="img-fluid" alt="">
           <h5>{{ $serie->title }}</h5>
       </div>
    @endforeach
    
</div>