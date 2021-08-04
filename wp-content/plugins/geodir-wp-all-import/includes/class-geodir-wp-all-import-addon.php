<?php

global $geodir_wpai_addon, $wpdb, $custom_type;

//Used to retrieve the import options
$import_id      = isset( $_GET['id'] ) ? $_GET['id'] : 'new';

//This is where all imports are stored
$imports_table  = $wpdb->prefix . 'pmxi_imports';

//Fetch the import options (usually serialized)
$import_options = $wpdb->get_var( $wpdb->prepare("SELECT options FROM $imports_table WHERE id = %d", $import_id) );

if ( ! empty($import_options) ) {

    //Convert to array
    $import_options_arr = maybe_unserialize( $import_options );

    //This is the post type being imported
    $custom_type = $import_options_arr['custom_type'];

} else {

    //Not yet saved to the imports database
    $import_options = get_option( "_wpallimport_session_{$import_id}_" );

    if ( ! empty($import_options) ) {

        $import_options     = $import_options;
        $import_options_arr = maybe_unserialize( $import_options );
        $custom_type        = empty( $import_options_arr['custom_type'] ) ? 'gd_place' : $import_options_arr['custom_type'];

    } else {

        //Probably a new import
        $import_options_arr = array();
        $custom_type        = 'gd_place';
    }
    
}

//@link https://github.com/soflyy/wp-all-import-rapid-addon
$geodir_wpai_addon = new RapidAddon( __('GeoDirectory Add-On', 'geodir-wpai'), 'geodir_wpai' );

$geodir_wpai_addon->disable_default_images();

//Prepare the import vars
$post_type  = !empty($custom_type) ? $custom_type : 'gd_place';
$table      = geodir_db_cpt_table( $post_type );
$fields     = geodir_wpai_get_custom_fields( $post_type );
$columns    = array();

//If the table exists, fetch its columns
if($wpdb->get_var("SHOW TABLES LIKE '$table'") == $table){
    $columns = $wpdb->get_col( "show columns from $table" );
}

//Special fields
$other_fields = array(
    'featured'          => __( 'Featured', 'geodir-wpai' ),
    'post_status'       => __( 'Post Status', 'geodir-wpai' ),
    'featured_image'    => __( 'Featured Image', 'geodir-wpai' ),
    'submit_ip'         => __( 'Submit IP', 'geodir-wpai' ),
    'overall_rating'    => __( 'Overall Rating', 'geodir-wpai' ),
    'rating_count'      => __( 'Rating Count', 'geodir-wpai' ),
    'ratings'           => __( 'Ratings', 'geodir-wpai' ),
    'marker_json'       => __( 'Marker JSON', 'geodir-wpai' ),
    'location_id'       => __( 'Location ID', 'geodir-wpai' ),
    'post_category'     => __( 'Categories', 'geodir-wpai' ),
    'default_category'  => __( 'Default Category', 'geodir-wpai' ),
    'post_tags'         => __( 'Tags', 'geodir-wpai' ),
);

if( GeoDir_Post_types::supports( $post_type, 'events' )  ){
    $other_fields['rsvp_count']     = __('RSVP Count', 'geodir-wpai');
}

$other_fields = apply_filters('geodir_wpai_import_other_fields', $other_fields);

foreach ( $other_fields as $slug => $title ){
    $field_type = apply_filters('geodir_wpai_import_other_field_type', 'text', $slug, $title, $other_fields);
    if( in_array( $slug, $columns ) ) {
        $geodir_wpai_addon->add_field( $slug, $title, $field_type );
    }
}

$geodir_wpai_addon->add_field( 'post_images', __('Images (post_images)', 'geodir-wpai'), 'text' );

