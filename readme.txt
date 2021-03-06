=== Paragraph Level IDs ===
Contributors: robertsharp, amucklow
Tags: paragraph, id, anchor, links
Requires at least: 3.0.1
Tested up to: 4.1		
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The plugin adds an 'id' attribute to each paragraph tag in a blog post.

== Description ==

The Paragraph Level IDs plugin adds an 'id' attribute to each paragraph tag in a blog post, giving the author and readers additional functionality.

So for example, **&lt;p&gt;** becomes **&lt;p id="para1234-5"&gt;**.

These additions allow anyone to link directly to that paragraph in the post. This is especially useful for long tracts of text, academic writing, and legal documents.

== Installation ==

1. Download the plug-in
1. Unzip the files and upload rs-para-level-ids.php to the wp-content/plugins directory.
1. Visit the plugins section of your WordPress Dashboard.
1. Activate the plugin
1. Nothing will be changed in your website's source code until you visit the 'Paragraph IDs' options under the WordPress 'Settings' menu, and update the settings according to your taste.

== Frequently Asked Questions ==

= What kind of tags does the plugin operate on? =

The plugin only makes additions to &lt;p&gt; tags that have no other attributes.  If any other part of the content or system gives a paragraph tag any kind of styling, name or id, then this plugin will simply ignore it.  

= How are the ids and anchors added? =

The id attributes are all added dynamically as the page is generated.  The plugin works by counting the number of paragraphs and adding an id or name based on that.  

= What happens when I change the content of my post? =

If the content changes and the author reduces or adds to the number of paragraphs in the text, the anchor or paragraph id will change accordingly.  

This plugin therefore works best with archived content that is not likely to change.

= I think your plugin could be improved - Would you like some help with it? =

Absolutely, I'm at almost the limit of my coding skills here!  [Get in touch via my website] (http://www.robertsharp.co.uk/paragraph-level-ids/) or on Twitter, [@robertsharp59] (https://twitter.com/robertsharp59)

== Changelog ==

= 1.0 =
* Simplified the process.  Now we offer only ids, not anchors. 
* Added an option to add # links immediately after each paragraph
* Added an option to add highlight styling to each paragraph tag on hover
* Many thanks to @strangerpixel for this fantastic update.

= 0.2 =
* Added a settings menu
* Added the ability to add an 'id' to the paragraph tags, an anchor, or both
* anchor/id customisation options.

= 0.1 =
* Proof of concept, no features

== Upgrade Notice ==

= 1.0 =

An overhauled version with simplified id settings, and a visible link feature for those that want it.

== Road Map ==

In the future I hope to make the following improvements.

* Streamline the code so it is at its most efficient and smallest file size.
* Further customisation options for the id
* A degree of backwards compatibility and localisation for other languages
* An option so this feature is only applied to the post types specified.

I would welcome any advice, offers of support, bug-testing, forking the project and troubleshooting to help make these extra features possible.
	
== Acknowledgements ==

My friend @strangerpixel overhauled the 0.2 code for this 1.0 release.

The comment by **s_ha_dum** in [this Stack Exchange thread] (http://wordpress.stackexchange.com/questions/74558/automate-paragraphs-in-a-post-page-to-have-a-unique-anchor-link) and the comment by **Milo** in [this Stack Exchange thread] (http://wordpress.stackexchange.com/questions/90066/numbering-sections-and-block-level-elements-in-wpautop-wordpress-as-cms-for-l) got me started.  The [Add To Post plugin (http://wordpress.org/plugins/add-to-post/) was instructive in helping me build a simple settings form.