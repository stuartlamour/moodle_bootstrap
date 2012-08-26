<?php

/**
 * Makes our changes to the CSS
 *
 * @param string $css
 * @param theme_config $theme
 * @return string 
 */
function nuim_process_css($css, $theme) {
    global $OUTPUT;

    // Set the link color
    if (!empty($theme->settings->colorset)) {
        $colorset = $theme->settings->colorset;
    } else {
        $colorset = 0;
    }
    $css = nuim_set_colorset($css, $colorset);

	// Set the link hover color
    if (!empty($theme->settings->linkhover)) {
        $linkhover = $theme->settings->linkhover;
    } else {
        $linkhover = null;
    }
    $css = nuim_set_linkhover($css, $linkhover);
        
    if (!empty($theme->settings->login_picture)) {
        $imagename = 'nuim_login_background_' . $theme->settings->login_picture;
        $imageurl = $OUTPUT->pix_url($imagename, 'theme');

        if ($theme->settings->login_picture == 4) {
            if(!empty($theme->settings->logo_url)) {
                $imageurl = $theme->settings->logo_url;
            }
        }
    } else {
        $imagename = 'nuim_login_background_1';
        $loginhelpposition = '324px';
        $imageurl = $OUTPUT->pix_url($imagename, 'theme');
        $loginposition ='288px';
    }
    
    
    
    if (!empty($theme->settings->login_box_position)) {
        $css = nuim_set_loginbackground($css, $imageurl);
       
        switch ($theme->settings->login_box_position) {
            case 1:
                $loginposition ='0px';
                $loginhelpposition = '36px';
                break;
            case 2:
                $loginposition = '288px';
                $loginhelpposition = '324px';
                break;
            case 3:
                $loginposition = '610px';
                $loginhelpposition = '646px';
                break;

            default:
                $loginposition = '0px';
                $loginhelpposition = '36px';
                break;
        }
    } else {
        $loginposition ='0px';
        $loginhelpposition = '36px';
    }

    $css = nuim_set_loginboxposition($css, $loginposition,$loginhelpposition);
    
    if(!empty($theme->settings->max_dropdown_courses)) {
        switch ($theme->settings->max_dropdown_courses) {
            case 1:
                $max_dropdown_courses = 5;
                break;
            case 2:
                $max_dropdown_courses = 10;
                break;
            case 3:
                $max_dropdown_courses = 15;
                break;
            case 4:
                $max_dropdown_courses = 25;
                break;
            case 5:
                $max_dropdown_courses = 999;
                break;
            default:
                $max_dropdown_courses = 10;
                break;
        }
    } else {
        $max_dropdown_courses = 10;
    }

    if (!empty($theme->settings->login_bgcolor)) {
        $css = nuim_set_loginbgcolor($css,$theme->settings->login_bgcolor);
    }
    

    // Return the CSS
    return $css;
}


/**
 * Sets the link color variable in CSS
 *
 */
