# Utiliser le hook save_post pour créer un sommaire d'article wordpress
> Inspiré par le sommaire de [la formation captain_wp](https://capitainewp.io/formations/developper-theme-wordpress/hook-save-post-sommaire)

```php
function table_of_content( $post_id, $post, $update )  {

    //1. Test 
	if( ! $update ) { return; } //Avoid wordpress use function at post creation, only need it when update
	if( wp_is_post_revision( $post_id ) ) { return; } //avoid wordpress use function everytime post has a revision
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; } //Avoid worpress use function every autosave
	if( $post->post_type != 'post' ) { return; } //Test if publication is type: post


	//2. Create anchors for titles in post content
    $content = preg_replace_callback( 
        "#<h([2-3])(id=\".*?\")(.*?)>(.*?)<\/h([2-3])>#i", //regex
        function( $matches ) { //replacing function
            $level = $matches[1];
            $id_attribute = $matches[2];
            $attributes = $matches[3];
            $slug = sanitize_title( $matches[4] );
            $title = $matches[4];

            return "<h$level id=\"$slug\" $attributes>$title</h$level>";
        }, 
        $post->post_content //Where to search
    );

    //Remove hook temporarily to avoid infinite loop
    remove_action( 'save_post', 'table_of_content', 10, 3 );

    //update html
    wp_update_post( array( 'ID' => $post_id, 'post_content' => $content ) );

    //restart hook
    add_action( 'save_post', 'table_of_content', 10, 3 );


	//3. Generate table of contents

    //Init list element
    $table_of_content = "<ul class='table-of-contents list-unstyled'>";

    //fetch all h2 or h3 titles
    preg_match_all(
        "#<h([2-3])(.*?)>(.*?)<\/h([2-3])>#i", //regex
        $post->post_content, //where to search
        $matches, //results array
        PREG_SET_ORDER
    );

    //Add entry to table of content
    foreach( $matches as $match ) {
		if( $match[1] == '2'){
			$slug = sanitize_title( $match[3] );
			$title = $match[3];
			$table_of_content .= "<hr><li><a href='#$slug' class='fw-bold'>$title</a></li>";
		}   
		else {
			$slug = sanitize_title( $match[3] );
			$title = $match[3];
			$table_of_content .= "<li><a href='#$slug' class='fw-normal'>$title</a></li>";
		}
    }
  
    //close list element
    $table_of_content .= "</ul>";

	//register into the post meta
	update_post_meta( $post_id, 'table_of_content', $table_of_content );
}
add_action( 'save_post', 'table_of_content', 10, 3 );
```