//Display the other fields
if( is_array( $fields ) ) {

    foreach ( $fields as $field ) {

        //Maybe abort early
        if ($field->htmlvar_name == "post_title" || $field->htmlvar_name == "post_content" || $field->htmlvar_name == "post_tags" || $field->htmlvar_name == "post_category" || $field->htmlvar_name == "post_images") {
            continue;
        }

        //Address fields
        if ( $field->field_type == "address" ) {

            $address_fields = array(
                'zip'           =>  __('Zip (zip)', 'geodir-wpai'),
                'street'        =>  __('Street (street)', 'geodir-wpai'),
                'street2'       =>  __('Street 2 (street2)', 'geodir-wpai'),
                'city'          =>  __('City (city)', 'geodir-wpai'),
                'region'        =>  __('Region (region)', 'geodir-wpai'),
                'country'       =>  __('Country (country)', 'geodir-wpai'),
                'neighbourhood' =>  __('Neighbourhood (neighbourhood)', 'geodir-wpai'),
                'latitude'      =>  __('Latitude (latitude)', 'geodir-wpai'),
                'longitude'     =>  __('Longitude (longitude)', 'geodir-wpai'),
                'mapview'       =>  __('Map View (mapview)', 'geodir-wpai'),
                'mapzoom'       =>  __('Map Zoom (mapzoom)', 'geodir-wpai'),
            );

            foreach( $address_fields as $slug => $title ) {

                if( in_array( $slug, $columns ) ) {
                    $geodir_wpai_addon->add_field( $slug, $title, 'text' );
                }

            }

            if( in_array( 'mapview', $columns ) ) {
                $geodir_wpai_addon->add_field('mapview',  __('Map View (mapview)', 'geodir-wpai'), 'radio', array('ROADMAP' => 'ROADMAP', 'SATELLITE' => 'SATELLITE', 'HYBRID' => 'HYBRID', 'TERRAIN' => 'TERRAIN'));
            }

            continue;
        }

        //Event dates
        if(  GeoDir_Post_types::supports( $post_type, 'events' ) && $field->htmlvar_name == "event_dates" ){

            $geodir_wpai_addon->add_field('start_date',        __('Start Date', 'geodir-wpai'), 'text');
            $geodir_wpai_addon->add_field('end_date',          __('End Date', 'geodir-wpai'), 'text');
            $geodir_wpai_addon->add_field('start_time',        __('Start Time', 'geodir-wpai'), 'text');
            $geodir_wpai_addon->add_field('end_time',          __('End Time', 'geodir-wpai'), 'text');
            $geodir_wpai_addon->add_field('is_all_day_event',  __('Is all day event?', 'geodir-wpai'), 'text');

            continue;
        }

        //Other fields
        if( in_array( $field->htmlvar_name, $columns ) ) {
            $title = isset( $field->frontend_title ) ? $field->frontend_title : $field->admin_title;
            $geodir_wpai_addon->add_field( $field->htmlvar_name, "$title ($field->htmlvar_name)", 'text' );
        }

    }
}

$geodir_wpai_addon->set_import_function( 'geodir_wpai_import_function' );

/**
 * Imports a single post
 * 
 * @param $post_id the id of the post being imported
 * @param $data the data to import
 * @param $import_options 
 */
