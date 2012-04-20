<!doctype html public>
<html lang="en" dir="ltr">
<?php
$old =  $OUTPUT->doctype(); // needs to be called to prevent moodle echoing old doctype

$hasheading = ($PAGE->heading);
$hasnavbar = (empty($PAGE->layout_options['nonavbar']) && $PAGE->has_navbar());
$hasfooter = (empty($PAGE->layout_options['nofooter']));

$hassidepre = $PAGE->blocks->region_has_content('side-pre', $OUTPUT);
$hassidepost = $PAGE->blocks->region_has_content('side-post', $OUTPUT);

$showsidepre = ($hassidepre && !$PAGE->blocks->region_completely_docked('side-pre', $OUTPUT));
$showsidepost = ($hassidepost && !$PAGE->blocks->region_completely_docked('side-post', $OUTPUT));
$custommenu = $OUTPUT->custom_menu();
$hascustommenu = (empty($PAGE->layout_options['nocustommenu']) && !empty($custommenu));
$haslogininfo =  (isguestuser() or isloggedin());

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
?>
<head>
	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo $PAGE->heading ?></title>
    
    <!-- mobile viewport -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
     <!-- icons-->
    <link rel="shortcut icon" href="<?php echo $OUTPUT->pix_url('favicon', 'theme')?>">
<!-- 	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<%shortcut_icon_path %>">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<% shortcut_icon_path %>">
		<link rel="apple-touch-icon-precomposed" href="<% shortcut_icon_path %>"> 
-->
    
    <!-- css includes -->
    
    <!--[if lt IE 9]>
  		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

		
    <?php echo $OUTPUT->standard_head_html(); // need to split the js,css etc ?>
</head>



<body id="<?php echo $PAGE->bodyid ?>" class="<?php echo $PAGE->bodyclasses.' '.join(' ', $bodyclasses) ?> container">
<div id="page">




<?php if ($hascustommenu) { ?>
<?php echo $custommenu; ?>
<?php } ?>
<!-- END SITE HEADER -->


<!-- MAIN -->
<div role="main" class="container">



<?php if ($hasheading || $hasnavbar) : ?>
<!- PAGE HEADING -->
    <header id="page-header" class="jumbotron">    	
        <?php if ($hasheading) { ?>
        <h1 class="headermain"><a href="<?php  global $CFG; $url = $CFG->wwwroot."/course/view.php?id=".$PAGE->course->id; echo $url; ?>"><?php echo $PAGE->heading ?></a></h1>
        
        <?php if (!empty($PAGE->layout_options['langmenu'])) {
                echo $OUTPUT->lang_menu();
            }
            echo $PAGE->headingmenu
        ?><?php } ?>
        
        
        <?php if ($hasnavbar) { ?>
            <div class="navbar stickynav clearfix">
                <div class="breadcrumb"><?php echo $OUTPUT->navbar(); ?></div>
                <div class="navbutton"> <?php echo $PAGE->button; ?></div>
            </div>
        <?php } ?>
    </header>
<!- END PAGE HEADING -->
<?php endif; ?>