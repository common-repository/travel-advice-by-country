=== Plugin Name ===
Contributors: wrigs1
Donate link: http://inblighty.com/
Tags: Travel, Travel Advice, Travel Information, Country, Country Advice, Country Information, travel widget, widget, holiday, vacation
Requires at least: 2.8
Tested up to: 4.3 beta
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Latest Travel Information and Advice by country from drop down combo box for over 200 countries (Afghanistan to Zimbabwe). Customisable.

== Description ==

Provides you and your visitors with the latest authoritative travel advice for over 200 countries via a simple drop-down combo box.
See [this blog](http://wptest.means.us.com) for live examples (one blended & one ugly custom).

*Note: the travel advice is displayed on an external web page in a new browser tab. A later release may have the option to display advice on custom page within the site. I have yet to investigate feasibility.*

Designed to blend in with your site, with options for changing alignment, width, colors (text, button etc) and button label text.
This version also allows you to specify padding above/below widget and title - to improve the look where the theme or other widgets
settings seem to make the space between widgets look unbalanced.

SEO friendly (Google has indexed my WP site for every country name in the dropdown list). 

The widget has been tested under Wordpress 4.3 beta/PHP 5.4  against numerous themes and should be compatible with WP 2.8 onwards.
Versions are also available as pure PHP (just 2 statements), HTML, and as a Blogger Gadget 
- for more info and to check for known issues see [travelchimps.com/widgets/travel-widgets.php](http://travelchimps.com/widgets/travel-widgets.php).


== Installation ==

The easiest way is direct from your WP Dashboard like any other widget:

1.Plugins -> Add New -> do a search for travel to find it -> click "install now"

2.Activate the plugin.

3.From the Dashboard 'Appearance' -> 'Widgets' menu. Drag the widget to the "widget area" you want it to appear in.

4. Whilst in this "widget area" you will see a faint dropdown arrow next any widgets that you have installed - this lets you customise them. 
   The travel widget uses your default color scheme, but if you wish you can customise colors, width and button text.

Alternatively:

1. Download the plugin direct from the Plugin Page at WordPress.org

2. Upload the WHOLE ZIP file (contains 'cadvice-wpwidget.php', screenshot-1.jpg and readme.txt) to your WordPress plugins directory ( normally /wp-content/plugins/ ).

3. Activate and configure as in 2 to 4 above.


== Frequently Asked Questions ==

== The drop down box is blank and does not list the countries =

A user has just reported this to to me.  It may be because of a restriction on PHP functionality (for valid security reasons) by your website host - version 0.9.0 should fix this; it includes an 
alternative method of retrieving the index for the dropdown box data.

If anyone has this problem under the new version - please let me know.


== Screenshots ==

1. "Standard and custom example: screenshot-1.jpg.

== Changelog ==

= 1.1.0 =
* modified for compatibility with upcoming Wordpress 4.3
* "get widget" link removed from widget to comply with WP requirements

= 1.0.0 =
* 30 June 11: ESSENTIAL TO UPDATE BEFORE END SEPT 2011 when file used by previous versions will be withdrawn.
Speed improvements - the file used by the widget is smaller + faster rendering of country information for users .
Fixes issue for IE6 users where the browser displayed the country advice page too wide, requiring users to horizontal scroll). 

= 0.9.5 =
* 25 Mar 2011 Caching introduced - so there is no need for the widget to retrieve the drop-down form for every visitor on every page. This will reduce server bandwidth usage, and the widget should be even
 quicker to load.  - Note: to encourage users to adopt this internet and server friendly upgrade previous versions of the widget will cease to function from 25 Sep 2011.
 
 Background: The drop-down form data was (and is) served from our own server instead of being hard coded in the widget.  This means there is no need to install a new version to cater for additions 
 to the menu (e.g. a new breakaway country). However, it is unnecessary for this to be retrieved from it's URL on every visit to every page.

= 0.9.1 =
* Further fix to cope with websites that don't allow PHP "file_get_contents". Reversed code so "CURL" is attempted first - fixes failure to identify "file_get" has failed.

= 0.9.0 =
* Will now use "CURL" to retrieve data if "file_get contents" fails.  Resolves issue of empty drop down box where a website host has turned off PHP "allow_url_fopen" functionality.  
  This has ONLY BEEN REPORTED ONCE - there is no need to upgrade if your widget is working.

= 0.8.2 = 
* change to readme.txt only, replacing '.' by ',' after 'travel' tag so plugin directory search for 'travel' will list this widget

= 0.8.1 =
* change to readme.txt only, to identify if you use WP admin plugin upload it is the whole zip that should be uploaded.

= 0.8 =
* First published version.

== Upgrade Notice ==

= 1.1.0 =
* modified for compatibility with upcoming Wordpress 4.3
* "get widget" link removed from widget to comply with WP requirements

= 1.0.0 =

Speed improvements - the file retrieved by the widget is reduced in size + rendering of country information for users quicker and both summary and detailed information are now displayed on one page.

= 0.9.5 = 

Caching introduced - to encourage users to adopt this internet and server friendly upgrade previous versions of the widget will cease to function from 25 Sep 2011.

== License ==

This program is free software licensed under the terms of the [GNU General Public License version 2](http://www.gnu.org/licenses/old-licenses/gpl-2.0.html) as published by the Free Software Foundation.

In particular please note the following:

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.