function geodir_wpai_import_function( $post_id, $data, $import_options, $_post, $logger ) {
    global $geodir_wpai_addon, $wpdb, $custom_type, $geodirectory;

    $post              = get_post( $post_id );
    $post_type         = get_post_type( $post_id );
    $post_type         = ! empty( $post_type ) ? $post_type : 'gd_place';
    $fields            = geodir_wpai_get_custom_fields( $post_type );
    $table             = geodir_db_cpt_table( $post_type );
    $custom_field_data = array();
    $columns           = array();
    $event_cf          = false;
    $address_cf        = false;
    $is_new            = empty( $_post['ID'] ) ? true : false;

    //If the table exists, fetch colums
    if ( $wpdb->get_var( "SHOW TABLES LIKE '$table'" ) == $table ) {
        $columns = $wpdb->get_col( "show columns from $table" );
    }

    /**
     * Fires before running a new import
     */
    do_action( 'geodir_wpai_before_import_fields', $post_id, $data, $import_options );

    call_user_func( $logger, __( 'DO ACTION `geodir_wpai_before_import_fields`...', 'geodir-wpai' ) );

    $file_fields = array();

    // Set the custom fields info
    foreach ( $fields as $cf ) {
        if ( in_array( $cf->htmlvar_name, array(
            'post_title',
            'post_content',
            'post_tags',
            'post_category',
            'post_images'
        ) ) ) {
            continue;
        }

        if ( $cf->htmlvar_name == 'event_dates' ) {
            $event_cf = $cf;
        }

        if ( $cf->field_type == "address" ) {
            $address_cf = $cf;
        } elseif( $cf->field_type == "file" ) {
            $file_fields[] = $cf->htmlvar_name;
        }

        // Abort early if the field does not exist in our CPT table...
        if ( ! in_array( $cf->htmlvar_name, $columns ) || ! isset( $data[ $cf->htmlvar_name ] ) ) {
            continue; //Note: event dates and addresses will fail this check
        }

        // Don't update if disabled.
        if ( 'post_category' == $cf->htmlvar_name && ! ( $is_new || $geodir_wpai_addon->can_update_taxonomy( $post_type . 'category', $import_options ) ) ) {
            continue;
        } else if ( 'post_tags' == $cf->htmlvar_name && ! ( $is_new || $geodir_wpai_addon->can_update_taxonomy( $post_type . '_tags', $import_options ) ) ) {
            continue;
        } else if ( 'post_images' == $cf->htmlvar_name && ! ( $is_new || $geodir_wpai_addon->can_update_image( $import_options ) ) ) {
            continue;
        } else if ( ! ( $is_new || $geodir_wpai_addon->can_update_meta( $cf->htmlvar_name, $import_options ) ) ) {
            continue;
        }

        // The value of this custom field
        $field_value = $data[ $cf->htmlvar_name ];

        // check for empty numbers and set to NULL so a default 0 or 0.00 is not set
        if ( isset( $cf->data_type ) && ( $cf->data_type == 'DECIMAL' || $cf->data_type == 'INT' ) && $field_value === '' ) {
            $field_value = null;
        }

        // Prepare checkboxes
        if ( 'checkbox' == $cf->field_type ) {
            $field_value = empty( $field_value ) ? 0 : 1;
        }

        $field_value = apply_filters( "geodir_custom_field_value_{$cf->field_type}", $field_value, $data, $cf, $post_id, $post, false );

        if ( is_array( $field_value ) ) {
            $field_value = implode( ',', $field_value );
        }

        if ( ! empty( $field_value ) ) {
            $field_value = stripslashes_deep( $field_value ); // stripslahses
        }

        $custom_field_data[ $cf->htmlvar_name ] = $field_value;
    }

    //Event dates
    if ( ( $is_new || $geodir_wpai_addon->can_update_meta( 'event_dates', $import_options ) ) && GeoDir_Post_types::supports( $post_type, 'events' ) && $event_cf && in_array( 'event_dates', $columns ) && class_exists( 'GeoDir_Event_Fields' ) ) {

        $event_keys   = explode( ' ', 'start_date end_date start_time end_time is_all_day_event' );
        $event_fields = array();

        foreach ( $event_keys as $key ) {
            if ( isset( $data[ $key ] ) ) {
                $event_fields[ $key ] = $data[ $key ];
            }
        }

        $event_fields['all_day'] = empty( $event_fields['is_all_day_event'] ) ? 0 : 1;

        $event_fields['recurring'] = ! empty( $custom_field_data['recurring'] );

        $custom_field_data['event_dates'] = GeoDir_Event_Fields::sanitize_event_data( $event_fields, $event_fields, $event_cf, $post_id, $post, false );

        //save event schedules
        GeoDir_Event_Schedules::save_schedules( $custom_field_data['event_dates'], $post_id );

        call_user_func( $logger, __( 'Saved event dates', 'geodir-wpai' ) );
    }

    //Addresses
    if ( ! empty( $address_cf ) ) {
        $address_fields   = array(
            'zip',
            'street',
            'street2',
            'city',
            'region',
            'country',
            'neighbourhood',
            'latitude',
            'longitude',
            'mapview',
            'mapzoom',
            'mapview'
        );
        $default_location = (array) $geodirectory->location->get_default_location();

        $_address_fields = array();
        foreach ( $address_fields as $address_field ) {
            if ( in_array( $address_field, $columns ) && ( $is_new || $geodir_wpai_addon->can_update_meta( $address_field, $import_options ) ) ) {
                if ( ! empty( $data[ $address_field ] ) ) {
                    $custom_field_data[ $address_field ] = $data[ $address_field ];
                } elseif ( ! empty( $default_location[ $address_field ] ) ) {
                    $custom_field_data[ $address_field ] = $default_location[ $address_field ];
                } else {
                    $custom_field_data[ $address_field ] = '';
                }
                $_address_fields[] = $address_field;
            }
        }

        if ( ! empty( $_address_fields ) ) {
            call_user_func( $logger, wp_sprintf( __( '- Importing address fields: `%s` ...', 'geodir-wpai' ), implode( ', ', $_address_fields ) ) );
        }

        //Special fields
        $fields = array(
            'featured',
            'post_status',
            'submit_ip',
            'overall_rating',
            'rating_count',
            'ratings',
            'post_dummy',
            'marker_json',
            'location_id',
            'default_category',
            'post_category',
            'post_tags'
        );

        if ( GeoDir_Post_types::supports( $post_type, 'events' ) ) {
            $fields[] = 'rsvp_count';
        }

        $fields = apply_filters( 'geodir_wpai_import_other_fields', $fields, $post_id, $data, $import_options );

        foreach ( $fields as $field ) {
            if ( in_array( $field, $columns ) && ! empty( $data[ $field ] ) ) {
                if ( ( 'post_category' == $field || 'default_category' == $field ) && ! ( $is_new || $geodir_wpai_addon->can_update_taxonomy( $post_type . 'category', $import_options ) ) ) {
                    continue;
                } else if ( 'post_tags' == $field && ! ( $is_new || $geodir_wpai_addon->can_update_taxonomy( $post_type . '_tags', $import_options ) ) ) {
                    continue;
                } else if ( ! ( $is_new || $geodir_wpai_addon->can_update_meta( $field, $import_options ) ) ) {
                    continue;
                }

                // Import categories
                if ( 'post_category' == $field || 'default_category' == $field ) {
                    $custom_field_data[ $field ] = geodir_wpai_get_categories( $data[ $field ], $post_type );
                    continue;
                }

                $custom_field_data[ $field ] = $data[ $field ];
            }
        }

        if ( $is_new || $geodir_wpai_addon->can_update_meta( 'post_title', $import_options ) ) {
            $custom_field_data['post_title'] = $post->post_title;
        }

        // Business hours
        if ( isset( $custom_field_data['business_hours'] ) && class_exists( 'GeoDir_Adv_Search_Business_Hours' ) && ( $is_new || $geodir_wpai_addon->can_update_meta( 'business_hours', $import_options ) ) && GeoDir_Post_types::supports( $post_type, 'business_hours' ) ) {
            if ( ! empty( $custom_field_data['country'] ) ) {
                $country = $custom_field_data['country'];
            } elseif ( GeoDir_Post_types::supports( $post_type, 'location' ) ) {
                $country = geodir_get_post_meta( $post_id, 'country', true );
            } else {
                $country = geodir_get_option( 'default_location_country' );
            }

            GeoDir_Adv_Search_Business_Hours::save_post_business_hours( $post_id, $custom_field_data['business_hours'], $country );

            call_user_func( $logger, wp_sprintf( __( '- Importing `%s` ...', 'geodir-wpai' ), 'business_hours' ) );
        }

        // Featured images
        if ( isset( $data['featured_image'] ) && ! empty( $data['featured_image'] ) && ( $is_new || $geodir_wpai_addon->can_update_image( $import_options ) )  ) {
            $featured_image = GeoDir_Post_Data::save_files( $post_id, $data['featured_image'], 'post_images', false, false );

            if ( ! empty( $featured_image ) && ! wp_is_post_revision( absint( $post_id ) ) ) {
                $custom_field_data['featured_image'] = $featured_image;
            }
        }

        // Post images
        if ( isset( $data['post_images'] ) && ! empty( $data['post_images'] ) && ( $is_new || $geodir_wpai_addon->can_update_image( $import_options ) ) ) {
            $save_post_images = GeoDir_Post_Data::save_files( $post_id, $data['post_images'], 'post_images', false, false );

            if ( ! empty( $save_post_images ) && ! wp_is_post_revision( absint( $post_id ) ) ) {
                $custom_field_data['featured_image'] = $save_post_images;
            }
        }

        // File fields
        if ( ! empty( $file_fields ) ) {
            foreach ( $file_fields as $file_field ) {
                if ( isset( $data[ $file_field ] ) && ! empty( $data[ $file_field ] ) ) {
                    if ( 'post_images' == $file_field && ! ( $is_new || $geodir_wpai_addon->can_update_image( $import_options ) ) ) {
                        continue;
                    } else if ( ! ( $is_new || $geodir_wpai_addon->can_update_meta( $file_field, $import_options ) ) ) {
                        continue;
                    }

                    GeoDir_Post_Data::save_files( $post_id, $data[ $file_field ], $file_field, false, false );
                    $custom_field_data[ $file_field ] = GeoDir_Media::get_field_edit_string( $post_id, $file_field );
                }
            }
        }

        $custom_field_data = apply_filters( 'geodir_wpai_custom_field_data', $custom_field_data, $post_id, $data );

        if ( ! empty( $custom_field_data ) ) {
            $wpdb->update(
                $table,
                $custom_field_data,
                array( 'post_id' => $post_id )
            );

            // Maybe import the new location
            if ( $is_new || ( $geodir_wpai_addon->can_update_meta( 'city', $import_options ) && $geodir_wpai_addon->can_update_meta( 'region', $import_options ) && $geodir_wpai_addon->can_update_meta( 'country', $import_options ) ) ) {
                geodir_wpai_maybe_import_location( $custom_field_data, $post_type, $post_id );
            }
        }

        do_action( 'geodir_wpai_after_import_fields', $post_id, $data, $import_options );
    }
}

