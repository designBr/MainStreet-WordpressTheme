<?php 
	require("header.php");
	require("sidebar.php");
?>

<div id="snapWrapper">
	<div id="hScrollObject">
		<?php // write out category lists ?>
		<?php
		$list_cat_args = array(
			'exclude'		=> 1,
			'parent'		=> 0
		);
		$list_number = 0;
		$categories=get_categories( $list_cat_args );
		  foreach($categories as $category) {
		      $posts=get_posts('posts_per_page=' . $postsPerPage . '&cat='. $category->term_id );
		      if ($posts) {
		        echo '<section class="catListOuter"><div class="categoryTitle">' . $category->name . '</div><div class="catList" id="categoryIndex-' . $list_number . '"><ul class="articleList">
		 ';
		        foreach($posts as $post) {
		          setup_postdata($post); ?>
		          	<li><a href="<?php the_permalink(); ?>">
						<div class="thumbWrap">
							<span>
								<?php show_thumbnail(); ?>
							</span>
						</div><!-- end #thumbWrap -->
						<div class="listText">
							<h3><?php the_title(); ?></h3>
							<h4><?php the_author(); ?></h4>
						</div>
						<div class="clear"></div>
					</a></li>
					<div class="clear"></div>

		          <?php
		        } // foreach($posts
				echo '	<li class="navigation">
						<div class="thumbWrap"></div><!-- end #thumbWrap -->
						<div class="listText">
							<a href="' . get_category_link( $category->term_id ) . 'page/2/" >Older Entries</a>
						</div>
						<div class="clear"></div>
					</li>
				</ul><div class="clear"></div></div></section><!-- end #' . $category->name . ' -->			
				<script>
				$(document).ready(function(){
					//var listCount = $(".catList").length;
					var vScroll' . $list_number . ';
					setTimeout(function () {
						vScroll' . $list_number . ' = new iScroll("categoryIndex-' . $list_number . '", {checkDOMChanges: true});
					}, 500);
				});
				</script>';
		      } // if ($posts
			$list_number++;
		    } // foreach($categories
		?>
</div><!-- end snapWrapper -->
<script>


var hScroll;
$(document).ready(function(){
	setWrapHeights();
	hScroll = new iScroll('snapWrapper', {
		snap: 		'section',
		momentum: 	false,
		hScrollbar: false,
		vScroll: 	false,
		checkDOMChanges: true<?php if($deviceResult->isTablet != TRUE) {echo ',
		onScrollEnd: function () {
				// this function adds and removes classes from the current horizontal scoller on the homepage to animate the column headers
				$("#hScrollObject .catListOuter").removeClass("post").removeClass("pre");
				var listCount 	= $(".catListOuter").length;
				var i = 0;
				for (i=0;i<(this.currPageX);i++) {
					$("#hScrollObject .catListOuter:nth-of-type(" + (i+1) + ")").addClass("pre");
				}
				for (i=(this.currPageX);i<listCount;i++) {
					$("#hScrollObject .catListOuter:nth-of-type(" + (i+2) + ")").addClass("post");
				}
			}';} ?>
	});
}); // end document ready

window.onresize = windowSizeFunction;
var resizefire;
function windowSizeFunction() {
	clearTimeout(resizefire);
	resizefire = setTimeout(function(){
		setWrapHeights();
		}, 100);
}

function setWrapHeights() {
	var screenWidth 		= $('#snapWrapper').width();
	var snapWrapperHeight 	= $(window).height() - 61;
	var listCount 			= $('.catListOuter').length;
	var hScrollWidth 		= listCount * screenWidth;
	var sideColWidth		= $('#sideColNav').width();
	var chickletHt			= screenWidth / 4;
	<?php 
	if($deviceResult->isTablet == TRUE) {
		echo "
		$('.catListOuter').css( { height: snapWrapperHeight } );
		$('#hScrollObject').css('width', ($('.catListOuter').width()) * listCount);
		$('#homefront').css( { width: screenWidth } );
		";
	} 
	else {
		echo "
		var featSliderWidth = 5 * screenWidth;
		$('.catListOuter').css( { width: screenWidth, height: snapWrapperHeight } );
		$('#hScrollObject').css('width', ($('.catListOuter').width()) * listCount);
		$('#homefront').css( { width: screenWidth } );
		$('#featureSlider ul li').css( { width: screenWidth } );
		$('#featureSlider ul').css( { width: featSliderWidth } );
		$('#chickletNav ul li').css( { height: chickletHt } );
		";
	}
	?>
	
	
	
}
</script>
<?php get_footer(); ?>