<!DOCTYPE html>

<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<html class="no-js" lang="en"> 

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width" />
  <title><?php create_page_title(); ?></title>
  
  <!-- CSS Files: All pages -->
   <script type="text/javascript" src="http://fast.fonts.com/jsapi/c5f514c7-d786-4bfb-9484-ea6c8fbd263f.js"></script>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/stylesheets/foundation.css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/stylesheets/flagship.css">
  <!-- CSS Files: Conditionals -->
  
  <!-- Modernizr and Jquery Script -->
  <script src="<?php echo get_template_directory_uri() ?>/assets/javascripts/modernizr.foundation.js"></script>
  <?php wp_enqueue_script('jquery'); ?> 
  <?php wp_head(); ?>

  <!-- Make IE a modern browser -->
  <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
  <![endif]-->
  <?php include_once("parts-analytics.php") ?> 
</head>

<?php
/* Get the Ancestor Page Slug to Use as a Body Class, this will only return a value on pages! */
$ancestorslug = '';
if( is_page() ) { 
	global $post;
        /* Get an array of Ancestors and Parents if they exist */
	$parents = get_post_ancestors( $post->ID );
        /* Get the top Level page->ID count base 1, array base 0 so -1 */ 
	$id = ($parents) ? $parents[count($parents)-1]: $post->ID;
	/* Get the parent and set the $ancestorslug with the page slug (post_name) */
        $parent = get_page( $id );
	$ancestorslug = $parent->post_name;
}

?>

<body <?php body_class($ancestorslug); ?>>
	<header>
		<div class="row show-for-small" role="banner">
			<div class="three columns centered">
			<div class="mobile-logo"><a href="<?php echo network_site_url(); ?>">Home</a></div>
			</div>
		</div>
	
		<div class="row">
			<div id="search-bar" class="offset-by-eight four columns" role="search">
				<div class="row">
					<div class="six columns">
					
					<form method="GET" action="<?php echo site_url('/search'); ?>" role="search">
						<input type="submit" class="icon-search" value="&#xe004;" />
						<input type="text" name="q" placeholder="Search this site" />
					</form>
					</div>
					<div class="six columns links">
						<a href="<?php echo network_site_url(); ?>about/contact/">Directory</a> | 
						<a href="http://my.jhu.edu">MYJHU</a> | 
						<a href="http://library.jhu.edu/">Library</a>
					</div>
				</div>	
			</div>	<!-- End #search-bar	 -->
		</div>
		<div class="row" role="navigation">
			<?php wp_nav_menu( array( 
				'theme_location' => 'main_nav', 
				'menu_class' => '', 
				'container' => 'nav',
				'container_id' => 'main_nav', 
				'container_class' => 'twelve columns',
				'depth' => 2,
				'walker'=> new page_id_classes )); ?> 
		</div>
		<div class="row show-for-small black_bg radius10" id="mobile_nav_container" role="navigation">

			<?php wp_nav_menu( array( 
				'theme_location' => 'main_nav', 
				'menu_class' => '', 
				'fallback_cb' => 'foundation_page_menu', 
				'container' => 'div',
				'container_id' => 'mobile_nav', 
				'container_class' => 'twelve columns',
				'depth' => 2,
				'walker' => new mobile_select_menu(),
				'items_wrap' => '<select onchange="window.open(this.options[this.selectedIndex].value,\'_top\')">%3$s</select>', )); ?> 
		</div>	
	</header>