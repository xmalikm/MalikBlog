$(document).ready(function() {

			// ak sa uzivatel prihlasil na to aby komentoval clanok, zoscrolluj
			// stranku na miesto, kde sa nachadza diskusia
			function scrollToComment() {
				// najdenie elementu s danym id-ckom
				var discussionAllowed = document.getElementById('discussionAllowed');
					// ak tento element existuje, zoscrolluj stranku na dany element rychlostou 1s
					if(discussionAllowed) {
						// collapse element nastavime aby sa pri zobrazeni otvoril
						// teda hned sa nam zobrazi formular a mozme pisat komentar
						$('#commentForm').addClass('in');
					    $('html, body').animate({
					        scrollTop: $('#discussionAllowed').offset().top-30
					    }, 1000, 'swing');
					}
			}

			// volanie funkcie na zoscrollovanie k diskusii
	        scrollToComment();

	        // funkcia najskor odstrani vsetky ajaxStart a ajaxStop eventy na stranke
	        // a nasledne ich zaregistruje nanovo s prisluchajucimi funkciami
	        function bindAjaxEvent(loader) {
	        	// odregistrujeme ajax eventy z dokumentu
	        	$(document).off('ajaxStart ajaxStop');
	        	// nanovo zaregistrujeme ajax eventy
				$(document).on({
					// pri starte ajax volania sa zobrazi animacia nacitavania
				    ajaxStart: function() { loader.css('display', 'inline'); },
				    // ked ajax volanie skonci, animaciu nacitavania skryjeme
				    ajaxStop: function() { loader.css('display', 'none'); }    
				});
	        }

	        // funkcia na handlovanie lajknutia komentaru
	        function likeComment() {
	        	// komentar, ktory lajkujeme
	        	var $comment = $(this).parent(),
	        		// id-cko komentaru
	        		$commentId = $comment.attr('id');

	        	// ajax volanie
	            $.ajax({
	            	type:'POST',
	               	headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  				},
	               	url:'/post/comment/like/' + $commentId,
	               	data:'_token = <?php echo csrf_token() ?>',
	               	success:function(data){
	               		// ak lajknutie clanku prebehlo
	               		if(data.msg) {
	               			
	               			// novy span, ktory nahradi povodny span na lajknutie komentaru
	               			$commentLiked = $('<span>', {
								'class': 'glyphicon glyphicon-thumbs-up comment-liked-btn',
								style: 'border: 1px solid red;,'
	               			});

	               			// namiesto povodneho spanu vlozime span, ktory uzivatela informuje, ze komentar uz lajkol
	               			$comment.find('.like-comment-btn').replaceWith($commentLiked);

	               			// aktualizuje pocet lajkov komentara
	               			$comment.find('.comment-likes').text('+ ' + data.numOfLikes);
	               		}

	               		// tato situacia by nemala nastat, ale predsa
	               		if(data.errorMsg)
	               			$comment.find('span.comment-like-error-msg').text(data.errorMsg);
	               	}
	            });
	        }

			$('#like-post-btn').on('click', function() {
				// image - animacia nacitavania, ktora sa zobrazi pocas ajax procesu
				var $ajaxLoader = $('#ajax_loader');
				// zaregistrujeme 2 ajax eventy - pre zaciatok a koniec ajax volania
				bindAjaxEvent($ajaxLoader);

				// samotny ajax
	            $.ajax({
	            	type:'POST',
	               	headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  				},
	               	url:'/post/like/' + postId,
	               	data:'_token = <?php echo csrf_token() ?>',
	               	success:function(data){
	               		var $likePostDiv = $('#like-post');
	               		
	               		// ak lajknutie clanku prebehlo
	               		if(data.msg) {

	               			// namiesto povodneho buttonu vlozime button, ktory uzivatela informuje, ze clanok uz lajkol
	               			$likePostDiv.replaceWith($('<button>', {
	               				class: 'btn btn-info',
	               				id: 'post-liked-btn'
	               			}).text('Článok sa mi páči'));

	               	   		// hodnoty ktore sa lajknutim zmenia
	               	  		$('#post-popularity').html(data.popularity);
	               	  		$('#avg-popularity').html(data.avg_popularity);
	               		}

	               		// tato situacia by nemala nastat, ale predsa
	               		if(data.errorMsg)
	               			$('#error-post-msg').text(data.errorMsg);
	               	}
	            });
	        });

	        $('#addCommentForm').on('submit', function(event) {
	        	// zabranenie klasickeho submitnutia formularu
	        	event.preventDefault();

		        	// image - animacia nacitavania, ktora sa zobrazi pocas ajax procesu
	        	var $ajaxLoader = $('#ajax_loader2'),
	        		// span pre error spravy
	        		$errorMsg = $(this).find('.comment-error-msg');

	        	// zaregistrujeme 2 ajax eventy - pre zaciatok a koniec ajax volania
	        	bindAjaxEvent($ajaxLoader);
	   			// obsah komentaru
	        	var $comment = $('#body').val();
	        	// samotny ajax
	        	$.ajax({
	            	type:'POST',
	               	headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  				},
	               	url:'/comment',
	               	data:{post_id: postId, user_id: userId, body: $comment},
	               	success:function(data){
	               		// niekde nastala chyba
	               		if(data.errorMsg)
			            	$errorMsg.text(data.errorMsg);
			            // pridanie komentara prebehlo uspesne
			            else {
			            	// vymazeme error message
				            $errorMsg.empty();
		               		// clearneme obsah inputu pre vkladanie komentaru
		               		$('#body').val("");
		               		// aktualizujeme pocet komentarov clanku
		               		$('.post-comments').html(data.numOfComments);
		               		// aktualizujeme priemerny pocet komentarov uzivatela
		               		$('#avg-comments').text(data.avg_comments);

		               		// novy komentar, ktory sme si naklonovali z existujucej sablony
		               		// tym padom nemusime rucne vytvarat vsetky elementy komentaru v jQuery
		               		var $newComment = $('#comment-template').clone().css('display', 'block');

		               		// id komentara
		               		$newComment.attr('id', data.comment.id);
		               		// profilova foto autora komentaru
		               		$newComment.find('img').first().attr('src', data.profile_photo);
							// handler pre click event na edit button komentaru
		               		$newComment.find('button.show-edit-comment-btn').on('click', editCommentHandler);
		               		// handler pre click event na lajknutie komentaru
		               		$newComment.find('span.like-comment-btn').on('click', likeComment);
		               		// meno autora komentaru
		               		$newComment.find('p.user-name').append(data.user.name);
		               		// telo komentaru
		               		$newComment.find('p.commentBody').append(data.comment.body);

		               		$('#allComments').prepend($newComment);

	               		} // vytvorenie noveho comment elementu a prependnutie na zaciatok

	               	} // succes funkcia

	            }); // ajax volanie

	        });// submit event pre create formular komentu

	        // handler pre click event na button 'Editovat komentar'
	        function editCommentHandler() {
	        	// wraper pre kazdy jeden komentar -> rodicovsky div element buttona, na ktory klikame
	        	var $parentDiv = $(this).parent(),
	        		// potomok div elementu, ktory obsahuje telo komentara
	        		$commentBody = $parentDiv.find('p.commentBody'),
	        		// skryty formular pre editaciu komentaru, ktory obsahuje kazdy komentar
	        		$editCommentForm = $parentDiv.find('form.edit-comment-form'),
	        		// pole edit formularu, v ktorom sa upravuje komentar
	        		$commentInput = $editCommentForm.find('#body'),
	        		// span pre error spravy
	        		$errorMsg = $editCommentForm.find('.comment-error-msg'),
	        		// animacia pri ajax volani
	        		$ajaxLoader = $parentDiv.find('img.edit-ajax-loader');
	        	
	        	// povodny text komentara zmizne

				$commentBody.fadeToggle(300);

	        	// $commentBody.fadeToggle(50, function() {
	        		// a zobrazi sa formular s povodnym komentarom, v ktorom moze autor komentaru upravit tento komentar
	        		$commentInput.val($commentBody.text());
	        		$editCommentForm.fadeToggle(300);

	        		// pre submitnutie tohto formulara registrujeme novy event
	        		$editCommentForm.on('submit', function(event) {
	        			// kedze sa bude vykonavat ajax volanie, zabranime odoslaniu formulara
	        			event.preventDefault();

	        			// zaregistrujeme 2 ajax eventy - pre zaciatok a koniec ajax volania
	        			bindAjaxEvent($ajaxLoader);

	        			// samotne ajax volanie
			        	$.ajax({
			            	type:'PUT',
			               	headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			  				},
			               	url:'/comment/' + $parentDiv.attr('id'), // id komentara ako parameter v route
			               	data: {commentBody: $commentInput.val()}, // text komentara, posiela sa ako data v requeste
			               	success:function(data){
			               		if(data.errorMsg)
			               			$errorMsg.text(data.errorMsg);
			               		else {
			               			$errorMsg.empty();
			               			$commentBody.html($commentInput.val());
						        	$editCommentForm.fadeOut(300);
			               			$commentBody.fadeIn(300);
			               		}
			               	}
			            }); // ajax volanie

	        		}); // submit event pre edit formular komentu
	        }

	        // event handler pre click event na button 'Editovat komentar'
	        $('.show-edit-comment-btn').on('click', editCommentHandler);

	        // handler pre click event na lajknutie komentaru
		    $('span.like-comment-btn').on('click', likeComment);

	        // tooltip - zobrazuje, ktorym uzivatelom sa paci dany clanok
	        $('.tooltip-likes').tooltip({html: true});

	    });