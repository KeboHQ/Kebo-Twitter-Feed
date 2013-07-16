=== Kebo Twitter Feed ===
Contributors: PeterBooker
Tags: twitter, feeds, social,
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: 0.15
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Connect your site to your Twitter account and display your Twitter Feed on your website effortlessly, in a useful list or stylish slider.

== Description ==

Hassle-free and user-friendly way to add a Twitter Feed to your website. We provide a custom Widget to help you display the Twitter Feed on your website, as well as direct access to the data for developers.

We access your Twitter Feed through you giving permission for our Kebo Twitter App to read your Twitter Feed. Your website can then request an updated list of Tweets at any point through our OAuth request server using the credentials stored on your own site, at no point will we store and log any of your information. You can get more information regarding how we treat your data in our [Privacy Policy](http://kebopowered.com/privacy-policy/ "Kebo Privacy Policy").

To ensure the reliability of the plugin, when using connections to external services to transmit data, we store the data locally in a text file. This means that if a connection is not possible at any point, we can fallback to the Tweets stored locally and continue to make requests each minute until a request is successful.

We have provided a 'Kebo Twitter Feed' Widget to allow you to easily display the Twitter Feed on your website. You can choose between a Vertical List which fits sidebars perfectly and a Horizontal Slider which works well in sidebars and footers.

Developers have direct access to an object containing all the tweets, functions to display tweets in our List and Slider, as well as other useful hooks.

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload `/kebo-twitter-feed/` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Then either:
* Place the `Kebo Twitter Feed` Widget into a Widget area through the `Appearance -> Widgets` menu in WordPress.
* More coming...

== Frequently Asked Questions ==

= How do you get my Twitter Feed? =

We provide a connection from your website to your Twitter feed using our Kebo Twitter App, using OAuth2. Once you grant permission for us to read your Twitter Feed we can provide your website with this information.

= What information do you access? =

Your website will hold your OAuth2 credentials and a list of your latest tweets. Your website will occasionally poll Twitter to update your feed, using our OAuth App, but none of the data is ever stored. We only ever request basic profile information and your latest tweets from twitter.

= Do you ever write to my Twitter account? =

The Kebo Twitter App only requests Read access to your account. This prevents us from ever creating tweets or sending direct messages on your behalf.

= Another question? =

Another answer.

== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the /assets directory or the directory that contains the stable readme.txt (tags or trunk). Screenshots in the /assets 
directory take precedence. For example, `/assets/screenshot-1.png` would win over `/tags/4.3/screenshot-1.png` 
(or jpg, jpeg, gif).
2. This is the second screen shot

== Changelog ==

= 0.15 =
* A change since the previous version.
* Another change.

== Upgrade Notice ==

= 0.15 =
Upgrade notices describe the reason a user should upgrade.  No more than 300 characters.

== Arbitrary section ==

You may provide arbitrary sections, in the same format as the ones above.  This may be of use for extremely complicated
plugins where more information needs to be conveyed that doesn't fit into the categories of "description" or
"installation."  Arbitrary sections will be shown below the built-in sections outlined above.

== A brief Markdown Example ==

Ordered list:

1. Some feature
1. Another feature
1. Something else about the plugin

Unordered list:

* something
* something else
* third thing

Here's a link to [WordPress](http://wordpress.org/ "Your favorite software") and one to [Markdown's Syntax Documentation][markdown syntax].
Titles are optional, naturally.

[markdown syntax]: http://daringfireball.net/projects/markdown/syntax
            "Markdown is what the parser uses to process much of the readme file"

Markdown uses email style notation for blockquotes and I've been told:
> Asterisks for *emphasis*. Double it up  for **strong**.

`<?php code(); // goes in backticks ?>`