<?php 


/*== CASE STUDY POST ==*/
function rvg_team(){
  $labels = array(
	'name' => 'Team',
	'singular_name' => 'Team',
	'add_new' => 'Add Team',
	'all_items' => 'All Teams',
	'add_new_item' => 'Add Team',
	'edit_item' => 'Edit Team',
	'view_item' => 'View Team',
	'search_item' => 'Search Team',
	'not_found' => 'No Team found',
	'not_found_in_trash' => 'No Team found in trash',
	'parent_item_colon' => 'Parent Team Study'
   );
   $args = array(
	 'labels' => $labels,
	 'public' => true,
	 'has_archive' => true,
	 'publicly_queryable' => true,
	 'query_var' => true,
//	 'rewrite' => array( 'slug' => 'case-studies' ),
	 'capability_type' => 'post',
	 'hierarchical' => true,
	 'supports' => array(
	   'title',
	   'editor',
	   'excerpt',
	   'thumbnail',
	   'revision',
	   'custom-fields'
	  ),
	 'menu_position' => 5,
	 'exclude_from_search' => false,
	 'show_in_admin_bar' =>  true,
     'taxonomies' => array('teamcat'),
	 
   );
   register_post_type('team-post',$args);
}
add_action( 'init', 'rvg_team' );


//POST LOAD MORE
function post_load_more() {
  $paged = $_POST["page"]+1;	
  $args = array('post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => 12, 'paged' => $paged, 'order' => 'DESC', 'orderby' => 'date');
  $loop = new WP_Query($args);
  
  
  if( $loop->have_posts() ):
  	while ( $loop->have_posts() ) : $loop->the_post();
  		$terms = get_the_category();
		$terms_array = array();
		foreach( $terms as $term){ 
			$terms_array[] = $term->name;
			$xy =  $term->slug;
		}
		$terms_string = join( ' ', $terms_array ); ?>
		<a href="<?php the_permalink(); ?>">
			<div class="latest_contents">
				<div class="latest_image background_style" style="background-image: url('<?php the_post_thumbnail_url(); ?>');"></div>
				<div class="latest_text">
					<div class="latest_cat latest_<?= $xy; ?>"><?= $terms_string; ?></div>
					<h4><?php the_title(); ?></h4>
				</div>
			</div>
		</a>
	<?php endwhile;
  
  else:
	echo 0;
  endif;
  wp_reset_postdata(); 
  die();
}
add_action('wp_ajax_nopriv_post_load_more', 'post_load_more' );
add_action('wp_ajax_post_load_more', 'post_load_more' );


