=== Kebo Twitter Feed ===
Contributors: PeterBooker
Tags: twitter, feed, twitter feed, latest tweets, twitter api, shortcode, widget, tweets
Requires at least: 3.2
Tested up to: 3.7
Stable tag: 1.4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The easiest way to add a great looking Twitter feed to your website.

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
* English (British).
* Swedish by [Johanna Kitzman](https://www.facebook.com/johannakitzmanphotography).

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

= 0.9.1 =
* Bug Fix: Now correctly deletes the old Tweet data on update, allowing the plugin start using the fixed format of Tweet data.
* Note: If 0.9.0 caused an error when outputting Tweets this fixes it.

= 0.9.0 =
* Bug Fix: Fixed WordPress failing to serialize the Tweet data (due to Unicode Characters), by using 'json_encode' myself before saving the data (which correctly handles Unicode characters).
* Note: The above problem was hidden by most sites simply refreshing Tweets every pageload before rendering the page, so another advantage is that those sites will go back to using the background caching which does not impact page load speed.

= 0.8.0 =
* New Feature: You can now choose to show media (photos) attached to Tweets using the Shortcode and Widget, by selecting the option 'Show Media?'. It currently only works for the 'List' display, but working it into the 'Slider' display is being planned.
* Note: If you notice any display issues with the photos displayed under Tweets please let me know, and ideally give me a live site URL, so that I can fix the plugins CSS where possible.

= 0.7.8 =
* Note: Now refreshes Tweets when the plugin updates.
* Note: Removed debug code from previous testing version to make it public safe.

= 0.7.7 =
* Bug Fix: Temporary fix for an error caused by miscalculating where Hashtags and Mentions are inside the Tweet text which resulted in corrupting the data.
* Bug Fix: The plugin now refreshes Tweets even if the Tweet data is corrupted.
* Note: Not a public release, only going out to certain people.

= 0.7.6 =
* Note: Skipped a version to fix a bad 0.7.5 release (not all files updated).

= 0.7.5 =
* Bug Fix: Prevent 'Cannot unset string offsets' error from occurring by changing how we deal with the expiry time at the end of the $tweets array.

= 0.7.4 =
* Bug Fix: Prevent an 'Illegal string offset' warning from occurring by checking for an array keys existence first.

= 0.7.3 =
* New Feature: You can now choose whether or not to show conversations in your feed using the Widget and Shortcode.
* Bug Fix: Prevent undefined index on updated plugins.

= 0.7.2 =
* Bug Fix: Handles character encoding differently, should work on all sites/themes using UTF8 charsets.
* Bug Fix: Improved handling of linkifying hashtags and mentions in tweet text. No longer uses regex.
* Note: Changed the "Sorry, no Tweets were found." error message to "The Tweet data is not in the expected format.", which better reflects the situation.
* Note: There have been a lot of character encoding issues reported recently and I am determined to fix these. If you notice any problems please let me know.

= 0.6.7 =
* Bug Fix: Correctly decode codes for single quotes.
* Bug Fix: Prevent duplicate options save messages.

= 0.6.6 =
* Bug Fix: Fixed duplicate admin notices.

= 0.6.5 =
* Bug Fix: Improved admin notices when user action is required.

= 0.6.4 =
* Bug Fix: Improved check to run upgrade script.

= 0.6.3 =
* Bug Fix: Fixed upgrade function not running on plugin update. Twitter connection data should now be migrated on update.
* Bug Fix: Now correctly decodes single quotes in Tweet text.

= 0.6.1 =
* Bug Fix: Fixed Plugin settings page not correctly identifying if a social connection has been made or not.

= 0.6.0 =
* Bug Fix: Store Twitter Connection data in reliable format, so it cannot be lost.
* Note: Your Twitter Connection information will be migrated from a Transient to an Option on activation. If anything goes wrong you may need to connect the plugin to your Twitter account again.

= 0.5.13 =
* Bug Fix: Correctly calculates 'timeago' when WordPress is using a timezone which is not GMT/UTC.

= 0.5.12 =
* Bug Fix: Correctly decode HTML chars like &amp; to &.
* Bug Fix: Improved error log styling for improved readability.
* Note: Extended the date format options to include full year displays.

= 0.5.11 =
* Bug Fix: Encoding of International Characters.
* New Feature: Added option for date format to plugin options page.
* Bug Fix: Display times using users time zone.

= 0.5.10 =
* Bug Fix: Properly encode/decode Tweet text using UTF-8, so that characters display as intended when output.
* Note: I am still investigating how to display characters as symbols as seen on the Twitter website.

= 0.5.9 =
* Bug Fix: Added output buffering to the Shortcode, fixes Tweets appearing at the top of the page regardless of Shortcode position. (Thanks dstZloi)

= 0.5.8 =
* Bug Fix: Fixed corruption of Tweet data when special characters were used to create symbols on Twitter. (Thanks Rosie)

= 0.5.7 =
* Bug Fix: Removed code which can potentially cause fatal PHP error.

= 0.5.6 =
* Bug Fix: Avoids Fatal PHP Error when the format of fetched data is not as expected.

= 0.5.5 =
* New Feature: Added 'Offset' attribute to the Shortcode, allowing you to skip a certain number of the Tweets from the beginning of the feed.
* Note: Added Shortcode information and attributes to the 'Other Notes' section.
* Bug Fix: Twitter API responses only come GZIP'd if the relevant Accept-Encoding headers are present, the default is now without inflation. This should resolve the rare cases where badly formated data was fetched, as the website could not deflate the response and so no Tweets could be displayed.
* Note: Added details of WordPress's inbuilt functionality for embedding Tweets into posts/pages to the 'Other Notes' section.

= 0.5.4 =
* Bug Fix: Fixed Slider javascript output to use new class names.

= 0.5.3 =
* Bug Fix: Slider style of Twitter Feed CSS updated to the new class names.

= 0.5.2 =
* Bug Fix: One CSS class had not been correctly prefixed with 'k', updated the 'text' using the list view to 'ktext'.

= 0.5.1 =
* Bug Fix: Fixed missing file (shortcode.php) from version 0.5.0.

= 0.5.0 =
* New Feature: Added a Shortcode to display the Twitter Feed in content areas. Example usage (with default values filled in, these will be used if you do not specify anything): [kebo_tweets title="Latest Tweets" count="5" style="list" theme="light" avatar="off"].
* Note: Most CSS classes were changed, were prefixed with 'k', so 'reply' becomes 'kreply'. This only effects people who have customised the styling of the Widget.
* Bug Fix: Fixed a problem with showing a blank Tweet if you had less Tweets on your account than the Tweets you were trying to show.

= 0.4.3 =
* Warning: The next major version (0.5.0) will be coming in the next couple of days and will re-name most of the classes used, to avoid any styles being picked up from commonly names classes (like .reply). So if you have written custom CSS to change the style of the plugin, please be aware that your styling might stop working when we change the class names.
* Bug Fix: Reverted code used to check for Tweets before rendering, which was incorrectly causing "Sorry, no Tweets were found." to be displayed.
* Bug Fix: Profile images now correctly link to the users profle (Thanks Joshua Michaels).

= 0.4.2 =
* Bug Fix: Fixed error logging to include internal WP_Errors when making HTTP requests, not just Twitter API errors.
* Note: Improved the Slider HTML to pass animation details using data attributes. Paving the way to make it easy to customise using the Widget.

= 0.4.1 =
* Bug Fix: Fixed the code which checks if we have Tweets stored before rendering to the page.
* Bug Fix: Improved the styling and function of the Slider. There will no longer occasionally be jerky re-sizing. Still working on a major re-work.

= 0.4.0 =
* New Feature: Now logs error messages from the Twitter API. You can view the log from the plugins options page and see what the errors mean.
* Bug Fix: Fixed turning text URLs into links. It now turns text URLs, account names and hashtags into HTML links. This is done once at import, for performance.
* Bug Fix: Moved the plugin options page from a top level menu to a sub-menu under Settings. (Thanks Shea Bunge)
* Bug Fix: Improved default CSS styling to better fit the users theme. (Thanks apatton and Clorith)
* Note: The information and position of data displayed for each Tweet has been changed to better replicate the official Twitter widget and save space. (Thanks apatton)

= 0.3.5 =
* New Feature: Used the in-built WP pointer system to add a helpful hint to direct new users to connect their website to Twitter.

= 0.3.4 =
* Bug Fix: Fixed unnecessary cache refreshes, by giving 10 seconds for each to be made.
* Bug Fix: Fixed some styling issues reported.
* Bug Fix: JS and CSS now only loaded on relevant pages.

= 0.3.3 =
* Bug Fix: Fixed wrong variable name used in Widget form.
* Bug Fix: Small styling fixes to improve integration with Themes.

= 0.3.2 =
* Note: Moved to a new version numbering system (internal use only).
* New Feature: Now fully Multisite compatible, including removal of database entries on delete. Each blog can have it's own connection.
* New Feature: New Advanced Silent Cache. New system refreshes the cache in the background, after page load. Meaning there is no impact on page load speed while refreshing data.
* Bug Fix: Fixed duplicated 'Settings saved.' message on the plugin settings page.
* Bug Fix: Fixed call to un-install script, so that the code runs correctly.
* Bug Fix: Fixed errors in the Widget options when you first create one.

= 0.26 =
* Bug Fix: Changed how we request your Tweets, now using User ID instead of Screen Name.
* New Feature: Added a link to the plugin data on the Plugins screen, for direct access to the settings page.

= 0.25 =
* New Feature: Added option to show profile image to the Widget.
* New Feature: Added option to show time since the Tweet to the Widget (e.g. 2 hours ago).
* New Feature: Made the local cache file tied to blog ID, making the plugin multisite compatible.
* Bug Fix: Date format fix (03rd to 3rd).
* Bug Fix: CSS fix - to ensure action links (reply, retweet, favorite) don't resize and break use of the sprite image.
* Bug Fix: CSS fix - to ensure links inside the content text display as expected.
* Bug Fix: Removed Widget code from the view files paving the way for directing outputting the Twitter Feed using a shortcode or the function directly - coming soon.
* Note: Adjusted Theme option usage, Light now fits light background sites and Dark fits dark background sites. Current users will see no difference to the display.

= 0.21 =
* Bug Fix: Fixed incompatibility with older versions of PHP.

= 0.20 =
* Note: Improved compatibility, getting ready to make translation possible.
* Note: Improved readme information.
* Bug Fix: Fixed Twitter account link on plugin settings page.
* Bug Fix: Added default settings to the Widget.

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

<?php if ( isset( $tweets[0]->created_at ) ) : ?>

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
Title - Text
Count - 1-50
Style - list/slider
Theme - light/dark
Avatar - on/off
Offset - 1-50
Conversations - true/false
Media - true/false
`

== Embedded Tweets ==

WordPress has inbuilt functionality for embedding Tweets directly into posts/pages. You can do this by simply pasting the full URL of the Tweet into the content, the URL will look similar to this:

`https://twitter.com/BarackObama/statuses/266031293945503744`