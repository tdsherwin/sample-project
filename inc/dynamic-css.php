<?php

header("Content-type: text/css; charset: UTF-8");

while( have_rows( 'page_options', 'option' ) ) : the_row();
	//H1 Settings
	$h1 = get_sub_field('h1_font_size', 'option'); 
	$lineheightH1 = get_sub_field('h1_line_height', 'option');
	$colorH1 = get_sub_field('h1_font_color', 'option');
	$fontweightH1 = get_sub_field('h1_font_weight', 'option');
	$fontfamilyH1 = get_sub_field('h1_font_family', 'option');
	//H2 Settings
	$h2 = get_sub_field('h2_font_size', 'option');
	$lineheightH2 = get_sub_field('h2_line_height', 'option');
	$colorH2 = get_sub_field('h2_font_color', 'option');
	$fontweightH2 = get_sub_field('h2_font_weight', 'option');
	$fontfamilyH2 = get_sub_field('h2_font_family', 'option');
	//Paragraph
	$p = get_sub_field('paragaph_font_size', 'option');
	$lineheightP = get_sub_field('paragraph_line_height', 'option');
	$colorP = get_sub_field('paragraph_font_color', 'option');
	$fontweightP = get_sub_field('paragraph_font_weight', 'option');
	$fontfamilyP = get_sub_field('paragraph_font_family', 'option');
	//A HREF
	$a = get_sub_field('a_font_size', 'option');
	$lineheightA = get_sub_field('a_line_height', 'option');
	$colorA = get_sub_field('a_font_color', 'option');
	$fontweightA = get_sub_field('a_font_weight', 'option');
	$fontfamilyA = get_sub_field('a_font_family', 'option');
	$hoverColorA = get_sub_field('a_hover_color', 'option');

endwhile;
?>

<style>
h1, h2, h3, h4, p {margin: 0px 0px 20px;}
h1 {font-family: <?= $fontfamilyH1; ?>; font-size: <?= $h1; ?>; line-height: <?= $lineheightH1; ?>; font-weight: <?= $fontweightH1; ?>; color: <?= $colorH1; ?>;}
h2, .header_seo h2 {font-family: <?= $fontfamilyH2; ?>; font-size: <?= $h2; ?>; line-height: <?= $lineheightH2; ?>; font-weight: <?= $fontweightH2; ?>; color: <?= $colorH2; ?>;}
p {font-family: <?= $fontfamilyP; ?>; font-size: <?= $p; ?>; line-height: <?= $lineheightP; ?>; font-weight: <?= $fontweightP; ?>; color: <?= $colorP; ?>;}
p:last-child {margin-bottom: 0px;}
a {font-family: <?= $fontfamilyA; ?>; font-size: <?= $a; ?>; line-height: <?= $lineheightA; ?>; font-weight: <?= $fontweightA; ?>; color: <?= $colorA; ?>; text-decoration: none;}
a:visited {text-decoration: none; color: <?= $colorA; ?>;}
a:hover {text-decoration: none; color: <?= $hoverColorA; ?>}
</style>