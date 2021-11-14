<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Invoice - SCIENCEDOMAIN international</title>
</head>
<body style="font-family:arial;">

<form name="edit_invoice" id="" action="" method="post">
<input type="hidden" name="manuscript_id" value="<?php echo $this->uri->segment(4);?>" />
<table width="700" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
<td colspan="5">
<?php $this->load->view('backend/includes/messageblank');?>
</td>
</tr>
  <tr>
    <td colspan="5" style="font-size:34px"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="19%" rowspan="2"><img src="<?php echo base_url(); ?>assets/themes/frontend/images/invoice-logo.jpg" width="120" /></td>
        <td width="81%"><p align="center"><strong>SCIENCEDOMAIN  <em>international</em></strong><br />
          <em>                www.sciencedomain.org</em></p></td>
      </tr>
      <tr>
        <td style="text-align:right; font-size:20px; height:40px;">INVOICE<br /><span style="font-size:18px;">Date: <input type="text" name="invoice_date" style="width:100px;" id="" value="<?php echo $invoiccedetails['invoice_date'];?>" /><br /></span><br /><br /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="5" style="font-size:14px; border-top:#333333 2px solid; font-weight:bold;"><table width="450" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td width="104">Invoice No.</td>
    <td width="8">: </td>
    <td width="314"><input type="text" name="invoice_no" style="width:300px;" id="" value="<?php echo $invoiccedetails['invoice_no'];?>" /></td>
  </tr>
  <tr>
    <td>Login Id.</td>
    <td>: </td>
    <td><input type="text" name="login_id" style="width:300px;" id="" value="<?php echo $invoiccedetails['login_id'];?>" /></td>
  </tr>
  <tr>
    <td style="vertical-align:top;">Billed to</td>
    <td style="vertical-align:top;">:</td>
    <td><textarea name="billed_to" style="width:300px;" id=""><?php echo $invoiccedetails['billed_to'];?></textarea></td>
  </tr>
</table></td>
  </tr>
  <tr>
    <td colspan="5" style="font-size:24px"><table width="100%" border="0" cellspacing="0" cellpadding="4">
      <tr valign="top">
        <td width="40%" height="40" style="border-top:#666666 1px solid; border-bottom:#666666 1px solid; font-size:14px;border-right:#333333 1px solid; font-weight:bold;">Product</td>
        <td width="15%" style="border-top:#666666 1px solid; border-bottom:#666666 1px solid; font-size:14px;border-right:#333333 1px solid; font-weight:bold;">Quantity</td>
        <td width="15%" style="border-top:#666666 1px solid; border-bottom:#666666 1px solid; font-size:14px;border-right:#333333 1px solid; font-weight:bold;">Unit Price (USD)</td>
        <td width="15%" style="border-top:#666666 1px solid; border-bottom:#666666 1px solid; font-size:14px;border-right:#333333 1px solid; font-weight:bold;">Discount (USD)</td>
        <td width="25%" style="border-top:#666666 1px solid; border-bottom:#666666 1px solid; font-size:14px; font-weight:bold;">Total (USD)</td>
      </tr>
     <tr>
        <td style="border-right:#333333 1px solid; font-size:14px;">Article Processing charge for <br /><br />Manuscript No.: <strong>
		<input type="text" name="manuscript_no" style="width:200px;" id="" value="<?php  echo $invoiccedetails['manuscript_no'];?>" /></strong><br /><br />
		Manuscript Name.: <br /><br /><textarea name="manuscript_name" style="width:250px; height:100px;" id=""><?php echo $invoiccedetails['manuscript_name'];?></textarea></td>
        <td style="border-right:#333333 1px solid; font-size:14px;"><input type="text" name="quantity" style="width:60px;" id="" value="<?php echo $invoiccedetails['quantity'];?>" /></td>
        <td style="border-right:#333333 1px solid; font-size:14px;">$<input type="text" name="unitprice" style="width:60px;" id="" value="<?php echo $invoiccedetails['unitprice'];?>" /></td>
        <td style="border-right:#333333 1px solid; font-size:14px;">$<input type="text" name="discount" style="width:60px;" id="" value="<?php echo $invoiccedetails['discount'];?>" /></td>
        <td style="font-size:14px;">$<input type="text" name="total" style="width:60px;" id="" value="<?php echo $invoiccedetails['total'];?>" /></td>
      </tr>
      
      <tr valign="top">
        <td width="57%" height="40" style="border-top:#666666 1px solid;">&nbsp;</td>
        <td colspan="3" style="border-top:#666666 1px solid; font-size:18px; text-align:right;border-right:#333333 1px solid; padding-right:10px;">Total</td>
        <td width="16%" style="border-top:#666666 1px solid; font-size:14px; font-weight:bold;">$<input type="text" name="total_amount" style="width:60px;" id="" value="<?php echo $invoiccedetails['total_amount']?>" /></td>
      </tr>
      <tr valign="top">
        <td height="40" style="border-top:#666666 1px solid;">&nbsp;</td>
        <td colspan="3" style="border-top:#666666 1px solid; font-size:18px; text-align:right;border-right:#333333 1px solid; padding-right:10px;">Grand Total</td>
        <td style="border-top:#666666 1px solid; font-size:14px; font-weight:bold;">$<input type="text" name="grand_total_amount" style="width:60px;" id="" value="<?php echo $invoiccedetails['grand_total_amount'];?>" /></td>
      </tr>
<?php 
if(get_settings(2))
{
?>      
      <tr valign="top">
        <td height="40" colspan="5" style="font-size:11px; color:#666666;"><?php echo get_settings(2);?></td>
        </tr>     
<?php 
}
?>     
<tr valign="top">
        <td height="40" colspan="5" style="font-size:14px; color:#666666; text-align:right;"><input type="submit" name="submit" value="Update Invoice" />&nbsp;&nbsp;
        <input type="button" name="button" onClick="parent.location='<?php echo site_url($this->controller.'/printinvoice/'.$this->uri->segment(4));?>'" value="Print Invoice" />
        </td>
        </tr>
    </table></td>
  </tr>
</table>
</form>
        <form name="pdfdownload" target="_blank" action="http://pdfmyurl.com">
<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
	<td align="right"> 
<input type="hidden" name="url" value="<?php echo site_url('user/invoicehidden/'.$this->uri->segment(4));?>" />
<input type="hidden" name="--page-size" value="A4" />
<input type="hidden" name="filename" value="<?php  echo "SD_invoice_".str_replace("/","-",manuscriptNo($this->uri->segment(4)));?>.pdf" />
                    <input type="submit" value="Download" />
                    </td></tr></table>
                    </form>
</body>
</html>