        <?php $this->load->view('frontend/includes/slider');?>
        
                <!----second2-row-body-contant-->
        <div class="second2-row">
        	<div class="container">
            	<div class="row">
                	<!----about us--- pages-->
                    <div class="col-lg-9 border-right">
                    	<div class="about_left">
                        	<h2>Advanced Search <?php if(isset($_GET['q'])) { echo '- '.$_GET['q']; }; ?></h2>



                                        <div style="margin:10px; padding:10px; height:400px; border-bottom:#CCC 1px solid; background-color:#eeecec; border:#CCC 1px solid; min-height:440px;">

<div class="searchFormBg">
		<div class="show-no">        
        <input type="text" maxlength="256" value="" style="width:300px;" id="keyword" name="keyword">
      	</div>  
		<div>        
        <label for="SearchText" class="searchFormLabel"><strong>Search</strong>&nbsp;</label>
      </div>       
      <div>
      	
        <input type="text" maxlength="256" value="<?php echo @$getvars['q1'];?>" style="width:300px;" id="q1" name="q1">
        &nbsp;&nbsp;in&nbsp;&nbsp;
          <select size="1" id="q1f" name="q1f">
          <option selected="" value="">All Fields</option>
          <option value="B.name" <?php if(@$getvars['q1f'] == 'B.name') { echo 'selected="selected"'; }?>>Title</option>
          <option value="A.issn" <?php if(@$getvars['q1f'] == 'A.issn') { echo 'selected="selected"'; }?>>ISSN</option>
          <option value="B.abstract" <?php if(@$getvars['q1f'] == 'B.abstract') { echo 'selected="selected"'; }?>>Abstract</option>          
          <option value="B.authors" <?php if(@$getvars['q1f'] == 'B.authors') { echo 'selected="selected"'; }?>>Authors</option>          
          <option value="B.keywords" <?php if(@$getvars['q1f'] == 'B.keywords') { echo 'selected="selected"'; }?>>Keywords</option>
          <option value="B.full_text" <?php if(@$getvars['q1f'] == 'B.full_text') { echo 'selected="selected"'; }?>>Full Text</option>
  </select>
      </div>
      
<div style="margin:10px 0;">        
          <select id="opr" name="opr">
          <option value="and" <?php if(@$getvars['opr'] == 'and') { echo 'selected="selected"'; }?>>And</option>
          <option value="or" <?php if(@$getvars['opr'] == 'or') { echo 'selected="selected"'; }?>>Or</option>
          <option value="not" <?php if(@$getvars['opr'] == 'not') { echo 'selected="selected"'; }?>>And Not</option>
          </select>
      </div>      
      
<div>        
        <input type="text" maxlength="256" value="<?php echo @$getvars['q2'];?>"  style="width:300px;" id="q2" name="q2">
        &nbsp;&nbsp;in&nbsp;&nbsp;
          <select size="1" id="q2f" name="q2f">
 		<option selected="" value="">All Fields</option>
          <option value="B.name" <?php if(@$getvars['q2f'] == 'B.name') { echo 'selected="selected"'; }?>>Title</option>
          <option value="A.issn" <?php if(@$getvars['q2f'] == 'A.issn') { echo 'selected="selected"'; }?>>ISSN</option>
          <option value="B.abstract" <?php if(@$getvars['q2f'] == 'B.abstract') { echo 'selected="selected"'; }?>>Abstract</option>          
          <option value="B.authors" <?php if(@$getvars['q2f'] == 'B.authors') { echo 'selected="selected"'; }?>>Authors</option>          
          <option value="B.keywords" <?php if(@$getvars['q2f'] == 'B.keywords') { echo 'selected="selected"'; }?>>Keywords</option>          
          <option value="B.full_text" <?php if(@$getvars['q2f'] == 'B.full_text') { echo 'selected="selected"'; }?>>Full Text</option>
          </select>
      </div>      
      </div>
	 
	  
	   <div style="clear:both;"></div>
	  <div style="margin:10px 0;">
	  <label for="Subject" class="searchFormLabel">Subject&nbsp;<span class="SDtxtNoteSmall">(select one or more)</span></label></div>
	  <div>
	  <div style="margin-right:10px;display:inline;float:left;"><select size="4" name="sb" id="sb" style="width:300px;">
      
      <option selected="" value=""> - All Subjects -</option>