//Only run the addon on our post types
$geodir_wpai_addon->run(
    array(
        "post_types" => apply_filters('geodir_wpai_post_types', geodir_get_posttypes() ),
    )
);

/**
 * Retrieves a CPTs custom fields
 */
function geodir_wpai_get_custom_fields( $post_type = 'gd_place' ) {

    $fields = GeoDir_Settings_Cpt_Cf::get_cpt_custom_fields( $post_type );
    return apply_filters('geodir_wpai_custom_fields', $fields, $post_type);

}

/**
 * Saves a new location to the database in case the location manager plugin is installed
 */
function geodir_wpai_maybe_import_location(  $custom_field_data, $post_type, $post_id ) {

    //Abort early if location manager is not installed...
    if(! class_exists('GeoDir_Location_Locations') ) {
        return;
    }

    //... or the post type does not support locations...
    if(! GeoDir_Post_types::supports( $post_type, 'location' ) ) {
        return;
    }

    //... or there is already a location set
    if(! empty( $custom_field_data['location_id'] ) ) {
        return;
    }

    //... or no location data is available
    if( empty( $custom_field_data['city'] ) ) {
        return;
    }

    //Does the location exist?
    $loc    = new GeoDir_Location_Locations();
    $exists = $loc->get_location_by_names( $custom_field_data['city'], $custom_field_data['region'], $custom_field_data['country'] );
    if(! empty( $exists ) ) {
        geodir_wpai_set_location_id(  $post_id, $exists->location_id, $post_type );
        return;
    }

    //Prepare location data
    $location = array(
        'country'   => $custom_field_data['country'],
        'region'    => $custom_field_data['region'],
        'city'      => $custom_field_data['city'],
        'latitude'  => empty( $custom_field_data['latitude'] )  ? '' : $custom_field_data['latitude'],
        'longitude' => empty( $custom_field_data['longitude'] ) ? '' : $custom_field_data['longitude'],
    );

    //Create the new location
    $location_id = geodir_location_insert_city( $location );

    // Remove it from the cache
	wp_cache_delete("geodir_location_get_location_by_names_".sanitize_title_with_dashes($custom_field_data['city'].$custom_field_data['region'].$custom_field_data['country']) );

    //and update the place's location id
    if( is_int( $location_id ) ) {
        geodir_wpai_set_location_id(  $post_id, $location_id, $post_type );
    }

}

