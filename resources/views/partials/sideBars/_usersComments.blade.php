{{-- komentare uzivatelov --}}
<section class="users-comments">
    {{-- row --}}
    <div class="row">
        <div class="col-lg-12">
            {{-- nadpis sekcie --}}
            <h3 class="title title-marker">Komentare uzivatelov<img class="sidebar-icon" src="{{asset('images/icons/comments.png')}}"></h3>

            <ul>
                {{-- zoznam komentarov --}}
                @foreach($usersComments as $comment)

                    <li class="clear-content">
                        {{-- profilove foto --}}
                        <a href="{{ url('user', $comment->user->id) }}">
                            <img src=" {{ asset('uploads/profile_photos/'.$comment->user->profile_photo) }}" class="img-circle user-avatar" alt="comment-avatar">
                        </a>
                        {{-- meno --}}
                        <a href="{{ url('user', $comment->user->id) }}" class="autor-name">{{ $comment->user->name }}</a>
                        {{-- komentar --}}
                        <a href="{{ route('post.show', ['id' => $comment->post->id, 'slug' => $comment->post->slug]) }}" class="comment-content">{{ $comment->body }}</a>
                    </li>

                @endforeach
            </ul>{{-- zoznam komentarov --}}
        </div>
    </div>{{-- row --}}
</section>{{-- komentare uzivatelov --}}