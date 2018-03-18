<div class="media">
    <a class="pull-left" href="#">
    <img src="{{  URL::to('/') }}/images/{{ $message->user->photo['file_name']  }}" alt="profile picture" class="img-circle" height="60" width="60"/>
        <!-- <img src="//www.gravatar.com/avatar/{{ md5($message->user->email) }} ?s=64"
             alt="{{ $message->user->name }}" class="img-circle"> -->
    </a>
    <div class="media-body">
        <h5 class="media-heading">{{ $message->user->name }}</h5>
        <p>{{ $message->body }}</p>
        <div class="text-muted">
            <small>Posted {{ $message->created_at->diffForHumans() }}</small>
        </div>
    </div>
</div>