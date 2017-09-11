$(document).ready(function(){
	$('.wideslider li').first().addClass('active');
	//$('.wideslider li').hide();    
	$('.wideslider li.active').show();

	    $('#next').click(function(){

	    $('.wideslider li.active').removeClass('active').addClass('oldActive');    
	                   if ( $('.oldActive').is(':last-child')) {
	        $('.wideslider li').first().addClass('active');
	        }
	        else{
	        $('.wideslider li.oldActive').next().addClass('active');
	        }
	    $('.wideslider li.oldActive').removeClass('oldActive');
	    //$('.wideslider li').fadeOut();
	    $('.wideslider li.active').fadeIn();
	        
	        
	    });
	    
	    $('#prev').click(function(){
	    $('.active').removeClass('active').addClass('oldActive');    
	           if ( $('.oldActive').is(':first-child')) {
	        $('.wideslider li').last().addClass('active');
	        }
	           else{
	    $('.oldActive').prev().addClass('active');
	           }
	    $('.oldActive').removeClass('oldActive');
	   // $('.wideslider li').fadeOut();
	    $('.active').fadeIn();
	    });
	    
	
	    
	});

   $('#bx-pager a').on("click",function(){
	   var thumbimg  =  $(this).data('slide-index');
	   $('#bx-pager a').removeClass('active'); 
	   $(this).addClass('active'); 
	 //  alert(thumbimg);
	  
		   $('.wideslider li').removeClass('active'); 
		   $('.wideslider li').each(function(){
		     if($(this).attr('data-tab-id')==thumbimg){
		      $(this).addClass('active'); 
		    }
		  });
   
});


   