{{-- Buttony na sortovanie clankov --}}

{{-- sort wrapper --}}
<div class="row sort-wrapper">
	{{-- skupina buttonov --}}
	<div class="col-lg-12 sort">
		<div class="btn-group">
			{{-- zoradenie podla najnovsich clankov --}}
			<a class="btn btn-primary" href=" {{ url('newest-posts') }} ">Najnovšie</a>
			{{-- zoradenie podla najcitanejsich clankov --}}
			<a class="btn btn-primary" href=" {{ url('most-viewed') }} ">Najčítanejšie</a>
			{{-- zoradenie podla najviac diskutovanych clankov --}}
			<a class="btn btn-primary" href=" {{ url('most-discussed') }} ">Najviac diskutované</a>
		</div>
	</div>{{-- skupina buttonov --}}
</div>{{-- sort wrapper --}}