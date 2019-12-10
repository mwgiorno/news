@extends('layouts.app')

@section('content')
  <!-- Page Content -->
      <div class="container">

        <div class="row">

          <!-- Blog Entries Column -->
          <div class="col-lg-8">

            <!-- Title -->
            <h1 class="mt-4 ">{{ $news->title }}</h1>



            <!-- Date/Time -->
            <p class="lead"><i class="fa fa-history"></i>  Обновлено:  {{ $news->updated_at }}</p>

            <!-- Author -->
            <p class="lead">
                <i class="fa fa-user"></i> Автор: {{ $news->user->name }}
            </p>


            <!-- Preview Image -->
            <img class="card-img-top" src="{{ $news->image->path }}" alt="Card image cap">

            <hr>

            <!-- Post Content -->
            {!! $news->content !!}

            <div class="card my-4">
              <h5 class="card-header">Оставить комментарий:</h5>
              <div class="card-body">
                <form action="{{ route('leave-comment', $news) }}" method="post" id="leaveComment">
                  @csrf
                  <div class="form-group">
                    <textarea class="form-control" rows="3" name="body" id='body'></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">Оставить комментарий</button>
                </form>
              </div>
            </div>

            <!-- Comments Form -->
            <div id='comment'>
              @include('news.comment', ['comments' => $news->comments])
            </div>



          </div>

          <!-- Sidebar Widgets Column -->
          <div class="col-md-4">

            @include('layouts.search')

            <!-- Categories Widget -->
            <div class="card my-3">
              <h5 class="card-header">Теги</h5>
              <div class="card-body">
                @foreach ($news->tags as $tag)
                  <a href="{{ route('news.tag', $tag->slug) }}" class="btn btn-primary btn-sm">{{ $tag->name }}</a>
                @endforeach
              </div>
            </div>

            </div>
          </div>

        </div>
        <!-- /.row -->

      </div>
      <!-- /.container -->
@endsection

@section('scripts')
<script>
  $(document).ready(function() {
        $("#leaveComment").submit(function(event) {
            event.preventDefault();
            body = $("#body").val();
            addComment(body);
        });
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function addComment(comment) {
            data = new FormData();
            data.append("body", comment);
            $.ajax({
                data: data,
                type: "POST",
                url: "{{ route('leave-comment', $news) }}",
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#comment').html(response)
                }
            });
        };
  });
</script>
@endsection
