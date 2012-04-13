<!doctype html public> <!-- why is there another doctype above this moodle? hum? -->
<html lang="en" dir="ltr">

<?php
// copied from base general.php
$hasheading = ($PAGE->heading);
$hasnavbar = (empty($PAGE->layout_options['nonavbar']) && $PAGE->has_navbar());
$hasfooter = (empty($PAGE->layout_options['nofooter']));
$hassidepre = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('side-pre', $OUTPUT));
$hassidepost = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('side-post', $OUTPUT));
$haslogininfo = (empty($PAGE->layout_options['nologininfo']));

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
$old =  $OUTPUT->doctype();

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
<?php echo $OUTPUT->standard_top_of_body_html(); ?>


<div id="page">
<?php if ($hasheading || $hasnavbar) { ?>
    <div id="page-header" class="jumbotron">    	
        <?php if ($hasheading) { ?>
        <h1 class="headermain"><a href="<?php  global $CFG; $url = $CFG->wwwroot."/course/view.php?id=".$PAGE->course->id; echo $url; ?>"><?php echo $PAGE->heading ?></a></h1>
        <div class="headermenu"><?php
            if ($haslogininfo) {
                echo $OUTPUT->login_info();
            }
            if (!empty($PAGE->layout_options['langmenu'])) {
                echo $OUTPUT->lang_menu();
            }
            echo $PAGE->headingmenu
        ?></div><?php } ?>
        <?php if ($hascustommenu) { ?>
        <div id="custommenu"><?php echo $custommenu; ?></div>
        <?php } ?>
        <?php if ($hasnavbar) { ?>
            <div class="navbar clearfix">
                <div class="breadcrumb"><?php echo $OUTPUT->navbar(); ?></div>
                <div class="navbutton"> <?php echo $PAGE->button; ?></div>
            </div>
        <?php } ?>
    </div>
<?php } ?>
<!-- END OF HEADER -->
<!-- silly css reset stuff that needs moving eventually..  -->
<style>
.block {
	border:0;
}
.breadcrumb {
	display:none;
}
#page-header {
	margin:2% 0;
}
.hidden { display:block !important;
visibility:visible !important; 
}

#region-main-box .span3,
#region-main-box .span6,
#region-main-box .span9 {
	border-top:2px solid #eee;
}

.mform fieldset, 
.generalbox,
.mod_introbox {
	border:0px !important;
}

.course-content ul li.section.main{
	padding:2em 0;
	margin:2em 0;
	border-bottom:2px solid #eee;
}

.course-content ul.topics li.section .content,
.course-content ul.weeks li.section .content {
	margin:0;
	padding:0;
}

#page-footer {
	text-align:left;
	font-size:1em;
	padding:1em 0;
	border-top:2px solid #eee;
}
#page-footer .logininfo, 
#page-footer .sitelink, 
#page-footer .helplink {
	margin:0;
	padding:0;
}
.advancedbutton img {
	display:none;
}
.mform fieldset .filemanager-toolbar {
	margin-bottom:0.5em;
}

.section_add_menus {
	text-align:center;
}
.section_add_menus .horizontal  .urlselect {
	display:inline-block;
	padding:0 2%;
}
.section li {
	line-height:1.75;
	font-size:14px;
}
.commands {
	display:inline-block;
}
</style>

           <div id="region-main-box" class="row">
                    
                <?php if ($hassidepre AND $hassidepost) : ?>
                <div role="main" class="span6">
                <?php else : ?>
                <div role="main" class="span9">
                <?php endif; ?>
                    <div id="region-main">
                        <div class="region-content">
                            <?php echo core_renderer::MAIN_CONTENT_TOKEN ?>
                        </div>
                    </div>
                </div>
                
				<?php if ($hassidepre) : ?>
                <aside class="span3">
                    <div class="region-content">
                        <?php echo $OUTPUT->blocks_for_region('side-pre') ?>
                    </div>
                </aside>
                <?php endif; ?>
                
                <?php if ($hassidepost) : ?>                
                <aside class="span3">
                    <div class="region-content">
                        <?php echo $OUTPUT->blocks_for_region('side-post') ?>
                    </div>
                </aside>
                <?php endif; ?>
          
        </div>
    

<!-- START OF FOOTER -->
    <?php if ($hasfooter) { ?>
    <footer role="contentinfo" id="page-footer">
	<nav role="navigation">
	 <!-- <p class="helplink"><?php echo page_doc_link(get_string('moodledocslink')) ?></p> -->
	 Designed and built with all the love in the world la la la<br />
	 <?php
        echo $OUTPUT->login_info();
        // echo $OUTPUT->home_link();
        echo $OUTPUT->standard_footer_html();
      ?>
      <a href="#">Back to top</a>
	</nav>	
	
	</footer>	
	<?php } ?>			
	
</div>
<?php echo $OUTPUT->standard_end_of_body_html() ?>
    <script type="text/javascript" src="<?php echo $CFG->wwwroot .'/theme/'.current_theme();?>/javascript/jquery.js"></script>
    <script type="text/javascript" src="<?php echo $CFG->wwwroot .'/theme/'.current_theme();?>/javascript/bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo $CFG->wwwroot .'/theme/'.current_theme();?>/javascript/bootstrap-dropdown.js"></script>
    <script type="text/javascript" src="<?php echo $CFG->wwwroot .'/theme/'.current_theme();?>/javascript/theme-specific.js"></script>
</body>
</html>