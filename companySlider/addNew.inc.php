<form method="post">
    <h3 style="margin:0;padding:0;"><?php echo i18n_r('companySlider/LANG_Add_New_CS') ;?></h3>
    <input type="text" required name="title" placeholder="<?php echo i18n_r('companySlider/LANG_Title_without_spaces') ;?>" pattern="[a-zA-Z0-9]+" <?php if (isset($_GET['edit'])) {
                                                                                                    echo 'value="' . $_GET['edit'] . '"';
                                                                                                }; ?>>

    <button class="btn btn-add addNew"><?php echo i18n_r('companySlider/LANG_Add_New') ;?></button>
    <a href="<?php echo $SITEURL . $GSADMIN; ?>/load.php?id=companySlider" class="btn btn-migrate"><?php echo i18n_r('companySlider/LANG_Back_to_List') ;?></a>

    <?php
		if (isset($_GET['edit'])) {
			$js = file_get_contents(GSDATAOTHERPATH . 'companySlider/' . $_GET['edit'] . '.json');
			$con = json_decode($js, true);
		}; 
	;?>

    <div style="border:solid 1px #ddd;padding:10px;margin-top:20px;">
        <button class="btn btn-migrate showsettings"><?php echo i18n_r('companySlider/LANG_Show_Hide') ;?></button>
    </div>

    <div class="settings config">

        <p style="margin:0;padding:0"><?php echo i18n_r('companySlider/LANG_Logo_Width') ;?>: </p>
        <input type="text" required name="width" placeholder="100px" <?php if (isset($_GET['edit'])) {
                                                        echo 'value="' . $con['settings'][0]['width'] . '"';
                                                    }; ?>>

        <p style="margin:0;padding:0"><?php echo i18n_r('companySlider/LANG_Logo_Height') ;?>: </p>
        <input type="text" required name="height" placeholder="100px" <?php if (isset($_GET['edit'])) {
                                                        echo 'value="' . $con['settings'][1]['height'] . '"';
                                                    }; ?>>

        <p style="margin:0;padding:0"><?php echo i18n_r('companySlider/LANG_Logo_Fit') ;?>: </p>
        <select name="logofit" required>
            <option value="contain" <?php if (isset($_GET['edit'])) {
                                        echo ($con['settings'][2]['logofit'] == 'contain' ? "selected" : '');
                                    }; ?>><?php echo i18n_r('companySlider/LANG_Contain') ;?></option>
            <option value="cover" <?php if (isset($_GET['edit'])) {
                                        echo ($con['settings'][2]['logofit'] == 'cover' ? "selected" : '');
                                    }; ?>><?php echo i18n_r('companySlider/LANG_Cover') ;?></option>
        </select>

        <p style="margin:0;padding:0"><?php echo i18n_r('companySlider/LANG_Slides_to_Show') ;?>: </p>
        <input type="text" name="slidetoshow" required placeholder="3" <?php if (isset($_GET['edit'])) {
                                                                            echo 'value="' . $con['settings'][3]['slidetoshow'] . '"';
                                                                        }; ?>>

        <p style="margin:0;padding:0"><?php echo i18n_r('companySlider/LANG_Slides_to_Scroll') ;?>: </p>
        <input type="text" required name="slidestoscroll" placeholder="1" <?php if (isset($_GET['edit'])) {
                                                                                echo 'value="' . $con['settings'][4]['slidestoscroll'] . '"';
                                                                            }; ?>>

        <p style="margin:0;padding:0"><?php echo i18n_r('companySlider/LANG_Autoplay') ;?>: </p>
        <select name="autoplay" required>
            <option value="true" <?php if (isset($_GET['edit'])) {
                                        echo ($con['settings'][5]['autoplay'] == 'true' ? 'selected' : '');
                                    }; ?>><?php echo i18n_r('companySlider/LANG_True') ;?></option>
            <option value="false" <?php if (isset($_GET['edit'])) {
                                        echo ($con['settings'][5]['autoplay'] == 'false' ? 'selected' : '');
                                    }; ?>><?php echo i18n_r('companySlider/LANG_False') ;?></option>
        </select>

        <p style="margin:0;padding:0"><?php echo i18n_r('companySlider/LANG_Autoplay_speed') ;?>Autoplay speed: </p>
        <input type="text" required name="autoplayspeed" placeholder="2000" <?php if (isset($_GET['edit'])) {
                                                                                    echo 'value="' . $con['settings'][6]['autoplayspeed'] . '"';
                                                                                }; ?>>

        <p style="margin:0;padding:0"><?php echo i18n_r('companySlider/LANG_Dots') ;?>: </p>
        <select name="dots" required>
            <option value="true" <?php if (isset($_GET['edit'])) {
                                        echo ($con['settings'][7]['dots'] == 'true' ? 'selected' : '');
                                    }; ?>><?php echo i18n_r('companySlider/LANG_True') ;?></option>
            <option value="false" <?php if (isset($_GET['edit'])) {
                                        echo ($con['settings'][7]['dots'] == 'false' ? 'selected' : '');
                                    }; ?>><?php echo i18n_r('companySlider/LANG_False') ;?></option>
        </select>

        <p style="margin:0;padding:0"><?php echo i18n_r('companySlider/LANG_Crossfade') ;?></p>
        <select name="fade" required>
            <option value="true" <?php if (isset($_GET['edit'])) {
                                        echo ($con['settings'][8]['fade'] == 'true' ? 'selected' : '');
                                    }; ?>><?php echo i18n_r('companySlider/LANG_True') ;?></option>
            <option value="false" <?php if (isset($_GET['edit'])) {
                                        echo ($con['settings'][8]['fade'] == 'false' ? 'selected' : '');
                                    }; ?>><?php echo i18n_r('companySlider/LANG_False') ;?></option>
        </select>

        <p style="margin:0;padding:0"><?php echo i18n_r('companySlider/LANG_Arrows') ;?>: </p>
        <select name="arrows" required>
            <option value="true" <?php if (isset($_GET['edit'])) {
                                        echo ($con['settings'][9]['arrows'] == 'true' ? 'selected' : '');
                                    }; ?>><?php echo i18n_r('companySlider/LANG_True') ;?></option>
            <option value="false" <?php if (isset($_GET['edit'])) {
                                        echo ($con['settings'][9]['arrows'] == 'false' ? 'selected' : '');
                                    }; ?>><?php echo i18n_r('companySlider/LANG_False') ;?></option>
        </select>

    </div>

    <div class="imagelist" style="margin-top:10px;" id="sortable">

        <?php
        if (isset($_GET['edit'])) {
            $companySlider->list($_GET['edit']);
        }; ?>
    </div>

    <input type="submit" name="createFile" class="btn btn-migrate" value="<?php echo i18n_r('BTN_SAVESETTINGS') ;?>" style="width:200px;">
</form>

<script>
    document.querySelectorAll('.addNew').forEach((item, index) => {

        item.addEventListener('click', (e) => {
            e.preventDefault();
            e.preventDefault();
            window.open('<?php global $SITEURL;
                            echo $SITEURL; ?>plugins/companySlider/filebrowser/imagebrowser.php?type=images&CKEditor=post-content&class=image-car&func=' + index, '', 'width=800,height=600');
        })

    })
</script>

<script>
    $(function() {
        $("#sortable").sortable();
    });
</script>

<script>
    document.querySelector('.config').classList.toggle('hidethis');

    document.querySelector('.showsettings').addEventListener('click', (x) => {
        x.preventDefault();
        document.querySelector('.config').classList.toggle('hidethis');
    })
</script>