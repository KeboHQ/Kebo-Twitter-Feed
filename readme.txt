=== Kebo Twitter Feed ===
Contributors: PeterBooker, lukeketley
Tags: twitter, feed, twitter feed, latest tweets, twitter api, twitter shortcode, twitter 1.1, twitter widget, tweets, twitter tweets
Requires at least: 3.2
Tested up to: 3.6.1
Stable tag: 0.7.8
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The easiest way to add a great looking Twitter feed to your website.

== Description ==

Hassle-free and user-friendly way to add a Twitter Feed to your website. We provide a custom Widget to help you display the Twitter Feed on your website, as well as direct access to the data for developers to use as they wish.

= Why use Kebo Twitter Feed? =

* Get started in just a few clicks. No setting up your own Twitter App (API v1.1 made easy).
* Compatible with any WordPress hosting.
* Advanced caching, discreetly caches in the background after page load.
* WordPress 3.6 compatible.
* Completely Multisite compatible.

Other solutions usually require you to create a Twitter App and provide the plugin with OAuth credentials yourself. Our hassle-free solution takes care of all the complex OAuth requests for you. In a few clicks you can have your Twitter Feed displayed on your site.

We make this so easy by managing all the complex OAuth requests on our own server using our Twitter app. Our app only asks for read permission and we only ever request publically available information. Your data is never stored on our system and you can read more about how we treat your information in our [privacy policy](http://kebopowered.com/privacy-policy/#social-connections "Kebo Privacy Policy").

= Features =

* Hassle-free Twitter API handling. We take care of the OAuth requests for you.
* Connect your website to Twitter in seconds with no technical knowledge required.
* Handy Widget to display your feed in seconds.
* Can display profile image with Tweets.
* Caching is used to avoid needless requests every page refresh.
* Local cache backup, in case the connection to Twitter has problems.

= Rate Us / Feedback =

Please take the time to let us and others know about your experiences by leaving a review. If your use of our plugin has not been a five star experience please let us know on the support forum.

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
            <a class="kreply"></a>
            <a class="kretweet"></a>
            <a class="kfavourite"></a>
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

    <p>Sorry, no Tweets found.</p>

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

`[kebo_tweets title="" count="5" style="list" theme="light" offset="false" avatar="off"]`

The available options are:

`
Title - Text
Count - 1-50
Style - list/slider
Theme - light/dark
Avatar - on/off
Offset - 1-50
`

== Embedded Tweets ==

WordPress has inbuilt functionality for embedding Tweets directly into posts/pages. You can do this by simply pasting the full URL of the Tweet into the content, the URL will look similar to this:

`https://twitter.com/BarackObama/statuses/266031293945503744`