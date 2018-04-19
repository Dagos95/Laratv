@extends('layouts/app')


@section('content')
  <div class="container">
      <div class="card">
          <div class="card-header">
              {{ $data->seriesName }}
          </div>
          
          <div class="card-body">
              <div class="row">
                  <div class="col-md-3">
                      <img src="{{ $instance->poster_url ?:  'http://via.placeholder.com/340x500' }}" class="img-fluid">
                      
                  </div>
                  
                  <div class="col-md-9">
                      <p>{{ $data->overview }}</p>
                  </div>
              </div>
          </div>
      </div>
  </div>

@endsection