/*.................Datepicker function.................................*/
jQuery.noConflict();
jQuery(function() {

});

jQuery(function() {
    jQuery('#datetimepicker3').datetimepicker({
      language: 'en',
      pick12HourFormat: true,
      pickTime: false
    });

     jQuery('#datetimepicker4').datetimepicker({
      language: 'en',
      pick12HourFormat: true,
      pickTime: false
    });
  });

/*.................Delete a email list from the coupo page.............*/
jQuery(document).ready(function() {

     jQuery("#delete-button").click(function(event){
      event.stopImmediatePropagation();
     if(confirm("Are you sure want to delete this?")){

        var id = [];
        jQuery(':checkbox:checked').each(function(i){
            id[i] = jQuery(this).val();
        });
        if(id.length === 0){
            alert('Please select at least one chechbox');
        }
        else{

            jQuery.ajax({
            type: "POST",
            url : "http://account.couponbutter.com/delete-cuppon/",
            data: {id:id}, 
            cache:false,
            dataType: "html",                
            success: function(){
                for(var i = 0; i<id.length; i++){
                jQuery('tr#'+id[i]+'').css('background-color', '#ccc');
                jQuery('tr#'+id[i]+'').fadeOut('2000');
                }
            }
        });

        }

     }
     else{
        return false;
     }

});
});
/*.....................Edit Account Details..................................*/
jQuery(document).ready(function(){
jQuery("#mytarget2").hide();
    jQuery("#makeEditable1").click(function(){
        jQuery('input[name="bname"]').removeAttr("readonly");
         jQuery("#mytarget2").show();
         jQuery("#mytarget1").hide();
    });   
    jQuery("#update-account").click(function(){
        var t1 = jQuery(this).data("uid");
        var upd_id= jQuery(this).attr('id');
        var why = jQuery('input[name="bname"]').val();
        jQuery.ajax({
        type: "POST",
        url : "http://account.couponbutter.com/update/",
        data: {val2:why,text12:t1}, 
        cache:false,
        dataType: "text",                
        success: function(data){
        if(data=="YES"){
        
        }else{
            jQuery( "#alert" ).append( "<p> successfully updated!!</p>" );
        }
        }
        });
    });
});
/*.....................Edit Account Address..................................*/
jQuery(document).ready(function(){

    jQuery("#mytarget4").hide();
    jQuery("#makeEditable2").click(function(){
        jQuery('input[name="baddress"]').removeAttr("readonly");
         jQuery("#mytarget4").show();
         jQuery("#mytarget3").hide();
    });

    
    jQuery("#update-account-address").click(function(){
        var t3 = jQuery(this).data("uid");
        
        var upd_id= jQuery(this).attr('id');
        var why3 = jQuery('input[name="baddress"]').val();
        
        jQuery.ajax({
        type: "POST",
        url : "http://account.couponbutter.com/update2/",
        data: {val2:why3,text12:t3}, 
        cache:false,
        dataType: "text",                
        success: function(data){
        
        if(data=="YES"){
       
        }else{
            jQuery( "#alert1" ).append( "<p> successfully updated!!</p>" );
        }
        }
        });
    });
});
/*.....................Edit Account Website..................................*/
jQuery(document).ready(function(){
	jQuery("#mytarget6").hide();
	jQuery("#makeEditable3").click(function(){
		jQuery('input[name="bsite"]').removeAttr("readonly");
		jQuery("#mytarget6").show();
		jQuery("#mytarget5").hide();
	});  
	jQuery("#update-account-website").click(function(){
		var t2 = jQuery(this).data("uid");        
		var upd_id= jQuery(this).attr('id');
		var why2 = jQuery('input[name="bsite"]').val();        
		jQuery.ajax({
			type: "POST",
			url : " http://account.couponbutter.com/update3/",
			data: {val2:why2,text12:t2}, 
			cache:false,
			dataType: "text",                
			success: function(data){        
			if(data=="YES"){       
			}else{
			jQuery( "#alert2" ).append( "<p> successfully updated!!</p>" );        
			}
			}
		});
	});
});

/*--------------------------------My Email List Insert----------------------------*/

jQuery(document).ready(function(){ 

/*	jQuery('select[name="number"]').on('change', function(){
        jQuery('#loadingmessage').show();
		var cou_name1 = jQuery(this).data("cname");    
		var cou_id1 = jQuery(this).data("cid");
		var cus_id1 = jQuery('select[name="number"]').val();
        //$('#loading').show();
		jQuery.ajax({
			type: "POST",
			url : "http://account.couponbutter.com/email-list-insert/",
			data: {cou_id:cou_id1,cus_id:cus_id1,cou_name:cou_name1}, 
			cache:false,
			dataType: "text",
			success: function(data){            
				if(data=="YES"){
					jQuery.ajax({
					type: "POST",
					url: "http://account.couponbutter.com/fetch-email-list/",
					data: {cou_id:cou_id1,cus_id:cus_id1,cou_name:cou_name1},
					success: function (data) {
					jQuery("#abc").append(data);
					jQuery("#abc").html(data);
					},
					error: function(){
					alert('error');
					} 
					});

				}
				else{
					jQuery.ajax({
					type: "POST",
					url: "http://account.couponbutter.com/fetch-email-list/",
					data: {cou_id:cou_id1,cus_id:cus_id1,cou_name:cou_name1},
					success: function (data) {
						jQuery('#loadingmessage').hide();
					jQuery("#abc").append(data);
					jQuery("#abc").html(data);
					},
					error: function(){
					alert('error');
					} 
					});
				}                
			},
			error: function(){

			}                

		}); 
	});*/
});

