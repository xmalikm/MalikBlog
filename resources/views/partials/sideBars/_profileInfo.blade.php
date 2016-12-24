 {{-- informacie o autotovi --}}
    <div class="panel panel-info panel-table">
	
		{{-- panel header --}}
        <div class="panel-heading panel-table-heading">

            <div class="row">
            	
				<div class="col-lg-12 text-center">
					
					{{-- profilova fotka --}}
					<img src="http://placehold.it/200x200" class="center-block profile-photo">
					
					{{-- meno --}}
					<div class="info">
						
						<h3> {{ $user->name }} </h3>

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

            		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Careret maximam noctesque. Liberae adhibenda impetu probarent misisti animos plerisque incorrupte. Iucunde.</p>
        			
        		</div>

        	</div>

        </div>{{-- panel body --}}

        {{-- panel footer este nie je spravene !!!!!!!!!!!!!!!!!!--}}
        <div class="panel-footer">
        	
        	<div class="row text-center">
        		
				<div class="col-lg-4 profile-boxes">

					<div class="well">
						<span class="profile-statistics">
							Pocet clankov
						</span><br>
						<b>	10 </b>
					</div>
				
				</div>

				<div class="col-lg-4 profile-boxes">

					<div class="well">
						<span class="profile-statistics">
							Priemerna citanost
						</span><br>
						<b>	10 </b>
					</div>
				
				</div>

				<div class="col-lg-4 profile-boxes">

					<div class="well">
						<span class="profile-statistics">
							Priemerna diskutovanost
						</span><br>
						<b>	10 </b>
					</div>
				
				</div>


        </div>{{-- panel footer --}}

    </div>{{-- informacie o autorovi --}}