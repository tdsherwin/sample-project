<?php

function my_theme_enqueue_styles() {
    wp_enqueue_style( 'customstylesheet', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'font-style', get_stylesheet_directory_uri() . '/inc/font-style.css' );
	wp_enqueue_style( 'default-style', get_stylesheet_directory_uri() . '/inc/default-style.css' );
	wp_enqueue_style( 'slickcss', get_stylesheet_directory_uri() . '/css/slick.css', '1.9.0', 'all');
	wp_enqueue_style( 'mmmenu', get_stylesheet_directory_uri() . '/css/jquery.mmenu.all.css', '7.3.2', 'all');
	wp_enqueue_style( 'slickcsstheme', get_stylesheet_directory_uri() . '/css/slick-theme.css', '1.9.0', 'all');
	wp_enqueue_style( 'lightboxcss', get_stylesheet_directory_uri() . '/css/lightbox.min.css', '3.4.1', 'all');
	wp_enqueue_style( 'litycss', get_stylesheet_directory_uri() . '/css/lity.min.css', '2.4.1', 'all');
	
	wp_enqueue_script( 'jquery', get_stylesheet_directory_uri() . '/lib/jquery.min.js', array( 'jquery' ), '3.6.3', true );
	wp_enqueue_script( 'customscript', get_stylesheet_directory_uri() . '/js/main.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'gsapscripts', get_stylesheet_directory_uri() . '/js/gsap.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'slickjs', get_stylesheet_directory_uri() . '/lib/slick.min.js', array('jquery'), '1.9.0', true );
	wp_enqueue_script( 'mmmenujs', get_stylesheet_directory_uri() . '/lib/jquery.mmenu.all.js', array(), '7.3.2', true );
	wp_enqueue_script( 'slickjs-init', get_stylesheet_directory_uri() . '/js/slick-init.js', array( 'slickjs' ), '1.9.0', true );
	wp_enqueue_script('isopkgd', get_stylesheet_directory_uri() . '/lib/isotope.pkgd.min.js', array(), '1', true );
	wp_enqueue_script('lityjs', get_stylesheet_directory_uri() . '/lib/lity.min.js', array(), '2.4.1', true );
	wp_enqueue_script('gsap', get_stylesheet_directory_uri() . '/lib/gsap.min.js', array(), '3.10.4', true );
	wp_enqueue_script('scrolltrigger', get_stylesheet_directory_uri() . '/lib/ScrollTrigger.min.js', array(), '3.10.4', true );
	wp_enqueue_script('lazyload', get_stylesheet_directory_uri() . '/lib/lazyload.min.js', array(), '1.10.4', true );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

/*== THEME OPTIONS ==*/
if( function_exists('acf_add_options_page') ) {
 $option_page = acf_add_options_page(array(
  'page_title'  => 'Lages & Associates <small style="font-size: medium;">V1.0.1</small>',
  'menu_title'  => 'THEME Options',
  'menu_slug'  => 'options-framework',
  'capability'  => 'edit_posts',
  'icon_url'   => 'dashicons-admin-settings',
  'position'   => '61',
  'redirect'   => false
 ));

}

require_once('inc/custom-post-type.php');

add_action( 'add_attachment', 'gbs_image_meta_upon_image_upload' );
function gbs_image_meta_upon_image_upload( $post_ID ) {
    if ( wp_attachment_is_image( $post_ID ) ) {
        $my_image_title = get_post( $post_ID )->post_title;
        $my_image_title = preg_replace( '%\s*[-_\s]+\s*%', '-',$my_image_title );
        $my_image_title = strtolower( $my_image_title );
        $altext_title = ''.$my_image_title.'-'.get_bloginfo( 'name' );
        $my_image_meta = array(
        'ID' => $post_ID,
        'post_content' => $altext_title,
        );
        update_post_meta( $post_ID, '_wp_attachment_image_alt', $altext_title );
    //    wp_update_post( $my_image_meta );
    }
}


/*== CUSTOM EXCERPT LENTGH ==*/
function excerpt($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
      } else {
        $excerpt = implode(" ",$excerpt);
      } 
    $excerpt = preg_replace('`\[[^\]]*\]`','', $excerpt);
	return $excerpt;
}