/*..........................Multiple select option..................................*/


jQuery(document).ready(function(){    
	jQuery("#selectall").click(function () {          
		jQuery('.case').prop('checked', this.checked);
	});    
});
/*.........................Delete a List Pop Msg...............................*/

jQuery(document).ready(function(){    
  jQuery(".listdel").click(function () {          
    if(confirm("Are you sure want to delete this?")){

      return true;
    }
    else{
        return false;
     }
  });    
});


/*.........................Multiple mail fire function............................*/

jQuery(document).ready(function(){

	/*jQuery("#send-button").click(function(event){

		event.stopImmediatePropagation();
		var t8 = jQuery(this).data("id");

		var id2 = [];


		jQuery(':checkbox:checked').each(function(i){
		//id2[i] = jQuery(this).val();
			id2[i] = jQuery(this).attr("data-eid");


		});
		if(id2.length === 0){
			alert('Please select at least one chechbox');
		}
		else{

			jQuery.ajax({
			type: "POST",
			url : "http://account.couponbutter.com/get-coupon/",
			data: {id2:id2,coup_id:t8}, 
			cache:false,
			dataType: "html",                
			success: function(data){                
			jQuery( "#alert2" ).append( "<p> Success : Mail was send </p>" );

			},
			error: function(data){
			alert('error');
			}     
			});

		}

	});*/
});


/*..................Delete Coupon From Manage Coupon Page.........................*/
jQuery(document).ready(function(){

jQuery('.Manacid').click(function(){
	if(confirm("Are you sure want to delete this?")){

           var mc_id = jQuery(this).attr('rel');
           //alert(mc_id);
           jQuery.ajax({
            type: "POST",
            url : "http://account.couponbutter.com/delete-manage-coupon/",
            data: {mc_id:mc_id}, 
            cache:false,
            dataType: "html",                
            success: function(data){

            	
                
                jQuery('tr#'+mc_id+'').css('background-color', '#ccc');
                jQuery('tr#'+mc_id+'').fadeOut('2000');
                
            }
        });
    }
    else{
        return false;
     }

});

});

/*....................................................................*/
jQuery(document).ready(function(){ 

  jQuery('select[name="number"]').on('change', function(event){
    event.stopImmediatePropagation();
    if(confirm("Are you sure want to assign this email list?")){
    var cou_name1 = jQuery(this).data("cname");
    var cus_id1 = jQuery('select[name="number"]').val();
    var cou_id1 = jQuery(this).data("cid");
    //alert(cus_id1);
    //alert(cou_id1);
      jQuery.ajax({
      type: "POST",
      url : "http://account.couponbutter.com/email-list-insert/",
      data: {cou_id:cou_id1,cus_id:cus_id1,cou_name:cou_name1}, 
      cache:false,
      dataType: "text",
      success: function(data){ 
        //alert('success');

      },
      error: function(data){
      //alert('error');
      }           
        
          });

       } 
  });

  jQuery('#demo').on('click', function (event) {
            if (jQuery('#sel1')[0].selectedIndex <= 0) {
              event.stopImmediatePropagation();              
              jQuery('div#myModal-get').hide();   
                alert("Please select the List");
            }
            else{
              jQuery('div#myModal-get').show();
              //alert("OK");
            }

        });

  jQuery('#demo1').on('click', function (event) {
            if (jQuery('#sel1')[0].selectedIndex <= 0) {
              event.stopImmediatePropagation();              
              jQuery('div#myModal-get').hide();   
                alert("Please select the List");
            }
            else{
              jQuery('div#myModal').show();
              //alert("OK");
            }

        });

  jQuery('.demo').on('click', function () {
            if (jQuery('#sel2')[0].selectedIndex <= 0) {
              
              jQuery('div#myModal-get').show();            
              
            }
  jQuery('.demo1').on('click', function () {
            if (jQuery('#sel2')[0].selectedIndex <= 0) {
              jQuery('div#myModal-get').show();            
              
            }          
            

        });
});
});

/*.................................excel download..........................*/

jQuery( document ).ready(function() {
    jQuery( "#table1" ).table_download({
        format: "xls",
        separator: ",",
        filename: "download",
        linkname: "Click here for XLS",
        quotes: "\""
    });
    
    jQuery( "#table1" ).table_download({
        format: "csv",
        separator: ",",
        filename: "download",
        linkname: "Export CSV",
        quotes: "\""
    });    
    
});
/*...............................Assign email list...........................*/