/**
 * Updates a locations location id
 */
function geodir_wpai_set_location_id(  $post_id, $location_id, $post_type ) {
    global $wpdb;

    $table = geodir_db_cpt_table( $post_type );

    //Ensure the location id column exists
    if( $wpdb->get_var("SHOW TABLES LIKE '$table'") == $table ){
        $columns = $wpdb->get_col( "show columns from $table" );

        if( in_array( 'location_id', $columns ) ) {
            $sql   = $wpdb->prepare( "UPDATE $table SET location_id = %d WHERE post_id = %d", array( $location_id, $post_id) );
            $wpdb->query( $sql );
        }
    }

}

/**
 * Fetch categories
 */
function geodir_wpai_get_categories( $categories, $post_type ) {

    $modified   = array();
    $categories = explode( ',', $categories );

    foreach( $categories as $category ) {

        //If this is an id import it as is
        if( is_numeric( $category ) ) {
            $modified[] = $category;
            continue;
        }

        //Else fetch the category id
        $cat = get_term_by( 'name', $category, $post_type . 'category' );
        if ( $cat ) {
            $modified[] = $cat->term_id;
            continue;
        }

        //If it don't exist, create it
        //We will never get here unless the user forgets to instruct WPAI to import categories
        $cat = wp_insert_term( $category, $post_type . 'category' );
        if( is_array( $cat ) ) {
            $modified[] = $cat['term_id'];
        }
    }

    return implode( ',', array_unique( $modified ) );
}
