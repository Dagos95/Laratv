<form method="get" action="{{ action('SearchController@serie') }}">
               <div class="input-group-append">
                  <input type="text" id="q" class="form-control" name="q" value="{{ request('q') }}" placeholder="Search">
                   <button class="btn btn-outline-secondary" type="submit">Search</button>
               </div>
               {{-- {{ csrf_field() }} --}} {{-- Il token non è possibile metterlo quando il form ha il metodo get --}}
</form>