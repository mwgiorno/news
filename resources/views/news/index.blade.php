@extends('layouts.app')

@section('content')
<div class="album py-5 bg-light">
  <div class="container">

    <div class="row">
      @foreach ($allNews as $news)
        <div class="col-md-4">
            <div class="card mb-4 box-shadow">
              <img class="card-img-top" src="{{ $news->image->path }}" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">{{ $news->title }}</p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <a href="{{ route('news.show', $news) }}" class="btn btn-sm btn-outline-secondary">Подробнее</a>
                  </div>
                  <small class="text-muted">{{ $news->getUpdatedDate() }}</small>
                </div>
              </div>
            </div>
          </div>
      @endforeach
    </div>

    @unless ($allNews)
      {{ $allNews->links() }}
    @endunless
  </div>
</div>
@endsection
