$(document).ready(function() {
	
	setup.doc();
	setup.navigation();
	
	$('#login-create-account').click(function(){
  
     if($(this).is(':checked'))
     {
        $('#login-create-account-button').val('CREATE ACCOUNT');
     }
     else
     {
       $('#login-create-account-button').val('LOGIN');
     }
  
  })
	
	
	
});

var setup = {
	
	doc:function() {
		
		$(document).scroll(function() {
			
			var topScroll = $(this).scrollTop();
			
			if(topScroll > 1) {
				
				$(".navigation-menu").css({'display': 'block'}).children('a').removeClass('active');
				
				$(".navigation-base").stop().animate({'opacity': 0}, 500, function() {
					
					$(this).css({'display': 'none'});
					
				});
				
			} else {
				
				$(".navigation-menu").css({'display': 'none'});
				
				$(".navigation-base").css({'display': 'block'}).stop().animate({'opacity': 1}, 500);
				
			}
			
		});
		
	},
	
	navigation:function() {
		
		var loginDropped = false;
		
		$("#navigation").css({'position': 'fixed'});
		
		$(".navigation-user a").click(function(e) {
			
			e.preventDefault();
			
			if(loginDropped) {
				
				$(this).removeClass('active');
				
				$(".navigation-user-dropdown").css({'display': 'none'});
				
				loginDropped = false;
				
			} else {
				
				$(this).addClass('active');
				
				$(".navigation-user-dropdown").css({'display': 'block'});
				
				loginDropped = true;
			
			}
			
		});
		
		$(".navigation-menu").click(function(e) {
			
			e.preventDefault();
			
			if($(".navigation-base").css('opacity') == 0) {
				
				$(".navigation-menu a").addClass('active');
				
				$(".navigation-base").css({'display': 'block'}).stop().animate({'opacity': 1}, 500);
				
			} else {
				
				$(".navigation-menu a").removeClass('active');
				
				$(".navigation-base").stop().animate({'opacity': 0}, 500, function() {
					
					$(this).css({'display': 'none'});
					
				});
				
			}
			
		});
		
	}
	
}