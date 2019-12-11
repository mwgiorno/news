@extends('layouts.app')

@section('content')


  <!-- Page Content -->
      <div class="container">

        <div class="row">

          <!-- Blog Entries Column -->
          <div class="col-md-8">

            <h1 class="my-4">
              My News
            </h1>

         @foreach ($allNews as $news)
            <!-- Blog Post -->
            <div class="card mb-4">
              <img class="card-img-top" src="{{ $news->image->path }}" alt="Card image cap">
              <div class="card-body">
                <h2 class="card-title">{{ $news->title }}</h2>
                <p class="card-text">{!! $news->description !!}</p>
                <a href="{{ route('news.show', $news) }}" class="btn btn-primary">Read more →</a>
                <a href="{{ route('news.edit', $news) }}" class="btn btn-primary">Edit →</a>
              </div>
              <div class="card-footer text-muted">
                <p><i class="fa fa-tags"></i>
                  @foreach ($news->tags as $tag)
                    <a href="{{ route('news.tag', $tag->slug) }}" class="badge badge-secondary">{{ $tag->name }}</a>
                  @endforeach
                    | <i class="fa fa-user"></i> {{ $news->user->name }}
                    | <i class="fa fa-history"></i> {{ $news->getUpdatedDate() }}
                    | <i class="fa fa-comments"></i> {{ $news->comments()->count() }}
                </p>
              </div>
            </div>

          @endforeach



          {{-- <div class="col-12 col-md-10 col-lg-8"> --}}
            {{ $allNews->links() }}
          {{-- </div> --}}

          </div>

          <!-- Sidebar Widgets Column -->

          </div>

        </div>
        <!-- /.row -->

      <!-- /.container -->

@endsection