function nuim_set_colorset($css, $colorset) {
    $menucolorstarttag = '[[setting:menucolorstart]]';
    $menucolorendtag = '[[setting:menucolorend]]';
    $pastelcolortag = '[[settings:pastelcolor]]';
    $blockbackgroundtag = '[[settings:blockbackground]]';
    $blockshadetag = '[[settings:blockshade]]';
    $inputbordertag = '[[settings:thinborder]]';
    $linkcolortag = '[[settings:linkcolor]]';
    $linkcolorhovertag = '[[settings:linkcolorhover]]';
    $linkcolorfocustag = '[[settings:linkcolorfocus]]';
    $headingcolortag = '[[settings:headingcolor]]';

    switch( $colorset )
    {
        case 0: //YELLOW
            $menustart = '#eeae13'; //darkyellow
            $menuend = '#f6d18a'; //lightyellow
            $blockbackground = '#FFF4D2'; // yellowish
            $pastel = '#fdf9ec'; //pastelred
            $blockshade = '#F8E7AF'; // darker yellow
            $inputborder = $blockshade;
            $linkcolor = '#cc4714';
            $linkcolorhover = '#7B290B';
            $linkcolorfocus = '#30377B';
            $headingcolor = '#181818';
            break;
             
        case 1: //BLUE

            $menustart = '#00818e'; //darkgreen
            $menuend = '#66b3bd'; //lightgreen
            $blockbackground = '#d8f0fe'; //#A9ECFF
            $pastel = '#fff'; //
            $blockshade = '#C1D2E8'; 
            $inputborder = $blockshade;
            $linkcolor = '#0C1924'; // or darker: #060F1B
            $linkcolorhover = '#060F1B';
            $linkcolorfocus = '#605553';
            $headingcolor = '#181818';
            break;

        case 2 :  //RED
            $menustart = '#92352f'; //darkred
            $menuend = '#c6897e'; //lightred
            $pastel = '#E9E9E9'; //pastelred
            $blockbackground = '#ebebeb'; //
            $blockshade = '#b7b7b7'; //
            $inputborder = $blockshade;
            $linkcolor = '#750102';
            $linkcolorhover = '#000';
            $linkcolorfocus = '#000';
            $headingcolor = '#ff0000';
            break;

        case 3 : //GREEN
            $menustart = '#333333'; //
            $menuend = '#222222'; //
            $pastel = '#e0e0e0'; //pastelred
            $blockbackground = '#e1f2c4'; // 
            $blockshade = '#c2d59c'; // 
            $inputborder = $blockshade;
            $linkcolor = '#423e0a';
            $linkcolorhover = '#0b0a02';
            $linkcolorfocus = '#0b0a02';
            $headingcolor = '#181818';
            break;
            
         case 5 :  //pink
            $menustart = '#92352f'; //darkred
            $menuend = '#c6897e'; //lightred
            $pastel = '#fff'; //pastelred
            $blockbackground = '#FFEEEC'; //
            $blockshade = '#FFEEEC'; //
            $inputborder = $blockshade;
            $linkcolor = '#3A94BF';
            $linkcolorhover = '#7B290B';
            $linkcolorfocus = '#30377B';
            $headingcolor = '#181818';
            break;

        break;

      default:
        $menustart = '#997b0f';
        $menuend = '#e6b400';
        break;
    }

    $css = str_replace($menucolorstarttag, $menustart, $css);
    $css = str_replace($menucolorendtag, $menuend, $css);
    $css = str_replace($pastelcolortag, $pastel, $css);
    $css = str_replace($blockbackgroundtag, $blockbackground, $css);
    $css = str_replace($blockshadetag, $blockshade, $css);
    $css = str_replace($inputbordertag, $inputborder, $css);
    $css = str_replace($linkcolortag, $linkcolor, $css);
    $css = str_replace($linkcolorhovertag, $linkcolorfocus, $css);
    $css = str_replace($linkcolorfocustag, $linkcolorhover, $css);
    $css = str_replace($headingcolortag, $headingcolor, $css);

    return $css;
}


function nuim_set_loginbackground($css, $imageurl) {
    $tag = '[[setting:custombackground]]';
    $replacement = 'background-image: url('.$imageurl.')';
    $css = str_replace($tag, $replacement, $css);

    return $css;
}



function nuim_set_loginboxposition($css, $loginposition,$loginhelpposition) {    
    $tag = '[[settings:loginpaddingleft]]';
    $replacement = $loginposition;
    $css = str_replace($tag, $replacement, $css);
    
    $tag = '[[settings:loginhelpmarginleft]]';
    $replacement = $loginhelpposition;
    $css = str_replace($tag, $replacement, $css);

    return $css;
}

function nuim_set_linkhover($css, $linkhover) {
    $tag = '[[setting:linkhover]]';
    $replacement = $linkhover;
    if (is_null($replacement)) {
        $replacement = '#666666';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function nuim_set_loginbgcolor($css,$loginbgcolor) {
    $tag = '[[setting:loginbgcolor]]';
    $replacement = $loginbgcolor;
    if (is_null($replacement)) {
        $replacement = '#000000';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

