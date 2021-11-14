

///////////////////////////validate_full_journal form 
function validate_full_journal_form(){
	var d=document.full_journal_form;
	
	  if(d.contact_person.value == "") {
		  alert("Please enter contact person name.");
		  d.contact_person.focus();
		  return false;
	  }	 		  
	  
	  if(d.email.value == "") {
		  alert("Please enter email address");
		  d.email.focus();
		  return false;
	  }	 		  
	  if(echeck(d.email.value)==false) {
		  d.email.focus();
		  return false;
	  }	 
	  
	  if(d.phone.value == "") {
		  alert("Please enter your phone");
		  d.phone.focus();
		  return false;
	  }	 
	  	  
	  if(d.address.value == "") {
		  alert("Please enter your address");
		  d.address.focus();
		  return false;
	  }	 	  
	  
	  if(d.country.value == "") {
		  alert("Please select your country name");
		  d.country.focus();
		  return false;
	  }	 
	  
	  if(d.state.value == "") {
		  alert("Please enter your state");
		  d.state.focus();
		  return false;
	  }	 	
	  
	  if(d.city.value == "") {
		  alert("Please enter your city");
		  d.city.focus();
		  return false;
	  }	 	
	  
	  if(d.zip.value == "") {
		  alert("Please enter your zip");
		  d.zip.focus();
		  return false;
	  }	 	
	  
	  if(d.total_amount.value == "") {
		  alert("Please select at least one journal to proceed.");
		  d.total_amount.focus();
		  return false;
	  }	 		  	  	  	  	  	  	  
	  
}
///////////////////////////manuscript form ends


///////////////////////////manuscript form 
function validate_request_discount(){
	var d=document.request_discount;
	
	  if(d.discount_percent.value == "0") {
		  alert("Discount Request should be greater than Zero");
		  d.discount_percent.focus();
		  return false;
	  }	 	
	
	  	  if(!d.agree.checked) {
		  alert("You must agree with with terms");
		  d.agree.focus();
		  return false;
	  }	 	  
	  
}
///////////////////////////manuscript form ends

///////////////////////////coupon validate form 
function validate_useCoupon(){
	var d=document.formname;
	
	  if(d.manuscript_id.value == "") {
		  alert("Please select the Manuscript");
		  d.manuscript_id.focus();
		  return false;
	  }	 	 
	  
}
///////////////////////////manuscript form ends



///////////////////////////manuscript form 
function validate_manuscript(){
	var d=document.manuscript;

	  if(d.main_cat.value == "") {
		  alert("Please select the subject for journal");
		  d.main_cat.focus();
		  return false;
	  }	 
	  
	  if(d.sub_cat.value == "") {
		  alert("Please select the journal");
		  d.sub_cat.focus();
		  return false;
	  }	 	
	  if(d.title.value == "") {
		  alert("Please enter the Manuscript Title");
		  d.title.focus();
		  return false;
	  }	 	
	  if(d.article_type.value == "") {
		  alert("Please enter the Article Type");
		  d.article_type.focus();
		  return false;
	  }	 		  
	  if(d.abstract.value == "") {
		  alert("Please enter the abstract");
		  d.abstract.focus();
		  return false;
	  }	 			  
	  if(d.keywords.value == "") {
		  alert("Please enter the keywords");
		  d.keywords.focus();
		  return false;
	  }	 	
	  
	  if(d.ca_name.value == "") {
		  alert("Please enter the Corresponding author name");
		  d.ca_name.focus();
		  return false;
	  }	 		  
	  if(d.ca_address.value == "") {
		  alert("Please enter the Corresponding author address");
		  d.ca_address.focus();
		  return false;
	  }	 			  
	  if(d.ca_email.value == "") {
		  alert("Please enter the Corresponding author email");
		  d.ca_email.focus();
		  return false;
	  }	 		  
	  if(echeck(d.ca_email.value)==false) {
		  d.ca_email.focus();
		  return false;
	  }	 	

	  if(d.ms_word_file.value == "") {
		  alert("Please upload the manuscript");
		  d.ms_word_file.focus();
		  return false;
	  }	 
	  
/*

if(Checkfiles(d.ms_word_file.value)) {
		  alert("Please upload the manuscript");
		  d.ms_word_file.focus();
		  return false;
	  }	 		  

*/	  
	  	  if(!d.agree.checked) {
		  alert("You must agree with with terms");
		  d.agree.focus();
		  return false;
	  }	 	  
	  
}


