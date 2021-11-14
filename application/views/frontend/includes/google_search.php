
<form action="<?php echo site_url("search");?>" id="cse-search-box" class="qsearch">
    <input type="hidden" name="cx" value="partner-pub-8259536416026944:8692765876" />
    <input type="hidden" name="cof" value="FORID:10" />
    <input type="hidden" name="ie" value="UTF-8" />
    <input type="text" name="q" size="18"  value="<?php if(isset($_GET['q'])) { echo $_GET['q']; }; ?>"  />
    <input class="go" type="submit" name="sa" value="Search" />
</form>
                        
<script type="text/javascript" src="http://www.google.com/coop/cse/brand?form=cse-search-box&amp;lang=en"></script>