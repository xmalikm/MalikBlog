{{-- kategorie clankov --}}
<div class="row">

	{{-- desktop view --}}
	<div class="col-lg-9 categories">
		{{-- zoznam kategorii --}}
		<div class="btn-group">
			@foreach($categories as $category)
				{{-- nazov kategorie --}}
				<a href = " {{ url('category', $category->id) }} " class="btn btn-primary btn-md">{{ $category->name }}</a>
			@endforeach
		</div>{{-- zoznam kategorii --}}
	</div>{{-- desktop view --}}

	{{-- mobile view --}}
	<div class="btn-group btn-group-justified categories-mobile">
		{{-- dropdown button, ktory rozbaluje kategorie --}}
		<button type="button" style="width: 100%;" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
	   		Ďalšie <span class="caret"></span>
	   	</button>
	   	{{-- zoznam kategorii --}}
	    <ul class="dropdown-menu" role="menu">
	    	@foreach($categories as $category)
	    		{{-- nazov kategorie --}}
				<li class="btn-group-justified text-center"><a href=" {{ url('category', $category->id) }} ">{{ $category->name }}</a></li>
			@endforeach
		</ul>{{-- zoznam kategorii --}}
	</div>{{-- mobile view --}}

</div>{{-- kategorie clankov --}}