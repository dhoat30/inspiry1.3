<?php
//routes

add_action("rest_api_init", "inspiry_board_route");

function inspiry_board_route(){ 
      //get boards
   register_rest_route("inspiry/v1/", "get-boards", array(
      "methods" => "POST",
      "callback" => "getBoard"
   ));
	
	// 	add to board
    register_rest_route("inspiry/v1/", "add-to-board", array(
      "methods" => "POST",
      "callback" => "addProjectToBoard"
      ));
	
// 	create board 
		register_rest_route("inspiry/v1/", "manage-board", array(
		   "methods" => "POST",
		   "callback" => "createBoard"
		));
	
	// 	get pins related to the single board 
		register_rest_route("inspiry/v1/", "get-pins", array(
		   "methods" => "POST",
		   "callback" => "getPins"
		));
	
	
    register_rest_route("inspiry/v1/", "manageBoard", array(
        "methods" => "DELETE",
        "callback" => "deletePin"
    ));

    register_rest_route("inspiry/v1/", "deleteBoard", array(
        "methods" => "DELETE",
        "callback" => "deleteBoardFunc"
    ));
    
    //update board 
    register_rest_route("inspiry/v1/", "updateBoard", array(
      "methods" => "POST",
      "callback" => "updateBoard"
  ));




}

// get board - new
function getBoard($data){
   $postID = sanitize_text_field($data["id"] ); 
   if(is_user_logged_in()){
   $boards = new WP_Query(array(
      'post_type' => 'boards',
      'post_parent' => 0, 
      'posts_per_page' => -1, 
      'p' => $postID,
      'author' => get_current_user_id()
   )); 

   $boardsResult = array(); 

   while($boards->have_posts()){
      $boards->the_post(); 
                            //GET THE CHILD ID
                            //Instead of calling and passing query parameter differently, we're doing it exclusively
                            $all_locations = get_pages( array(
                              'post_type'         => 'boards', //here's my CPT
                              'post_status'       => array( 'private', 'pending', 'publish') //my custom choice
                          ) );

                          //Using the function
                          $parent_id = get_the_id();
                          $inherited_locations = get_page_children( $parent_id, $all_locations );

                          // echo what we get back from WP to the browser (@bhlarsen's part :) )
                          $child_id = $inherited_locations[0]->ID;
                        //   $childThumbnailImageID =  get_field('saved_image_id', $child_id); 
                          $childThumbnail = get_field('saved_project_id', $child_id); 
                           $productID= (int)$childThumbnail;
                           $imageURL='';
                           if (!$productID) { 
                              $imageURL = "https://inspiry.co.nz/wp-content/uploads/2020/12/icon-card@2x.jpg";
                           }
      array_push($boardsResult, array(
         'title' => get_the_title(),
         'description' => get_the_content(), 
         'id' => get_the_id(), 
         'status' => get_post_status(), 
         "product_id" => $productID,
         "image_url"=> $imageURL, 
		  "slug"=> get_post_field( 'post_name', get_the_ID() )
      ));       
   }

   return $boardsResult; 
   }  
   else{
   return 'you do not have permission' ;
   }
}

// add project to board 
function addProjectToBoard($data){ 
   if(is_user_logged_in()){
      $boardID = sanitize_text_field($data["boardID"]);
      $postTitle = sanitize_text_field($data["postTitle"]);
      $publishStatus = sanitize_text_field($data['status']);
      $projectID = sanitize_text_field($data['projectID']);
      $tradeID = sanitize_text_field($data['tradeID']);
      $productID = sanitize_text_field($data['productID']);
      
      if($projectID){
         return wp_insert_post(array(
            "post_type" => "boards", 
            "post_status" => $publishStatus, 
            "post_parent" => $boardID, 
            "post_title" => get_the_title($projectID),
            "meta_input" => array(
               "saved_project_id" => $projectID
            )
         )); 
      }
      elseif ($tradeID){
         return wp_insert_post(array(
            "post_type" => "boards", 
            "post_status" => $publishStatus, 
            "post_title" => $postTitle,
            "post_parent" => $boardID, 
            "meta_input" => array(
               "trade_id"=> $tradeID
            )
     )); 
      }
      else{
         return wp_insert_post(array(
            "post_type" => "boards", 
            "post_status" => $publishStatus, 
            "post_title" => $postTitle,
            "post_parent" => $boardID, 
            "meta_input" => array(
               "product_id"=> $productID
            )
     )); 

      }
   }
   else{
      die("Only logged in users can create a board");
   }
   
}

	// create board 
	function createBoard($data){ 
	   if(is_user_logged_in()){
		  $boardName = sanitize_text_field($data["boardName"]);
		  $boardDescription = sanitize_text_field($data['board-description']); 
		  $publishStatus = sanitize_text_field($data['status']);

		  $existQuery = new WP_Query(array(
			'author' => get_current_user_id(), 
			'post_type' => 'boards', 
			's' => $boardName
		)); 
		 if($existQuery->found_posts == 0){ 
			return wp_insert_post(array(
				"post_type" => "boards", 
				"post_status" => $publishStatus, 
				"post_title" => $boardName,
				'post_content' => $boardDescription
		 )); 
		 }
		 else{ 
			 die('Board already exists');
		 }
	   }
	   else{
		  die("Only logged in users can create a board");
	   }
	}


		// get pins - new
		function getPins($data){
		   $slug = sanitize_text_field($data["slug"] ); 
			// check if the user is logged in 
		   if(is_user_logged_in()){
		   $boardsResult = array(); 
			   $parentID = 0; 
					if ( $post = get_page_by_path( $slug, OBJECT, 'boards' ) ){
						$parentID = $post->ID;
					}
			   	$parentStatus = get_post_status($parentID);
				$boardLoop = new WP_Query(array(
                'post_type' => 'boards', 
                'post_parent' => $parentID,
                'posts_per_page' => -1
            	));
			   	
				
			     while($boardLoop->have_posts()){
                $boardLoop->the_post(); 
                $parentID =  wp_get_post_parent_id($parentID); 
					 
				// get the ids for images 
			   	$projectID = 0; 
			   $tradeID=0; 
			   $productID = 0; 
				$projectImage=''; 
				$tradeImage = ''; 
					 $productImage = ''; 
			   if(get_field("saved_project_id")){ 
			   	$projectID = get_field("saved_project_id"); 
				 $projectImage = get_field('gallery', $projectID);
			   }
			   elseif(get_field("trade_id")){ 
			   	$tradeID = get_field("trade_id"); 
				   $tradeImage = get_field('gallery', $tradeID);
			   }
			    elseif(get_field("product_id")){ 
			   	$productID = get_field("product_id"); 
					$productImage = get_the_post_thumbnail($productID);
			   }
					 
					 array_push($boardsResult, array(
							'id' => get_the_id(), 
						 	'title'=> get_the_title(),
						 	'status'=> $parentStatus, 
						 	'project-image'=> $projectImage, 
						 	'trade-image'=> $tradeImage, 
						 	'product-image'=> $productImage
// 						 	'project-id'=> $projectID, 
// 						 	'trade-id'=> $tradeID,
// 						 	'product-id'=> $productID, 
						 	
						));   
				 }
					 
		   return $boardsResult; 
		   }  
		   else{
		   return 'you do not have permission' ;
		   }
		}


