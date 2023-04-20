<h3><?php echo i18n_r('companySlider/LANG_Migrate_CompanySlider') ;?></h3>

<form action="#" method="post" >
	<label for=""><?php echo i18n_r('companySlider/LANG_Old_URL') ;?></label>
	<input type="text" name="oldurl"  placeholder="https://youroldadress.com/">
	
	<label for=""><?php echo i18n_r('companySlider/LANG_New_URL') ;?></label>
	<input type="text" name="newurl" placeholder="https://yournewadress.com/">
	
	<input type="submit" name="changeURL"  value="<?php echo i18n_r('companySlider/LANG_Update_URL') ;?>">
</form>