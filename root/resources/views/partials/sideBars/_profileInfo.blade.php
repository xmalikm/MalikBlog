{{-- Profil autora clanku --}}
<section class="posts-author">
 	{{-- nazov sidebaru --}}
    <h3 class="title title-marker">Autor</h3>

	{{-- panel - informacie o autorovi --}}
    <div class="panel panel-default panel-table author-panel" style=" border-radius: 0;">
	
		{{-- hlavicka panelu --}}
        <div class="panel-heading panel-table-heading author-panel-heading">
			{{-- row --}}
            <div class="row">
				<div class="col-lg-12 text-center">
					{{-- profilova fotka autora --}}
					<img src=" {{asset('uploads/profile_photos/'. $user->profile_photo)}}" style="width: 200px; height: 200px; ">
					{{-- meno autora --}}
					<h3>
						<strong><a href=" {{ url('user', $user->id) }} ">{{ $user->name }}</a></strong>
					</h3>
					{{-- email autora --}}
					<p title="Kontakt na autora článku"> 
						<span class="glyphicon glyphicon-envelope"></span>&nbsp <a href=" mailto:{{ $user->email }} ">{{ $user->email }} </a>
					</p>
				</div>
            </div>{{-- row --}}
        </div>{{-- panel-header --}}

		{{-- telo panelu --}}
        <div class="panel-body">
        	{{-- nieco o autorovi --}}
        	<div class="row">
        		<div class="col-lg-12 text-left">
        			<p>
        				<b>O autorovi</b>
        			</p>
            		<p><i>{{ $user->about }}</i></p>
        		</div>
        	</div>
        </div>{{-- telo panelu --}}

		{{-- footer panelu --}}
        <div class="panel-footer">
        	{{-- row --}}
        	<div class="row text-center">
        		{{-- pocet clankov autora --}}
				<div class="col-lg-12 profile-boxes">
					<div class="well emphasis">
						<span class="profile-statistics">
							Počet článkov
						</span><br>
						<b>	{{ $user->num_of_articles }} </b>
					</div>
				</div>

				{{-- priemerna citanost clankov autora --}}
				<div class="col-lg-12 profile-boxes">
					<div class="well emphasis">
						<span class="profile-statistics">
							Priemerná čítanosť
						</span><br>
						<b>	{{ $user->avg_readability }} </b>
					</div>
				</div>

				{{-- priemerna popularita clankov autora --}}
				<div class="col-lg-12 profile-boxes">
					<div class="well emphasis">
						<span class="profile-statistics">
							Priemerná popularita
						</span><br>
						<b>	<span id="avg-popularity">{{ $user->avg_popularity }}</span> </b>
					</div>
				</div>

				{{-- priemerna diskutovanost clankov autora --}}
				<div class="col-lg-12 profile-boxes">
					<div class="well emphasis">
						<span class="profile-statistics">
							Priemerná diskutovanosť
						</span><br>
						<b>	<span id="avg-comments">{{ $user->avg_comments }}</span> </b>
					</div>
				</div>
        	</div>{{-- row --}}
    	</div>{{-- footer panelu --}}

    </div>{{-- panel - informacie o autorovi --}}

</section>