function updateBoard($data){
   $parentID = sanitize_text_field($data["board-id"] ); 
   $boardName = sanitize_text_field($data["board-name"] ); 
   $boardDescription = sanitize_text_field($data["board-description"] );
   $publishStatus  = sanitize_text_field($data["status"] );

    // Delete the Parent Page
    if(get_current_user_id() == get_post_field("post_author", $parentID) AND get_post_type($parentID)=="boards"){

        //Instead of calling and passing query parameter differently, we're doing it exclusively
        $all_locations = get_pages( array(
            'post_type'         => 'boards', //here's my CPT
            'post_status'       => array( 'private', 'pending', 'publish') //my custom choice
        ) );

        //Using the function
        $inherited_locations = get_page_children( $parentID, $all_locations );
        // echo what we get back from WP to the browser (@bhlarsen's part :) )
            // Update all the Children of the Parent Page
            foreach($inherited_locations as $post){
               
                wp_insert_post(array(
                  "ID" => $post->ID, 
                  "post_type" => "boards", 
                  "post_status" => $publishStatus,
                  'post_parent'=> $parentID, 
                  "post_title" =>get_the_title($post->ID)
               )); 
            }

        // Update the Parent Page
        wp_insert_post(array(
         "ID" => $parentID, 
         "post_type" => "boards", 
         "post_status" => $publishStatus, 
         "post_title" => $boardName,
         'post_content' => $boardDescription
         )); 

        return 'updation worked. congrats'; 
     }
     else{ 
        die("You do not have permission to update a board");
     }
}


function deletePin($data){ 
   $pinID = sanitize_text_field($data["pin-id"] ); 

   if(get_current_user_id() == get_post_field("post_author", $pinID) AND get_post_type($pinID)=="boards"){
      wp_delete_post($pinID, true); 
      return "congrats, like deleted"; 
   }
   else{ 
      die("you do not have permission to delete a pin");
   }
}

function deleteBoardFunc($data){ 
    $parentID = sanitize_text_field($data["board-id"] ); 

    // Delete the Parent Page
    if(get_current_user_id() == get_post_field("post_author", $parentID) AND get_post_type($parentID)=="boards"){

        //Instead of calling and passing query parameter differently, we're doing it exclusively
        $all_locations = get_pages( array(
            'post_type'         => 'boards', //here's my CPT
            'post_status'       => array( 'private', 'pending', 'publish') //my custom choice
        ) );

        //Using the function
        $inherited_locations = get_page_children( $parentID, $all_locations );
        // echo what we get back from WP to the browser (@bhlarsen's part :) )
            // Delete all the Children of the Parent Page
            foreach($inherited_locations as $post){
        
                wp_delete_post($post->ID, true);
            }

        // Delete the Parent Page
        wp_delete_post($parentID, true);

        return 'deletion worked. congrats'; 
     }
     else{ 
        die("you do not have permission to delete a pin");
     }
}

/*function deleteParentBoard(){ 
    $boardID = sanitize_text_field($data["board-id"] ); 

    // Delete the Parent Page
    if(get_current_user_id() == get_post_field("post_author", $boardID) AND get_post_type($boardID)=="boards"){
        wp_delete_post($boardID, true); 
        return "congrats, board deleted"; 
     }
     else{ 
        die("you do not have permission to delete a pin");
     }
}*/