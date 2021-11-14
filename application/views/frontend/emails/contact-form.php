<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<title>::. Global Pubplication Hub .::</title>
<style type="text/css">

body {
	margin: 20px;
	padding: 0px;
}
a {
	color: #c75460;
	text-decoration:none;
}
a:hover {
	color: #454545;
	text-decoration:none;
}
h1 {
	font-family: 'Oswald', sans-serif;
	font-size:24px;
	color:#e7d394;
	padding-top:10px;
	letter-spacing:1px;
	font-weight:normal;
}
p {
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	color:#454545;
	line-height:20px;
}

</style>
</head>
<body bgcolor="#fff">
<table border="0" align="center" cellpadding="0" cellspacing="0" style=" background:#e7d394;  border:1px solid #474747;">
  <tr>
    <td valign="top" align="left" style="padding:15px;"><table border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center" valign="top" style="background-color:#FFF; padding-top:10px;"><img src="<?php echo $logo_path; ?>" alt="<?php echo $site_name;?>" /></td>
        </tr>
        <tr>
          <td align="left" valign="top"  style="background:#FFF;  padding:15px;"><table width="544" border="0" cellspacing="0" >
            <tr>
              <td align="left" valign="top"><table width="500" border="0" cellspacing="4" cellpadding="4">
            <tr>
            	<td colspan="2" height="40"><strong>Enquiry Form - <?php echo $site_name;?></strong></td>
            </tr>
            <tr>
                <td width="145">Name</td>
                <td width="337"><?php echo $name; ?></td>
            </tr>
            <tr>
                <td width="145">Email</td>
                <td width="337"><?php echo $email;?></td>
            </tr>
            <tr>
                <td>Mobile</td>
                <td><?php echo $contact_no; ?></td>
            </tr>
            <tr>
                <td>Message</td>
                <td><?php echo $comments; ?></td>
            </tr>
            <tr>
                <td>IP Address</td>
                <td><?php echo $ip_address;?></td>
            </tr>  
        </table></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="center">&copy; <?php echo date("Y");?> <?php echo $site_name;?>.</td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>