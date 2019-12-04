@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 blog-main">

        <div class="blog-post">
          <h2 class="blog-post-title">{{ $news->title }}</h2>
          <p class="blog-post-meta">{{ $news->updated_at }} by {{ $news->user->name }}</p>

          {!! $news->content !!}

        </div>

      </div>
    </div>

  </div>
@endsection
