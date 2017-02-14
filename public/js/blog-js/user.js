$('#sort-users').on('submit', function(){
	// vybrate kriteria z formularu, podla ktorych sa bude sortovat
	var $sortBy = $('#sort-by :selected').text();
	var $sortFrom = $('#sort-from :selected').text();

	// dva skryte inputy vo formulari naplnime tymito hodnotami
	// ulahci nam to vypis podla coho zoradujeme blogerov
	$('#sort-by-msg').val($sortBy);
	$('#sort-from-msg').val($sortFrom);
});

function deletePost(id){
    $.ajax({
    	type:'DELETE',
       	headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
       	url:'/post/'+id,
       	data:'_token = <?php echo csrf_token() ?>',
       	success:function(data){
       		$('#post_'+id).remove();
       		$("#post_deleted").html(data.msg);
       	}
    });
 }

$(document).on({
	ajaxStart: function() { $("#ajax_loader3").css('display', 'inline'); },
    ajaxStop: function() {
    	$("#ajax_loader3").css('display', 'none');
    	window.setTimeout(function() {
		  $("#post_deleted").fadeTo(500, 0).slideUp(500, function(){
		    $(this).remove(); 
		  });
		}, 1500);
    }    
});