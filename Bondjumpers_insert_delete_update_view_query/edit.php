<?php  
/* 
Template Name:edit page
*/

get_header();
?>
<?php 
if(isset($_GET['uid'])){ 
global $wpdb;
 $id=$_GET['uid'];
 $x=$_GET['uname'];
$table_name = $wpdb->prefix . "bond";
    
          $row = $wpdb->get_results("SELECT * FROM $table_name WHERE user_id=$id");
          
          //print_r($row);
          
          
			  foreach ($row as $rows){ 
			  $user_id=$rows->user_id; 
				 $lname=$rows->lname;
				 $fname= $rows->fname;
				 $gender= $rows->gender;				
				 $dob= $rows->dob;
				
				 //$age= $rows->age;
				 $race= $rows->race;
				 $height= $rows->height;				
				 $weight=$rows->weight;
				 $company=$rows->company;
				 $country=$rows->country;
				 $charge=$rows->charge;
				 $phone=$rows->phone;
				 $dateofbond=$rows->dateofbond;
				 
				 $uphoto=$rows->uphoto;
		 
			  }
			 ?>
		<?php $d= $rows->dob; $d1=explode("-",$d); //print_r($d1);?>
		<?php $dbb= $rows->dateofcharge; $d3=explode("-",$dbb); //print_r($d1);?>
		<?php $db= $rows->dateofbond; $d2=explode("-",$db); //print_r($d1);?>	
				 
	    <form action="http://bondjumpers.com/update?page=update&uid=<?php echo $user_id; ?>&uname=<?php echo $rows->uname; ?>" method="post" enctype="multipart/form-data"> 
  
    
    <div class="listing_list">
	<h4 style="font-size: 21px !important;margin:30px 0;">Hello: <?php echo $rows->uname;?></h4>
<div class="lis_51" style="text-align:right;">
    	<img width="220" height="170" src="<?php echo $rows->uphoto;?>"/>
    </div>
	
    
    
        <div class="lis_52">
        	
            <div class="min_list" >
            	<div class="lis_50_left">Last Name</div>
            	<div class="lis_50_right"><input id="lname" name="lname1" class="input" type="text" value="<?php echo $lname; ?>" ></div>
            <div class="clear"></div>
            </div>
            
            <div class="min_list" >
                <div class="lis_50_left">First Name</div>
                <div class="lis_50_right"><input id="fname" name="fname1" class="input" type="text" value="<?php echo $fname; ?>" ></div>
            <div class="clear"></div>
            </div>
            
            
            <div class="min_list" >
            
                <div class="lis_50_left">Gender</div>
                <div class="lis_50_right">
                	<input type="radio" name="gender1" <?php if (isset($gender) && $gender=="M") echo "checked";?> value="M" >Male 
                	<br/> 
                	<input type="radio" name="gender1" <?php if (isset($gender) && $gender=="F") echo "checked";?> value="F">Female</td>
                </div>
                
            	<div class="clear"></div>
           	</div>
            
            
             
            
           <div class="min_list" >
                <div class="lis_50_left">Date of Birth</div>
                <div class="lis_50_right">
				    <input id="p13" name="month11"  maxlength="2"  class="input input_new01_01" placeholder="MM" type="text" value="<?php echo $d1[0]; ?>" style=" ">
				    <input id="p12" name="day11"    maxlength="2"  class="input input_new01_02" placeholder="DD" type="text" value="<?php echo $d1[1]; ?>" style=" ">
					<input id="p11" name="year11"   maxlength="4"  class="input input_new01_03" placeholder="YYYY" type="text" value="<?php echo $d1[2]; ?>" style=" "> 
				</div>
           <div class="clear"></div>
            </div>
            
            
            <!--<div class="min_list" >
                <div class="lis_50_left">Age</div>
                <div class="lis_50_right"><input id="age" name="age1" class="input"  type="text" value="<?php echo $age;?>"></div>
              <div class="clear"></div>
            </div>-->      
              <div class="min_list" >
                <div class="lis_50_left">Race</div>
                <div class="lis_50_right"><input id="race" name="race1" class="input"  type="text" value="<?php echo $race;?>"></div>
             <div class="clear"></div>
            </div>
             
             
             <div class="min_list" >
                <div class="lis_50_left">Height</div>
                <div class="lis_50_right"><input id="height" name="height1" class="input"  type="text" value="<?php echo $height; ?>" ></div>
             <div class="clear"></div>
            </div>
             <div class="min_list" >
                <div class="lis_50_left">Weight</div>
                <div class="lis_50_right"><input id="weight" name="weight1" class="input"  type="text" value="<?php echo $weight; ?>" ></div>
            <div class="clear"></div>
            </div>
            <div class="min_list" >
                <div class="lis_50_left">Bonding Company</div>
                <div class="lis_50_right"><input id="company" name="company1" class="input"  type="text" value="<?php echo $company; ?>"></div>
           <div class="clear"></div>
			</div>
			<div class="min_list" >
                <div class="lis_50_left">Bonding Company Phone No.</div>
                <div class="lis_50_right"><input id="phone" name="phone1" class="input"  type="text" value="<?php echo $phone; ?>"></div>
           <div class="clear"></div>
			</div>
             <div class="min_list" >
                <div class="lis_50_left">County</div>
                <div class="lis_50_right"><input id="country" name="country1" class="input"  type="text" value="<?php echo $country; ?>"></div>
            <div class="clear"></div>
            </div>
            <div class="min_list" >
                <div class="lis_50_left">Charge</div>
                <div class="lis_50_right"><input id="charge" name="charge1" class="input"  type="text" value="<?php echo $charge; ?>"></div>
            <div class="clear"></div>
            </div>
			<div class="min_list" >
                <div class="lis_50_left">Date Of Charge</div>
                 <div class="lis_50_right">
				    <input id="p2" name="month33"  maxlength="2"  class="input input_new01_01" placeholder="MM" type="text" value="<?php echo $d3[0]; ?>" style=" ">
				    <input id="p8" name="day33"    maxlength="2"  class="input input_new01_02" placeholder="DD" type="text" value="<?php echo $d3[1]; ?>" style=" ">
					<input id="p9" name="year33"   maxlength="4"  class="input input_new01_03" placeholder="YYYY" type="text" value="<?php echo $d3[2]; ?>" style=" "></div>
            <div class="clear"></div>
            </div>
            <div class="min_list" >
                <div class="lis_50_left">Date Of Bond</div>
                <div class="lis_50_right">
				    <input id="p14" name="month22"  maxlength="2"  class="input input_new01_01" placeholder="MM" type="text" value="<?php echo $d2[0]; ?>" style=" ">
				    <input id="p15" name="day22"    maxlength="2"  class="input input_new01_02" placeholder="DD" type="text" value="<?php echo $d2[1]; ?>" style=" ">
					<input id="p16" name="year22"   maxlength="4"  class="input input_new01_03" placeholder="YYYY" type="text" value="<?php echo $d2[2]; ?>" style=" "></div>
            <div class="clear"></div>
            </div>
            <div class="min_list" >
                <div class="lis_50_left">Upload Photo</div>
                <div class="lis_50_right">
				<input type="hidden" name="uphoto" value="<?php echo $uphoto; ?>" />
				<input id="uphoto" name="uphoto" type="file" class="input"  value="<?php echo $uphoto; ?>">
				</div>
            <div class="clear"></div>
            </div>
            <div class="min_list" >
            	<div class="lis_50_left">&nbsp;</div>
                <div class="lis_50_right" style="text-align:right;"><input type="submit" name="edit" style="text-align:right;"></div>
            <div class="clear"></div>
            </div>
            
        <div class="clear"></div>
        </div>
        
        
    
    
    
    <div class="clear"></div>
    
	</div>
        
     </form>
     
     <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
      <script language="javascript" type="text/javascript">
          function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#image_upload_preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#inputFile").change(function () {
        readURL(this);
    });
      </script>

      
     <style>
     
     .login,.signup,.or{display:none;}
     
     .logout{display:block;}
     
     
     </style>           
     <style>
			.input_new01_01 { width:50px !important; float: left;}
			.input_new01_02 { width:50px!important; float: left; margin-left: 8px; margin-right: 6px;}
			.input_new01_03 { width:68px!important; float: left;}
			
		   </style>           
                
            
<?php 
} 
 
?>
<?php //print_r($_POST);?>	
<?php get_footer(); ?>

