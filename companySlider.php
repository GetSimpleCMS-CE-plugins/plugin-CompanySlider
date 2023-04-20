<?php

# get correct id for plugin
$thisfile = basename(__FILE__, ".php");

# add in this plugin's language file
i18n_merge('companySlider') || i18n_merge('companySlider', 'en_US');

# register plugin
register_plugin(
	$thisfile, //Plugin id
	'companySlider',     //Plugin name
	'1.1',         //Plugin version
	'Multicolor',  //Plugin author
	'http://www.paypal.me/multicol0r', //author website
	i18n_r('companySlider/LANG_Description'), //Plugin description
	'pages', //page type - on which admin tab to display
	'companySlider'  //main function (administration)
);

include GSPLUGINPATH . 'companySlider/companySlider.class.php';

# add a link in the admin tab 'theme'
add_action('pages-sidebar', 'createSideMenu', array($thisfile, i18n_r('companySlider/LANG_Settings')));

function companySlider()
{

	global $SITEURL;
	global $GSADMIN;

	$companySlider = new CompanySlider();

	echo '<style>@import url("' . $SITEURL . 'plugins/companySlider/css/backend.css");</style>';

	echo '<div class="carCreator">';

	if (isset($_GET['addnew']) || isset($_GET['edit'])) {
		include GSPLUGINPATH . 'companySlider/addNew.inc.php';
	} elseif (isset($_GET['migrator'])) {
		include GSPLUGINPATH . 'companySlider/migrate.inc.php';
	} else {
		include GSPLUGINPATH . 'companySlider/list.inc.php';
	}

	if (isset($_GET['delete'])) {
		$companySlider->deleteFile($_GET['delete']);
	}

	echo '
			<div class="sponsor">
				<p class="lead">' . i18n_r('companySlider/LANG_PayPal') . '</p>
				<a href="https://www.paypal.com/donate/?hosted_button_id=TW6PXVCTM5A72">
					<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif"  />
				</a>
			</div>
			';
	echo '
		</div>';

	//magic

	if (isset($_POST['changeURL'])) {
		$companySlider->changeUrl();
	}

	if (isset($_POST['createFile'])) {
		$companySlider->createFile();
	};
};

add_action('theme-header', 'styleCompanySlider');

function styleCompanySlider()
{
	global $SITEURL;
	global $GSADMIN;
	echo '<link rel="stylesheet" href="' . $SITEURL . 'plugins/companySlider/css/slick.css">';
	echo '<link rel="stylesheet" href="' . $SITEURL . 'plugins/companySlider/css/slick-theme.css">';
}

function showCompanySlider($name)
{
	$companySlider = new CompanySlider();
	$companySlider->frontList($name);
};

add_action('theme-header', 'pageBeginCompanySlider');
function pageBeginCompanySlider()
{
	global $content;
	$newcontent = preg_replace_callback(
		'/\\[% company=(.*) %\\]/i',
		'runCompanyShortcode',
		$content
	);
	$content = $newcontent;
};

function runCompanyShortcode($matches)
{
	global $SITEURL;

	$name = $matches[1];

	$file = file_get_contents(GSDATAOTHERPATH. 'companySlider/' . $name . '.json');
	$js = json_decode($file, true);

	$sponsor = '';

	$sponsor .= "<div class='" . $name . "' style='width:98%;margin:0 auto;'>";

	foreach ($js['logos'] as $value) {
		$sponsor .= '<div><img src="' . $value . '" style="display:block;margin:0 auto;width:' . $js['settings'][0]['width'] . ';height:' . $js['settings'][1]['height'] . ';object-fit:' . $js['settings'][2]['logofit'] . '"/></div>';
	}

	$sponsor .= "</div>";

	$sponsor .= '<script src="' . $SITEURL . 'plugins/companySlider/js/jquery-3.6.4.min.js"></script>';
	$sponsor .= '<script src="' . $SITEURL . 'plugins/companySlider/js/slick.min.js"></script>';

	$sponsor .=  "
	   
		<script>
			$('." . $name . "').slick({
				slidesToShow: " . $js['settings'][3]['slidetoshow'] . ",
				slidesToScroll: " . $js['settings'][4]['slidestoscroll'] . ",
				autoplay: " . $js['settings'][5]['autoplay'] . ",
				autoplaySpeed: " . $js['settings'][6]['autoplayspeed'] . ",
				dots:" . $js['settings'][7]['dots'] . ",
				fade:" . $js['settings'][8]['fade'] . ",
				arrows:" . $js['settings'][9]['arrows'] . ",
				infinite: true,
				adaptiveHeight:true,

				responsive: [
					{
						breakpoint: 480,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
							fade:true,
							dots:false,
							arrows:true,
							infinite: true,
						}
					}
				]
			});
		</script>

		";

	return $sponsor;
};
