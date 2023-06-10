<?php

/*
 * Plugin Name:       NSF COA Manager for WordPress
 * Description:       Manage publications and helps prepare NSF's COA form
 * Author:            Bryan Hoffman
 * Author URI:        https://bryanhoffman.xyz/
 */

/*
 * The create_posttypes function creates publications, people, and group
 * members custom post types. I should probably make the group members
 * part a whole different plugin
 */
  
function create_publication_and_people_post_types() {
  
    register_post_type( 'publications',
        array(
            'labels' => array(
                'name' => __( 'Publications' ),
                'singular_name' => __( 'Publication' )
            ),
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 4,
        'can_export'          => true,
        'has_archive'         => false,
        'exclude_from_search' => false,
	'rewrite'             => array( 'slug' => 'portfolio'),
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' 	      => true,
        )
    );
	
	  
    register_post_type( 'people',
        array(
            'labels' => array(
                'name' => __( 'People' ),
                'singular_name' => __( 'Person' )
            ),
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 4,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest'        => true,
        )
    );
}
add_action( 'init', 'create_publication_and_people_post_types' );

/*
 * This plugin requires the plugin Advanced Custom Fields
 * The create_posttypes function needs ACF to create custom post types
 */

// check that ACF is installed
if(in_array('advanced-custom-fields/acf.php', apply_filters('active_plugins', get_option('active_plugins')))) {

function my_acf_add_local_field_groups() {
// People (Authors)
acf_add_local_field_group(array(
	'key' => 'group_62832880b6b98',
	'title' => 'People',
	'fields' => array(
		array(
			'key' => 'field_6283288e88d62',
			'label' => '',
			'name' => 'people',
			'type' => 'checkbox',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
			),
			'allow_custom' => 0,
			'default_value' => array(
			),
			'layout' => 'vertical',
			'toggle' => 0,
			'return_format' => 'value',
			'save_custom' => 0,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'publications',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 1,
));
 
// Affiliations
acf_add_local_field_group(array (
	'key' => 'affiliations',
	'title' => 'Affiliations',
	'fields' => array (
		array (
			'key' => 'affiliations',
			'label' => '',
			'name' => 'affiliations',
			'type' => 'text',
			'prefix' => '',
			'instructions' => 'Multiple affiliations can be added by using comma separation. Use \'\\\' to escape commas not intended to separate distinct strings.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		)
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'people',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'show_in_rest' => 1,
	'hide_on_screen' => '',
));
	
// Person Type (Collaborator Author)
acf_add_local_field_group(array (
	'key' => 'person_relationship',
	'title' => 'Relationship',
	'fields' => array (
		array (
			'key' => 'person_relationship',
			'label' => '',
			'name' => 'person_relationship',
			'type' => 'checkbox',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'A' => 'Author',
				'C' => 'Collaborator'
			),
			'allow_custom' => 0,
			'default_value' => array(
			),
			'layout' => 'vertical',
			'toggle' => 0,
			'return_format' => 'value',
			'save_custom' => 0,
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'people',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'show_in_rest' => 1,
	'hide_on_screen' => '',
));
	

// Journal
acf_add_local_field_group(array (
	'key' => 'journal',
	'title' => 'Journal',
	'fields' => array (
		array (
			'key' => 'journal_field',
			'label' => '',
			'name' => 'journal',
			'type' => 'text',
			'prefix' => '',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		)
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'publications',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'show_in_rest' => 1,
));
	
// Pages
acf_add_local_field_group(array (
	'key' => 'pages',
	'title' => 'Pages',
	'fields' => array (
		array (
			'key' => 'pages',
			'label' => '',
			'name' => 'pages',
			'type' => 'text',
			'prefix' => '',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		)
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'publications',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'show_in_rest' => 1,
));
	
// Volume
acf_add_local_field_group(array (
	'key' => 'volume',
	'title' => 'Volume',
	'fields' => array (
		array (
			'key' => 'volume_field',
			'label' => '',
			'name' => 'volume',
			'type' => 'text',
			'prefix' => '',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		)
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'publications',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'show_in_rest' => 1,
));

// Year
acf_add_local_field_group(array (
	'key' => 'year',
	'title' => 'Year',
	'fields' => array (
		array (
			'key' => 'year_field',
			'label' => '',
			'name' => 'year',
			'type' => 'text',
			'prefix' => '',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		)
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'publications',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'show_in_rest' => 1,
));

// DOI
acf_add_local_field_group(array (
	'key' => 'doi',
	'title' => 'DOI',
	'fields' => array (
		array (
			'key' => 'doi_field',
			'label' => '',
			'name' => 'doi',
			'type' => 'text',
			'prefix' => '',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		)
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'publications',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'show_in_rest' => 1,
));
add_action('acf/init', 'my_acf_add_local_field_groups');

// DOI URL
acf_add_local_field_group(array (
	'key' => 'url',
	'title' => 'URL',
	'fields' => array (
		array (
			'key' => 'url',
			'label' => '',
			'name' => 'url',
			'type' => 'text',
			'prefix' => '',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		)
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'publications',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'show_in_rest' => 1,
));
add_action('acf/init', 'my_acf_add_local_field_groups');


// Override
/*
acf_add_local_field_group(array (
	'key' => 'override',
	'title' => 'Override',
	'fields' => array (
		array (
			'key' => 'override',
			'label' => '',
			'name' => 'override',
			'type' => 'checkbox',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'1' => 'Display custom text?'
			),
			'allow_custom' => 0,
			'default_value' => array(
			),
			'layout' => 'vertical',
			'toggle' => 0,
			'return_format' => 'value',
			'save_custom' => 0,
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'publications',
			),
		),
	),
	'menu_order' => 9,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'show_in_rest' => 1,
));
add_action('acf/init', 'my_acf_add_local_field_groups'); */

// Manual Reference
acf_add_local_field_group(array (
	'key' => 'manual_reference',
	'title' => 'Manual Reference',
	'fields' => array (
		array (
			'key' => 'manual_reference',
			'label' => '',
			'name' => 'manual_reference',
			'type' => 'text',
			'prefix' => '',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		)
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'publications',
			),
		),
	),
	'menu_order' => 10,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'show_in_rest' => 1,
));
add_action('acf/init', 'my_acf_add_local_field_groups');

// Unformatted People
acf_add_local_field_group(array (
	'key' => 'unformatted_people',
	'title' => 'unformatted_people',
	'fields' => array (
		array (
			'key' => 'unformatted_people',
			'label' => '',
			'name' => 'unformatted_people',
			'type' => 'text',
			'prefix' => '',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		)
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'publications',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'show_in_rest' => 1,
));
}
add_action('acf/init', 'my_acf_add_local_field_groups');

} else {
	// display message in admin about needing ACF plugin
	function ACF_required_admin_notice() {
	    echo '<div class="notice notice-warning">
		<p>The plugin Advanced Custom Fields (ACF) is required for NSF-COA-Manager</p>
	    </div>';
	}
	add_action('admin_notices', 'ACF_required_admin_notice' );
}

// adds the people table as a selectable field in publications
function acf_load_people_field_choices( $field ) {
    
    // reset choices
    $field['choices'] = array();
	
	$people = get_posts([
  'post_type' => 'people',
  'post_status' => 'publish',
  'numberposts' => -1
  // 'order'    => 'ASC'
]);

// compares names
    function compareNames($a, $b) {
	return strcmp($a->post_title, $b->post_title);
   }

	//alphabetize people
	 usort($people,"compareNames");
    
    // loop through array and add to field 'choices'
    if( is_array($people) ) {
        
        foreach( $people as $person ) {
            
            $field['choices'][ $person->ID ] = $person->post_title." | ".$person->affiliations;
            
        }
        
    }
    

    // return the field
    return $field;
    
}

add_filter('acf/load_field/name=people', 'acf_load_people_field_choices');

// function that shows a few publications
function publications_shortcode() { 
$message = "";  
$publications = get_posts([
  'post_type' => 'publications',
  'post_status' => 'publish',
  'numberposts' => 5,
  'meta_key' => 'year',
  'orderby' => 'meta_value',
  'order' => 'DESC'
]);

    
    // loop through array and add to field 'choices'
    if( is_array($publications) ) {
        $year_tracker = "";
        foreach( $publications as $publication ) {
				if($publication->year != $year_tracker){
					if($year_tracker!=""){
						$message=$message."</ul>";
					}
					$year_tracker=$publication->year;
					$message=$message."<span>".$publication->year."</span><br/><ul>";
				}
				$message=$message."<br/><li class=\"publication-item\">".$publication->manual_reference."</li><br/>";
        }
        
    }
  
// Output needs to be return
return $message;
}
// register shortcode
add_shortcode('publications', 'publications_shortcode');

// function that shows all publications
function full_publications_shortcode() { 
$message = "";  
$publications = get_posts([
  'post_type' => 'publications',
  'post_status' => 'publish',
  'numberposts' => -1,
  'meta_key' => 'year',
  'orderby' => 'meta_value',
  'order' => 'DESC'
]);

    
    // loop through array and add to field 'choices'
    if( is_array($publications) ) {
        $year_tracker = "";
        foreach( $publications as $publication ) {
				if($publication->year != $year_tracker){
					if($year_tracker!=""){
						$message=$message."</ul>";
					}
					$year_tracker=$publication->year;
					$message=$message."<span>".$publication->year."</span><br/><ul>";
				}
				$message=$message."<br/><li class=\"publication-item\">".$publication->manual_reference."</li><br/>";
        }
        
    }
  
// Output needs to be return
return $message;
}
// register shortcode
add_shortcode('full_publications', 'full_publications_shortcode');


// Admin Menu Page Code
add_action( 'admin_menu', 'my_admin_menu' );

function my_admin_menu() {
	add_menu_page( 'CSV Manager', 'CSV Manager', 'manage_options', 'myplugin/myplugin-admin-page.php', 'myplguin_admin_page', 'dashicons-admin-generic', 7  );
	//add_submenu_page( 'myplugin/myplugin-admin-page.php', 'Publications Data', 'Publications Data', 'manage_options', 'myplugin/myplugin-admin-sub-page.php', 'myplguin_admin_page_publications' ); 
	//add_submenu_page( 'myplugin/myplugin-admin-page.php', 'People Data', 'People Data', 'manage_options', 'myplugin/myplugin-admin-sub-page.php', 'myplguin_admin_page_people' ); 
}
function myplguin_admin_page(){
	?>
	<div class="wrap">
		<h2>CSV Manager</h2>
	</div>
	<h2>
		Publications
	</h2>
<form enctype='multipart/form-data' method="post" action="">
<p>Choose your CSV file</p><br />
<input type="file" name="publications_csv"/>
<input type="submit" name="submit" value="submit"/>
</form>
	<p>The publications csv upload will create new publications and people with an empty affiliation. If the publication already exists it will not be duplicated.</p>
<form method="post" id="download_form" action="">
    <input type="submit" name="download_publications_csv" class="button-primary" value="Download Publications CSV" />
</form>
	<h2>
		People
	</h2>
<form enctype='multipart/form-data' method="post" action="">
<p>Choose your CSV file</p><br />
<input type="file" name="people_csv"/>
<input type="submit" name="submit" value="submit"/>
</form>
	<p>The people csv upload will create new people and update affiliations that have changed.</p>
<form method="post" id="download_form" action="">
    <input type="submit" name="download_people_csv" class="button-primary" value="Download People CSV" />
</form>
	<h2>
		COA CSV
	</h2>
	<p>This will generate a CSV of all authors and collaborators on publications from the year specified until the present.</p>
<form method="post" id="download_form" action="">
	<input type="number" name="number" min="1900" max="2099" step="1" value="<?php echo date('Y')-4; ?>" />
    <input type="submit" name="download_coa_csv" class="button-primary" value="Download CSV" />
</form>



<?php

    //Upload CSV File
    if (isset($_POST['submit'])) {
		// if publications csv 
		if ($_FILES['publications_csv']){
		$tmpName = $_FILES['publications_csv']['tmp_name'];
		$csvAsArray = array_map('str_getcsv', file($tmpName));
		foreach($csvAsArray as $publication) {
			$query = new WP_Query(array('post_type'=>'publications', 'title'=>$publication[2]));
			if($query->have_posts()) { 
					// echo $publication[2]." exists!<br/>";
					$names =  explode(";", $publication[1]);
					foreach($names as $person_name) {
						$person_name=ltrim($person_name,' ');
						$author_query =  new WP_Query(array('post_type'=>'people', 'title'=>$person_name));
						if($author_query->have_posts()) { 
							// person already exists
						} else {
							// person doesn't exists so create them
							$my_post = array(
							  'post_title'    => $person_name,
							  'post_type' => "people",
							  'post_status'   => 'publish',
							);
 							
							// Insert the post into the database
							wp_insert_post( $my_post );

						}
						
						
						
					}
			} else {
				// process author names and get ids
            	$authors = explode(";", $publication[1]);
            	$author_text = "";
				$author_ids = array();
				
            	foreach($authors as $author) {
					$author = ltrim($author, ' ');
					$author_query =  new WP_Query(array('post_type'=>'people', 'title'=>$author));
						if($author_query->have_posts()) { 
							// person already exists
							$personObj = get_page_by_title($author, OBJECT, 'people' );
							array_push($author_ids, $personObj->ID);
						} else {
							// person doesn't exists so create them
							$my_post = array(
							  'post_title'    => $author,
							  'post_type' => "people",
							  'post_status'   => 'publish',
							);
 							
							// Insert the post into the database
							array_push($author_ids, wp_insert_post( $my_post ));

						}
                	if($author_text!="") { $author_text=$author_text.","; }
                	$names = explode(",", $author);
                	$author_text=$author_text.$names[1]." ".str_replace(' ', '', $names[0]);
					//strip first space
					$author_text = ltrim($author_text, ' ');
					
            	}
				
				// create publication and any new authors
				$my_post = array(
				  'post_title'    => $publication[2],
				  'post_status'   => 'publish',
				  'post_type' => "publications",
				  'meta_input' => array(
				  	'journal' => $publication[3],
					  'year' => $publication[0],
					  'volume' => $publication[7],
					  'doi' => $publication[4],
					  'url' => $publication[5],
					  'pages' => $publication[6],
					  'manual_reference' => $author_text .". \"". $publication[2]."\", ".$publication[3]." ".$publication[7]." ".$publication[6]." (".$publication[0]."). <a target=\"_blank\" href=\"".$publication[5]."\">DOI: ".$publication[4]."</a>",
					  'people' => $author_ids,
					  'unformatted_people' => $publication[1],
				  )
				);
 							
				// Insert the post into the database
				// update_field('field_6283288e88d62', $author_ids, wp_insert_post( $my_post ));
				wp_insert_post( $my_post );
			}
			//echo $publication[0]."<br/>";
		}
		// if people csv	
		} elseif ($_FILES["people_csv"]) {
			$tmpName = $_FILES['people_csv']['tmp_name'];
		$csvAsArray = array_map('str_getcsv', file($tmpName));
		foreach($csvAsArray as $person) {
			$query = new WP_Query(array('post_type'=>'people', 'title'=>$person[1]));
			if($query->have_posts()) {
				// update person
				$personObj = get_page_by_title($person[1], OBJECT, 'people' );
					$my_post = array(
					'ID' => $personObj->ID,
					'post_title'    => $person[1],
					'post_type' => "people",
					'post_status'   => 'publish',
					'meta_input' => array(
						'affiliations' => $person[2],
						'person_relationship' => $person[0]
					)
				);
				wp_update_post($my_post);
			} else {
				// person doesn't exists so create them
				$my_post = array(
					'post_title'    => $person[1],
					'post_type' => "people",
					'post_status'   => 'publish',
					'meta_input' => array(
						'affiliations' => $person[2],
						'person_relationship' => $person[0]
					)
				);
 							
				// Insert the post into the database
				wp_insert_post( $my_post );
			}
		}
		}
		
		
	}
}

add_action("admin_init", "download_csv");

function download_csv() {

	if (isset($_POST['download_people_csv'])) {
	    header('Content-Type: application/csv');
    	header('Content-Disposition: attachment; filename=people.csv');
    	header('Pragma: no-cache');

    	// open the "output" stream
    	// see http://www.php.net/manual/en/wrappers.php.php#refsect2-wrappers.php-unknown-unknown-unknown-descriptioq
    	ob_clean();
    	$f = fopen('php://output', 'w');
		$people = get_posts(['post_type' => 'people', 'numberposts' => -1]);
		foreach($people as $person) { 
        	fputcsv($f, array($person->person_relationship ?: " ", $person->post_title, $person->affiliations), ",");
		}
		fclose($f);
		ob_flush();
		exit;
	}
	
		if (isset($_POST['download_publications_csv'])) {
	    header('Content-Type: application/csv');
    	header('Content-Disposition: attachment; filename=publications.csv');
    	header('Pragma: no-cache');

    	// open the "output" stream
    	// see http://www.php.net/manual/en/wrappers.php.php#refsect2-wrappers.php-unknown-unknown-unknown-descriptioq
    	ob_clean();
    	$f = fopen('php://output', 'w');
		$publications = get_posts(['post_type' => 'publications', 'numberposts' => -1]);
		foreach($publications as $publication) { 
			$array = array(
						$publication->year,
						$publication->unformatted_people,
						$publication->post_title,
						$publication->journal,
						$publication->doi,
						$publication->url,
						$publication->pages,
						$publication->volume
							);
        	fputcsv($f, $array, ",");
		}
		fclose($f);
		ob_flush();
		exit;
	}
	
	if (isset($_POST['download_coa_csv'])) {
	    header('Content-Type: application/csv');
    	header('Content-Disposition: attachment; filename=coa.csv');
    	header('Pragma: no-cache');

    	// open the "output" stream
    	// see http://www.php.net/manual/en/wrappers.php.php#refsect2-wrappers.php-unknown-unknown-unknown-descriptioq
		ob_clean();
    	$f = fopen('php://output', 'w');
		$array_of_people = array();
		$most_recent_year_active = array();
		for($i = $_POST["number"]; $i <= date('Y'); $i++) {
			$publications = get_posts(['post_type' => 'publications',
									   'numberposts'       => -1,
								   'meta_query'		=> array(
															array(
																'key' => 'year',
																'value' => $i,
																'compare' => '='
																)
										)]);

		
			foreach($publications as $publication) { 
				foreach($publication->people as $personID){
					$personName = get_the_title($personID);
					if(!in_array($personName, $array_of_people)){
						array_push($array_of_people, $personName);
					}
					$most_recent_year_active[$personName] = $i;
				}	
			}
		}
		sort($array_of_people);
		foreach($array_of_people as $personName) {
			$personID = get_page_by_title($personName, OBJECT, 'people')->ID;
        	fputcsv($f, array(get_field("person_relationship", $personID)[0] ?: " ", get_the_title($personID), get_field("affiliations", $personID)?: " ", $most_recent_year_active[$personName]), ",");
		}
		fclose($f);
		ob_flush();
		exit;
	}
}