<?php if(!empty($subjects))
{
	foreach($subjects as $value)
	{
?>                                              
                                              <option value="<?php echo $value['Id'];?>" <?php if($value['Id'] == @$getvars['sb']) { echo 'selected="selected"'; } ?>><?php echo $value['name'];?></option>
<?php
	}
}
?>           
      </select></div>
	  <!--<div style="display:inline;" class="txtSmall">Hold down the Ctrl key (or Apple Key) <br>to select multiple entries.</div>-->
      </div>
	   <div style="clear:both;"></div>
	  
	  
	  <div style="margin:10px 0;">
	  <label for="dateSelectRadio" class="searchFormLabel">Date Range</label>
	  <div>
      <input type="radio" value="1" name="yearOpt" <?php if(@$getvars['yearOpt'] !='2') { echo 'checked="checked"'; }?> id="yearOpt1" style="cursor: pointer;margin-left:0;">
      <label for="allYears">All Years</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="radio" value="2" name="yearOpt" id="yearOpt2" style="cursor:pointer;" <?php if(@$getvars['yearOpt']=='2') { echo 'checked="checked"'; }?> >
      <select size="1" name="fromDate" id="fromDate">
		<?php 
        $range = range(date('Y'),2000);
        foreach($range as $value)
        {
        ?>          
              <option value="<?php echo $value;?>" <?php if($value == @$getvars['fromDate']) { echo 'selected="selected"'; }?>><?php echo $value;?></option>
         <?php 
        }
        ?>       
      </select>             
                  &nbsp;to:&nbsp;
      <select size="1" name="toDate" id="toDate">
		<?php 
        $range = range(date('Y'),2000);
        foreach($range as $value)
        {
        ?>          
              <option value="<?php echo $value;?>" <?php if($value == @$getvars['toDate']) { echo 'selected="selected"'; }?>><?php echo $value;?></option>
         <?php 
        }
        ?>                      
      </select></div>
	  </div>
      
      
	<div>        
        <label for="SearchText" class="searchFormLabel">Volume&nbsp;</label>
        <input type="text" maxlength="256" value="<?php echo @$getvars['v'];?>" size="12" id="v" name="v"><label for="SearchText" class="searchFormLabel">&nbsp;Issue&nbsp;</label>
        <input type="text" maxlength="256" value="<?php echo @$getvars['i'];?>" size="12" id="i" name="i">&nbsp;Page&nbsp;</label>
        <input type="text" maxlength="256" value="<?php echo @$getvars['p'];?>" size="12" id="p" name="p">
        
        
    </div>	  

<div style="clear:both;">
  <input type="button" id="Search" name="Search" value="Search" class="button" >&nbsp;&nbsp;
  <input class="buttons" type="button" value="Reset" onclick="parent.location='<?php echo site_url('advancedsearch');?>'" />
</div>
 </div>
                                        
  <div id="highlight-plugin">                                  
<?php
if(!empty($coloums))
{
	foreach($coloums as $key=>$value)
	{
?>    
                                    
        <div id="BOX2_content" style="margin:10px; padding-bottom:0px; height:120px; border-bottom:#CCC 1px solid;">
            <p id="BOX_contentHEADING_AS">
                <a href="<?php echo site_url('abstract'.$value['Id'])?>">
                    <?php echo get_dots_new('articles','name',$value['Id'],200);?>
                </a>
            </p>
			<p id="BOX_content">
            	<em>
					<?php if($value['journalName']) { echo $value['journalName']; }?>, 
  					<?php if($value['volume']) { echo "Volume: ".$value['volume'].", "; }?>
					<?php if($value['issue'] and $value['year']) { echo "Issue: " .$value['issue']." ".$value['year'].", "; }?>
                    <?php if($value['page_no']) { echo "Pages: ".$value['page_no']; }?>
				</em>
			</p>
			<p id="BOX_content">
				<?php echo get_dots_new('articles','abstract',$value['Id'],250);?>
            </p>
		</div>
        <div class="pagination" style="text-align:left; padding-left:10px;"><?php echo $pagination;?></div>
        <div class="pagination" style="text-align:left; padding-left:10px;">
            	You are seeing <?php echo $startvalue;?> to <?php echo $endvalue;?> of total <?php echo $totalvalue;?> records
	    </div>        
<?php
	}
}
else
{
?>
	<div style="text-align:left; padding-left:10px; color:#FF0000">No matched results, please try another keyword.</div>    
        <?php } ?>

                                       </div>             


                        </div>
                    </div>
                    	<?php $this->load->view('frontend/includes/right');?> 
                </div>
            </div>
        </div>

<script>
		$( "#Search" ).click(function() 		
		{
			q1 = $( "#q1" ).val();
			q1f = $( "#q1f" ).val();
			opr = $( "#opr" ).val();
			q2 = $( "#q2" ).val();
			q2f = $( "#q2f" ).val();
			sb = $( "#sb" ).val();

			if($('#yearOpt1').prop("checked") == true)
			{
				yearOpt = 1;
			}
			else
			{
				yearOpt = 2;
			}
			
			fromDate = $( "#fromDate" ).val();
			toDate = $( "#toDate" ).val();
			v = $( "#v" ).val();
			i = $( "#i" ).val();
			p = $( "#p" ).val();

			window.location.href = '<?php echo site_url('advancedsearch');?>/'+'filter-q1:'+q1+'-q1f:'+q1f+'-opr:'+opr+'-q2:'+q2+'-q2f:'+q2f+'-sb:'+sb+'-yearOpt:'+yearOpt+'-fromDate:'+fromDate+'-toDate:'+toDate+'-v:'+v+'-i:'+i+'-p:'+p;
			
		});	
</script>