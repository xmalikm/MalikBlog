 {{-- informacie o autotovi --}}
    <div class="panel panel-info panel-table">
	
		{{-- panel header --}}
        <div class="panel-heading panel-table-heading">

            <div class="row">
            	
				<div class="col-lg-12 text-center">
					
					{{-- profilova fotka --}}
					<img src=" {{asset('uploads/profile_photos/'. $user->profile_photo)}}" style="width: 200px; height: 200px; border: 1px solid grey;">
					
					{{-- meno --}}
					<div class="info">

						<h3>
							<a href=" {{ url('user', $user->id) }} ">{{ $user->name }}</a>
						</h3>

					</div>

					{{-- email --}}
					<div class="info">
						
						<p> 
							<a href=" mailto:{{ $user->email }} ">{{ $user->email }} </a> </p>

					</div>

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

            		<p>{{ $user->about }}</p>
        			
        		</div>

        	</div>

        </div>{{-- panel body --}}

        {{-- panel footer este nie je spravene !!!!!!!!!!!!!!!!!!--}}
        <div class="panel-footer">
        	
        	<div class="row text-center">
        		
				<div class="col-lg-4 profile-boxes">

					<div class="well">
						<span class="profile-statistics">
							Počet článkov
						</span><br>
						<b>	{{ $user->num_of_articles }} </b>
					</div>
				
				</div>

				<div class="col-lg-4 profile-boxes">

					<div class="well">
						<span class="profile-statistics">
							Priemerná čítateľnosť
						</span><br>
						<b>	{{ $user->avg_readability }} </b>
					</div>
				
				</div>

				<div class="col-lg-4 profile-boxes">

					<div class="well">
						<span class="profile-statistics">
							Priemerná diskutovanosť
						</span><br>
						<b>	10 </b>
					</div>
				
				</div>


        </div>{{-- panel footer --}}

    </div>{{-- informacie o autorovi --}}