//jQuery(document).ready(function() {
//jQuery(document).one('load',function(){
  //jQuery(document).one('ready',function(){
  jQuery(window).load(function(){

    jQuery('#list-head').append(jQuery('.table_download_csv_link'));
    jQuery('#list-head').append(jQuery('.table_download_xls_link'));
    jQuery( 'a .table_download_xls_link' ).replaceWith( "Export XLS" );
  jQuery('.table_download_xls_link a').text("Export XLS");
  var couponid = jQuery('select[name="number2"]').attr('rel');    
  var customerid = jQuery('select[name="number2"]').val();    
    jQuery.ajax({
    type: "POST",
    url : "http://account.couponbutter.com/email-list-insert/",
    data: {customerid:customerid,couponid:couponid}, 
    cache:false,
    dataType: "text",
    success: function(data){ 
            //alert('success');
      jQuery.ajax({
        type: "POST",
        url: "http://account.couponbutter.com/fetch-email-list/",
        data: {customerid:customerid,couponid:couponid},
        success: function (data) {            
        jQuery("#abc").html(data);
        }
        });
           
      /*if(data=="YES"){         
      }
      else{
        jQuery.ajax({
        type: "POST",
        url: "http://account.couponbutter.com/fetch-email-list/",
        data: {customerid:customerid,couponid:couponid},
        success: function (data) {            
        jQuery("#abc").html(data);
        },
        error: function(){          
        } 
        });
      }   */            
    },
    error: function(){
      //alert('error');
    }               
    });

});
/*.................................Redemed using.........................*/
jQuery(document).ready(function(){ 

  jQuery('.sucreedeemed').on('click', function(){
    var scpnid = jQuery(this).data("rcid");
    var scqrc = jQuery(this).data("rqid");
    //alert(scpnid);
    //alert(scqrc);
    jQuery.ajax({
      type: "POST",
      url : "http://account.couponbutter.com/reedem-update/",
      data: {scpnid:scpnid,scqrc:scqrc}, 
      cache:false,
      dataType: "text",
      success: function(data){ 
        jQuery( "#sucreedeemed" ).append( "<p> This Coupon Successfully reedem </p>" );

      },
      error: function(data){
        //alert('error');
      jQuery( "#sucreedeemed" ).append( "<p> Error</p>" );
      }           
      });
  });
});


/*............................................................*/
jQuery(document).ready(function(){

jQuery('#cancel-membership').click(function(){
  if(confirm("Are you sure want to Cancel Your subscription?")){
     jQuery.ajax({
      type: "POST",
      url : "http://account.couponbutter.com/cancel-membership/",
      data: {}, 
      cache:false,
      dataType: "text",
      success: function(data){ 
       
        jQuery( "#cancel" ).append( "<p> Successfully Cancel Subscription </p>" );
         setTimeout(function(){
          jQuery("#cancel").remove();
           }, 5000);
      },
      error: function(data){
        jQuery( "#cancel" ).append( "<p> Successfully Cancel Subscription </p>" );
         setTimeout(function(){
          jQuery("#cancel").remove();
           }, 5000);
        
      }     
      });
  }
  });
});

/*..............................................................*/
jQuery(document).ready(function(){
jQuery('.dev').hide();

jQuery('select[name="fullstripe_plan"]').on('change', function(){
    var plan1 = jQuery('select[name="fullstripe_plan"]').val();    
    
if(plan1=='CBInd'){
jQuery('.dev').hide();
jQuery('.ind').show();
}
else{
jQuery('.ind').hide();
jQuery('.dev').show();
}
});
jQuery('#Change-membership').click(function(){
var plan = jQuery('select[name="fullstripe_plan"]').val();

var scpnid = jQuery(this).data("plan");
var id = jQuery("select[name='fullstripe_plan'] option:selected").attr("id");
//alert(id);
var ammount = jQuery("select[name='fullstripe_plan'] option:selected").attr("class");
//alert(ammount);


if (plan == id) {
  jQuery("#change").text("You have alredy running this subscription");
  setTimeout(function(){
jQuery("#change").remove();
}, 5000);
return false;
}
else{
  var plan = jQuery('select[name="fullstripe_plan"]').val();

if(confirm("Are you sure want to Change Your subscription Level?")){
jQuery.ajax({
type: "POST",
url : "http://account.couponbutter.com/change-membership-level/",
data: {plan:plan,ammount:ammount}, 
cache:false,
dataType: "text",
success: function(data){ 

jQuery( "#change" ).append( "<p> Successfully Change membership level </p>" );
setTimeout(function(){
jQuery("#change").remove();
}, 5000);
},
error: function(data){
jQuery( "#change" ).append( "<p> Successfully Change membership level </p>" );
setTimeout(function(){
jQuery("#change").remove();
}, 5000);
}         
});
}
}
});
});

