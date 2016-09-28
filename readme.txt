=== Kebo Twitter Feed ===
Contributors: PeterBooker
Tags: twitter, feed, twitter feed, latest tweets, social, widget, tweets
Requires at least: 3.2
Tested up to: 4.6.1
Stable tag: 1.5.12
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Display your Twitter Feed beautifully in 60 seconds.

== Description ==

Hassle-free and user-friendly way to add a Twitter Feed to your website. Get started in just a few clicks without the need to setup your own Twitter App. Use the provided Widget or Shortcode to easily display your Tweets on your website.

= Why use Kebo Twitter Feed? =

* Get started in just a few clicks. No setting up your own Twitter App.
* Fits seamlessly with your current site design.
* Friendly and active support.
* Compatible with any WordPress hosting.
* WordPress Multisite compatible.
* Refreshes Tweets in the background, never impacts pageload.
* Translation ready (see below for included languages).

Other solutions usually require you to create a Twitter App and provide the plugin with oAuth credentials yourself. We don't believe it should be that hard, and with our plugin you can get the Tweets displayed on your website with just a few clicks.

We make this so easy by managing all the complex oAuth requests on our own server using our Twitter app. Our app only asks for read permission and we only ever request publically available information. Your data is never stored on our system and you can read more about how we treat your information in our [privacy policy](http://kebopowered.com/privacy-policy/#social-connections "Kebo Privacy Policy").

= Main Features =

* Hassle-free setup (no creating a Twitter App).
* Easily display Tweets with a Widget or Shortcode.
* Choose to show a profile image, attached media and much more with your Tweets.
* Advanced Caching, so that we never impact pageload speed.
* Local cache backup, in case the connection to Twitter has problems.

= Included Translations =

* German by [Bego Mario Garde](https://twitter.com/pixolin).
* Russian by [Stas Newdel](http://newdel.net).
* Italian by [Alberto Ramacciotti](http://ramacciotti.altervista.org).
* Dutch by [Renee Klein](http://restaurantthemes101.com).
* English (British) by [Peter Booker](https://kebopowered.com).
* Swedish by [Johanna Kitzman](https://www.facebook.com/johannakitzmanphotography).
* Serbian by [Borisa Djuraskovic](http://www.webhostinghub.com/).
* Spanish by [Javier Sanz](http://escueladebaileelalmacen.com/).

= Rate Us / Feedback =

Please take the time to let us and others know about your experiences by leaving a review. If your use of our plugin has not been a five star experience we would like to understand why, so that we can improve the plugin for you and other users.

== Installation ==

1. Install using your WordPress Admin or upload /kebo-twitter-feed/ to the /wp-content/plugins/ directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Visit the Kebo Twitter menu at the bottom of your WordPress control panel.
4. Click on the large 'Connect to Twitter' button and follow the prompts.
5. Place the 'Kebo Twitter Feed' Widget into a Widget area through the 'Appearance -> Widgets' menu in WordPress.

== Frequently Asked Questions ==

= Why should I use Kebo Twitter Feed? =

It is significantly easier to use than other plugins. We no not require that you create your own developer application at Twitter and then copy your credentials across to the plugin options. We skip this step by providing access to our own Twitter App allowing you to get started in just a few clicks.

We also make good use of inbuilt WordPress functions for caching and compatibility. Meaning that our plugin functions efficiently and has no hosting requirements above those which WordPress itself uses, making it safe to use on any site.

= How do you get my Twitter Feed? =

We provide a connection from your website to your Twitter feed using our Kebo Twitter App, using OAuth2. Once you grant permission for us to read your Twitter Feed we can provide your website with this information.

= What information do you access? =

Your website will hold your OAuth2 credentials and a list of your latest tweets. Your website will occasionally poll Twitter to update your feed, using our OAuth App, but none of the data is ever stored. We only ever request basic profile information and your latest tweets from twitter.

= Do you ever write to my Twitter account? =

The Kebo Twitter App only requests Read access to your account. This prevents us from ever creating tweets or sending direct messages on your behalf.

= I have found a bug or need help using the plugin, what do I do? =

Let us know in our [Support Forum](http://wordpress.org/support/plugin/kebo-twitter-feed). We want to hear about any bugs and/or problems ASAP so that we can fix them to improve the experience for all users.

= There is something cool you could add... =

Fantastic, make a post on the [Support Forum](http://wordpress.org/support/plugin/kebo-twitter-feed) and let us know. We are always looking for ways to improve our plugins.

= Will this plugin leave clutter in my WordPress database? =

We store data in an option and transient, both of which are removed when you uninstall the plugin. No trace will be left in your database.

== Screenshots ==

1. This is the settings page for the plugin, you will need to connect your website to Twitter by clicking the 'Conntect to Twitter' button.
2. Once you have setup a connection to Twitter, this is what the settings page should look like. You will now have access to our Widget.
3. This is the Widget you can use to display your Twitter Feed.
4. The Widget in action on the soon to be released theme 'Twenty Thirteen' coming in the next major WordPress update.
5. An example of how the Widget fits into the design of a theme automatically.

== Changelog ==

= 1.5.12 - 2016/09/28 =
* Bug Fix: Updated Widget class constructor method, to bring compatibility with PHP7.
* Note: Version 2.0 development is complete. Testing it in production with volunteers and will release in the next couple of weeks.

= 1.5.11 - 2016/01/14 =
* Bug Fix: Switches to a new domain for the API, which resolves the current issue of not being able to update Tweet data. Sorry for the inconvenience.

= 1.5.10 - 2015/09/03 =
* Bug Fix: Replace old method of initiating WP_Widget instances, to bring compatibility with WordPress 4.3 (and about time too!).

= 1.5.8 - 2015/04/01 =
* Bug Fix: Updated the URL used to connect your Twitter account to your website. Resolves the current Twitter account connection issues, rendering the plugin inoperative.
* Note: My sincere apologies for the extended period the plugin was not functioning, personal issues around took me away from work for an unexpectedly long period. I am back now full time and you can expect more timely updates and improvements.

= 1.5.7 =
* Bug Fix: Fixes a bug introduced in the last update. Prevents an array_multisort() error on Tweets with just plain text.

= 1.5.6 =
* New Feature: Added the Spanish (es_ES) language files, thanks to Javier Sanz for providing the translation.
* Bug Fix: Fixed a problem where URLs, Mentions and Hashtags were not always being correctly converted into HTML links. They should always display correctly now.

= 1.5.4 =
* Bug Fix: Fixed a bug where Hashtags where not fully turned into links when words contained characters with diacrititcs. (props fris)

= 1.5.3 =
* Bug Fix: Shortcodes can now correctly use the intent and media_visible options now too. Fixes a problem where the intent links would never show for Shortcodes. (props chriscolden)
* Bug Fix: Improved the display of images on Tweets shown in wide areas (like full page through the Shortcode). Properly centred and use their natural width.

= 1.5.2 =
* Bug Fix: Fixes Tweet text getting corrupted when turning entities (Hashtags, Mentions, URLs) into links caused by html special characters being encoded (more than one character) when processed.

= 1.5.1 =
* Bug Fix: Fixes a Fatal PHP error caused by hosting without mb_ functions active. Now checks for this and uses old method to linkify text if not present.

= 1.5.0 =
* Important: Major change to the way text is converted into links (e.g. hashtags, mentions and URLs). The plugin now uses the Twitter Entity data to find/replace these with links, which has an added bonus of being able to display the proper URL instead of the shortlink normally present.
* New Feature: Added CSS styling fixes to combat common bad practice in themes, e.g. styling widgets using genertic identifiers and IDs like #widgets and #sidebar, which makes plugin overrides very difficult.
* New Feature: Added an option to the Widget (and Shortcode parameter) to control the display of the Twitter Intent Links (Reply, Re-Tweet and Favourite). Displays them by default.
* New Feature: Added an option to the Widget (and Shortcode parameter) to control whether or not Tweets with images display the image by default or have it hidden. Hidden by default.
* Bug Fix: Media attached to Tweets should now display centered if not the full width of its container. This should improve the display for those using the Shortcode inside page content.

= 1.4.11 =
* Bug Fix: Remove slashes added to tweet text, caused by recent update which makes links rel="nofollow". All Tweet content should be displayed properly again.
* Note: As we reach 100,000 downloads I just want to thank you all for using the plugin, you make it worth while.

= 1.4.10 =
* New Feature: Added the Serbian (sr_RS) language files, thanks to Borisa Djuraskovic for providing the translation.
* Bug Fix: Properly add NoFollow to mentions and hashtags when the option is set.

= 1.4.9 =
* Important: Tested and updated for WordPress 3.9 compatibility, with focus on the new Widget Customizer feature.
* Bug Fix: Potential fix to images not being output with Tweets leaving empty HTML.

= 1.4.8 =
* New Feature: The plugins options page now allows you to choose whether or not the links created by the plugin use the rel="nofollow" attribute.

= 1.4.7 =
* Important: If you have been suffering the "Sorry, no Tweets found." problem since the API problems last week this update might resolve that problem for you.
* Bug Fix: Now properly removes the plugins Widget configuration and version number from the database when the plugin is uninstalled.
* Bug Fix: Improved various areas of code to better avoid the possibility of PHP errors when dealing with unexpected data/values.
* Bug Fix: Updates will now completely clear the cached data. This should resolve a bug where an API problem resulted in cached data only holding an expiry time as an array, as the cached data was expected to be an object, this caused many problems.
* Note: Saving on the plugins options page will now delete the transient holding the Cached Tweet Data, this allows users to forcefully clear the cache which may solve certain problems.

= 1.4.6 =
* Important: The Kebo API server changes recently, which means it now runs from a different IP address. The new IP is 23.239.13.127 and this will not be changing for a few months. I realise that such a fast and unannounced change is very inconvenient and I will ensure that next time I give a few weeks notice and announce the coming change in these change logs and in the plugin.
* New Feature: Added an API Status box to the top right of the plugin's settings page. This checks whether or not your site can connect to the API Server successfully or not. It will turn green for success or red for failure shortly after the page loads.
* New Feature: There is now a 'Debug Tweet Data' link at the far bottom of the plugin's settings page. This will load the cached Tweet data into a text box which will assist in debugging problems with the plugin.

= 1.4.4 =
* Bug Fix: Styled the Tweet list item to height: auto, so that general theme styling does not alter the height of the Tweets.

= 1.4.3 =
* Bug Fix: Hovering over the Tweet date now correctly shows the time adjusted for timezone. (thanks dr4g0nus)
* Bug Fix: Fixed br tags damaging the Shortcode output and breaking the layout/styling. Used a CSS trick to disable any br tags inside the plugin Shortcode.

= 1.4.2 =
* Bug Fix: Improved Slider theme compatibility by identifying it using the widget ID as a class. Involved a change to the slider view file.
* Bug Fix: Removed the border under the last Tweet in the list.

= 1.4.1 =
* Bug Fix: Slider now correctly fetches the animation speed and timer, so it does not transition too fast.

= 1.4.0 =
* New Feature: Changed the system behind the Slider, this should resolve bugs breaking the display when using the Slider. It now uses http://responsiveslides.com/ by Viljami Salminen (thanks to pixolin for the suggestion).
* Important: Due to the above change there have been small changes to the HTML output (IDs and Classes) of the Slider view file.

= 1.3.0 =
* New Feature: Now searches for custom template files in the theme ( 'views/kebo-twitter-list.php' and 'views/kebo-twitter-slider.php' ), allowing users to more easily customise the plugin output.
* Bug Fix: Improved security by blocking anything other than links from the Tweet content.

= 1.2.0 =
* Note: First pass at properly using sanization on all outputs for improved security.
* Bug Fix: Added WordPress 3.2 compatibility for enqueueing the stylesheet, as it does not support adding files after the header. Now gets enqueued on all pages automatically.

= 1.1.8 =
* Bug Fix: Prevented calling the WP Pointer unless on version 3.3 or up, to maintain compatibility with version 3.2.

= 1.1.7 =
* Bug Fix: Fixed a problem where the Tweets would be displayed slightly to the right, as the Themes CSS would overwrite the plugins styling, adding a margin-left to the unordered list element.

= 1.1.6 =
* Bug Fix: The Shortcode now correctly prints the Slider javascript.
* Bug Fix: Changed the way the Slider calculates how many slides are present, which fixes a problem where some cycles of the Slider had all slides hidden.

= 1.1.5 =
* Note: Removed all the jQuery Masonry compatibility code, as it was causing another bug where the Slider would get stuck and repeatedly show a single slide.

= 1.1.4 =
* Bug Fix: Fixed an error where the slider would get to the last slide and then continue showing this slide permanently.
* Note: Improved jQuery Masonry detection and recalculation.

= 1.1.3 =
* Bug Fix: Default CSS now forces 'text-align: left' on the account name of each Tweet.
* Note: Improved the code which attempts to detect jQuery Masonry.

= 1.1.2 =
* Bug Fix: Added inline CSS to list items in the Slider. This prevents themes from overwriting the 'display: none' property which breaks the slider, causing two slides to be visible at a time.
* Bug Fix: Added a check for jQuery Masonry being active when using the Slider, if so each slide forces Masonry to recalculate positions, so the resizing of the Tweets does not break the widget positioning.

= 1.1.1 =
* Bug Fix: Changed how we sanitize/validate the 'Style' option in the Widget. We now test it against being a numerical value, instead of filtering it for HTML.

= 1.1.0 =
* Note: Removed inline javascript from view files into functions. If you are using custom View files, you can safely remove the inline javascript after updating. There is a small edit to the end of the lists view file to ensure the media javascript is output.

= 1.0.9 =
* Bug Fix: Correctly supply https avatar images when the site is using SSL.
* Bug Fix: Added default style to Tweet text as 'text-align: left' to ensure other theme Widget styling does not overwrite it.

= 1.0.8 =
* New Feature: Included the Swedish language translation files. Our thanks to Johanna Kitzman for providing the translation.

= 1.0.7 =
* New Feature: Included the British English (en_GB) language translation files.
* Bug Fix: Now correctly displays Re-Tweets, with the exact original text.

= 1.0.5 =
* Bug Fix: Prevent simultaneous Twitter API updates in certain situations. This did not effect users in any way and neither will the change.
* Bug Fix: Correctly prefix all Javascript variables with 'k', so they do not clash with others. Only effects those displaying Tweets using the 'Slider' method.

= 1.0.4 =
* New Feature: Included the Dutch language translation files. Our thanks to Renee Klein from themes101 for providing the translation.

= 1.0.3 =
* New Feature: Included the Italian language translation files. Our thanks to Alberto Ramacciotti (obert) for providing the translation.

= 1.0.2 =
* Note: New version to fix a bad released on wordpress.org, some files got muddled up in version 1.0.1.

= 1.0.1 =
* Note: We finally reached our goals for compatibility, reliability and feature set and have moved past the version 1.0.0 release point. This means we are confident that users of the plugin will have an excellent experience. However it does not mean we are going to stop working on the plugin, as there are more features and a lot of polish we would like to add, to make this the greatest Twitter Feed plugin of all. Thanks to all our users and everyone who has made the time to give feedback, your input and support is invaluable.
* New Feature: We now import your Re-Tweets too, you can now choose between displaying your personal Tweets, your Re-Tweets, or all your Tweets.
* New Feature: Russian translation files are now included. Our thanks to Stas Newdel (stasn) for providing the translation.
* Bug Fix: Fixed the alignment of profile images inside Tweets. The recent RTL changes did not have the required .rtl class, so were effecting the default view by mistake.
* Note: The Widget and Shortcode have been updated to handle us now importing Re-Tweets. The Widget has a dropdown called 'Display', with the options 'Tweets' (Your personal Tweets), 'Re-Tweets' (Your Re-Tweets) and 'All Tweets' (Your Tweets and Re-Tweets). By Re-Tweets we mean other user's Tweets which you Re-Tweeted. The Shortcode has the 'display' parameter, which has the same three options 'tweets', 'retweets' and 'all'. The default for both is just showing your personal Tweets (no Re-Tweets).

= 0.9.8 =
* New Feature: Right-to-Left (RTL) language support.
* Bug Fix: Resolved bad check for no Tweets. Only displays "Sorry, no Tweets were found." if there really are no Tweets.

= 0.9.7 =
* New Feature: German translation file included by default. Our thanks to Bego Mario Garde (pixolin) for providing the translation.
* Bug Fix: Fixed language .mo files from not being included correctly. Now including your own translation .mo file should work.

= 0.9.6 =
* New Feature: Included a 'kebo_twitter.pot' file, so that users can translate the plugin into their own language. If you do translate it, I would be grateful if you could send the files to me and we will include them in the plugin.

= 0.9.5 =
* Note: Removed the date format option. The plugin now uses the date format selected under 'Settings -> General'. This allows it to be automatically be translated for those using WordPress in other languages.
* Note: Updated the Error Log area of the options page to make it only visible if there have been an error, and to make it more clear these are errors when connecting to the Twitter API.
* Note: Various updates to the language used in the plugin.

= 0.9.4 =
* Bug Fix: Missed changing a class name in the plugins CSS from the previous change to US English which meant one 'Intent' icon could be the wrong color.
* Bug Fix: Slightly adjusted the Tweet container CSS to improve compatibility with the sites Theme CSS.

= 0.9.3 =
* Bug Fix: Corrected spelling from British English to US English, 'Favourite' to 'Favorite'.
* Note: The above change also means that one of the CSS classes changed name. One of the 'Twitter Intent' links changed from '.kfavourite' to '.kfavorite', now all the CSS classes are in US English there should be no further changes.

= 0.9.2 =
* Bug Fix: Correctly schedules Tweets to be refreshed according to plugin option. Change in Tweet data format caused this to break in 0.9.x!

...

= 0.15 =
* Note: Initial version.

== Styling the Widget ==

We use the the inbuilt methods to output the Widget and Title containers so that it should fit seamlessly into your website.

If you want to style the inside of the Widget below is the HTML structure:

`
<ul class="kebo-tweets">

    <li class="ktweet">

        <div class="kmeta">
            <a class="kaccount"></a>
            <a class="kdate"></a>
        </div>
        
        <p class="ktext">
            <a><img class="kavatar" /></a>
        </p>

        <div class="kfooter">
            <a class="ktogglemedia"></a>
            <a class="kreply"></a>
            <a class="kretweet"></a>
            <a class="kfavourite"></a>
        </div>

        <div class="kmedia">
            <a><img /></a>
        </div>

    </li>

</ul>
`

The slider has one significant change which is that the containing unordered list has an ID of 'kebo-tweet-slider'.

== Developers Notes ==

You can directly access the object containing all the Tweets like this:

`<?php $tweets = kebo_twitter_get_tweets(); ?>`

This function checks the cache and refreshes the data if needed. Then returns the object containing all the Tweets. Below is an example of how you might use the data:

`
<?php $tweets = kebo_twitter_get_tweets(); ?>

<?php $i = 0; ?>

<?php if ( isset( $tweets->{0}->created_at ) ) : ?>

    <?php foreach ($tweets as $tweet) : ?>

        <?php echo $tweet->text; ?>

        <?php if (++$i == 10) break; ?>

    <?php endforeach; ?>

<?php else : ?>

    <p>Sorry, the Tweet data is not in the expected format.</p>

<?php endif; ?>
`

== What data is available? ==

The object we store contains everything that the Twitter API returns, leaving what you use in your control. Below are some of the most useful items:

`
$tweet->id_str // Tweet ID
$tweet->created_at // Date/Time created
$tweet->text // The content text (URLs already HTML links)
$tweet->user->id_str // Author ID
$tweet->user->name // Author display name
$tweet->user->screen_name // Author screen name
$tweet->user->location // Author location
$tweet->user->description // Author description
$tweet->user->followers_count // Author followers count
$tweet->user->friends_count // Author friends count
$tweet->user->profile_image_url // Authors profile image URL
$tweet->user->profile_image_url_https // As above but with HTTPS
`

There are many ways you could use this information for more than just a Twitter Feed. For example you could also use this to track the follower count of your Twitter account for display on your website.

== Shortcodes ==

Currently there is one Shortcode which can be used to replicate the behavior of the Widget. You can call this shortcode in the content of a post and/or page using:

`[kebo_tweets]`

Or by using PHP directly:

`<?php echo do_shortcode('[kebo_tweets]'); ?>`

Here is the shortcode with all the available attributes and their default values:

`[kebo_tweets title="" count="5" style="list" theme="light" offset="false" avatar="off" conversations="false" media="false"]`

The available options are:

`
title - Text
count - 1-50
style - list/slider
display - tweets/retweets/all
theme - light/dark
avatar - on/off
offset - 1-50
conversations - true/false
intent - true/false
media - true/false
media_visible - true/false
`

== Embedded Tweets ==

WordPress has inbuilt functionality for embedding Tweets directly into posts/pages. You can do this by simply pasting the full URL of the Tweet into the content, the URL will look similar to this:

`https://twitter.com/BarackObama/statuses/266031293945503744`