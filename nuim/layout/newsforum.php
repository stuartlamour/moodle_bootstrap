<?php
require_once($CFG->dirroot.'/mod/forum/lib.php');   // We'll need this

$text = '';

if (!$forum = forum_get_course_forum($COURSE->id, 'news')) {
    return '';
}

$modinfo = get_fast_modinfo($COURSE);
if (empty($modinfo->instances['forum'][$forum->id])) {
    return '';
}
$cm = $modinfo->instances['forum'][$forum->id];

if (!$cm->uservisible) {
    return '';
}

$context = get_context_instance(CONTEXT_MODULE, $cm->id);

/// User must have perms to view discussions in that forum
if (!has_capability('mod/forum:viewdiscussion', $context)) {
    return '';
}

/// First work out whether we can post to this group and if so, include a link
$groupmode    = groups_get_activity_groupmode($cm);
$currentgroup = groups_get_activity_group($cm, true);


if (forum_user_can_post_discussion($forum, $currentgroup, $groupmode, $cm, $context)) {
    $text .= '<div class="newlink"><a href="'.$CFG->wwwroot.'/mod/forum/post.php?forum='.$forum->id.'">'.
    get_string('addanewtopic', 'forum').'</a>...</div>';
}

/// Get all the recent discussions we're allowed to see

if (! $discussions = forum_get_discussions($cm, 'p.modified DESC', true,
$currentgroup, $COURSE->newsitems) ) {
    $text .= '('.get_string('nonews', 'forum').')';
    $nuim_news_output = $text;
    return $nuim_news_output;
}

/// Actually create the listing now

$strftimerecent = get_string('strftimerecent');


/// Accessibility: markup as a list.
$text .= "<div id='featured'>";
foreach ($discussions as $discussion) {
    $strmore = get_string('read_more', 'theme_nuim');
    if (isset($discussion->message)) {
        if (strlen($discussion->message) > 250) {
            $message = substr($discussion->message,0,250) . '..';
        } else {
            $message = $discussion->message;
            $strmore = '';
        }
    } else {
        $message = '';
    }

    $discussion->subject = $discussion->name;

    $discussion->subject = format_string($discussion->subject, true, $forum->course);

    $text .= '<div class="forumpost">'.
                         '<div class="head clearfix">'. 
                         '<div class="info"><h2>'.get_string('sitenews','theme_nuim'). '</h2></div>' .
                         '<div class="date name"><b>'. $discussion->subject .'</b> '.userdate($discussion->modified, $strftimerecent).' '.fullname($discussion).'  
                         
                         </div></div>'.                         
                         '<div class="message">'. $message . ' </div>' .
                         '<div class="readmore"><a href="'.$CFG->wwwroot.'/mod/forum/discuss.php?d='.$discussion->discussion.'">'.
                          $strmore.'</a></div>'.
                         "</div>\n";

}
$text .= "</div>\n";

$nuim_news_output = $text;

get_string('oldertopics', 'forum').'</a> ...';
 echo $nuim_news_output;

?>
