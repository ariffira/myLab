<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package mymeda
 */
?>

	</div><!-- #content -->
	</div >
<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="wrapper">
			<div class="newsfeed-widget">
				<h3>Medizinischer Newsfeed</h3>
				<ul>
					<li>
						<h4>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</h4>
						<p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu.</p>
					</li>
					<li>
						<h4>Glorious baklava ex librus hup hey ad infinitum.</h4>
						<p>A un Angleso it va semblar un simplificat Angles, quam un skeptic Cambridge amico dit me que Occidental es.</p>
					</li>
				</ul>
			</div>
			<!-- end newsfeed -->
			<div class="news-widget">
				<h3>News IhrArzt24</h3>
				<?php	$args = array( 'post_type' => 'news', 'posts_per_page' => 2 );
			$loop = new WP_Query( $args );?>
			
			
			<?php while ( $loop->have_posts() ) : $loop->the_post();	 ?>
			    <ul>
					<li>
						<h4><a href="<?php the_permalink() ?>"><?php $thetitle = $post->post_title; /* or you can use get_the_title() */
						$getlength = strlen($thetitle);
						$thelength = 68;
						echo substr($thetitle, 0, $thelength);
						if ($getlength > $thelength) echo "..."; ?></a></h4>
						<em><?php the_time('M j Y'); ?></em>
					</li>
				</ul>
					<?php endwhile; ?>

			</div>
			
			<!-- end news -->
			<div class="contact-widget">
				<?php 
    $language = substr(get_bloginfo ( 'language' ), 0, 2);
    if($language == 'en')
	{
echo "<h3>Contact Us</h3>";
	  
	} elseif ($language == 'ar'){
echo "<h3>الاتصال بنا</h3>";
          
	}  elseif ($language == 'hi'){
echo "<h3>हमसे संपर्क करें</h3>";
        
}  elseif ($language == 'th'){
echo "<h3>ติดต่อเรา</h3>";
       
}  else {
echo "<h3>Kontaktieren Sie Uns</h3>";
      

} ?>	

				<p><strong>IhrArzt24 GmbH</strong><br>Rheindorfer Weg 4, 40591 Düsseldorf</p>
				<p>Tel: 0211 / 972 640 94  |  Fax: 0211 / 972 640 96<br>Email: <a href="mailto:kontakt@ihrarzt24.de">kontakt@ihrarzt24.de</a></p>
				<p><?php echo '<img src="'.get_bloginfo('template_url').'/images/app-store.png" alt="" />'; ?>
				<?php echo '<img src="'.get_bloginfo('template_url').'/images/google-play.png" alt="" />'; ?></p>
				<ul class="social-links">
					<li><a class="linked" href="#"></a></li>
					<li><a class="twit" href="#"></a></li>
					<li><a class="facebk" href="#"></a></li>
					<li><a class="gplus" href="#"></a></li>
				</ul>
			</div>
			
			<!-- end address -->
		</div><!-- #page -->
	</footer>
	<!-- #colophon -->
	<div class="foot-btm">
		<div class="wrapper">
			<div class="left">&copy;2013IhrArzt24</div>
			<div class="right"><a href="#">Impressum</a>  |  <a href="#">Nutzungsvertrag und Datenschutz</a></div>
		</div>
	</div>
	


<?php wp_footer(); ?>
<script>


$(document).ready(function() {
	
	  $('#nav').onePageNav({
			filter: ':not(.external)',
                        scrollSpeed: 2500,
			scrollThreshold: 0.75
			});
	});
//scroll-to-top button show and hide
jQuery(document).ready(function(){
jQuery(window).scroll(function(){
    if (jQuery(this).scrollTop() > 100) {
        jQuery('.scrollup').fadeIn();
    } else {
        jQuery('.scrollup').fadeOut();
}
});
//scroll-to-top animate
jQuery('.scrollup').click(function(){
jQuery("html, body").animate({ scrollTop: 0 }, 600);
    return false;
});
});
$("div.lazy").lazyload({
    effect : "fadeIn"
});

$('.videoslider').bxSlider({
infiniteLoop: false,

  pagerCustom: '#video-pager',
touchEnabled: false,
  video: true,
   useCSS: false,
  controls: false,
  onSlideBefore: function($slideElement, oldIndex, newIndex){ 
	if(typeof($("#player_iframe1")[0]) != 'undefined') { $('#player_iframe1')[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*'); }
	if(typeof($("#player_iframe2")[0]) != 'undefined') { $('#player_iframe2')[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');}
if(typeof($("#player_iframe3")[0]) != 'undefined') { $('#player_iframe3')[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*'); 
	}}

}); 




</script>

<script type="text/javascript">
function slider(slideridn) {
               goto(slideridn);
}

function slideNext(){
         curtSlider = 1; sliderlen = $('#wideslider').find('li').length;
		 curtSlider = (typeof($("#bx-pager a.active").index()) !=  'undefined')? parseInt($("#bx-pager a.active").index())+1:1;
         slideridn = curtSlider;
	 	 if(curtSlider < sliderlen ){ 
                    goto(slideridn);
		  }
  }
function slidePrev(){
         curtSlider = 1; sliderlen = $('#wideslider').find('li').length;
		 curtSlider = (typeof($("#bx-pager a.active").index()) !=  'undefined')? parseInt($("#bx-pager a.active").index()) - 1:1;
         slideridn = curtSlider;
	 	 if(curtSlider >= 0 ){
		  	 goto(slideridn);
		  }
}


function goto(slideridn){
              $("#bx-pager").find('a').removeClass('active');
	          $("#bx-pager").find('a:eq('+slideridn+')').addClass('active');
	          $('#wideslider').find('li').addClass('hidden');
	          $("#wideslider").find('li:eq('+slideridn+')').removeClass('hidden');
}
$(document).ready(function(){
       goto(0);
});



	
</script>

	
</body>
</html>