$('#sortBloggers').on('submit', function(){
	// vybrate kriteria z formularu, podla ktorych sa bude sortovat
	var $sortBy = $('#sortBy :selected').text();
	var $sortFrom = $('#sortFrom :selected').text();

	// dva skryte inputy vo formulari naplnime tymito hodnotami
	// ulahci nam to vypis podla coho zoradujeme blogerov
	$('#sortByMsg').val($sortBy);
	$('#sortFromMsg').val($sortFrom);
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
	ajaxStart: function() { $("#ajax_loader").css('display', 'inline'); },
    ajaxStop: function() {
    	$("#ajax_loader").css('display', 'none');
    	window.setTimeout(function() {
		  $("#post_deleted").fadeTo(500, 0).slideUp(500, function(){
		    $(this).remove(); 
		  });
		}, 1500);
    }    
});