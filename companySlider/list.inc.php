<h3><?php echo i18n_r('companySlider/LANG_CompanySlider_List'); ?></h3>

<div class="col-md-12 py-2 px-0 mb-2">
	<a href="<?php echo $SITEURL . $GSADMIN . '/load.php?id=companySlider&addnew'; ?>" class="btn btn-add"><?php echo i18n_r('companySlider/LANG_Add_New'); ?></a>
	<a href="<?php echo $SITEURL . $GSADMIN . '/load.php?id=companySlider&migrator'; ?>" class="btn btn-migrate"><?php echo i18n_r('companySlider/LANG_Migrate'); ?></a>
</div>

<ul class="col-md-12 carList">

	<li class="list-item">
		<div class="title">
			<?php echo i18n_r('companySlider/LANG_Name'); ?>
		</div>
		<div class="shortcode">
			<?php echo i18n_r('companySlider/LANG_Shortcode'); ?>
		</div>
		<div class="list-btn" style="text-align:center;">
			<?php echo i18n_r('companySlider/LANG_Edit'); ?>
		</div>
	</li>

	<?php
	foreach (glob(GSDATAOTHERPATH . 'companySlider/*.json') as $item) {
		$name = pathinfo($item)['filename'];

		echo '
			<li class="list-item">
				<div class="title">
					<b>' . $name . '</b>
				</div>

				<div class="shortcode">
					<b>' . i18n_r('companySlider/LANG_ckEditor') . ':</b> <code style="text-align:center; color:green;">[% company=' . $name . ' %] </code><br> 
					<b>' . i18n_r('companySlider/LANG_Template') . '</b> <code style="text-align:center; color:blue;">&#60;?php showCompanySlider("' . $name . '");?&#62; </code>
				</div>

				<div class="list-btn" style="text-align:center;">
					<a href="' . $SITEURL . $GSADMIN . '/load.php?id=companySlider&edit=' . $name . '" class="btn btn-edit">' . i18n_r('companySlider/LANG_Edit') . '</a>
					<a href="' . $SITEURL . $GSADMIN . '/load.php?id=companySlider&delete=' . $name . '" onclick="return confirm(`Are you sure you want to delete this item?`);"  class="btn btn-del" title="' . i18n_r('companySlider/LANG_Delete') . '">✕</a>
				</div>
			</li>';
	}; ?>

</ul>