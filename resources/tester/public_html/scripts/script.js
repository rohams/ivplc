/* Elliot Barer, ebarer [at] mac [dot] com, XX/YY/2011 */


$(document).ready(function() {
	$('#browser').addClass('closed').removeClass('closed');

	var $manufacturer = false;
	var $model = false;
	var $year = false;

	$('a', '#manufacturer').click(function(){		
		if($(this).parents('li').hasClass('selected') == true){
			$manufacturer = false;
			$model = false;
			$year = false;
			$('li.selected').removeClass('selected');
			animation();
			$('#manufacturer').animate({scrollTop:0},250);
		} else {
			$manufacturer = false;
			$model = false;
			$year = false;
			$('li.selected').removeClass('selected');
			animation();
			$manufacturer = true;
			$('#manufacturer li.selected').removeClass('selected');
			$(this).parents('li').addClass('selected');
			scrollColumn($(this).prop('id'), $(this).parents('ul').prop('id'));
			animation();
		}
	});	
	
	$('a', '#model').click(function(){
		if($(this).parents('li').hasClass('selected') == true){
			$model = false;
			$year = false;
			$('#model li.selected, #year li.selected').removeClass('selected');
			animation();
			$('#model').animate({scrollTop:0},250);
		} else {
			$model = false;
			$year = false;
			$('#model li.selected, #year li.selected').removeClass('selected');
			animation();
			$model = true;
			$('#model li.selected').removeClass('selected');
			$(this).parents('li').addClass('selected');
			scrollColumn($(this).prop('id'), $(this).parents('ul').prop('id'));
			animation();
		}
	});

	$('a', '#year').click(function(){		
		if($(this).parents('li').hasClass('selected') == true){
			$year = false;
			$('#year li.selected').removeClass('selected');
			animation();
			$('#year').animate({scrollTop:0},250);
		} else {
			$year = true;
			$(this).parents('li').addClass('selected');
			scrollColumn($(this).prop('id'), $(this).parents('ul').prop('id'));
			animation();
			console.log(
				$('#manufacturer li.selected').text() + '; ' +
				$('#model li.selected').text() + '; ' +
				$('#year li.selected').text()
			);
		}
	});
	
	function scrollColumn(i,p){
		$scroll = parseInt(i.match(/[0-9]+/)) * 40;
		console.log($scroll);
		$('#'+p).animate({scrollTop:$scroll},250);
	}
	
	function animation(){
		if($manufacturer == true){
			$('#model').addClass('active', 250);
			
			if($model == true){
				$('#year').addClass('active', 250);
				
				if($year == true){
					$('#browser').addClass('closed', 250);
				} else {
					$('#browser').removeClass('closed', 250, function(){
						$('#year').animate({scrollTop:0},250);
					});
				}
			} else {
				$('#year').removeClass('active', 250, function(){
					$('#year').animate({scrollTop:0},250);
				});
				$('#browser').removeClass('closed', 250);
			}
		} else {
			$('#model, #year').removeClass('active', 250, function(){
				$('#model, #year').animate({scrollTop:0},250);
			});
			$('#browser').removeClass('closed', 250);
		}
	}
	
});


