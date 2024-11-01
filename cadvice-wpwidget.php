<?php
/*
Plugin Name: Travel Advice by Country Widget
Plugin URI: http://inblighty.com/widgets/travel-widgets.php
Description: Travel Information by country from drop down combo box for over 200 countries (Afghanistan to Zimbabwe). Customisable
Author: Andrew Wrigley
Version: 1.1.0
Author URI: http://inblighty.com/
*/


class CountryAdviceWidget extends WP_Widget
{

/* constructor */
    function __construct() {
      $widget_ops = array('classname' => 'aw_countrywidget', 'description' => __( "Travel Advice") );
      $control_ops = array('width' => 320, 'height' => 300,  'id_base' => 'awcountry');
      parent::__construct('awcountry', 'Travel Advice', $widget_ops, $control_ops);
/*parent::WP_Widget(false, $name = 'CountryAdviceWidget');*/
    }

/* displays widget overrides class WP_Widget with own stuff */
	 	function widget($args, $instance) {		
		/*$args = standard widget variables what to display before and after widget etc as defined by WP themes*/
		/* more than one instance object can be created*/
      extract( $args );
			/*variables holding website specified config settings for widget look */
      $title = apply_filters('widget_title', $instance['title']);
      $width = $instance['width'];
      $btnbkg = $instance['btnbkg'];
      $btnfnt = $instance['btnfnt'];		
			$btntxt=$instance['btntxt'];
			$dropbg=$instance['dropbg'];
			$dropfnt=$instance['dropfnt'];
			$newtab=strtolower($instance['newtab']);
			$aline=$instance['aline'];
			$abovewidget=$instance['abovewidget'];
			$belowtitle=$instance['belowtitle'];
			$belowwidget=$instance['belowwidget'];			
      echo $before_widget;
/* build widget dropdown box using website chosen or defaults */
			if (strlen($abovewidget) > 2 ) echo "<div style='height:$abovewidget;'>&nbsp;</div>\n";
      if ( $title )echo $before_title . $title . $after_title;
			$formstyle='';
			if (strlen($aline) > 0 && $aline != 'theme') $formstyle=" style='text-align:$aline;'";		
      $dropstyle='';
      if (strlen($width) > 0 ) $dropstyle="width:$width;";
      if (strlen($dropbg) > 0 ) $dropstyle .= "background:$dropbg;";
      if (strlen($dropfnt) > 0 ) $dropstyle .= "color:$dropfnt;";
      if (strlen($dropstyle) > 0 ) $dropstyle = " style='" . $dropstyle . "' ";

      if (strlen($belowtitle) > 2 ) echo "<div style='height:$belowtitle;'>&nbsp;</div>\n";
// old pre INNOV CTYS
//      if ($newtab != 'n') echo  "<form method='post' target='_blank' action='http://inblighty.com/widgets/country-advice-widget2.php' $formstyle>\n<select name ='inlynx' $dropstyle>\n";
//      else echo  "<form method='post' action='http://inblighty.com/widgets/country-advice-widget2.php' $formstyle>\n<select name ='inlynx' $dropstyle>\n";
      if ($newtab != 'n') echo  "<form method='post' target='_blank' action='http://travelchimps.com/country/advice.php' $formstyle>\n<select name ='inlynx' $dropstyle>\n";
      else echo  "<form method='post' action='http://travelchimps.com/country/advice.php' $formstyle>\n<select name ='inlynx' $dropstyle>\n";


// use cached, or create country form cache if it does not exist
//      if (false === ( $includeFile = get_transient('aw_ctyform') ) ) {  // old preInov cache name - reuse this name again if new list url is used

      if (false === ( $includeFile = get_transient('aw_ctylist') ) ) {

			// identify url of dropdown form to retrieve
	 			   // old url of dropdown data
	 			   //		$url_for_ctyform = 'http://inblighty.com/widgets/country_form_for_wid.htm';
				   //		$url_for_ctyform = 'http://inblighty.com/country/widctylst.inc';  //	from now on use travelchimps domain, inc duplications in inblighty.com are being retired
				$url_for_ctyform = 'http://travelchimps.com/country/widctylst.inc';


// request include User Agent - may modify htaccess to only respond for these UA's to do: ENSURE CPANEL REPORTS CORRECT USER AGENT FOR BOTH curl AND GET (DISABLE ONE TO TEST) IF OKAY SET HTACCESS TO PREVENT BLANK UA'S

            /* if server does not allow curl then try file_get to retrieve form from remote server */
            if (function_exists('curl_version')) { 
                      $ch = curl_init();
                      $timeout = 10;
                      curl_setopt ($ch, CURLOPT_URL, $url_for_ctyform);
                      curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
                      curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
											curl_setopt($ch,CURLOPT_USERAGENT,'wpctywidCU');											
                      $includeFile = curl_exec($ch);
//										set_transient('aw_ctyform', $includeFile, 12*3600);  // old form cache may reuse on modification
										  set_transient('aw_ctylist', $includeFile, 12*3600);
                      curl_close($ch);
            } 
            else {
								ini_set('user_agent', 'wpCtywidFG'); 
            		$includeFile=file_get_contents($url_for_ctyform);
//								set_transient('aw_ctyform',$includeFile, 12*3600); // old cache
								set_transient('aw_ctylist', $includeFile, 12*3600);
            }
      }


// form retrieved from cache or from URL
      echo $includeFile;
      $btnstyle='';
      if (strlen($btnbkg) > 0 ) $btnstyle="background:$btnbkg;";
      if (strlen($btnfnt) > 0 ) $btnstyle .="color:$btnfnt;";
      if (strlen($btnstyle) > 0 ) $btnstyle = " style='" . $btnstyle . "' ";
      echo "</select>\n<input type='submit' value='$btntxt' name='submit' $btnstyle />\n";
			echo "\n</form>";
      if (strlen($belowwidget) > 2 ) echo "<div style='height:$belowwidget;'>&nbsp;</div>\n";
      echo $after_widget;
   }

/*$instance is an array that will store all of your widget’s configurable options, which in this case is $title, $lineOne, and $lineTwo. 
/*called on "save" settings page from WP widgets admin*/ 
    function update($new_instance, $old_instance) {
		// $instance, new information about this particular instance of the widget	
		//$old_instance, previously saved widget information
			$instance = $old_instance;
    	$instance['title'] = strip_tags($new_instance['title']);
      $instance['width'] = strip_tags(stripslashes($new_instance['width']));
      $instance['btnbkg'] = strip_tags(stripslashes($new_instance['btnbkg']));
      $instance['btnfnt'] = strip_tags(stripslashes($new_instance['btnfnt']));
      $instance['btntxt'] = strip_tags(stripslashes($new_instance['btntxt']));
      $instance['dropbg'] = strip_tags(stripslashes($new_instance['dropbg']));
      $instance['dropfnt'] = strip_tags(stripslashes($new_instance['dropfnt']));
      $instance['newtab'] = strip_tags(stripslashes($new_instance['newtab']));
      $instance['aline'] = strip_tags(stripslashes($new_instance['aline']));
      $instance['abovewidget'] = strip_tags(stripslashes($new_instance['abovewidget']));	
      $instance['belowtitle'] = strip_tags(stripslashes($new_instance['belowtitle']));
      $instance['belowwidget'] = strip_tags(stripslashes($new_instance['belowwidget']));		
      return $instance;
    }

