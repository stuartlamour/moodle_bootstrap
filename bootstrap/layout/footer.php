<!-- START OF FOOTER -->
    <?php if ($hasfooter) { ?>
    <footer role="contentinfo" id="page-footer">
	<h1>welcome to the colophon</h1>	
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

<? print_r($PAGE); ?>

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