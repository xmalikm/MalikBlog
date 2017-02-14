 <section class="posts-author">
 	{{-- nadpis sekcie --}}
    <h3 class="title title-marker">Autor</h3>
	{{-- informacie o autotovi --}}
    <div class="panel panel-default panel-table author-panel" style=" border-radius: 0;">
	
		{{-- panel header --}}
        <div class="panel-heading panel-table-heading" style="background-color: #f0f0f0">
            <div class="row">
				<div class="col-lg-12 text-center">
					{{-- profilova fotka --}}
					<img src=" {{asset('uploads/profile_photos/'. $user->profile_photo)}}" style="width: 200px; height: 200px; ">
					{{-- meno --}}
					<h3>
						<strong>
							<a href=" {{ url('user', $user->id) }} ">{{ $user->name }}</a>
						</strong>
					</h3>
					{{-- email --}}
					<p> 
						<a href=" mailto:{{ $user->email }} ">{{ $user->email }} </a>
					</p>
				</div>
            </div>
        </div>{{-- panel-header --}}

		{{-- panel body este nie je spravene !!!!!!!!!!!!!!!!!!--}}
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
        </div>{{-- panel body --}}

        {{-- panel footer este nie je spravene !!!!!!!!!!!!!!!!!!--}}
        <div class="panel-footer">
        	
        	<div class="row text-center">
				<div class="col-lg-12 profile-boxes">
					<div class="well emphasis">
						<span class="profile-statistics">
							Počet článkov
						</span><br>
						<b>	{{ $user->num_of_articles }} </b>
					</div>
				</div>

				<div class="col-lg-12 profile-boxes">
					<div class="well emphasis">
						<span class="profile-statistics">
							Priemerná čítateľnosť
						</span><br>
						<b>	{{ $user->avg_readability }} </b>
					</div>
				</div>

				<div class="col-lg-12 profile-boxes">
					<div class="well emphasis">
						<span class="profile-statistics">
							Priemerná popularita
						</span><br>
						<b>	<span id="avg-popularity">{{ $user->avg_popularity }}</span> </b>
					</div>
				</div>

				<div class="col-lg-12 profile-boxes">
					<div class="well emphasis">
						<span class="profile-statistics">
							Priemerná diskutovanosť
						</span><br>
						<b>	<span id="avg-comments">{{ $user->avg_comments }}</span> </b>
					</div>
				</div>

        </div>{{-- panel footer --}}

    </div>{{-- informacie o autorovi --}}
    </div>

</section>