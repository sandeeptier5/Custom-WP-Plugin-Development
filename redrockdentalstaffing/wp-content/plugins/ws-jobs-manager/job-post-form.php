<?php
//Job Post Form
function custom_job_post_form_field($post_id) {
	ob_start();
	//echo $post_id; echo "Hello";
	//print_r($_REQUEST);
	if( $_REQUEST['post_id']!='' ) {
		$post_id_second = $_REQUEST['post_id'];
		$content_post = get_post($post_id_second);
		$content = $content_post->post_content;
	}
	elseif( $_REQUEST['id']!='' ) {
		$post_id_edit = $_REQUEST['id'];
		$content_post = get_post($post_id_edit);
		$content = $content_post->post_content;
		$post_id = $post_id_edit;
		//echo "hello";
		
		//echo '<h2 class="title">UPDATE THE JOB</h2>';
		

	}
	else{
		
		if($post_id != ''){
			//echo "in in";
			$post_id_first = $post_id;//This is page id or post id
			$content_post = get_post($post_id_first);
			$content = $content_post->post_content;
		}
	}
	
	?>
    <?php
    if($post_id_second){
        echo '<h2 class="title">UPDATE THE JOB</h2>';
        echo '<span class="success_msg"> You have successfully updated this Job.<br/>Please wait for admin authorization to view this job.</span>';

    }elseif ($post_id_first){
        echo '<h2 class="title">UPDATE THE JOB</h2>';
        echo '<span class="success_msg"> You have successfully post a Job.<br/>Please wait for admin authorization to view this job.</span>';

    }elseif ($post_id_edit){
        echo '<h2 class="title">UPDATE THE JOB</h2>';
        //echo '<span class="success_msg"> You have successfully updated this Job.<br/>Please wait for admin authorization to view this job.</span>';

    }else{
        echo '<h2 class="title">Post a new job</h2>';

    }
    ?>

		<?php 
		// show any error messages after form submission
		job_post_error_messages();
		?>
		<script>
			if (jQuery("div").hasClass("job_log_errors")) {
				//alert("HI");
				jQuery(".success_msg").remove();
			}
		</script>
		<form name="custom_job_post_form" id="custom_job_post_form" class="custom_reg_log_form" action="" method="POST" enctype="multipart/form-data">
			
			<input type="hidden" name="post_id" value="<?php echo $post_id;?>" readonly="readonly">
			<input type="hidden" id="ajax_url" name="ajax_url" value="<?php echo admin_url('admin-ajax.php'); ?>" readonly="readonly">
			<fieldset>
				<p>
					<label for="custom_job_post_title"><?php _e('Job Title <span class="required">*</span>'); ?></label>
					<input name="custom_job_post_title" id="custom_job_post_title" class="required" type="text" value="<?php if($content_post->post_title){ echo $content_post->post_title; } ?>"/>
				</p>
                                <p>
					<label for="custom_job_post_descrip"><?php _e('Job Description <span class="required">*</span>'); ?></label>
					<?php /* ?>
					       <input name="custom_job_post_descrip" id="custom_job_post_descrip" class="required" type="text" value="<?php if($content_post->post_content){ echo $content_post->post_content; } ?>" required/>
					       <?php */ ?>
					
					<textarea name="custom_job_post_descrip" id="custom_job_post_descrip" class="required" required><?php if($content_post->post_content){ echo trim($content_post->post_content); } ?></textarea>
				</p>
				
				
				<p>
					<label for="custom_job_post_require"><?php _e('Job Requirements <span class="required">*</span>'); ?></label>
					<input name="custom_job_post_require" id="custom_job_post_require" class="required" type="text" value="<?php if(get_post_meta($post_id,'jobs_manager_requirements',true)){ echo get_post_meta($post_id,'jobs_manager_requirements',true); } ?>" required/>
				</p>
				<?php /* ?>
                                <p>
					<label for="custom_job_post_comp_name"><?php _e('Company Name'); ?></label>
					<input name="custom_job_post_comp_name" id="custom_job_post_comp_name" type="text" value="<?php if(get_post_meta($p_id,'jobs_manager_company_name',true)){ echo get_post_meta($p_id,'jobs_manager_company_name',true); } ?>" />
				</p>
				<?php */ ?>
                                <p>
					<label for="custom_job_post_contact"><?php _e('Contact:'); ?></label>
					<input name="custom_job_post_contact" id="custom_job_post_contact" class="wpcf7-tel" type="text" value="<?php if(get_post_meta($post_id,'jobs_manager_contact',true)){ echo get_post_meta($post_id,'jobs_manager_contact',true); } ?>" />
				</p>
				
				<p>	
					<label for="custom_job_start_date">Start Date: <span class="required">*</span> </label>
					<input name="custom_job_start_date" type="text" value="<?php if(get_post_meta($post_id,'jobs_manager_startdate',true)){ echo date("m-d-Y", strtotime(get_post_meta($post_id, "jobs_manager_startdate", true))); } ?>" class="startdate date_picker required" placeholder="mm/dd/yyyy" required>
				</p>

				<p>
					
					<label for="custom_job_end_date">End Date:</label>
      <input name="custom_job_end_date" type="text" value="<?php if(get_post_meta($post_id,'jobs_manager_enddate',true)){ echo date("m-d-Y", strtotime(get_post_meta($post_id, "jobs_manager_enddate", true))); } ?>" class="enddate date_picker" placeholder="mm/dd/yyyy">
				</p>
				<div class="gap">
					<label for="job_cat"><?php _e('Category'); ?></label>
					
					<?php $terms_list = get_terms( array(
						'taxonomy' => 'cptjobsmanager_category',
						'hide_empty' => false,
					    ) );
					//$selected_cat = $_POST["custom_job_category"];
					$selected_cat = wp_get_post_terms($post_id, 'cptjobsmanager_category', array("fields" => "slugs"));
					//print_r($selected_cat);	
					
					if($terms_list){
					?>
					<div class="radio-wrap">
						<?php
						foreach($terms_list as $single_term ){
							//print_r($single_term);
							if (in_array($single_term->slug, $selected_cat)) {						
							    $selected_item = ' checked="checked"';
							} else {
							    $selected_item = ' ';
							}
						?>
							<span><input name="custom_job_category[]" type="radio" value="<?php echo $single_term->slug ;?>" <?php echo $selected_item; ?> /><?php echo $single_term->name ;?></span>
						<?php } ?>
						
					</div>
					<?php
					}
					?>
				</div>
				
				
				
				<div class="gap">
					<label for="job_cat"><?php _e('Job Type'); ?></label>
					<div class=radio-wrap>
						<?php
						//echo $post_id;
						$selected_jobtype = get_post_meta($post_id,'jobs_manager_jobtype',true);
						//print_r($selected_jobtype);
						?>
						
						<?php
						$page = get_page_by_path('pricing');
						$pricing_page_id = $page->ID;
						
						if( have_rows('business_matches_positions',$pricing_page_id) ){ 
						// $count=1;
							while ( have_rows('business_matches_positions',$pricing_page_id) ) {
								the_row();
								$position_field_name = get_sub_field('dental_position_field_name');
								
								if (in_array($position_field_name, $selected_jobtype)) {						
								    $selected_item = ' checked="checked"';
								} else {
								    $selected_item = ' ';
								}
								
								
								
								?>
								<span><input name="custom_job_type[]" type="radio" value="<?php echo $position_field_name ;?>" <?php echo $selected_item; ?> /><?php echo $position_field_name ;?></span>
							
						<?php 	}
						
						}?>
					</div>
				</div>
				
				
				
				
				
				
				
				
				
				
				
				
					
				<?php /* ?>
                                <p>
					<label for="custom_job_post_designatn"><?php _e('Job Designation'); ?></label>
					<input name="custom_job_post_designatn" id="custom_job_post_designatn" type="text" value="<?php if(get_post_meta($p_id,'jobs_manager_designation',true)){ echo get_post_meta($p_id,'jobs_manager_designation',true); } ?>" />
				</p>
				<?php */ ?>
				
				<p>
					<label for="custom_job_post_salary"><?php _e('Salary'); ?></label>
					<input name="custom_job_post_salary" id="custom_job_post_salary" type="text" value="<?php if(get_post_meta($post_id,'jobs_manager_salary',true)){ echo get_post_meta($post_id,'jobs_manager_salary',true); } ?>" />
				</p>
				<!--
                                <p>
					<label for="custom_job_post_department"><?php //_e('Job Department'); ?></label>
					<input name="custom_job_post_department" id="custom_job_post_department" type="text" value="<?php //if(get_post_meta($p_id,'jobs_manager_department',true)){ echo get_post_meta($p_id,'jobs_manager_department',true); } ?>" />
				</p>
				-->
                                <p>
					<label for="custom_job_post_loc"><?php _e('Job Location <span class="required">*</span>'); ?></label>
					<input name="custom_job_post_loc" id="custom_job_post_loc" class="required" type="text" value="<?php if(get_post_meta($post_id,'jobs_manager_location',true)){ echo get_post_meta($post_id,'jobs_manager_location',true); } ?>" required/>
				</p>
				<?php /*?>
                                <p>
					<label for="custom_job_Year_expr"><?php _e('Years of Experience Required <span class="required">*</span>'); ?></label>
					<input name="custom_job_Year_expr" id="custom_job_Year_expr" class="required" type="text" value="<?php if(get_post_meta($post_id,'jobs_manager_experience',true)){ echo get_post_meta($post_id,'jobs_manager_experience',true); } ?>" required />
				</p>
				<?php */ ?>
				
				
				
				
				
				
				
				<?php
				$years_of_experience_required = get_field('years_of_experience_required','options');
				$user_experience = get_post_meta($post_id,'jobs_manager_experience',true);
				
				if($user_experience){
				    if($user_experience/12 >0){
				      $user_experience_years = (int)($user_experience / 12);
				      $user_experience_month = $user_experience % 12;
				    }
				}
				?>
				<div class="exp_label">
				   <label for="custom_job_Year_expr"><?php _e('Years of Experience Required <span class="required">*</span>'); ?></label>
				</div>
				<div class="exp_wrap">
				     <select name="custom_reg_log_user_exp_years">
					  <option value="">Select Years</option>
					  <?php for($i=0; $i<=$years_of_experience_required; $i++){?>
						  <option value="<?php echo $i; ?>" <?php if($user_experience_years == $i){echo 'selected';} ?>><?php echo $i; ?></option>
					  
					  
					  <?php }?>
				     </select>
				     <span class="exp_type">years</span>
				     <select name="custom_reg_log_user_exp_months">
					  <option value="">Select Months</option>
					  <?php for($j=0; $j<=11; $j++){?>
						     <option value="<?php echo $j; ?>" <?php if($user_experience_month == $j){echo 'selected';} ?>><?php echo $j; ?></option>					
					     <?php }?>
				     </select>
				     <span class="exp_type">months</span>
				</div>
			      
			      
			      
				<!--
                                <p>
					<label for="custom_job_vacancy"><?php //_e('Job Vacancy'); ?></label>
					<input name="custom_job_vacancy" id="custom_job_vacancy" type="text" value="<?php //if(get_post_meta($p_id,'jobs_manager_vacancy',true)){ echo get_post_meta($p_id,'jobs_manager_vacancy',true); } ?>" />
				</p>                               
				-->
				<p>
					<input type="hidden" name="custom_job_post_nonce" value="<?php echo wp_create_nonce('custom_job_post_nonce'); ?>"/>
					<?php if( $post_id ){ ?>
					<input type="submit" name="submit_job_post" value="<?php _e('Update Post'); ?>"/>
					<?php } else { ?>
					<input type="submit" name="submit_job_post" value="<?php _e('Submit Post'); ?>"/>
					<?php } ?>
				</p>
			</fieldset>
		</form>
	<?php
	return ob_get_clean();
}
?>