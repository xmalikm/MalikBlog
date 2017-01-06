@extends('contentWithoutSidebars')

{{-- title stranky --}}
@section('title', $title)

@section('breadcrumbs')
	{!! Breadcrumbs::render('showMyProfile') !!}
@endsection

@section('pageTitle', 'Profil: ' . $user->name)

@section('content')

	{{-- avatar + informacie --}}
	<div class="row">
		<div class="col-md-12">

			{{-- profilova fotka --}}
			<img src=" {{asset('uploads/profile_photos/'. $user->profile_photo)}}" style="width: 200px; height: 250px; border: 1px solid grey;">
			<h2>{{ $user->name }}</h2>
			<h3>{{ $user->email }}</h3>
			<h3><b>O autorovi</b></h3>
			{{ $user->about }}
			<br>
			<a href=" {{ url('profile/edit') }} " class="btn btn-primary">Zmena udajov</a>
			<a href="edit hesla" class="btn btn-primary">Zmena hesla</a>

		</div>
	</div>{{-- avatar + informacie --}}	

	<div class="row">
		<div class="col-md-4">
			<div class="well">
				<span class="profile-statistics">
					Pocet clankov
				</span><br>
				<b>	{{ $user->num_of_articles }} </b>
			</div>
		</div>
		<div class="col-md-4">
			<div class="well">
				<span class="profile-statistics">
					Priemerna citatelnost
				</span><br>
				<b>	ND </b>
			</div>
		</div>
		<div class="col-md-4">
			<div class="well">
				<span class="profile-statistics">
					Priemerna diskutovanost
				</span><br>
				<b>	ND </b>
			</div>
		</div>
	</div>

	{{-- clanky usera --}}
	<div class="row">
		
	</div>{{-- clanky usera --}}

	<div class="table-responsive">          
	  	<table class="table">
		    <thead>
		      <tr>
		        <th>#</th>
		        <th>Nadpis</th>
		        <th>Ukaza clanku</th>
		        <th>Kategoria</th>
		        <th>Vytvorene</th>
		        <th>Naposledy upravene</th>
		        <th>!!</th>
		      </tr>
		    </thead>
	    	<tbody>
	    		@foreach($user->posts as $post)
					<tr>
					<td>{{ $post->id }}</td>
					<td>{{ $post->title }}</td>
					<td>{{ $post->textTeaser }}</td>
					<td>{{ $post->category }}</td>
					<td>{{ $post->created_at }}</td>
					<td>{{ $post->updated_at }}</td>
					<td><a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary">Uprav blog</a>
						<a href=" delete " class="btn btn-success">Vymaz</a></td>
					</tr>
				@endforeach
	    	</tbody>
	    </table>
    </div>

@endsection