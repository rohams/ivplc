$(document).ready(function(){

/* GENERAL - OPEN WINDOW IN NEW TAB*/
	$('.ext').click(function(){ window.open(this.href); return false; });


/* DELETE CONFIRMATION*/
        $('a.delete').click(function(){
            if (confirm("Are you sure you want to delete this record from the database?")) {
                return true;
            }
            return false; 
	});

/* DELETE FILES IN EDITFORM*/
  /*  $('#deletefile-1').click(function(){
        $append= '<input type="file" name="component[]"/>';
        var boxes = $('input[name=delete]:checked');       
        $(boxes).each(function(){
            var checkId = $(this).attr('id');
            //alert(checkId);             
                $('#component'+checkId).append($append);
                $('#file_'+checkId).remove();
        });
        return false; 
    });
    */
    $('#deletefile-2').click(function(){
        $append= '<input type="file" name="component[]"/>';
        var boxes = $('input[name=delete2]:checked');       
        $(boxes).each(function(){
            var checkId = $(this).attr('id');
            //alert(checkId);             
                $('#component'+checkId).append($append);
                $('#cfile_'+checkId).remove();
        });
        return false; 
    });
    
    $('#deletefile-3').click(function(){
        $append= '<input type="file" name="measurement[]"/>';
        var boxes = $('input[name=delete3]:checked');       
        $(boxes).each(function(){
            var checkId = $(this).attr('id');
            //alert(checkId);             
                $('#r'+checkId).append($append);
                $('#mfile_'+checkId).remove();
        });
        return false; 
    });


/* GROUPS DEFAULT IMAGE*/
	$("#groups .member img").error(function(){
		$(this).attr('src', '../resources/styles/defaults/groups.png');
	});
	
	$("#admin-group img").error(function(){
		$(this).attr('src', '../../resources/styles/defaults/groups.png');
	});
	
	
/* AUTHORS INCR/DECR*/
	$authCounter = 2;
	
	$('#incrementAuthor').click(function(){
		if($authCounter <= 8){
			$append = '<div class="group_member" id="author'+$authCounter+'">';
			$append += '<label for="author_first[]">First Initial</label>';
			$append += '<input type="text" name="author_first[]"/>';
			$append += '<label for="author_last[]">Last</label>';
			$append += '<input type="text" name="author_last[]"/>';
			$append += '</div>';
			
			$('#authors').append($append);
			$('#author'+$authCounter).css({'display':'none'}).slideDown(300);
			$authCounter++;
			
			if($authCounter > 8){
				$('#incrementAuthor').stop().animate({'opacity':'0.25'}).css({'cursor':'default'});
			} else {
				$('#incrementAuthor').stop().animate({'opacity':'1'}).css({'cursor':'pointer'});
				$('#decrementAuthor').stop().animate({'opacity':'1'}).css({'cursor':'pointer'});
			}
		}
		
		return false;
	});
	
	$('#decrementAuthor').click(function(){
		if($authCounter > 2){
			$authCounter--;
			$('#author'+$authCounter).slideUp(300, function(){ $(this).remove(); });
			
			if($authCounter <= 2){
				$('#decrementAuthor').stop().animate({'opacity':'0.25'}).css({'cursor':'default'});
			} else {
				$('#decrementAuthor').stop().animate({'opacity':'1'}).css({'cursor':'pointer'});
				$('#incrementAuthor').stop().animate({'opacity':'1'}).css({'cursor':'pointer'});
			}
		}	

		return false;
	});


/* IMAGES INCR?DECR */
	$imgCounter = 2;

	$('#incrementImage').click(function(){
		if($imgCounter <= 10){
			$append = '<div class="group_member" id="image'+$imgCounter+'">';
			$append += '<label for="image">Image '+$imgCounter+'</label>';
			$append += '<input type="file" name="image[]"/>';
			$append += '</div>';
			
			$('#images').append($append);
			$('#image'+$imgCounter).css({'display':'none'}).slideDown(300);
			$imgCounter++;
			
			if($imgCounter > 10){
				$('#incrementImage').stop().animate({'opacity':'0.25'}).css({'cursor':'default'});
			} else {
				$('#incrementImage').stop().animate({'opacity':'1'}).css({'cursor':'pointer'});
				$('#decrementImage').stop().animate({'opacity':'1'}).css({'cursor':'pointer'});
			}
		}
		
		return false;
	});
	
	$('#decrementImage').click(function(){
		if($imgCounter > 2){
			$imgCounter--;
			$('#image'+$imgCounter).slideUp(300, function(){ $(this).remove(); });
			
			if($imgCounter <= 2){
				$('#decrementImage').stop().animate({'opacity':'0.25'}).css({'cursor':'default'});
			} else {
				$('#decrementImage').stop().animate({'opacity':'1'}).css({'cursor':'pointer'});
				$('#incrementImage').stop().animate({'opacity':'1'}).css({'cursor':'pointer'});
			}
		}
		
		return false;
	});


/* COMPONENTS & MEASUREMENTS INCR/DECR (EDIT PAGE)*/ 

	$compCounter = 3+id;
	$measurementCounter = 2+id;
	$cellCounter = 1;
	
	
	$('#incrementComponent').click(function(){
		if($compCounter <= 10){
			/* INCR & DECR */
			if($compCounter >= 3){
				$('#decrementComponent').stop().animate({'opacity':'1'}).css({'cursor':'pointer'});
			}
			
			/* COMPONENTS */
			$component = '<div class="group_member component" id="component'+$compCounter+'">';
			$component += '<label for="component_name">Component '+$compCounter+'</label>';
			$component += '<input type="text" name="component_name[]" maxlength="20"/>';
			$component += '<input type="file" name="component[]"/>';
			$component += '</div>';
			
			$('#components').append($component);
			$('#component'+$compCounter).css({'display':'none'}).slideDown(300);
			
			
			/* MEASUREMENTS */
			$measurement =  '<div class="measurement" id="measurement'+$measurementCounter+'">';
			$measurement += '<h2 class="component'+$measurementCounter+'">Component '+$measurementCounter+'</h2>';
			$measurement += '</div>';
						
			$('#measurements').append($measurement);
			$('#measurement'+$measurementCounter);
			
			/* ADD REFERENCE MEASUREMENTS */
			$('.measurement').each(function(){
				$reference = '<div class="reference">';
				$reference += '<label class="component'+$compCounter+'" for="measurement[]">Component '+$compCounter+'</label>';
				$reference += '<input type="file" name="measurement[]" value="">';
				$reference += '</div>';
				
				$(this).append($reference);
			});
			
			$measurementCounter++;
			$compCounter++;
		}
		
		return false;
	});
	
	$('#decrementComponent').click(function(){
		if($compCounter > 3){
                        $('#decrementComponent').stop().animate({'opacity':'1'}).css({'cursor':'pointer'});
			$compCounter--;
			$measurementCounter--;
			
			/*COMPONENTS*/
			$('#component'+$compCounter).slideUp(300, function(){ $(this).remove(); });
			
			/* REMOVE LAST MEASUREMENT */
			console.log('#measurement'+$measurementCounter);
			$('#measurement'+$measurementCounter).remove();
			
			/* REMOVE REFERENCE MEASUREMENTS */
			$('.measurement').each(function(){
				$(this).children('.reference').last().remove();
			});
                }
		else{
                     $('#decrementComponent').stop().animate({'opacity':'0.25'}).css({'cursor':'default'});
                }
        
		
		return false;
	});
	
	/*Agree to Terms and Conditions before Submit*/
	$('#confirm').click(function(){
		$('form#submit_general').animate({'opacity':'1'}).css({'cursor':'pointer'});
	});


	/* UPDATE HEADERS */
	$('input[name="component_name[]"]').live('keyup', function(){
		$modifier = $(this).parents('.group_member').attr('id');
		$('.'+$modifier).html($(this).val());
	});


/* MEASUREMENTS */
	$('#slider').nivoSlider({
		effect: 'fade',
		pauseOnHover: true,
		pauseTime: 5000,
		directionNav: false,
		directionNavHide: true,
		controlNav: true,
	});


/*ADMIN GROUP*/

	$('#add').click(function(){
		if($('#add_member').css('display') == 'block'){
			$('#add_member').slideUp(300);		
		} else {
			$('#add_member').slideDown(300);
		}
	});

});