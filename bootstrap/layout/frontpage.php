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
    <meta name="description" content="<?php p(strip_tags(format_text($SITE->summary, FORMAT_HTML))) ?>" />
    <?php echo $OUTPUT->standard_head_html() ?>

    

</head>

<body id="<?php p($PAGE->bodyid) ?>" class="<?php p($PAGE->bodyclasses.' '.join(' ', $bodyclasses)) ?>">
<?php echo $OUTPUT->standard_top_of_body_html() ?>

<div id="page">

<div class="row-fluid">
<div class="span12">
<div class="navbar">
<div class="navbar-inner">
<div class="container">
<?php if ($hascustommenu) { ?>
<?php echo $custommenu; ?>
<?php } ?>


</div>
</div>
</div>
</div>
</div>

<!-- START OF HEADER -->
<div class="row-fluid">
    <div class="span12">
        <div class="row-fluid">
		<div class="span8">
	        <h1 class="headermain"><?php echo $PAGE->heading ?></h1>
	        </div>
	        <div class="span4">
    	    <div class="headermenu">
        		<?php
	        	    echo $OUTPUT->login_info();
    	        	echo $OUTPUT->lang_menu();
	        	    echo $PAGE->headingmenu;
		        ?>
	    	</div>
	    	</div>
	    </div>
    </div>
 </div>

<!-- END OF HEADER -->


<!-- START OF CONTENT -->
<div class="container-fluid">
<div class="row-fluid">
<div class="span12">
<div class="row-fluid">
<div class="span2">
                <?php if ($hassidepre) { ?>
                <div id="region-pre" class="block-region">
                    <div class="region-content">
                        <?php echo $OUTPUT->blocks_for_region('side-pre') ?>
                    </div>
                </div>
                <?php } ?>
</div>

<div class="span8">

                <div id="region-main-wrap">
                    <div id="region-main">
                        <div class="region-content">
                            <?php echo $OUTPUT->main_content() ?>
                        </div>
                    </div>
                </div>
</div>

<div class="span2">


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
</div>

<!-- END OF CONTENT -->

<!-- START OF FOOTER -->

<div class="row-fluid">
<div class="span12">

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
    
</div>
</div>


<!-- END OF FOOTER -->

</div>
<?php echo $OUTPUT->standard_end_of_body_html() ?>
    <script type="text/javascript" src="<?php echo $CFG->wwwroot .'/theme/'.current_theme();?>/javascript/jquery.js"></script>
    <script type="text/javascript" src="<?php echo $CFG->wwwroot .'/theme/'.current_theme();?>/javascript/bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo $CFG->wwwroot .'/theme/'.current_theme();?>/javascript/bootstrap-dropdown.js"></script>
    <script type="text/javascript" src="<?php echo $CFG->wwwroot .'/theme/'.current_theme();?>/javascript/theme-specific.js"></script>
</body>
</html>