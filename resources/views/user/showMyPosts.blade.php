@extends('contentWithoutSidebars')

{{-- title stranky --}}
@section('title', 'Moje články' )

@section('breadcrumbs')
	{!! Breadcrumbs::render('showMyProfile') !!}
@endsection

@section('pageTitle', 'Moje články')

@section('content')

	@if(Session::has('postDeleted'))
        <h2 class="text-danger bg-danger text-center"><b> {{ Session::get('postDeleted') }} </b></h2>
    @endif

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
	    		@foreach($user->posts as $post)
					<tr>
					<td>{{ $loop->iteration }}</td>	{{-- cislo iteracie, koli cislovaniu zaznamov v tabulke --}}
					<td><a href=" {{ url('post', $post->id) }} "> <img src=" {{ asset('uploads/blog_photos/'. $post->blog_photo) }} " style="width: 40px; height: 40px;"> {{ $post->title }} </a></td>
					<td>{{ $post->category->name }}</td>
					<td>{{ $post->unique_views }}</td>
					<td>este nie je</td>
					<td>este nie je</td>
					<td>{{ $post->created_at }}</td>
					<td>{{ $post->updated_at }}</td>
					<td><a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary">Uprav blog</a>
					{{ Form::open(['url' => url('post', $post->id), 'method' => 'delete']) }}

						{{ Form::submit('Vymazať', ['class' => 'btn btn-danger']) }}

					{{ Form::close()}}
					</tr>
				@endforeach
	    	</tbody>
	    </table>
    </div>

@endsection