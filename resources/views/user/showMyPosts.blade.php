@extends('contentWithoutSidebars')

{{-- title stranky --}}
@section('title', 'Moje články' )

@section('breadcrumbs')
	{!! Breadcrumbs::render('showMyPosts') !!}
@endsection

@section('pageTitle')
	{{-- nadpis --}}
	<div class="row">
		<div class="col-lg-12 col-md-12 text-center post-title">
			<h1><a href=""> Moje články </a></h1>
		</div>
	</div>{{-- nadpis --}}
@endsection

@section('content')
	<h2 class="text-danger bg-danger text-center" id="post_deleted"></h2>

	<img id="ajax_loader3" src="{{asset('images/loader.gif')}}">
	<div class="table-responsive my-posts-list">          
	  	<table class="table">
		    <thead>
		      <tr>
		        <th>#</th>
		        <th>Náhľadová foto</th>
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
						{{-- cislo iteracie, koli cislovaniu zaznamov v tabulke --}}
						<td>{{ $loop->iteration }}</td>
						<td><a href=" {{ route('post.show', ['id' => $post->id, 'slug' => $post->slug]) }} "><img src=" {{ asset('uploads/blog_photos/'. $post->blog_photo) }}"></a></td>
						<td class="post-title"><a href=" {{ route('post.show', ['id' => $post->id, 'slug' => $post->slug]) }} ">  {{ $post->title }} </a></td>
						<td>{{ $post->category->name }}</td>
						<td>{{ $post->unique_views }}</td>
						<td>{{ $post->popularity }}</td>
						<td>{{ count($post->comments) }}</td>
						<td>{{ $post->created_at }}</td>
						<td>{{ $post->updated_at }}</td>
						<td><div><a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary">Uprav blog</a>
						<a class="btn btn-danger" id="delete_post" onclick="deletePost({{ $post->id }})">Vymazať</a></div>
					</tr>
				@endforeach
	    	</tbody>
	    </table>
    </div>
    
@endsection

@section('scripts')
	
	<script src=" {{ asset('js/blog-js/user.js') }} "></script>

@endsection