<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
get_header(); ?>

<?php if(have_posts()){ ?>
<?/* ?>
<div class="row column<?php if(is_page('user-lists') && !is_user_logged_in() ){echo ' login_page';}?> <?php if(is_page('reset-password') && !is_user_logged_in() ){echo ' login_page';}?> <?php if(is_page('forgot-password') && !is_user_logged_in() ){echo ' login_page';}?>">
<?php */ ?>

<div class="row column<?php if(is_page(array('user-lists','reset-password','forgot-password','login-now')) && !is_user_logged_in() ){echo ' login_page';}?>">

  <?php while(have_posts()){ the_post(); ?>
  
<?php /* if( is_page( array( 'user-lists') ) ) { ?>
	<?php if(!is_user_logged_in()){ ?>
	<h2 class="title">Log In</h2>
	<?php } else { ?>
	<h2 class="title"><?php the_title(); ?></h2>
	<?php } ?>
<?php } else { ?>
  <h2 class="title"><?php the_title(); ?></h2>
<?php } */ ?>

<?php
$current_user   = wp_get_current_user();
$prmsn = get_user_meta($current_user->ID, 'users_permission');
$role_name      = $current_user->roles[0];

if( is_page( array( 'login-now') ) ) { ?>
	<h2 class="title"><?php the_title(); ?></h2>
<?php }
else if( is_page( array( 'job-listing') ) ) { ?>
	<?php if( $role_name == 'job_seeker' ) { ?>
	  <h2 class="title">Candidate Dashboard</h2>
	
	<?php }?>
	<?php if( $role_name == 'job_provider' ) { ?>
	  <h2 class="title">Jobs List</h2>
	
	<?php }?>
	
	<?php
	if( $prmsn[0] == 'Enable' ) {
	  if( $role_name == 'job_provider' ) { ?>
		  <a class="add_new_job button right" href="job-post-form" title="Post a new job">Post A New Job</a>
	  <?php }
	}
	?>	
<?php }
else if( is_page( array( 'job-post-form') ) ) { }
else if( is_page( array( 'sign-up-for-candidates', 'sign-up-for-dental-offices') ) ) { ?>
	<h2 class="title">Register Now</h2>
<?php }
else if( is_page( array( 'user-lists', 'user-details', 'job-providers', 'job-seekers', 'job-listing') ) ) { ?>
	<?php
	if( $role_name == 'job_seeker' ) {
		$pgtitle = 'Available Positions';
		//$pgtitle = 'Candidate Dashboard';
	}
	else if( $role_name == 'job_provider' ) {
	  if(is_page('user-details')){
	      if($_REQUEST['id']){
		
		  $user_details_page = new WP_User(base64_decode($_REQUEST['id']));
		  $user_details_page_role = $user_details_page->roles[0];
		  if($user_details_page_role == 'job_seeker'){
		    $pgtitle = "Candidate Details";
		  }
		  if($user_details_page_role == 'job_provider'){
		    $pgtitle = "Employer Details";
		  }
	      }
	  }
	  else{
	    	$pgtitle = 'Employer Dashboard';
		if( is_user_logged_in() ) {
			$user_details = new WP_User(get_current_user_id());
			$user_id = $user_details->ID;	
			$permission = get_user_meta($user_id, 'users_permission');
			if( $permission[0] == 'Enable' ) { 
				//$sub_pgtitle = '<p class="sub-title">Browse the available candidates below, and click on "INQUIRE NOW."  We will reach out to check the candidate&#39;s availability and set up the interview.</p>';
			}
		}
	  }
	  

	}	else {
		$pgtitle = 'Dashboard';
	}
	?>
	<h2 class="title"><?php echo $pgtitle; ?></h2>
	<?php if($sub_pgtitle) { echo $sub_pgtitle; } ?> 
<?php } else { ?>
	<h2 class="title"><?php the_title(); ?></h2>
<?php } ?>

  <?php if(has_post_thumbnail()): ?>
  <img class="thumbnail" src="<?php the_post_thumbnail_url(); ?>" alt="">
  <?php endif; the_content(); } ?>
</div>
<?php }

get_footer();
