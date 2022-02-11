# Populate acf select fields

```php
//for post types
function populate_posts_acf( $field ) {
    
    // reset choices
    $field['choices'] = array();

	//Query all posts
	$args = array(
        'post_type' => 'post',
        'posts_per_page' => -1
    );
	$query = new WP_Query($args);
	if ($query->have_posts() ) : 
		while ( $query->have_posts() ) : $query->the_post();
			$value = get_the_ID();
			$label = get_the_title();
			$field['choices'][ $value ] = $label;
		endwhile;
		wp_reset_postdata();
	endif;

	return $field;

}

add_filter('acf/load_field/name=post_to_populate', 'populate_posts_acf');

//For taxonomies
function populate_taxonomies_acf( $field ) {
    
    // reset choices
    $field['choices'] = array();

	$custom_taxonomies = get_terms([
		'taxonomy' => 'custom_taxonomy',
		'hide_empty' => false,
	]);


	foreach($custom_taxonomies as $custom_taxonomy):

		$value = $custom_taxonomy->term_id;
        $label = $custom_taxonomy->name;

		$field['choices'][ $value ] = $label;

	endforeach; 

	return $field;

}

add_filter('acf/load_field/name=custom_tax', 'populate_taxonomies_acf');