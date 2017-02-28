// registarcia event handleru na sortovanie uzivatelov
$('#sort-users').on('submit', function(){
	// vybrate kriteria z formularu, podla ktorych sa bude sortovat
	var $sortBy = $('#sort-by :selected').text();
	var $sortFrom = $('#sort-from :selected').text();

	// dva skryte inputy vo formulari naplnime tymito hodnotami
	// ulahci nam to vypis podla coho zoradujeme blogerov
	$('#sort-by-msg').val($sortBy);
	$('#sort-from-msg').val($sortFrom);
});

// vymazanie clanku z databazi
function deletePost(id){
    $.ajax({
    	type:'DELETE',
       	headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
       	url:'/blog/post/'+id,
       	data:'_token = <?php echo csrf_token() ?>',
       	success:function(data){
       		// odstranenie clanku z tabulky clankov
       		$('#post_'+id).remove();
       		// succes sprava, ze clanok bol vymazany
       		$("#post_deleted").html(data.msg);
       	}
    });
 }

// registracia event handlerov pre zaciatok a koniec ajax volania
$(document).on({
	// start ajax volania -> zobrazime animaciu nacitavania
	ajaxStart: function() { $("#ajax_loader3").css('display', 'inline'); },
	// stop ajax volania
    ajaxStop: function() {
    	// animaciu nacitavania skryjeme
    	$("#ajax_loader3").css('display', 'none');
    	// nastavime casovy interval, po ktorom skryjeme spravu o vymazani clanku
    	window.setTimeout(function() {
    		// zmiznutie delete spravy
		  $("#post_deleted").fadeTo(500, 0).slideUp(500, function(){
		  	// callback funkcia po zmiznuti delete spravy
		  	// obsah elementu so spravou vymazeme
		  	$(this).html("");
		  	// nastavime css vlastnosti tohto elementu tak, aby mohol byt znovu pouzity
		    $(this).css({
		    	'display': 'block',
		    	'opacity': 1,
		    }); 
		  });
		}, 2500);
    }    
});