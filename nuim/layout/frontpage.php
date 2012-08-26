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
$frontpagenews = $PAGE->theme->settings->frontpagenews;

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
    <meta name="description" content="<?php p(strip_tags(format_text($SITE->summary, FORMAT_HTML))) ?>" />
    <?php echo $OUTPUT->standard_head_html() ?>
    
        <script type="text/javascript" src="<?php echo $CFG->wwwroot;?>/theme/nuim/js/jquery.js"></script> 
        <script type="text/javascript" src="<?php echo $CFG->wwwroot;?>/theme/nuim/js/foundation.js"></script> 
    	<script type="text/javascript">
    $(window).load(function() {
    	$('#featured').orbit({
    	     animation: 'fade',                  // fade, horizontal-slide, vertical-slide, horizontal-push
    	     animationSpeed: 1600,                // how fast animtions are
    	     timer: true, 			 // true or false to have the timer
    	     resetTimerOnClick: false,           // true resets the timer instead of pausing slideshow progress
    	     advanceSpeed: 4000, 		 // if timer is enabled, time between transitions 
    	     pauseOnHover: true, 		 // if you hover pauses the slider
    	     startClockOnMouseOut: true, 	 // if clock should start on MouseOut
    	     startClockOnMouseOutAfter: 1000, 	 // how long after MouseOut should the timer start again
    	     directionalNav: true, 		 // manual advancing directional navs
    	     captions: true, 			 // do you want captions?
    	     captionAnimation: 'fade', 		 // fade, slideOpen, none
    	     captionAnimationSpeed: 800, 	 // if so how quickly should they animate in
    	     bullets: false,			 // true or false to activate the bullet navigation
    	     bulletThumbs: false,		 // thumbnails for the bullets
    	     bulletThumbLocation: '',		 // location from this file where thumbs will be
    	     afterSlideChange: function(){}, 	 // empty function 
    	     fluid: true                         // or set a aspect ratio for content slides (ex: '4x3') 
    	});

    	
    });
    
</script>
    
</head>

<body id="<?php p($PAGE->bodyid) ?>" class="<?php p($PAGE->bodyclasses.' '.join(' ', $bodyclasses)) ?>">
<?php echo $OUTPUT->standard_top_of_body_html() ?>

<?php if ($hascustommenu) { ?>
<div id="custommenuwrap">
    <div id="custommenu">
    <div id="menulogo">
    <img src="<?php echo $OUTPUT->pix_url('nuim-logo-small', 'theme')?>">
    </div>
        <?php echo $custommenu; ?>
            	    <div class="headermenu">
        		<?php
	        	    echo $OUTPUT->login_info();
	        	    
    	        	echo $OUTPUT->lang_menu();
	        	    echo $PAGE->headingmenu;
		        ?>
	    	</div>
    </div>
 </div>
<?php } ?>

<div id="page">

<!-- START OF HEADER -->
    <div id="page-header">
		<div id="page-header-wrapper" class="wrapper clearfix">

	    </div>
    </div>

<!-- END OF HEADER -->


<!-- START OF CONTENT -->

<div id="page-content-wrapper" class="wrapper clearfix">
    <div id="page-content">
        <div id="region-main-box">
            <div id="region-post-box">

                <div id="region-main-wrap">
                    <div id="region-main">
                        <div class="region-content">
                            <?php if ($frontpagenews) {?>
                                <div id = "nuimnews">
                                         <?php include($CFG->dirroot . "/theme/nuim/layout/newsforum.php"); ?>  
                                   </div>
                                <?php } ?>
                            <?php echo $OUTPUT->main_content() ?>
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
</div>

<!-- END OF CONTENT -->

<!-- START OF FOOTER -->

    <div id="page-footer" class="wrapper">
        <p class="helplink">
        <?php echo page_doc_link(get_string('moodledocslink')) ?>
        </p>

        <?php
        echo $OUTPUT->login_info();
        echo $OUTPUT->home_link();
        echo $OUTPUT->standard_footer_html();
        ?>
    </div>

<!-- END OF FOOTER -->

</div>
<?php echo $OUTPUT->standard_end_of_body_html() ?>
</body>


</html>