{{-- Informacie o projekte --}}

@extends('contentWithoutSidebars')

{{-- breadcrumbs --}}
@section('breadcrumbs')
	{!! Breadcrumbs::render('projectInfo') !!}
@endsection

{{-- obsah stranky --}}
@section('content')
	
	{{-- info content --}}
	<div class="row text-left">

		<div class="col-sm-8 col-sm-offset-2">
			{{-- nasdpis --}}
			<h1 class="title title-marker">Informácie o projekte</h1>
			{{-- text --}}
			<p>
				Aplikácia <strong>malikblog</strong> predstavuje klasický blog, kde môžu uživatelia písať svoje vlastné články, resp. čítať články ostatných	uživateľov.
				<br>
				Na to aby mohol uživateľ pisať vlastný blog sa musi najskôr zaregistrovať a následne prihlasiť.<br>
				Články je možné zoraďovať podľa rôznych kriterii. Taktiež je možné články hodnotiť a tým zvyšovať ich popularitu.<br>
				Popularita článku sa zvyšuje aj počtom jeho prečítaní. Prihlásení uživatelia môžu články komentovať, ako aj lajkovať ostatné
				komentáre. Uživatelia majú možnosť upraviť svoje článoky aj všetky svoje komentáre k článkom.<br>
				Blog obsahuje live vyhladávanie všetkých článkov z databázy.<br>
				Prihlásený uživateľ má možnosť spravovať svoje články v prehladnej tabuľke, v ktorej sa zobrazujú štatistiky k článkom.<br>
				Tak isto má k dispozícii admin panel, ktorý zobrazuje informácie o uživatelovi s možnosťou ich editácie.<br>
				Admin panel obsahuje aj button na vymazanie profilu z aplikácie.<br><br>
			</p>

			<h3>
				<strong>Technické špecifikácie:</strong>
			</h3>
			<p>
				<h4 style="text-decoration: underline;">Backend</h4> <strong>PHP</strong> - Laravel + <strong>MySql</strong> databáza<br>
				<h4 style="text-decoration: underline;">Frontend</h4> <strong>HTML</strong>, <strong>CSS</strong> - Bootstrap, <strong>JavaScript</strong> - jquery, <strong>Ajax</strong><br>
				<h4 style="text-decoration: underline;">Použité knižnice</h4> <strong>Selectize</strong>(live vyhladávanie, pridávanie tagov), <strong>Slick</strong>(slider článkov), <strong>Tooltipster</strong>(zobrazovanie tooltipov)
			</p>
		</div>

	</div>{{-- info content --}}
		
@endsection