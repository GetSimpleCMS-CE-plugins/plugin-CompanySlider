<?php
class CompanySlider
{
	public function changeUrl()
	{
		foreach (glob(GSDATAOTHERPATH . 'companySlider/*.json') as $file) {
			$fileContent = file_get_contents($file);
			$oldurl = str_replace('/', '\/', $_POST['oldurl']);
			$newurl = str_replace('/', '\/', $_POST['newurl']);
			$newContent = str_replace([$oldurl, $oldurl . '/'], [$newurl, $newurl . '/'], $fileContent);
			file_put_contents($file, $newContent);
		}
		echo '<div class="alert-carcreator">Done!</div>';
	}

	public function deleteFile()
	{
		global $GSADMIN;
		global $SITEURL;
		unlink(GSDATAOTHERPATH . 'companySlider/' . $_GET['delete'] . '.json');
		echo '<script>window.location.replace("' . $SITEURL . $GSADMIN . '/load.php?id=companySlider");</script>';
	}

	public function createFile()
	{

		$folder = GSDATAOTHERPATH . 'companySlider/';

		if (file_exists($folder) == null) {
			mkdir($folder, 0755);
			file_get_contents($folder . '.htaccess', 'Deny from all');
		}

		global $GSADMIN;
		global $SITEURL;
		$logoList = array();
		$logoList['logos'] = [];
		$logoList['settings'] = [];
		$logos = $_POST['image'];
		$width = $_POST['width'];
		$height = $_POST['height'];
		$logofit = $_POST['logofit'];
		$slidetoshow = $_POST['slidetoshow'];
		$slidestoscroll = $_POST['slidestoscroll'];
		$autoplay = $_POST['autoplay'];
		$autoplayspeed = $_POST['autoplayspeed'];
		$dots = $_POST['dots'];
		$fade = $_POST['fade'];
		$arrows = $_POST['arrows'];

		array_push($logoList['settings'], array('width' => $width));
		array_push($logoList['settings'], array('height' => $height));
		array_push($logoList['settings'], array('logofit' => $logofit));
		array_push($logoList['settings'], array('slidetoshow' => $slidetoshow));
		array_push($logoList['settings'], array('slidestoscroll' => $slidestoscroll));
		array_push($logoList['settings'], array('autoplay' => $autoplay));
		array_push($logoList['settings'], array('autoplayspeed' => $autoplayspeed));
		array_push($logoList['settings'], array('dots' => $dots));
		array_push($logoList['settings'], array('fade' => $fade));
		array_push($logoList['settings'], array('arrows' => $arrows));

		foreach ($logos as $key => $value) {
			array_push($logoList['logos'], $logos[$key]);
			$jser = json_encode($logoList, true);
			file_put_contents(GSDATAOTHERPATH . 'companySlider/' . @$_POST['title'] . '.json', $jser);
		};

		echo '<script>window.location.replace("' . $SITEURL . $GSADMIN . '/load.php?id=companySlider&edit=' . $_POST['title'] . '");</script>';
	}

	public function list($name)
	{
		$file = file_get_contents(GSDATAOTHERPATH . 'companySlider/' . $name . '.json');
		$js = json_decode($file, true);

		foreach ($js['logos'] as $value) {
			echo '
				<span class="monsterspan"> 
					<button class="closeThis" onclick="event.preventDefault();this.parentElement.remove()">✕</button>
					<img src="' . $value . '" >
					<input type="text" name="image[]" value = "' . $value . '" >
				</span>';
		}
	}

	public function frontlist($name)
	{
		global $SITEURL;

		$file = file_get_contents(GSDATAOTHERPATH . 'companySlider/' . $name . '.json');
		$js = json_decode($file, true);

		echo "<div class='" . $name . " ' style='width:90%;margin:0 auto; '>";

		foreach ($js['logos'] as $value) {
			echo '<div><img src="' . $value . '" style="display:block;margin:0 auto;width:' . $js['settings'][0]['width'] . ';height:' . $js['settings'][1]['height'] . ';object-fit:' . $js['settings'][2]['logofit'] . '"/></div>';
		}

		echo "</div>";

		echo '<script src="' . $SITEURL . 'plugins/companySlider/js/jquery-3.6.4.min.js"></script>';
		echo '<script src="' . $SITEURL . 'plugins/companySlider/js/slick.min.js"></script>';

		echo "
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
	}

	public function shortcode($matches)
	{
		global $SITEURL;

		$name = $matches[1];

		$file = file_get_contents(GSDATAOTHERPATH . 'companySlider/' . $name . '.json');
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
				fade:" . $js['settings'][8]['fade'] . "
			});
        </script>

        ";

		return $sponsor;
	}
};;
