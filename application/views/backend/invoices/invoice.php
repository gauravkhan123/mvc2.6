<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Invoice - SCIENCEDOMAIN international</title>
</head>
<body style="font-family:arial;">
<table width="700" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td colspan="5"></td>
  </tr>
  <tr>
    <td colspan="5" style="font-size:34px"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="19%" rowspan="2"><img src="<?php echo base_url(); ?>assets/themes/frontend/images/invoice-logo.jpg" width="120" /></td>
        <td width="81%"><p align="center"><strong>SCIENCEDOMAIN  <em>international</em></strong><br />
          <em>                www.sciencedomain.org</em></p></td>
      </tr>
      <tr>
        <td style="text-align:right; font-size:20px; height:40px;">INVOICE<br /><span style="font-size:18px;">Date: <?php echo substr($orderdata['date'],0,10);?><br /></span></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="5" style="font-size:14px; border-top:#333333 2px solid; font-weight:bold;"><table width="450" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td width="104">Order No.</td>
    <td width="8">: </td>
    <td width="314"><?php echo 10000+$orderdata['Id'];?></td>
  </tr>
  <tr>
    <td>Login Id.</td>
    <td>: </td>
    <td><?php echo $authordata['username'];?></td>
  </tr>
  <tr>
    <td style="vertical-align:top;">Billed to</td>
    <td style="vertical-align:top;">:</td>
    <td><?php echo $authordata['name'];?><br />
    <?php echo $authordata['username'];?><br />
    <?php echo get_corresponing_value('countries','name',$authordata['country'],'Id');?><br />
    <?php echo $authordata['contact_no'];?></td>
  </tr>
</table></td>
  </tr>
  <tr>
    <td colspan="5" style="font-size:24px"><table width="100%" border="0" cellspacing="0" cellpadding="4">
      <tr valign="top">
        <td width="57%" height="40" style="border-top:#666666 1px solid; border-bottom:#666666 1px solid; font-size:14px;border-right:#333333 1px solid; font-weight:bold;">Product</td>
        <td width="8%" style="border-top:#666666 1px solid; border-bottom:#666666 1px solid; font-size:14px;border-right:#333333 1px solid; font-weight:bold;">Quantity</td>
        <td width="10%" style="border-top:#666666 1px solid; border-bottom:#666666 1px solid; font-size:14px;border-right:#333333 1px solid; font-weight:bold;">Unit Price (USD)</td>
        <td width="9%" style="border-top:#666666 1px solid; border-bottom:#666666 1px solid; font-size:14px;border-right:#333333 1px solid; font-weight:bold;">Discount (USD)</td>
        <td width="16%" style="border-top:#666666 1px solid; border-bottom:#666666 1px solid; font-size:14px; font-weight:bold;">Total (USD)</td>
      </tr>
     <tr>
        <td style="border-right:#333333 1px solid; font-size:14px;">Publication fee for Manuscript No.: <strong>
		<?php  echo substr($manuscriptdata['date'],0,4)."/"?><?php echo get_short_name($manuscriptdata['journal_id'])?><?php echo "/". $manuscriptdata['Id'];?></strong><br /><br />
		Manuscript Name.: <br /><br /><?php echo $manuscriptdata['title']?></td>
        <td style="border-right:#333333 1px solid; font-size:14px;"><?php echo $orderdata['qty']?></td>
        <td style="border-right:#333333 1px solid; font-size:14px;">$<?php echo $orderdata['unitprice']?></td>
        <td style="border-right:#333333 1px solid; font-size:14px;">$<?php echo $orderdata['discount']?></td>
        <td style="font-size:14px;">$<?php echo $orderdata['payment']?></td>
      </tr>
      <tr>
        <td height="100" style="border-right:#333333 1px solid;">&nbsp;</td>
        <td style="border-right:#333333 1px solid;">&nbsp;</td>
        <td style="border-right:#333333 1px solid;">&nbsp;</td>
        <td style="border-right:#333333 1px solid;">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr valign="top">
        <td width="57%" height="40" style="border-top:#666666 1px solid;">&nbsp;</td>
        <td colspan="3" style="border-top:#666666 1px solid; font-size:18px; text-align:right;border-right:#333333 1px solid; padding-right:10px;">Total</td>
        <td width="16%" style="border-top:#666666 1px solid; font-size:14px; font-weight:bold;">$<?php echo $orderdata['payment']?></td>
      </tr>
   <!--   <tr valign="top">
        <td height="40" style="border-top:#666666 1px solid;">&nbsp;</td>
        <td colspan="3" style="border-top:#666666 1px solid; font-size:18px; text-align:right;border-right:#333333 1px solid; padding-right:10px;">Tax</td>
        <td style="border-top:#666666 1px solid; font-size:14px; font-weight:bold;">0</td>
      </tr>-->
      <tr valign="top">
        <td height="40" style="border-top:#666666 1px solid;">&nbsp;</td>
        <td colspan="3" style="border-top:#666666 1px solid; font-size:18px; text-align:right;border-right:#333333 1px solid; padding-right:10px;">Grand Total</td>
        <td style="border-top:#666666 1px solid; font-size:14px; font-weight:bold;">$<?php echo $orderdata['payment']?></td>
      </tr>
<?php 

if(get_settings(5))
{
?>      
      <tr valign="top">
        <td height="40" colspan="5" style="font-size:11px; color:#666666;"><?php echo get_settings(2);?></td>
        </tr>     
<?php 
}
?>     
<tr valign="top">
        <td height="40" colspan="5" style="font-size:14px; color:#666666; text-align:right;"><a href="javascript:print();">Print</a></td>
        </tr>
    </table></td>
  </tr>
</table>
</body>
</html>