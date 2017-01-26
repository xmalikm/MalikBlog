@extends('contentWithoutSidebars')

{{-- title stranky --}}
@section('title', 'Moje články' )

@section('breadcrumbs')
	{!! Breadcrumbs::render('showMyPosts') !!}
@endsection

@section('pageTitle', 'Moje články')

@section('content')
	<img id="ajax_loader" src="{{asset('images/loader.gif')}}" style="display: none;">
	<h2 class="text-danger bg-danger" id="post_deleted"></h2>

	<div class="table-responsive">          
	  	<table class="table">
		    <thead>
		      <tr>
		        <th>#</th>
		        <th>Nadpis</th>
		        <th>Kategória</th>
		        <th>Počet zobrazení</th>
		        <th>Karma</th>
		        <th>Počet komentarov</th>
		        <th>Vytvorene</th>
		        <th>Naposledy upravene</th>
		        <th>Upraviť/Vymazať</th>
		      </tr>
		    </thead>
	    	<tbody>
	    		@foreach($posts as $post)
					<tr id="post_{{$post->id}}">
					<td>{{ $loop->iteration }}</td>	{{-- cislo iteracie, koli cislovaniu zaznamov v tabulke --}}
					<td><a href=" {{ route('post.show', ['id' => $post->id, 'slug' => $post->slug]) }} "> <img src=" {{ asset('uploads/blog_photos/'. $post->blog_photo) }} " style="width: 40px; height: 40px;"> {{ $post->title }} </a></td>
					<td>{{ $post->category->name }}</td>
					<td>{{ $post->unique_views }}</td>
					<td>{{ $post->popularity }}</td>
					<td>{{ count($post->comments) }}</td>
					<td>{{ $post->created_at }}</td>
					<td>{{ $post->updated_at }}</td>
					<td><a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary">Uprav blog</a>
					{{-- {{ Form::open(['url' => url('post', $post->id), 'method' => 'delete']) }}

						{{ Form::submit('Vymazať', ['class' => 'btn btn-danger']) }}

					{{ Form::close()}} --}}
					<a class="btn btn-danger" id="delete_post" onclick="deletePost({{ $post->id }})">Vymazať</a>
					</tr>
				@endforeach
	    	</tbody>
	    </table>
    </div>
    
@endsection

@section('scripts')
	
	<script src=" {{ asset('js/blog-js/user.js') }} "></script>

@endsection