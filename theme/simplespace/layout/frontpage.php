<?php
$hasheading = ($PAGE->heading);
$hasnavbar = (empty($PAGE->layout_options['nonavbar']) && $PAGE->has_navbar());
$hasfooter = (empty($PAGE->layout_options['nofooter']));

$hassidepre = $PAGE->blocks->region_has_content('side-pre', $OUTPUT);
$hassidepost = $PAGE->blocks->region_has_content('side-post', $OUTPUT);

$showsidepre = ($hassidepre && !$PAGE->blocks->region_completely_docked('side-pre', $OUTPUT));
$showsidepost = ($hassidepost && !$PAGE->blocks->region_completely_docked('side-post', $OUTPUT));

$custommenu = $OUTPUT->custom_menu();
$hascustommenu = (empty($PAGE->layout_options['nocustommenu']) && !empty($custommenu));

$bodyclasses = array();
if ($showsidepre && !$showsidepost) {
    $bodyclasses[] = 'side-pre-only';
} else if ($showsidepost && !$showsidepre) {
    $bodyclasses[] = 'side-post-only';
} else if (!$showsidepost && !$showsidepre) {
    $bodyclasses[] = 'content-only';
}
if ($hascustommenu) {
    $bodyclasses[] = 'has_custom_menu';
}


    
echo $OUTPUT->doctype() ?>


<html <?php echo $OUTPUT->htmlattributes() ?>>
<head>
    <title><?php echo $PAGE->title ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->pix_url('favicon', 'theme')?>" />
    <?php echo $OUTPUT->standard_head_html() ?>

</head>
<body id="<?php echo $PAGE->bodyid ?>" class="<?php echo $PAGE->bodyclasses.' '.join(' ', $bodyclasses) ?>">
<?php echo $OUTPUT->standard_top_of_body_html() ?>
<div id="page">

<div id="header-wrap">
	<div id="header-container">
		<div id="header-inner"><div id="page-header"></div>
			
			<div id="headleft">
			<?php if ($hasheading) {
		echo $PAGE->heading;
		}
		?>
			</div>
			<div id="headright">
			<?php
			
			 if ($hascustommenu) { ?>
 <div id="custommenu"><?php echo $custommenu; ?></div>
<?php } ?>
			</div>
			
		</div>
	</div>
</div>


<div id="textcontainer-wrap">
<div id="textcontainer">
<div class="thetitle">
<div class="innertitle">

 </div>
</div>
<div class="rightinfo">
<?php
 echo "<div class='innerrightinfo'>";
                    if (isloggedin())
                    {
 			echo ''.$OUTPUT->user_picture($USER, array('size'=>55)).'';
 			}
 			else {
 			?>
 			<img class="userpicture" src="<?php echo $CFG->wwwroot .'/theme/'. current_theme().'/pix/image.png' ?>" />
 			<?php
 			}
            echo $OUTPUT->login_info();
            echo $OUTPUT->lang_menu();
            echo $PAGE->headingmenu;
       		echo"<div class=\"ppin\"></div>";
       echo "</div>";
       ?>

</div>
</div>
</div>

<div id="ie6-container-wrap">
	<div id="container">
	
	
	
	<div id="page-content">
        <div id="region-main-box">
            <div id="region-post-box">
            
                <div id="region-main-wrap">
                    <div id="region-main">
                        <div class="region-content">
         
                            <?php echo core_renderer::MAIN_CONTENT_TOKEN ?>
                        </div>
                    </div>
                </div>
                
                <?php if ($hassidepre) { ?>
                <div id="region-pre" class="block-region">
                    <div class="region-content">
               		                   
                        <?php echo $OUTPUT->blocks_for_region('side-pre') ?>
                    </div>
                </div>
                <?php } ?>
                <?php if ($hassidepost) { ?>
                <div id="region-post" class="block-region">
                    <div class="region-content">
                        <?php echo $OUTPUT->blocks_for_region('side-post') ?>
                    </div>
                </div>
                <?php } ?>
                
            </div>
        </div>
    </div>
      
	
	<!-- Containers end -->
	<div class="johnclear"></div>
	</div>
</div>
	

<!-- START OF FOOTER -->
<div id="footer-wrap"><div id="page-footer"></div>
	<div id="footer-container">
		<div id="footer">
		
		 <?php if ($hasfooter) {
		 echo "<div class='johndocsleft'>";
        echo $OUTPUT->login_info();
       // echo $OUTPUT->home_link();
        echo $OUTPUT->standard_footer_html();
        echo "</div>";
        }
        ?>
		
	
       
         
    <?php if ($hasfooter) { ?>
    <div class="johndocs">
      
            <?php echo page_doc_link(get_string('moodledocslink')) ?>
       		
       
       
    </div>
    <?php } ?>
        
		</div>
	</div>
</div>




</div>
<?php echo $OUTPUT->standard_end_of_body_html() ?>
</body>
</html>