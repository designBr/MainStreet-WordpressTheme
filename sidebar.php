<?php
	// if its the homepage and the device is a tablet, render the following
	if(is_home() == TRUE && $deviceResult->isTablet == TRUE) {
		echo '<div id="sideColNav">
			<h3 id="featPaneTitle">Featured</h3>
			<ul id="indicator">
				<li class="active"></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
			</ul>
			<div id="featureSlider">
				<ul>';
					$posts=get_posts('posts_per_page=5&tag=featured');
					if ($posts) {
						foreach($posts as $post) {
							setup_postdata($post); ?>
							<li>
								<div class="listText">
									<h4><a href="<?php the_permalink(); ?>"><?php the_author(); ?></a></h4>
									<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<?php the_excerpt() ?> <a class="more-link" href="<?php the_permalink();?>"><?php _e('Continue reading');?> <?php the_title();?></a>
									<a href="<?php the_permalink(); ?>"><img src="<?php show_post_image_url(); ?>" /></a>
								</div>
								<div class="clear"></div>
							</li>
						<?php
						} // foreach($posts
					} // if ($posts
				echo '</ul>
			</div><!-- end #featureSlider -->
		</div><!-- end sideColNav -->
		<script>
		var featureScroll;
			featureScroll = new iScroll("featureSlider", {
				snap: 		true,
				momentum: 	false,
				hScrollbar: false,
				vScroll: 	false,
				onScrollEnd: function () {
							document.querySelector("#indicator > li.active").className = "";
							document.querySelector("#indicator > li:nth-child(" + (this.currPageX+1) + ")").className = "active";
						}
			});
		</script>';
	}
	// if its the homepage and the device is mobile, but NOT a tablet, render the following
	elseif(is_home() == TRUE) {
		echo '<div id="homefrontContain">
			<div id="homefront">
				<ul id="indicator">
					<li class="active"></li>
					<li></li>
					<li></li>
					<li></li>
					<li></li>
				</ul>
				<div id="sideColNav">
					<div id="featureSlider">
						<ul>';
							$posts=get_posts('posts_per_page=5&tag=featured');
							if ($posts) {
								foreach($posts as $post) {
									setup_postdata($post); ?>
									<li style="background-image:url('<?php show_post_image_url(); ?>');">
										<a href="<?php the_permalink(); ?>">
											<div class="listText">
												<h3><?php the_title(); ?></h3>
												<h4><?php the_author(); ?></h4>
											</div>
											<div class="clear"></div>
										</a>
									</li>
								<?php
								} // foreach($posts
							} // if ($posts
					echo '</ul></div><!-- end #featureSlider -->
					<div id="chickletNav">
						<ul>';
						$list_cat_args = array(
							'exclude'		=> 1,
							'parent'		=> 0
						);
						$slide_index_number = 0;
						$categories=get_categories( $list_cat_args );
						  foreach($categories as $category) {
						      $posts=get_posts('showposts=-1&cat='. $category->term_id);
						      if ($posts) {
						        echo '<li onclick="toggleHome();hScroll.scrollToPage(' . $slide_index_number . ', 0, 0)"><a href="javascript:void(0)" class="onclick category-' . $category->term_id . '"><span class="img"> </span><span class="chickletName">' . $category->name . '</span></a><span class="catCount">' . $category->count . '</span></li>';

						      } // if ($posts
							$slide_index_number++;
						    } // foreach($categories
					echo '<div class="clear"></div></ul>
					</div><!-- end chickletNav -->
				</div><!-- end sideColNav -->
			</div><!-- end #homefront -->
		</div><!-- end #homefrontContain -->
		<script>
		var featureScroll;
		var chickScroll;
		$(document).ready(function(){

				featureScroll = new iScroll("featureSlider", {
					snap: 		true,
					momentum: 	false,
					hScrollbar: false,
					vScroll: 	false,
					checkDOMChanges: true,
					onScrollEnd: function () {
								document.querySelector("#indicator > li.active").className = "";
								document.querySelector("#indicator > li:nth-child(" + (this.currPageX+1) + ")").className = "active";
							}
				});

			chickScroll = new iScroll("chickletNav", {checkDOMChanges: true});
		}); // end document ready
		

		
		function toggleHome() {
			// if the homefront is hidden and the categories are showing, do stuff
			if ($("#main").hasClass("catView")) {
				$("#homeIcon").css("display", "none");
				$("#main").removeClass("catView");
			}
			// if the homefront is visible, do stuff
			else {
				$("#homeIcon").css("display", "block");
				$("#main").addClass("catView");
			}
		}

		</script>';
	}
	// THE FOLLOWING IS FOR PAGES OTHER THAN THE HOMEPAGE
	// if the device IS a tablet, and its NOT the homepage that is being loaded, render the following
	if(is_home() != TRUE && $deviceResult->isTablet == TRUE) {
		// these two variables grab the parent category id of the current page to later highlight the active nav item
		$pageParent = get_the_category();
		$pageParentId = $pageParent[0]->term_id;
		// the followig function is called to determine if the link being rendered in the category list matches the id of the parent category of the page, i.e. is this link the parent category
		function curPageStatus($a, $b) {
				if ($a == $b) {
					return ' has-current-page';
				}				
			}
		// write out the category list for the side column
		echo '<div id="sideColNav" class="catNav">
			<ul>';
				$list_cat_args = array(
					'exclude'		=> 1,
					'parent'		=> 0
				);
				$categories=get_categories( $list_cat_args );
				foreach($categories as $category) {
				    $posts2=get_posts('showposts=-1&cat='. $category->term_id);
				    if ($posts2) {
				    	echo '<li><a href="' . get_category_link( $category->term_id ) . '" class="category-' . $category->term_id . curPageStatus($category->term_id, $pageParentId) . '"><span class="img"> </span><span>' . $category->name . '</span><span class="catCount">' . $category->count . '</span></a></li>';
				    } // if ($posts
				} // foreach($categories
			echo '<li id="fillerBlock"> </li>
			</ul>
		</div><!-- end sideColNav -->
		<script>
			$(document).ready(function(){
				setSideUlHt();
				sideNavScroll = new iScroll("sideColNav", {checkDOMChanges: true});
				
			}); // end document ready
			
			window.onresize = windowSizeFunction;
			var resizefire;
			function windowSizeFunction() {
				clearTimeout(resizefire);
				resizefire = setTimeout(function(){
					setSideUlHt();
					}, 100);
			}
		
			function setSideUlHt() {
				var ulHt			= $("#sideColNav.catNav ul").height();
				var sideColHt		= $("#sideColNav").height();
				var fillBlockHt		= $("#fillerBlock").height();
				if ( sideColHt > ( ulHt - fillBlockHt ) ) {
					var htDiff		= sideColHt - ( ulHt - fillBlockHt );
					$("#fillerBlock").css( "height", htDiff );
				}
			}
		
			
		</script>';
	}
	// if the desivce is not a tablet, not the homepage, and is mobile, render the following
	//elseif(is_home() != TRUE) {
		// render nothing, we will not use a sidebar
	//}

?>
	