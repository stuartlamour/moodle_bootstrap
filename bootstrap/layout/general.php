<!doctype html public>
<html lang="en" dir="ltr">

<?php
$old =  $OUTPUT->doctype(); // needs to be called to prevent moodle echoing old doctype

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

<!- BEGIN PAGE HEADER -->
<header class="navbar navbar-fixed-top">
    <nav class="container">
    	<div class="user_bar">
    	<?php if ($haslogininfo) {
                echo $OUTPUT->login_info();
            }
        ?>
    	<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            	<span class="icon-bar"></span>
            	<span class="icon-bar"></span>
            	<span class="icon-bar"></span>
        </a>
        </div>
    	<div class="nav-collapse collapse">
    		
				<ul class="nav">
					<li><a href="#">Courses</a></li>
					<li><a href="#">Timetable</a></li>
					<li><a href="#">Stuff</a></li>
					<li><a href="#">Stuff</a></li>
				</ul>
			</div>
    </nav>
</header>
<!-- END PAGE HEADER -->


<!-- BEGIN MAIN -->
<div role="main" class="container">

<?php if ($hasheading || $hasnavbar) { ?>
    <header id="page-header" class="jumbotron">    	
        <?php if ($hasheading) { ?>
        <h1 class="headermain"><a href="<?php  global $CFG; $url = $CFG->wwwroot."/course/view.php?id=".$PAGE->course->id; echo $url; ?>"><?php echo $PAGE->heading ?></a></h1>
        
        <?php if (!empty($PAGE->layout_options['langmenu'])) {
                echo $OUTPUT->lang_menu();
            }
            echo $PAGE->headingmenu
        ?><?php } ?>
        
        
        <?php if ($hasnavbar) { ?>
            <div class="navbar clearfix">
                <div class="breadcrumb"><?php echo $OUTPUT->navbar(); ?></div>
                <div class="navbutton"> <?php echo $PAGE->button; ?></div>
            </div>
        <?php } ?>
    </header>
<?php } ?>


          <div id="region-main-box" class="row">
                    
                <?php if ($hassidepre AND $hassidepost) : ?>
                <article class="span6">
                <?php else : ?>
                <article class="span9">
                <?php endif; ?>
                	<?php echo core_renderer::MAIN_CONTENT_TOKEN ?>
                </article>
                
				<?php if ($hassidepre) : ?>
                <aside class="span3">
                   <?php echo $OUTPUT->blocks_for_region('side-pre') ?>
                </aside>
                <?php endif; ?>
                
                <?php if ($hassidepost) : ?>                
                <aside class="span3">
                       <?php echo $OUTPUT->blocks_for_region('side-post') ?>
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

</div><!-- close container -->	
</div><!-- close #page -->	
<!-- silly css reset stuff that needs moving eventually..  -->
<style>
.block {
	border:0;
}
.breadcrumb {
	visibility:hidden;
}
	.breadcrumb .arrow {
		visibility:hidden;
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

header.navbar {	
  background-color: #2c2c2c;
  background-image: -moz-linear-gradient(top, #333333, #222222);
  background-image: -ms-linear-gradient(top, #333333, #222222);
  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#333333), to(#222222));
  background-image: -webkit-linear-gradient(top, #333333, #222222);
  background-image: -o-linear-gradient(top, #333333, #222222);
  background-image: linear-gradient(top, #333333, #222222);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#333333', endColorstr='#222222', GradientType=0);
  -webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.25), inset 0 -1px 0 rgba(0, 0, 0, 0.1);
  -moz-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.25), inset 0 -1px 0 rgba(0, 0, 0, 0.1);
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.25), inset 0 -1px 0 rgba(0, 0, 0, 0.1);
}

.user_bar {
	float:right;
	line-height:3;
}
.logininfo {
	display:inline-block;
	color:#999;
}
	.logininfo a{
		color:#faa732;
	}

body.container {
	width:100%;
	padding:0;
	margin:0;
	/* background:#e6eaec url(http://pea.rs/wp-content/themes/pears/css/../images/tile.png); */
}

#region-main-box {
	
}


#page-header {
	margin-top:50px;
}
@media (max-width: 979px) {
	.btn-navbar,
	.user_bar  {
		float:none;
		display:inline-block;
	}
	.user_bar {
		width:100%;
		text-align:right;
	}
	#page-header {
		margin-top:0px;
	}

}
</style>

<?php echo $OUTPUT->standard_top_of_body_html(); ?> 
<?php echo $OUTPUT->standard_end_of_body_html() ?>
    <script type="text/javascript" src="<?php echo $CFG->wwwroot .'/theme/'.current_theme();?>/javascript/jquery.js"></script>
    <script type="text/javascript" src="<?php echo $CFG->wwwroot .'/theme/'.current_theme();?>/javascript/bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo $CFG->wwwroot .'/theme/'.current_theme();?>/javascript/bootstrap-dropdown.js"></script>
    <script type="text/javascript" src="<?php echo $CFG->wwwroot .'/theme/'.current_theme();?>/javascript/theme-specific.js"></script>
</body>
</html>