function Checkfiles(str)
{
//var fup = document.getElementById('filename');
//var fileName = fup.value;
var ext = str.substring(str.lastIndexOf('.') + 1);
if(ext == "gif" || ext == "GIF" || ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" || ext == "doc")
{
return true;
} 
else
{
alert("Upload Gif or Jpg images only");
d.ms_word_file.focus();
return false;
}
}

///////////////////////////manuscript form ends
///////////////////////////contact form
function validate_contact(){
	var d=document.contact;

	  if(d.name.value == "") {
		  alert("Please enter your name");
		  d.name.focus();
		  return false;
	  }	 	
	  if(d.affiliation.value == "") {
		  alert("Please enter company Name");
		  d.affiliation.focus();
		  return false;
	  }	 	
	  if(d.email.value == "") {
		  alert("Please enter your email");
		  d.email.focus();
		  return false;
	  }	 	
	  if(echeck(d.email.value)==false) {
		  d.email.focus();
		  return false;
	  }	 	    		  
	  if(d.contact_no.value == "") {
		  alert("Please enter your contact no.");
		  d.contact_no.focus();
		  return false;
	  }	 	
	  if(d.comments.value == "") {
		  alert("Please enter your comments");
		  d.comments.focus();
		  return false;
	  }	 		  
	  if(d.txtNumber.value == "") {
		  alert("Please enter code as shown in image");
		  d.txtNumber.focus();
		  return false;
	  }	 	  	  
	  
}
///////////////////////////comment form
 function validate_comment(){
	var d=document.comment;
	
	  if(d.name.value == "") {
		  alert("Please enter your Name");
		  d.name.focus();
		  return false;
	  }	 		
	  if(d.email.value == "") {
		  alert("Please enter your email");
		  d.email.focus();
		  return false;
	  }	 	
	  if(d.comment.value == "") {
		  alert("Please enter your comments");
		  d.comment.focus();
		  return false;
	  }	 		  
	  
}
///////////////////////////Main form
 function validate_main_login(){
	var d=document.main_login;
	
	  if(d.username.value == "") {
		  alert("Please enter your username/email");
		  d.username.focus();
		  return false;
	  }	 
	  
	  if(echeck(d.username.value)==false) {
		  d.username.focus();
		  return false;
	  }	 	  
	  	  
	  if(d.password.value == "") {
		  alert("Please enter your password");
		  d.password.focus();
		  return false;
	  }	 	  
	  
}
///////////////////////////Main form
 function validate_right_login(){
	var d=document.right_login;
	
	  if(d.username.value == "") {
		  alert("Please enter your username");
		  d.username.focus();
		  return false;
	  }	 		
	  if(d.password.value == "") {
		  alert("Please enter your password");
		  d.password.focus();
		  return false;
	  }	 	  
	  
}
///////////////////////////Main form
 function validate_forgot_pass(){
	var d=document.forgot_pass;
	
	  if(d.username.value == "") {
		  alert("Please enter your username");
		  d.username.focus();
		  return false;
	  }	 		
	  if(echeck(d.username.value)==false) {
		  d.username.focus();
		  return false;
	  }	 	    
	  if(d.txtNumber.value == "") {
		  alert("Please enter code as shown in image");
		  d.txtNumber.focus();
		  return false;
	  }	 	  
	  
}
///////////////////////////Register form
function validate_register_form()
{

	  if(document.register_form.role.value == "") {
		  alert("Please select your role");
		  document.register_form.role.focus();
		  return false;
	  }	 
	  
	  if(document.register_form.name.value == "") {
		  alert("Please enter your name");
		  document.register_form.name.focus();
		  return false;
	  }	 			  
	  if(document.register_form.username.value == "") {
		  alert("Please enter your username/email");
		  document.register_form.username.focus();
		  return false;
	  }	 
	  
	  if(echeck(document.register_form.username.value)==false) {
		  document.register_form.username.focus();
		  return false;
	  }	 	  

	  if(document.register_form.password.value == "") {
		  alert("Please enter your password");
		  document.register_form.password.focus();
		  return false;
	  }	 
	  if(document.register_form.cpassword.value == "") {
		  alert("Please confirm your password");
		  document.register_form.cpassword.focus();
		  return false;
	  }	 	
	  if(document.register_form.password.value != document.register_form.cpassword.value) {
		  alert("Both passwords must be same");
		  document.register_form.cpassword.focus();
		  return false;
	  }	 
	  
	  if(document.register_form.contact_no.value == "") {
		  alert("Please enter your Contact No");
		  document.register_form.contact_no.focus();
		  return false;
	  }	 
	  if(document.register_form.country.value == "") {
		  alert("Please select your country");
		  document.register_form.country.focus();
		  return false;
	  }	 	  
	  if(document.register_form.specilization_area1.value == "") {
		  alert("Please enter your Specialization Area");
		  document.register_form.specilization_area1.focus();
		  return false;
	  }	 	  
 	
	  if(document.register_form.ms_word_file.value != "") {
		  
	var extensions = new Array("doc","docx","pdf");
	
	/*
	// Alternative way to create the array
	
	var extensions = new Array();
	
	extensions[1] = "jpg";
	extensions[0] = "jpeg";
	extensions[2] = "gif";
	extensions[3] = "png";
	extensions[4] = "bmp";
	*/
	
	var image_file = document.register_form.ms_word_file.value;
	
	var image_length = document.register_form.ms_word_file.value.length;
	
	var pos = image_file.lastIndexOf('.') + 1;
	
	var ext = image_file.substring(pos, image_length);
	
	var final_ext = ext.toLowerCase();
	
	for (i = 0; i < extensions.length; i++)
	{
		if(extensions[i] == final_ext)
		{
		return true;
		}
	}
	
	alert("You must upload an image file with one of the following extensions: "+ extensions.join(', ') +".");
	return false;
	  }
	  
	  if(document.register_form.txtNumber.value == "") {
		  alert("Please enter code as shown in image");
		  document.register_form.txtNumber.focus();
		  return false;
	  }	 	 	  
	  
	  	  if(!document.register_form.agree.checked) {
		  alert("You must agree with with terms");
		  document.register_form.agree.focus();
		  return false;
	  }	 	  
	  
	  
	  
	}
	

function echeck(str) {

var at="@"
var dot="."
var lat=str.indexOf(at)
var lstr=str.length
var ldot=str.indexOf(dot)
if (str.indexOf(at)==-1){
alert("Please enter your valid email Id")
return false
}

if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
alert("Please enter your valid email Id")
return false
}

if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
alert("Please enter your valid email Id")
return false
}

if (str.indexOf(at,(lat+1))!=-1){
alert("Please enter your valid email Id")
return false
}

if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
alert("Please enter your valid email Id")
return false
}

if (str.indexOf(dot,(lat+2))==-1){
alert("Please enter your valid email Id")
return false
}

if (str.indexOf(" ")!=-1){
alert("Please enter your valid email Id")
return false
}

return true					
}