/*== SECTION SETTINGS VARIABLES ==*/
class SectionSettings {
	public function section_settings($sSettings) {
		while( have_rows('section_settings') ) : the_row();
			$get_ID = get_sub_field('section_id');
			$get_section_bg_img = get_sub_field('section_background_image');
			$get_custom_container = get_sub_field('section_custom_width');
			$get_container_options = get_sub_field('section_container');
			
			if( get_sub_field('section_background_image') ) : 
				$set_section_bg_img = 'data-bg="' . $get_section_bg_img . '"';
			else :
				$set_section_bg_img = '';
			endif;
		
			if( get_sub_field('section_id') ) : 
				$set_ID = 'id="'.$get_ID.'"';
			else :
				$set_ID = '';
			endif;
			
			if( get_sub_field('section_class') ) : 
				$set_class_name = '  ' . get_sub_field('section_class');
			else :
				$set_section_bg_img = '';
			endif;
			
			if( get_sub_field('section_container') == 'custom' ) : 
				$set_custom_container = 'class="custom_container" style="width: ' . $get_custom_container . 'px"';
			else :
				$set_custom_container = 'class="' . $get_container_options . '"';
			endif;
			
			if( get_sub_field('animate_direction') ) : 
				$set_animation = '  ' . get_sub_field('animate_direction');
			else :
				$set_animation = '';
			endif;
			
		endwhile;
		
/*		
		
		$get_group = get_field('section_settings');
		$get_section_bg_img = $get_group['section_background_image'];
		$get_ID = $get_group['section_id'];
		$get_class_name = $get_group['section_class'];
		$get_animation = $get_group['animate_direction'];
		$get_container_options = $get_group['section_container'];
		$get_custom_container = $get_group['section_custom_width'];
		
		//Background image settings
		if( ! empty($get_section_bg_img) ) {
			$set_section_bg_img = 'data-bg="' . $get_section_bg_img . '"';
		} else {
			$set_section_bg_img = '';
		}
		
		//Custom ID
		if( ! empty($get_ID) ) {
			$set_ID = 'id="'.$get_ID.'"';
		} else {
			$set_ID = '';
		}
		
		//Custom class name
		if( ! empty($get_class_name) ) {
			$set_class_name = '  ' . $get_class_name;
		} else {
			$set_class_name = "";
		}
		
		//Custom animation
		if( ! empty($get_animation) ) {
			$set_animation = '  ' . $get_animation;
		} else {
			$set_animation = "";
		}
		
		//Container settings
		if( $get_container_options == 'custom' ) {
			$set_custom_container = 'class="custom_container" style="width: ' . $get_custom_container . 'px"';
		} else {
			$set_custom_container = 'class="' . $get_container_options . '"';
		}
	*/	
		$ssVariables = ( array (
			'ssAnimate' => $set_animation,
			'ssID' => $set_ID,
			'ssClass' => $set_class_name,
			'ssContainer' => $set_custom_container,
			'ssBackground' => $set_section_bg_img,
		));
		return $ssVariables[$sSettings];
	}
	
//SECTION STYLING 
	public function section_styling(){
		while ( have_rows('section_settings') ) : the_row();
			if( get_sub_field('section_top_padding') ) :
				$section_padding_top = get_sub_field('section_top_padding'); 
			endif; 
			if( get_sub_field('section_top_padding_copy') ) :
				$section_padding_bottom = get_sub_field('section_top_padding_copy'); 
			endif;
			if( get_sub_field('section_background_color') ) :
				$section_bg_color = get_sub_field('section_settings_background_color'); 
			else:
				$section_bg_color = 'transparent';
			endif; 
		endwhile;
			
		$sstyle =  'style="padding-top: ' . $section_padding_top  . '; padding-bottom: ' . $section_padding_bottom . '; background-color:' . $section_bg_color . ';';
		return $sstyle;
	}
}
//REPEATED SECTION SETTINGS
//if( class_exists('SectionSettings') ) {
	
	function div_settings(){
		$x = new SectionSettings();
		$y = 'background_style normalize_padding lazy' . $x->section_settings("ssClass") . $x->section_settings("ssAnimate") . '" ' . $x->section_settings('ssBackground'). ' ' . $x->section_styling();
		return $y;
	}
	
	function container_settings(){
		$x = new SectionSettings();
		$z = $x->section_settings('ssContainer');
		return $z;
	}
	
	function custom_id(){
		$id = new SectionSettings();
		$newID = $id->section_settings('ssID');
		return $newID;
	}
//}

/*== REMOVE P TAG ON IMAGE ACF ==*/
function img_unautop($ptag) {
    $ptag = preg_replace('/<p>\\s*?(<a .*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s', '\1\2\3', $ptag);
    return $ptag;
}
add_filter( 'acf_the_content', 'img_unautop', 30 );

/*== REMOVE P TAG ON IMAGE CONTENT ==*/
function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'filter_ptags_on_images');

add_filter('get_search_form', 'my_search_form');
 
function my_search_form($text) {
     $text = str_replace('value="Search"', 'value=""', $text);
     return $text;
}

//SHORTCODE READ MORE COLLAPSE
function readmore($atts, $content = null){
	$readmore = ' <span class="readmore_content">';
  	$readmore .= $content;
	$readmore .= '</span>';
	$readmore .= ' <span class="readmore_btn readmore_link">Read More</span>';
  	return $readmore;
}
add_shortcode('read-more', 'readmore');


//SHORTCODE CTA BLOG POST
function cta_blog($atts){
	$default = array(
        'title' => '',
		'button_label' => '',
		'url' => ''
    );
	$x = shortcode_atts($default, $atts);
	$contents = '<div class="blog_cta flex_column">';
	$contents .= '<div class="blog_cta_title">';
	$contents .= '<h3>'. $x['title'] .'</h3>';
	$contents .= '</div>';
	$contents .= '<div class="blog_cta_btn">';
	$contents .= '<a class="template_btn" href="'. $x['url'] . '">'. $x['button_label'] .'</a>';
	$contents .= '</div>';
	$contents .= '</div>';
	
	return $contents;
}
add_shortcode('cta_blog', 'cta_blog');


