<script>
  function namevalidate()
	 {	  
		var name=document.getElementById('service_provider_fname').value;
		var alphaExp = /^[a-zA-Z .]+$/;
		if(name!="" && name.match(alphaExp))
		 {
			document.getElementById('service_provider_fname').style.borderColor = "";
			document.getElementById('service_provider_fname').title = "";
		 }
		 else
		 {
		    document.getElementById('service_provider_fname').value='';
			document.getElementById('service_provider_fname').style.borderColor = "red";
			document.getElementById('service_provider_fname').title = "Must be alphabet!";
		 }
    }
  </script>
  
<script>
  function number_validate()
	 {	  
		var name=document.getElementById('number_type').value;
		var alphaExp = /^[0-9.]+$/;
		if(name!="" && name.match(alphaExp))
		 {
			document.getElementById('number_type').style.borderColor = "";
			document.getElementById('number_type').title = "";
		 }
		 else
		 {
		    document.getElementById('number_type').value='';
			document.getElementById('number_type').style.borderColor = "red";
			document.getElementById('number_type').title = "Must be numerical!";
		 }
    }
  </script>
  
<script>
function re_send_otp(id)
{
    $.ajax({type:'POST',url:'re_send_otp.php',data:{id:id},success:function(result){
	if(result=='yes')
	{
		 alert("OTP Send on your phone");
	}
}});
      
}
		</script>
  
<script>
  function mobilevalidate()
	 {	  
	 
		var mobile=document.getElementById('service_provider_phone').value;
		
		var alphaExp = /^[0-9 +]+$/;
		if(mobile!="" && mobile.match(alphaExp) && mobile.length <= 14 && mobile.length >= 10)
		 {
			document.getElementById('service_provider_phone').style.borderColor = "";
			document.getElementById('service_provider_phone').title = "";
		 }
		 else
		 {
		    document.getElementById('service_provider_phone').value='';
			document.getElementById('service_provider_phone').style.borderColor = "red";
			document.getElementById('service_provider_phone').title = "Required 10 digits/ Must be Number!";
		 }
		 
		
    }
  </script>
  
<script>
  function emailvalidate()
	 {
		 var email=document.getElementById('service_provider_email').value;
		 if(email!="" && email.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/))
		 {		 
			 $.ajax({
				 type: "POST",
				 data: {email: email},
				 url: "emailvalidate.php",
				 success: function(msg){
					 //alert(msg);
					 if(msg=="available")
					 {
						 document.getElementById('service_provider_email').style.borderColor = "";
						 document.getElementById('service_provider_email').title = "";
					 }
					 else
					 {
						document.getElementById('service_provider_email').value='';
						document.getElementById('service_provider_email').style.borderColor = "red";
						document.getElementById('service_provider_email').title = "Email already exists!";
					 }
					 }
				 });		
		 }
		 else
		  {
		  	document.getElementById('service_provider_email').value='';
			document.getElementById('service_provider_email').style.borderColor = "red";
			document.getElementById('service_provider_email').title = "Must be email!";
		  }
	}
  </script>
  
<script>
  function old_password_validate()
	 {
		 var pass=document.getElementById('old_password').value;
		 if(pass!="")
		 {		 
			 $.ajax({
				 type: "POST",
				 data: {pass: pass},
				 url: "old_password_validate.php",
				 success: function(msg){
					 //alert(msg);
					 if(msg=="available")
					 {
						 document.getElementById('old_password').style.borderColor = "";
						 document.getElementById('old_password').title = "";
					 }
					 else
					 {
						document.getElementById('old_password').value='';
						document.getElementById('old_password').style.borderColor = "red";
						document.getElementById('old_password').title = "Worng Password!";
					 }
					 }
				 });		
		 }
		 else
		  {
		  	document.getElementById('service_provider_email').value='';
			document.getElementById('service_provider_email').style.borderColor = "red";
			document.getElementById('service_provider_email').title = "Must be email!";
		  }
	}
  </script>
  
<script>
	function passvalidate()
	 {	 
		var pass=document.getElementById('passworduser').value;
		var cpass=document.getElementById('cpasswordUser').value;
		 var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{8,}$/;
		var len=pass.length;
		if(len!='' && pass.match(re))
		{
			document.getElementById('passworduser').style.borderColor = "";
			document.getElementById('passworduser').title = "";
		}
		else
		{
			document.getElementById('passworduser').value='';
			document.getElementById('cpasswordUser').value='';
			document.getElementById('passworduser').style.borderColor = "red";
			document.getElementById('passworduser').title = "The password must be contain At least eight characters, one small letter, one Captial Letter, One Numerical digit.";
			
		}
	}
		 
	function onFocusev()
	{
		document.getElementById('cpasswordUser').value='';
		document.getElementById('passworduser').value='';
	}
	
	function conformval()
	{	 
		var cpass=document.getElementById('cpasswordUser').value;
		var pass=document.getElementById('passworduser').value;
		var len=cpass.length;
		if(len!=0)
		{
			if(cpass==pass)
			 {
				document.getElementById('passworduser').style.borderColor = "";
				document.getElementById('passworduser').title = "";
				document.getElementById('cpasswordUser').style.borderColor = "";
				document.getElementById('cpasswordUser').title = "";
		 	 }
			 else
		 	 {
				document.getElementById('cpasswordUser').value='';
				document.getElementById('cpasswordUser').style.borderColor = "red";
			 }
		}
		else
			{
				document.getElementById('cpasswordUser').value='';
				document.getElementById('cpasswordUser').style.borderColor = "red";
			}
		}
	</script>
    
<script>
   function get_city(str) {
    var dataString = 'city_id='+str;
    
    $.ajax({
      type:'POST',
      data:dataString,
      url:'get_city.php',
      success:function(data) {
         $("#city").html(data);
		 
      }
    });
  }
</script>

<script>
   function get_city1(str) {
    var dataString = 'city_id='+str;
    
    $.ajax({
      type:'POST',
      data:dataString,
      url:'get_city1.php',
      success:function(data) {
         $("#city1").html(data);
		 
      }
    });
  }
</script>

<script>
    function deleteupload_doc(id)
    {
      var x = confirm("Are you sure you want to delete?");
    if (x)
      {
         $.ajax({type:'POST',url:'deleteupload_doc.php',data:{id:id},success:function(result){
     if(result=='yes')
     {
     // alert(result);
     alert("Doc has been deleted successfully");
     $('#sessiondiv'+id).hide();
     }
     else
     {
     //alert(result);
      alert("Doc has been deleted successfully");
     $('#sessiondiv'+id).hide();
     }
      }});
      }
      else
      alert("Not Deleted");
    }
    </script>
    
<script>
    function delete_bank(id)
    {
      var x = confirm("Are you sure you want to delete?");
    if (x)
      {
         $.ajax({type:'POST',url:'delete_bank.php',data:{id:id},success:function(result){
     if(result=='yes')
     {
     // alert(result);
     alert("Bank detail has been deleted successfully");
     $('#sessiondiv'+id).hide();
     }
     else
     {
     //alert(result);
      alert("Bank detail has been deleted successfully");
     $('#sessiondiv'+id).hide();
     }
      }});
      }
      else
      alert("Not Deleted");
    }
    </script>