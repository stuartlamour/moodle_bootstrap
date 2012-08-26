<?php

/********************************************************
**
** Theme name: Nuim
** Creation Date: May 5th 2012
** Author: Bas Brands
** Author URI: http://www.sonsbeekmedia.nl
**
*********************************************************/ 

class theme_nuim_core_renderer extends core_renderer {
    
    public function custom_menu($custommenuitems = '') {
        global $CFG;
        
        $site  = get_site();
        $custommenuitems = $site->fullname . "|" . $CFG->wwwroot . "\n";
        
        if (!empty($CFG->custommenuitems)) {
            $custommenuitems .= $CFG->custommenuitems;
        }
        
       

        $custommenu = new custom_menu($custommenuitems, current_language());
        return $this->render_custom_menu($custommenu);
    }
	
	protected function render_custom_menu(custom_menu $menu) {
	    global $USER,$PAGE;
	    
	    $site  = get_site();
		// If the menu has no children return an empty string
		if (!$menu->has_children()) {
			return '';
		}
		
		$menupos = 3;
		

		if (is_siteadmin($USER)) {     
	    $menu->add(get_string('purgecaches', 'theme_nuim'), new moodle_url('/admin/purgecaches.php', array('sesskey' =>  sesskey(), 'confirm' => '1')), null, $menupos++);
		}

	    
		if(!empty($this->page->theme->settings->max_dropdown_courses)) {
		    switch ($this->page->theme->settings->max_dropdown_courses) {
		    case 0:
                $max_dropdown_courses = 5;
                break;
            case 1:
                $max_dropdown_courses = 10;
                break;
            case 2:
                $max_dropdown_courses = 15;
                break;
            case 3:
                $max_dropdown_courses = 25;
                break;
            case 4:
                $max_dropdown_courses = 999;
                break;
            default:
                $max_dropdown_courses = 10;
                break;
		    }   
		} else {
		    $max_dropdown_courses = 5;
		}

		if (isloggedin()) {
		    $mycourses = $menu->add(get_string('mycontent', 'theme_nuim'), new moodle_url('/my'), null, $menupos++);
		    $courses = enrol_get_my_courses(NULL, 'fullname ASC', '999');
		     
		    $countcourses = 0;
		    foreach ($courses as $mycourse) {
		        if ($countcourses > $max_dropdown_courses ) {
		            $mycourses->add(get_string('morecourses', 'theme_nuim'), new moodle_url('/my'), null);
		            break;
		        }
		        if (strlen($mycourse->fullname) > 19 ) {
		            $coursename = substr($mycourse->fullname,0,19) .  '..';
		        } else {
		            $coursename = $mycourse->fullname;
		        }

		        $mycourses->add($coursename, new moodle_url('/course/view.php', array('id' => $mycourse->id)), $mycourse->fullname);
		        $countcourses++;
		    }
		}
		
		
	    
		// Initialise this custom menu
		$content = html_writer::start_tag('div', array('id'=>'navigation'));
		$content .= html_writer::start_tag('ul', array('id'=>'main-navigation'));
		// Render each child
		foreach ($menu->get_children() as $item) {
			$content .= $this->render_custom_menu_item($item);
		}
		// Close the open tags
		$content .= html_writer::end_tag('ul');
		$content .= html_writer::end_tag('div');
		// Return the custom menu
		return $content;
	}

	protected function render_custom_menu_item(custom_menu_item $menunode) {
		// Required to ensure we get unique trackable id's
		static $submenucount = 0;
		$content = html_writer::start_tag('li');
		if ($menunode->has_children()) {
			// If the child has menus render it as a sub menu
			$submenucount++;
			if ($menunode->get_url() !== null) {
				$url = $menunode->get_url();
			} else {
				$url = '#cm_submenu_'.$submenucount;
			}
			
			$content .= html_writer::link($url, $menunode->get_text(), array('title'=>$menunode->get_title()));
			
			$content .= html_writer::start_tag('ul');
			foreach ($menunode->get_children() as $menunode) {
				$content .= $this->render_custom_menu_item($menunode);
			}
			$content .= html_writer::end_tag('ul');
		} else {
			// The node doesn't have children so produce a final menuitem

			if ($menunode->get_url() !== null) {
				$url = $menunode->get_url();
			} else {
				$url = '#';
			}
			$content .= html_writer::link($url, $menunode->get_text(), array('title'=>$menunode->get_title()));
		}
		$content .= html_writer::end_tag('li');
		// Return the sub menu
		return $content;
	}
	
	public function heading($text, $level = 2, $classes = 'main', $id = null) {
		global $COURSE;
		 
		$topicoutline = get_string('topicoutline');

		if ($text == $topicoutline) {
			$text = $COURSE->fullname;
		}
		
		if ($text == get_string('weeklyoutline')) {
			$text = $COURSE->fullname;
		}

		$content = parent::heading($text, $level, $classes, $id);

		return $content;
	}
}
