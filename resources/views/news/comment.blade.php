

@foreach ($comments as $comment)
    <div class="media mb-4">
      <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
      <div class="media-body">
        <h5 class="mt-0">{{ $comment->user->name }}</h5>
        {{ $comment->body }}

        @foreach ($comment->replies as $reply)
            <div class="media mt-4">
              <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
              <div class="media-body">
                  <h5 class="mt-0">{{ $reply->user->name }}</h5>
                  {{ $reply->body }}
              </div>
            </div>
        @endforeach

      </div>
    </div>
@endforeach