    function form($instance) {			

      //Defaults
      $instance = wp_parse_args( (array) $instance, array('title'=>'Travel Advice', 'width'=>'180px', 'btnbkg'=>'', 'btntxt'=>'Select', 'dropbg'=>'', 'dropfnt'=>'', 'credanc'=>'', 'newtab'=>'y', 'aline'=>'', 'abovewidget'=>'', 'belowtitle'=>'', 'belowwidget'=>'' ) );
      $title = htmlspecialchars($instance['title']);
      $width = htmlspecialchars($instance['width']);
      $btntxt = htmlspecialchars($instance['btntxt']);
      $btnbkg = htmlspecialchars($instance['btnbkg']);
			$btnfnt = htmlspecialchars($instance['btnfnt']);
      $dropbg = htmlspecialchars($instance['dropbg']);
      $dropfnt = htmlspecialchars($instance['dropfnt']);
      $newtab = htmlspecialchars($instance['newtab']);
      $aline = htmlspecialchars($instance['aline']);
      $abovewidget = htmlspecialchars($instance['abovewidget']);	
      $belowtitle = htmlspecialchars($instance['belowtitle']);			
      $belowwidget = htmlspecialchars($instance['belowwidget']);	
      # Output the options
      echo '<p style="text-align:right;"><label for="' . $this->get_field_name('title') . '">' . __('Title:') . ' <input style="width: 250px;" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></label></p>';
      echo '<p style="text-align:right;"><label for="' . $this->get_field_name('width') . '">' . __('Dropdown Box width:') . ' <input style="width: 50px;" id="' . $this->get_field_id('width') . '" name="' . $this->get_field_name('width') . '" type="text" value="' . $width . '" /></label></p>';
      echo '<p style="text-align:right;"><label for="' . $this->get_field_name('btntxt') . '">' . __('Button Text:') . ' <input style="width: 150px;" id="' . $this->get_field_id('btntxt') . '" name="' . $this->get_field_name('btntxt') . '" type="text" value="' . $btntxt . '" /></label></p>';
      echo '<p style="text-align:right;"><label for="' . $this->get_field_name('btnbkg') . '">' . __('Button Color e.g. "black" or "#000000":') . ' <input style="width: 60px;" id="' . $this->get_field_id('btnbkg') . '" name="' . $this->get_field_name('btnbkg') . '" type="text" value="' . $btnbkg . '" /></label></p>';
      echo '<p style="text-align:right;"><label for="' . $this->get_field_name('btnfnt') . '">' . __('Button Font Color e.g. "white" or "#ffffff":') . ' <input style="width: 60px;" id="' . $this->get_field_id('btnfnt') . '" name="' . $this->get_field_name('btnfnt') . '" type="text" value="' . $btnfnt . '" /></label></p>';
      echo '<p style="text-align:right;"><label for="' . $this->get_field_name('dropbg') . '">' . __('Dropdown BG color e.g. "black" or "#000000":') . ' <input style="width: 60px;" id="' . $this->get_field_id('dropbg') . '" name="' . $this->get_field_name('dropbg') . '" type="text" value="' . $dropbg . '" /></label></p>';
      echo '<p style="text-align:right;"><label for="' . $this->get_field_name('dropfnt') . '">' . __('Dropdown font color e.g. "black" or "#000000":') . ' <input style="width: 60px;" id="' . $this->get_field_id('dropfnt') . '" name="' . $this->get_field_name('dropfnt') . '" type="text" value="' . $dropfnt . '" /></label></p>';
      echo '<p style="text-align:right;"><label for="' . $this->get_field_name('newtab') . '">' . __('Display Country Info on new page y/n?') . ' <input style="width:15px;" id="' . $this->get_field_id('newtab') . '" name="' . $this->get_field_name('newtab') . '" type="text" value="' . $newtab . '" /></label></p>';
      echo '<p style="text-align:right;"><label for="' . $this->get_field_name('aline') . '">' . __('Dropdown Box alignment, leave empty for theme default, or "left","right" or "center":') . ' <input style="width: 50px;" id="' . $this->get_field_id('aline') . '" name="' . $this->get_field_name('aline') . '" type="text" value="' . $aline . '" /></label></p>';
      echo '<p style="text-align:right;"><label for="' . $this->get_field_name('abovewidget') . '">' . __('(extra) Padding above Widget e.g. 5px') . ' <input style="width: 50px;" id="' . $this->get_field_id('abovewidget') . '" name="' . $this->get_field_name('abovewidget') . '" type="text" value="' . $abovewidget . '" /></label></p>';
      echo '<p style="text-align:right;"><label for="' . $this->get_field_name('belowtitle') . '">' . __('(extra) Padding below Title in px') . ' <input style="width: 50px;" id="' . $this->get_field_id('belowtitle') . '" name="' . $this->get_field_name('belowtitle') . '" type="text" value="' . $belowtitle . '" /></label></p>';
      echo '<p style="text-align:right;"><label for="' . $this->get_field_name('belowwidget') . '">' . __('(extra) Padding below Widget in px') . ' <input style="width: 50px;" id="' . $this->get_field_id('belowwidget') . '" name="' . $this->get_field_name('belowwidget') . '" type="text" value="' . $belowwidget . '" /></label></p>';
    }
} // end class countrywidget

/* registers/initialises widget*/
  function CountryInit() {
    register_widget('CountryAdviceWidget');
  }
  add_action('widgets_init', 'CountryInit');