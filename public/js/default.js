$(document).ready(function(){
	var x = $(location).attr('href').replace( 'http://marcel-server/marcel/' , ""); // Step 1
	//alert(x);
	$('ul.nav > li').removeClass('active');
	$('a[href="' + x + '"]').parent().addClass('active'); // Step 2


	$('.teaser, .portal-news-teaser').hover(
		function(){
			$(this).animate({'backgroundColor': '#efefef'}, 750);
			$(this).find('h3').animate({'color': 'red'}, 750);
		},
		function(){
			$(this).animate({'backgroundColor': 'white'}, 750);
			$(this).find('h3').animate({'color': 'black'}, 750);
		}
	);

	var url = document.location.toString();
	if(url.match('#')){
	    $('.nav-tabs a[href=#'+url.split('#')[1]+']').tab('show');
	}
});



function handleForm(requestType, elem, success_callback){
	$(elem).submit(function(e){
		e.preventDefault();

		$.ajax({
			type: 		requestType, 
			url: 		$(this).attr('action'),
			data: 		$(this).serialize(),
			dataType: 	'json',
			success: 	function(o){
				if(o.type === true){
					Result.success(o.headline, o.message);
				}else{
					Result.error(o.headline, o.message);
				}

				if(typeof success_callback == 'function'){
					success_callback(o);
				}
			},
			error: function(o){
				console.log(o);
			}
		});
	});
}

var subdir = '/marcel/';