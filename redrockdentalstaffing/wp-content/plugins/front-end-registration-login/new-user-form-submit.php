<?php
//New User Form Submit
// register a new user
function custom_reg_log_add_new_member() {
  	if (isset( $_POST["custom_reg_log_user_login"] ) && isset($_POST['custom_reg_log_register_nonce']) && wp_verify_nonce($_POST['custom_reg_log_register_nonce'], 'custom_reg_log-register-nonce')) {
		if(isset($_POST["user_type"]) ){
			$user_type = $_POST["user_type"]; // Job Seekers OR Job Providers		
		}
		if(isset($_POST["custom_reg_log_user_login"]) ){
			$user_login = $_POST["custom_reg_log_user_login"]; // this is username
		}
		if(isset($_POST["custom_reg_log_user_email"]) ){
			$user_email = $_POST["custom_reg_log_user_email"];
		}
		if(isset($_POST["custom_reg_log_user_first"]) ){
        	$user_first = $_POST["custom_reg_log_user_first"];
		}
		if(isset($_POST["custom_reg_log_user_last"]) ){
        	$user_last = $_POST["custom_reg_log_user_last"];
		}
		if(isset($_POST["custom_reg_log_user_pass"]) ){
			$user_pass = $_POST["custom_reg_log_user_pass"];
		}
		if(isset($_POST["custom_reg_log_user_pass_confirm"]) ){
			$pass_confirm = $_POST["custom_reg_log_user_pass_confirm"];
		}
		if(isset($_POST["custom_reg_log_user_comp_name"]) ){
			$user_comp_name = $_POST["custom_reg_log_user_comp_name"];
		}
		if(isset($_POST["custom_reg_log_user_zip_code"]) ){
			$user_zip_code = $_POST["custom_reg_log_user_zip_code"];
		}
		//print_r($_POST["custom_reg_log_user_industry"]);die("HI");
		if(isset($_POST["custom_reg_log_user_industry"]) ){
			$user_industry = $_POST["custom_reg_log_user_industry"];
		}
		if(isset($_POST["custom_reg_log_user_city"]) ){
			$user_city = $_POST["custom_reg_log_user_city"];
		}
		if(isset($_POST["custom_reg_log_user_state"]) ){
			$user_state = $_POST["custom_reg_log_user_state"];
		}
		if(isset($_POST["custom_reg_log_user_country"]) ){
			$user_country = $_POST["custom_reg_log_user_country"];
		}
		if(isset($_POST["custom_reg_log_user_max_working_distance"]) ){
			$user_max_working_distance = $_POST["custom_reg_log_user_max_working_distance"];
		}
		
		if(isset($_POST["custom_reg_log_user_pos_requestd"])){
			$user_pos_requestd = $_POST["custom_reg_log_user_pos_requestd"];
		}
		//print_r($_POST["custom_reg_log_user_available_days"]);die("HI");
		if(isset($_POST["custom_reg_log_user_available_days"]) ){
			$user_available_days = serialize($_POST["custom_reg_log_user_available_days"]);
		}
		
	
		if(isset($_POST["custom_reg_log_user_exp_years"]) ){
			$user_experience_years = $_POST["custom_reg_log_user_exp_years"];
		}
		if(isset($_POST["custom_reg_log_user_exp_months"]) ){
			$user_experience_months = $_POST["custom_reg_log_user_exp_months"];
		}
		if($user_experience_years){
			$user_exp_in_month = $user_experience_years*12;
			if($user_experience_months){
				$user_exp_in_month = $user_exp_in_month+$user_experience_months;
			}
			$user_experience = $user_exp_in_month;
		}else{
			$user_experience = $user_experience_months;
		}
	
		/********For Provider Form Start*******/
		if(isset($_POST["custom_reg_log_user_auth_per"]) ){
			$user_authorised_person = $_POST["custom_reg_log_user_auth_per"];
		}
		
		if(isset($_POST["custom_reg_log_user_adrs"]) ){
			$user_address = $_POST["custom_reg_log_user_adrs"];
		}
		
		if(isset($_POST["custom_reg_log_user_off_phone"]) ){
			$user_offc_phn = $_POST["custom_reg_log_user_off_phone"];
		}
		
		if(isset($_POST["custom_reg_log_user_fax"]) ){
			$user_fax = $_POST["custom_reg_log_user_fax"];
		}
		
		if(isset($_POST["custom_reg_log_user_website"]) ){
			$user_website = $_POST["custom_reg_log_user_website"];
		}
		if(isset($_POST["custom_reg_log_practice_type"]) ){
			//$user_practice_type = $_POST["custom_reg_log_practice_type"];
			$user_industry = $_POST["custom_reg_log_practice_type"];
		}
		if(isset($_POST["custom_reg_log_dentists"]) ){
			$user_dentist = $_POST["custom_reg_log_dentists"];
		}
		if(isset($_POST["custom_reg_log_hygienists"]) ){
			$user_hygienist = $_POST["custom_reg_log_hygienists"];
		}
		if(isset($_POST["custom_reg_log_assistants"]) ){
			$user_assistant = $_POST["custom_reg_log_assistants"];
		}
		if(isset($_POST["custom_reg_log_front_office"]) ){
			$user_front_offc = $_POST["custom_reg_log_front_office"];
		}
		if(isset($_POST["custom_reg_log_other"]) ){
			$user_log_other = $_POST["custom_reg_log_other"];
		}
		if(isset($_POST["custom_reg_log_comp_soft_used"]) ){
			$user_comp_used = $_POST["custom_reg_log_comp_soft_used"];
		}
		if(isset($_POST["custom_reg_log_accept_candidate"]) ){
			$user_accpt_candidate = $_POST["custom_reg_log_accept_candidate"];
		}
		/*if(isset($_POST["custom_reg_log_xray_used"]) ){
			$user_xray_used = $_POST["custom_reg_log_xray_used"];
		}
		*/
		if(isset($_POST["custom_reg_log_xray_type"]) ){
			$user_xray_type = $_POST["custom_reg_log_xray_type"];
		}
		
		if(isset($_POST["custom_reg_log_add_info"]) ){
			$user_add_info = $_POST["custom_reg_log_add_info"];
		}
		/********For Provider Form End*******/
		
		
		// this is required for username checks
		require_once(ABSPATH . WPINC . '/registration.php');
		
		
		/*==========================Start Of Error Checking=====================*/
		if(username_exists($user_login)) {
			// Username already registered
			custom_reg_log_errors()->add('username_unavailable', __('Username already taken'));
		}
		if(!validate_username($user_login)) {
			// invalid username
			custom_reg_log_errors()->add('username_invalid', __('Invalid username'));
		}
		else{
			$regex = '/^[a-zA-Z ]*$/'; 
			if (!preg_match($regex,$user_login)) {
				//$result->invalidate( $tag, "Please input alphabet characters only." );
				custom_reg_log_errors()->add('uname_invalid', __('Please input alphabet characters only for username.'));
			}
		}
		
		if($user_first != '') {
			$regex_fname = '/^[a-zA-Z ]*$/'; 
			if (!preg_match($regex_fname,$user_first)) {
				//$result->invalidate( $tag, "Please input alphabet characters only." );
				custom_reg_log_errors()->add('firstname_invalid', __('Please input alphabet characters only for firstname.'));
			}
		}
		
		if($user_last != '') {
			$regex_lname = '/^[a-zA-Z ]*$/'; 
			if (!preg_match($regex_lname,$user_last)) {
				//$result->invalidate( $tag, "Please input alphabet characters only." );
				custom_reg_log_errors()->add('lastname_invalid', __('Please input alphabet characters only for lastname.'));
			}
		}
		
		if($user_login == '') {
			// empty username
			custom_reg_log_errors()->add('username_empty', __('Please enter a username'));
		}
		//Below email validation was not working properly. So We replace the email validation code
		//if(!is_email($user_email)) {
			////invalid email
			//custom_reg_log_errors()->add('email_invalid', __('Invalid email'));
		//}
		// We can use below the validation
		// Email mask
		//if(preg_match("/^[a-zA-Z]w+(.w+)*@w+(.[0-9a-zA-Z]+)*.[a-zA-Z]{2,4}$/", $user_email) === 0)
		//$errEmail = '<p class="errText">Email must comply with this mask: chars(.chars)@chars(.chars).chars(2-4)</p>';
		if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
			custom_reg_log_errors()->add('email_invalid', __('Invalid email'));
		}
		else{
			$regex_mail = '/^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$/';
			if(email_exists($user_email)) {
				//Email address already registered
				custom_reg_log_errors()->add('email_used', __('Email already registered'));
			}
			 
			if (!preg_match($regex_mail, $user_email)) {
				custom_reg_log_errors()->add('email_invalid', __('Invalid email type.'));
			}
		}
		
		if($user_pass == '') {
			// passwords do not match
			custom_reg_log_errors()->add('password_empty', __('Please enter a password'));
		} else if(preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $user_pass) === 0) {
			// Password must be strong
			custom_reg_log_errors()->add('password_empty', __('Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit'));
		}
		if($user_pass != $pass_confirm) {
			// passwords do not match
			custom_reg_log_errors()->add('password_mismatch', __('Passwords do not match'));
		}
		if($user_fax){ 
			if (!is_numeric($user_fax))
			{
				custom_reg_log_errors()->add('fax_numeric', __('Please enter numeric value for Fax'));
			}
		}
		if($user_dentist){
			if (!is_numeric($user_dentist))
			{
				custom_reg_log_errors()->add('dentist_numeric', __('Please enter numeric value for Dentist Staff'));
			}
		}
		if($user_hygienist){
			if (!is_numeric($user_hygienist))
			{
				custom_reg_log_errors()->add('hygienist_numeric', __('Please enter numeric value for Hygienist Staff'));
			}
		}
		if($user_assistant){
			if (!is_numeric($user_assistant))
			{
				custom_reg_log_errors()->add('assistant_numeric', __('Please enter numeric value for Assistant Staff'));
			}
		}
		if($user_front_offc){
			if (!is_numeric($user_front_offc))
			{
				custom_reg_log_errors()->add('front_offc_numeric', __('Please enter numeric value for Front Office Staff'));
			}
		}
		if($user_log_other){
			if (!is_numeric($user_log_other))
			{
				custom_reg_log_errors()->add('others_numeric', __('Please enter numeric value for Other Staff'));
			}
		}
		/*==========================End Of Error Checking=====================*/
		
		//start for licenses/certifications image
		if(isset( $_FILES['custom_reg_log_user_licenses']) ){
			if( $_FILES['custom_reg_log_user_licenses']['name'] != '' ) {
				// Allowed mimes    
				$allowed_ext2 = "JPG, jpg, JPEG, jpeg, GIF, gif, PNG, png, PDF, pdf";  
				// Default is 50kb 
				$max_size2 = (1000*1024);  //1MB
				
				// Check mime types are allowed  
				$extension2 = pathinfo($_FILES['custom_reg_log_user_licenses']['name']);  
				$extension2 = $extension2[extension];  
				$allowed_paths2 = explode(", ", $allowed_ext2);
				if ( !in_array($extension2, $allowed_paths2) ) {
					custom_reg_log_errors()->add('file_extension2', __('File type for licenses/certifications does not support!'));
				}
		
				// Check File Size  
				elseif($_FILES['custom_reg_log_user_licenses']['size'] > $max_size2) {  
					custom_reg_log_errors()->add('file_size2', __('Licenses/Certifications file size is too big!'));
				}  
			}
		}
		//end for licenses/certifications image
		
		
		//start for resume upload
		if(isset( $_FILES['custom_reg_log_user_resume']) ){
			if( $_FILES['custom_reg_log_user_resume']['name'] != '' ) {
				// Allowed mimes    
				$allowed_ext3 = "TXT, txt, DOC, doc, DOCX, docx, PDF, pdf";  
				// Default is 50kb 
				$max_size3 = (1000*1024);  
	
				// Check mime types are allowed  
				$extension3 = pathinfo($_FILES['custom_reg_log_user_resume']['name']);  
				$extension3 = $extension3[extension];  
				$allowed_paths3 = explode(", ", $allowed_ext3);
				if ( !in_array($extension3, $allowed_paths3) ) {
					custom_reg_log_errors()->add('file_extension3', __('File type for resume does not support!'));
				}
		
				// Check File Size  
				elseif($_FILES['custom_reg_log_user_resume']['size'] > $max_size3) {  
					custom_reg_log_errors()->add('file_size3', __('Resume file size is too big!'));
				}  
			}
		}
		//end for resume upload
		
		
		//start for avatar/user profile image
		if(isset( $_FILES['custom_reg_log_user_profile_picture']) ){
			if( $_FILES['custom_reg_log_user_profile_picture']['name'] != '' ) {
				// Allowed mimes    
				$allowed_ext = "JPG, jpg, JPEG, jpeg, GIF, gif, PNG, png";  
				// Default is 50kb 
				$max_size = (1000*1024);  
				// height in pixels, default is 320px 
				$max_height = 320;  
				// width in pixels, default is 384px 
				$max_width = 384;
				
				// Check mime types are allowed  
				$extension = pathinfo($_FILES['custom_reg_log_user_profile_picture']['name']);  
				$extension = $extension[extension];  
				$allowed_paths = explode(", ", $allowed_ext);
				if ( !in_array($extension, $allowed_paths) ) {
					custom_reg_log_errors()->add('file_extension', __('Profile picture file type does not support!'));
				}
		
				// Check File Size  
				elseif($_FILES['custom_reg_log_user_profile_picture']['size'] > $max_size) {  
					custom_reg_log_errors()->add('file_size', __('Profile picture file size is too big!'));
				}  
				
				// Check Height & Width  
				//elseif ($max_width && $max_height) {  
				//	list($width, $height, $type, $w) = getimagesize($_FILES['custom_reg_log_user_profile_picture']['tmp_name']);  
				//	if($width > $max_width || $height > $max_height) {  
				//		custom_reg_log_errors()->add('file_height_width', __('Profile picture file size is too big! file size should be with in (W x H = 320 x 384)px.'));
				//	}  
				//}  
			}
		}
		//end for avatar/user profile image
		
		
		//start for for signed application
		if(isset( $_FILES['custom_reg_log_user_signed_app']) ){
			if( $_FILES['custom_reg_log_user_signed_app']['name'] != '' ) {
				// Allowed mimes    
				$allowed_ext4 = "JPG, jpg, JPEG, jpeg, GIF, gif, PNG, png, PDF, pdf";  
				// Default is 50kb 
				$max_size4 = (1000*1024);  
				// height in pixels, default is 175px 
				$max_height4 = 2480;  
				// width in pixels, default is 450px 
				$max_width4 = 3508;
				
				// Check mime types are allowed  
				$extension4 = pathinfo($_FILES['custom_reg_log_user_signed_app']['name']);  
				$extension4 = $extension4[extension];  
				$allowed_paths4 = explode(", ", $allowed_ext4);
				if ( !in_array($extension4, $allowed_paths4) ) {
					custom_reg_log_errors()->add('file_extension4', __('Signed application file type does not support!'));
				}
		
				// Check File Size  
				elseif($_FILES['custom_reg_log_user_signed_app']['size'] > $max_size4) {  
					custom_reg_log_errors()->add('file_size4', __('Signed application file size is too big! Max image width = 320px, Max image height = 384px and file size 1 MB'));
				}  
				
				//// Check Height & Width  
				//elseif ($max_width4 && $max_height4) {  
				//	list($width4, $height4, $type4, $w4) = getimagesize($_FILES['custom_reg_log_user_signed_app']['tmp_name']);  
				//	if($width4 > $max_width4 || $height4 > $max_height4) {  
				//		custom_reg_log_errors()->add('file_height_width4', __('Signed application file size is too big! file size should be with in (W x H = 2480 x 3508)px.'));
				//	}  
				//}  
			}
		}
		//end for signed application

		/************For Job Providers File Upload Section start********/
		//start for Credit Application
		if(isset( $_FILES['custom_reg_log_user_credt_aplict']) ){
			if( $_FILES['custom_reg_log_user_credt_aplict']['name'] != '' ) {
				// Allowed mimes    
				$allowed_ext5 = "JPG, jpg, JPEG, jpeg, GIF, gif, PNG, png, PDF, pdf";  
				// Default is 50kb 
				$max_size5 = (1000*1024);  
				
				// Check mime types are allowed  
				$extension5 = pathinfo($_FILES['custom_reg_log_user_credt_aplict']['name']);
				
				$extension5 = $extension5[extension];  
				$allowed_paths5 = explode(", ", $allowed_ext5);
				if ( !in_array($extension5, $allowed_paths5) ) {
					custom_reg_log_errors()->add('file_extension5', __('Credit Application file type does not support!'));
				}
		
				// Check File Size  
				elseif($_FILES['custom_reg_log_user_credt_aplict']['size'] > $max_size5) {  
					custom_reg_log_errors()->add('file_size5', __('Credit Application file size is too big! Max image size 1 MB'));
				}  
			}
		}
		//end for Credit Application
		
		//start for Office Agreement
		if(isset( $_FILES['custom_reg_log_user_offc_aggrmnt']) ){
			if( $_FILES['custom_reg_log_user_offc_aggrmnt']['name'] != '' ) {
				// Allowed mimes    
				$allowed_ext6 = "JPG, jpg, JPEG, jpeg, GIF, gif, PNG, png, PDF, pdf";  
				// Default is 50kb 
				$max_size6 = (1000*1024);  
				
				// Check mime types are allowed  
				$extension6 = pathinfo($_FILES['custom_reg_log_user_offc_aggrmnt']['name']);
				
				$extension6 = $extension6[extension];  
				$allowed_paths6 = explode(", ", $allowed_ext6);
				if ( !in_array($extension6, $allowed_paths6) ) {
					custom_reg_log_errors()->add('file_extension6', __('Office Agreement file type does not support!'));
				}
		
				// Check File Size  
				elseif($_FILES['custom_reg_log_user_offc_aggrmnt']['size'] > $max_size6) {  
					custom_reg_log_errors()->add('file_size6', __('Office Agreement file size is too big! Max image size 1 MB'));
				}  
			}
		}
		//end for Office Agreement
		
		
		/************For Job Providers File Upload Section End********/
	
		/*
		//start Profile picture
		if(isset( $_FILES['custom_reg_log_user_profile_picture']) ){
			if( $_FILES['custom_reg_log_user_profile_picture']['name'] != '' ) {
				// Allowed mimes    
				$allowed_ext7 = "JPG, jpg, JPEG, jpeg, GIF, gif, PNG, png";  
				// Default is 50kb 
				$max_size7 = (5000*1024);  
				
				// Check mime types are allowed  
				$extension7 = pathinfo($_FILES['custom_reg_log_user_profile_picture']['name']);
				
				$extension7 = $extension7[extension];  
				$allowed_paths7 = explode(", ", $allowed_ext7);
				if ( !in_array($extension7, $allowed_paths7) ) {
					custom_reg_log_errors()->add('file_extension7', __('File type for Office Agreement does not support!'));
				}
		
				// Check File Size  
				if($_FILES['custom_reg_log_user_profile_picture']['size'] > $max_size7) {  
					custom_reg_log_errors()->add('file_size7', __('Office Agreement file size is too big!'));
				}  
			}
		}
		//end Profile Picture
		*/
	
	
	
	
	
	
	
		
		/*
		//========== Start for g-reCaptcha Version-2 ==========//
						
		// Initiate the autoloader. The file should be generated by Composer.
		// You will provide your own autoloader or require the files directly if you did
		// not install via Composer.
		require_once __DIR__ . '/reCaptcha/src/autoload.php';
		
		// Register API keys at https://www.google.com/recaptcha/admin
		$siteKey = '6LeDBzQUAAAAAH7TD2yNLXp0w0CEyvo8ROBwbbCo';
		$secret = '6LeDBzQUAAAAAFxY5nHasQCQGUfV8QlL_KF4rTpE';
		
		// reCAPTCHA supported 40+ languages listed here: https://developers.google.com/recaptcha/docs/language
		$lang = 'en';
		
		if (isset($_POST['g-recaptcha-response'])){
			// The POST data here is unfiltered because this is an example.
			// In production, *always* sanitise and validate your input'

			// If the form submission includes the "g-captcha-response" field
			// Create an instance of the service using your secret
			//$recaptcha = new \ReCaptcha\ReCaptcha($secret);
			$recaptcha = new \ReCaptcha\ReCaptcha($secret, new \ReCaptcha\RequestMethod\SocketPost());
		
			// If file_get_contents() is locked down on your PHP installation to disallow
			// its use with URLs, then you can use the alternative request method instead.
			// This makes use of fsockopen() instead.
			//  $recaptcha = new \ReCaptcha\ReCaptcha($secret, new \ReCaptcha\RequestMethod\SocketPost());
			
			// Make the call to verify the response and also pass the user's IP address
			$resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
		
			if (!$resp->isSuccess()) {
			// If it's not successful, then one or more error codes will be returned.
				$captchaerr = "";
				foreach ($resp->getErrorCodes() as $errcode) {
					$captchaerr .= '<span>' . $errcode . '</span> ';
				}
				custom_reg_log_errors()->add('recaptcha', __('The reCAPTCHA was not entered correctly. ('.$captchaerr.')'));
			} else {
			// If the response is a success, that's it!
			// Your code here to handle a successful verification
			}
		}
						
		//========== End for g-reCaptcha Version-1 ==========//
		*/
		
		$errors = custom_reg_log_errors()->get_error_messages();
		
		// only create the user in if there are no errors
		if(empty($errors)) {
			if( !empty($user_type) ) {
				$new_user_id = wp_insert_user(array(
						'user_login'		=> $user_login,
						'user_pass'	 		=> $user_pass,
						'user_email'		=> $user_email,
						'first_name'		=> $user_first,
						'last_name'			=> $user_last,
						'user_registered'	=> date('Y-m-d H:i:s'),
						//'role'				=> 'subscriber'				
						'role'				=> $user_type				
					)
				);
			}

			if($new_user_id) {
				//wp_update_user( array ('ID' => $new_user_id, 'role' => 'editor') ) ;
				
				update_user_meta( $new_user_id, 'company_name', $user_comp_name );
				update_user_meta( $new_user_id, 'zip_code', $user_zip_code );
				update_user_meta( $new_user_id, 'industry', $user_industry );
				update_user_meta( $new_user_id, 'user_city', $user_city );
				update_user_meta( $new_user_id, 'user_state', $user_state );
				update_user_meta( $new_user_id, 'user_country', $user_country );
				update_user_meta( $new_user_id, 'max_working_distance', $user_max_working_distance );
				update_user_meta( $new_user_id, 'position_requested', $user_pos_requestd);
				
				update_user_meta( $new_user_id, 'available_days', $user_available_days );
				update_user_meta( $new_user_id, 'user_experience', $user_experience );
				
				
				/****** For Providers Section Start*****/
				update_user_meta( $new_user_id, 'authorized_contact', $user_authorised_person );			
				update_user_meta( $new_user_id, 'user_addr', $user_address );				
				update_user_meta( $new_user_id, 'office_phone', $user_offc_phn );
				update_user_meta( $new_user_id, 'user_fax', $user_fax );
				wp_update_user( array( 'ID' => $new_user_id, 'user_url' => $user_website ) ); // For Website
				//update_user_meta( $new_user_id, 'practice_type',	$user_practice_type );//Type Of Practice/Company
				
				update_user_meta( $new_user_id, 'emp_dentists', $user_dentist );
				update_user_meta( $new_user_id, 'emp_hygienists', $user_hygienist );				
				update_user_meta( $new_user_id, 'emp_assistants', $user_assistant );
				update_user_meta( $new_user_id, 'emp_front_office', $user_front_offc );
				update_user_meta( $new_user_id, 'other_stuff', $user_log_other );				
				update_user_meta( $new_user_id, 'computer_sw', $user_comp_used );
				update_user_meta( $new_user_id, 'exp_with_sw', $user_accpt_candidate );
				/*update_user_meta( $new_user_id, 'x_ray_used', $user_xray_used );*/
				update_user_meta( $new_user_id, 'x_ray_type', $user_xray_type );				
				update_user_meta( $new_user_id, 'description', $user_add_info );//For Additional Comments:
				
				
				$user_permission = 'Disable';
				update_user_meta( $new_user_id, 'users_permission', $user_permission );
				$user_ids = array();
				update_user_meta( $new_user_id, 'relation_with_users', $user_ids );
				
				/****** For Providers Section End*****/
				
				/*
				if($_FILES['custom_reg_log_user_avatar']['name']) {
					// Directory for uploaded images
					$uploaddir = ABSPATH . 'wp-content/uploads/users_doc/avatars';  
					if (!file_exists($uploaddir)) {
						mkdir($uploaddir, 0777, true);
					}
					$image_name=$new_user_id.'.'.$extension;
					// Rename file and move to folder
					$newname = $uploaddir."/user_avatar_".$image_name;  
					$files = $_FILES['custom_reg_log_user_avatar'];
					if( move_uploaded_file($files['tmp_name'], $newname) ) {
						//update_usermeta( $user_id, 'user_meta_image', $_POST['user_meta_image'] );
						update_usermeta($new_user_id,'_user_avatar','avatars/user_avatar_'.$image_name);
					}
				}
				//echo '<br><br>';
				*/
				
				if($_FILES['custom_reg_log_user_licenses']['name']) {
					// Directory for licenses images 
					$uploaddir2 = ABSPATH . 'wp-content/uploads/users_doc/licenses';  
					if (!file_exists($uploaddir2)) {
						mkdir($uploaddir2, 0777, true);
					}
					$image_name2=$new_user_id.'.'.$extension2;
					// Rename file and move to folder
					$newname2 = $uploaddir2."/user_licenses_".$image_name2;  
					$files2 = $_FILES['custom_reg_log_user_licenses'];
					if( move_uploaded_file($files2['tmp_name'], $newname2) ) {
						update_usermeta($new_user_id,'_user_licenses','licenses/user_licenses_'.$image_name2);
					}
				}
				//echo '<br><br>';
				
				if($_FILES['custom_reg_log_user_resume']['name']) {
					// Directory for resume doc 
					$uploaddir3 = ABSPATH . 'wp-content/uploads/users_doc/resume';  
					if (!file_exists($uploaddir3)) {
						mkdir($uploaddir3, 0777, true);
					}
					$image_name3=$new_user_id.'.'.$extension3;
					// Rename file and move to folder
					$newname3 = $uploaddir3."/user_resume_".$image_name3;  
					$files3 = $_FILES['custom_reg_log_user_resume'];
					if( move_uploaded_file($files3['tmp_name'], $newname3) ) {
						update_usermeta($new_user_id,'_user_resume','resume/user_resume_'.$image_name3);
					}
				}
				//echo '<br><br>';
				
				if($_FILES['custom_reg_log_user_signed_app']['name']) {
					// Directory for signed application images/doc
					$uploaddir4 = ABSPATH . 'wp-content/uploads/users_doc/signapp';  
					if (!file_exists($uploaddir4)) {
						mkdir($uploaddir4, 0777, true);
					}
					$image_name4=$new_user_id.'.'.$extension4;
					// Rename file and move to folder
					$newname4 = $uploaddir4."/user_signapp_".$image_name4;  
					$files4 = $_FILES['custom_reg_log_user_signed_app'];
					if( move_uploaded_file($files4['tmp_name'], $newname4) ) {
						update_usermeta($new_user_id,'_user_signapp','signapp/user_signapp_'.$image_name4);
					}
				}	
				//echo '<br><br>';
				
				if($_FILES['custom_reg_log_user_credt_aplict']['name']) {
					// Directory for Credit Application
					$uploaddir5 = ABSPATH . 'wp-content/uploads/users_doc/creditapp';  
					if (!file_exists($uploaddir5)) {
						mkdir($uploaddir5, 0777, true);
					}
					$image_name5=$new_user_id.'.'.$extension5;
					// Rename file and move to folder
					$newname5 = $uploaddir5."/user_creditapp_".$image_name5;
					$files5 = $_FILES['custom_reg_log_user_credt_aplict'];
					
					if( move_uploaded_file($files5['tmp_name'], $newname5) ) {
						update_usermeta($new_user_id,'_user_creditapp','creditapp/user_creditapp_'.$image_name5);
					}
				}
				//echo '<br><br>';
				
				if($_FILES['custom_reg_log_user_offc_aggrmnt']['name']) {
					// Directory for Office Agreement
					$uploaddir6 = ABSPATH . 'wp-content/uploads/users_doc/officeaggr';  
					if (!file_exists($uploaddir6)) {
						mkdir($uploaddir6, 0777, true);
					}
					$image_name6=$new_user_id.'.'.$extension6;
					// Rename file and move to folder
					$newname6 = $uploaddir6."/user_offcaggr_".$image_name6;
					$files6 = $_FILES['custom_reg_log_user_offc_aggrmnt'];
					
					if( move_uploaded_file($files6['tmp_name'], $newname6) ) {
						update_usermeta($new_user_id,'_user_offcaggr','officeaggr/user_offcaggr_'.$image_name6);
					}
				}
				//echo '<br><br>';

				/***************Start Profile picture upload*************/
				if($_FILES['custom_reg_log_user_profile_picture']['name']) {

					require_once(ABSPATH . "wp-admin" . '/includes/image.php');
					require_once(ABSPATH . "wp-admin" . '/includes/file.php');
					require_once(ABSPATH . "wp-admin" . '/includes/media.php');
		
					//var_dump($_POST); exit;
					$file = $_FILES['custom_reg_log_user_profile_picture'];
					$uploads = wp_upload_dir();//var_dump($uploads); exit;
					$args = array(
						'post_status' => 'publish',
						'post_author' => $new_user_id,
						//'post_title' => $new_user_id,
						'post_content' => '',
						'post_type' => 'mt_pp'
					);
					$post_id = wp_insert_post( $args );
					
					if($post_id) {
						$upload_overrides = array( 'test_form' => FALSE );
		
						$uploaded_file = wp_handle_upload( $file, $upload_overrides );
						$attachment = array(
							   'post_mime_type' => $uploaded_file['type'],
							   'post_title' => preg_replace('/\.[^.]+$/', '', basename( $uploaded_file['file'] ) ),
							   'post_content' => '',
							   'post_author' => '',
							   'post_status' => 'inherit',
							   'post_type' => 'attachment',
							   'post_parent' => $post_id,
							   'guid' => $uploaded_file['file']
						   );
						$attachment_id = wp_insert_attachment( $attachment, $uploaded_file['file'] );
						$attach_data = wp_generate_attachment_metadata( $attachment_id, $uploaded_file['file'] );
					   
						// update the attachment metadata
						wp_update_attachment_metadata( $attachment_id,  $attach_data );
						//Set as thumbnail
						set_post_thumbnail ($post_id, $attachment_id );
						
						update_user_option( $new_user_id, 'metronet_post_id', $post_id );
						update_user_option( $new_user_id, 'metronet_image_id', $attachment_id );
						update_user_option( $new_user_id, 'metronet_avatar_override', 'on' );
					}
				}
				/***************End Profile picture upload*************/		
				
	 
				// send an email to the admin alerting them of the registration
				wp_new_user_notification($new_user_id);
				
				// log the new user in
				wp_setcookie($user_login, $user_pass, true);
				wp_set_current_user($new_user_id, $user_login);	
				do_action('wp_login', $user_login);
				
				// send the newly created user to the current page after logging them in
				//$redirect_location = get_permalink(); // this would not be worked here
				//$redirect_location = $_SERVER['HTTP_REFERER'];
				//wp_safe_redirect($redirect_location);
				
				
				
				$current_user   = wp_get_current_user();
				$role_name      = $current_user->roles[0];
				
				if($role_name == 'job_seeker'){
					$geturl = get_option( 'candi_redirect_url_after_login')?get_option( 'candi_redirect_url_after_login'):'';
				wp_redirect(home_url().''.$geturl.'?msg=logsuccess');
				}
				if($role_name == 'job_provider'){
					$geturl = get_option( 'user_redirect_url_after_login')?get_option( 'user_redirect_url_after_login'):'';
				wp_redirect(home_url().''.$geturl.'?msg=logsuccess');
				}
				
				
				exit();
				
				//wp_redirect(home_url());
				//exit();
			}
			
		}
	
	}
}
add_action('init', 'custom_reg_log_add_new_member');
?>