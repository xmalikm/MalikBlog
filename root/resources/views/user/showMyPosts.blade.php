{{-- Zoznam clankov aktualne prihlaseneho uzivatela --}}

@extends('contentWithoutSidebars')

{{-- title stranky --}}
@section('title', 'Moje články' )

{{-- breadcrumbs --}}
@section('breadcrumbs')
	{!! Breadcrumbs::render('showMyPosts') !!}
@endsection

{{-- nadpis stranky --}}
@section('pageTitle')
	<div class="row">
		<div class="col-lg-12 col-md-12 text-center post-title">
			<h1 class="title title-marker"><a href=""> Moje články </a></h1>
		</div>
	</div>
@endsection

{{-- obsah stranky --}}
@section('content')

	{{-- success message pri vymazani clanku --}}
	<h2 class="text-danger bg-danger text-center" id="post_deleted"></h2>
	{{-- animacia nacitavania --}}
	<img id="ajax_loader3" src="{{asset('images/loader.gif')}}" alt="loading animation">

	{{-- tabulka s clankami --}}
	<div class="table-responsive my-posts-list">          
	  	<table class="table">
	  		{{-- zahlavie tabulky --}}
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
		    {{-- telo tabulky --}}
	    	<tbody>
	    		@forelse($posts as $post)
					<tr id="post_{{$post->id}}">
						{{-- cislo iteracie, koli cislovaniu zaznamov v tabulke --}}
						<td>{{ $loop->iteration }}</td>
						{{-- foto clanku --}}
						<td>
							<a href=" {{ route('post.show', ['id' => $post->id, 'slug' => $post->slug]) }} ">
								<img src=" {{ asset('uploads/blog_photos/'. $post->blog_photo) }}" title="{{ $post->title }}" alt="{{ $post->title }}">
							</a>
						</td>
						{{-- nadpis --}}
						<td class="post-title">
							<a href=" {{ route('post.show', ['id' => $post->id, 'slug' => $post->slug]) }} ">  {{ $post->title }} </a>
						</td>
						{{-- nazov kategorie --}}
						<td>{{ $post->category->name }}</td>
						{{-- pocet videni --}}
						<td>{{ $post->unique_views }}</td>
						{{-- popularita --}}
						<td>{{ $post->popularity }}</td>
						{{-- pocet komentarov --}}
						<td>{{ count($post->comments) }}</td>
						{{-- datum vytvorenia --}}
						<td>{{ $post->created_at }}</td>
						{{-- datum poslednej upravy --}}
						<td>{{ $post->updated_at }}</td>
						{{-- buttony na vymazanie/editaciu clanku --}}
						<td>
							<div>
								{{-- editacia --}}
								<a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary">Uprav blog</a>
								{{-- vymazanie --}}
								<a class="btn btn-danger" id="delete_post" onclick="deletePost({{ $post->id }})">Vymazať</a>
							</div>
						</td>
					</tr>

				{{-- ak uzivatel este nanapisal ziadny clanok --}}
				@empty
					<td nowrap=""><p><strong>Zatiaľ ste nenapísali žiadny článok.</strong></p></td>

				@endforelse
	    	</tbody>
	    </table>
    </div>{{-- tabulka s clankami --}}
    
@endsection

{{-- js subory --}}
@section('scripts')
	{{-- js stranky --}}
	<script src=" {{ asset('js/blog-js/user.js') }} "></script>
@endsection