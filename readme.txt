=== FES WordPress Newsletter Plugin ===
Contributors: fesoftware
Donate link: http://www.fastemailsender.com/plugins/wordpress-newsletter-plugin
Tags: newsletter subscription, send newsletter, newsletter plugin, newsletter widget, email newsletter, newsletter subscribe, email subscribe
Requires at least: 2.0.0
Tested up to: 3.2.1
Stable tag: 1.0.0

Store and manage newsletter subscribers list with custom form and send mass emails for opt-in users.

== Description ==

This **FREE plugin** enables any website/blog to store a list of newsletter subscriptions. You can store custom fields like gender, country or job department, and send emails to your subscribers straight from your website's admin interface. The subscribers list can also be downloaded as a **CSV** file, compatible with most **newsletter software programs**. The plugin features a **double-opt-in** process, so visitors can only register themselves, and a newsletter-agreement box, to keep complaints about spamming to a minimum. To make it easier for you to use the plugin, there is a Custom CSS field, so you don't have to change any files in your theme.

= Plugin Features =

* 15 custom fields
* Fields can be textboxes or radioboxes
* Every label and message in the front end is customisable
* Custom CSS field
* Terms and conditions agreement checkbox and information window
* Optional double opt-in
* Customisable email for new subscribers
* BCC friendly subscribers list
* Downloadable subscribers list (CSV)
* Send mass email to all subscribers, from the admin interface of your site/blog
* Mass emails can be send from local server, or from a dedicated SMTP server

= Highlight Features =

Compatible 100% with an external [newsletter software](http://www.fastemailsender.com/newsletter-software.html "Fast Email Sender").

* Your subscribed users list can be automatically imported in Fast Email Sender software recipients groups. This feature is available in the full version of [bulk email software](http://www.fastemailsender.com "Bulk Email Software").
* In Fast Email Sender Trial Version you can import manual your subscribed users list after you export .CSV file from *WordPress Newsletter Plugin > Settings > Subscribed users > Download list as: CSV*.


= Plugin Settings =

* E-mail address for managing subscriptions (edit)
* Message to subscriber - EMail subject (edit)
* Message to subscriber - EMail content (edit)
* Double Opt-in option (enable and disable)
* Terms and conditions option (edit, enable and disable)
* Front side messages (edit)
* Front side appearance and custom fields
* Credits (enable and disable)
* Preview and export in CSV subscribed members
* Send newsletter Text Plain / HTML using Local or SMTP delivery method

== Screenshots ==

1. Newsletter subscription form your WordPress sidebar displayed in public interface
2. Newsletter agreement window
3. Admin panel of plugin where you can administrate options and change view
4. Admin panel of plugin where you can manage subscribed users and export list
5. Admin panel of plugin where you can send newsletters Plain/HTML format with LOCAL SERVER or SMTP delivery method.


== Installation ==

This section describes how to install the plugin and get it working.

1. Unzip the downloaded archive
2. Extract **fes-newsletter.zip** and upload the folder **fes newsletter** to */wp-content/plugins/* directory
3. Activate the plugin from *Plugins > FES Newsletter WordPress > Activate*, under WordPress admin interface
4. In the *Appearance > Widgets* menu, drag to your sidebar the FES WordPress Newsletter plugin.
5. Change settings and manage plugin from *Settings > FES WordPress Newsletter*.
6. More information about plugin at developer page [WordPress Newsletter Plugin](http://www.fastemailsender.com/plugins/wordpress-newsletter-plugin.html).

== Frequently Asked Questions ==

= How is work Double Opt-in option ? = 

If Doubled Opt-in option is checked subscribed user will receive an instant email of subscription confirmation. Only after he confirm his subscription from provided link will be Opted-in in the Subscribed users list. In case that you don't want to use Doubled Opt-in option you just uncheck it and users get Opted-in instantly after subscription.

= How I can customize design of the newsletter form ? =

You can change CSS styles from *FES WordPress Newsletter Plugin > Settings > Custom CSS layout*. Default CSS classes are defined from installation.

= It is possible to send HTML newsletters with this plugin ? =

Yes. You can use HTML tags and inline CSS in the Body message of the newsletter under *FES WordPress Newsletter Plugin > Send Newsletter*.

= How I can add the newsletter form in pages or posts ? =

Insert this code in your pages or posts: `<?php wpfes_opt_in(); ?>`
Before to add the code it is required to install the exec php plugin from http://wordpress.org/extend/plugins/exec-php/

= It is possible to display off the credits of developer ? = 

Yes. If you wish to don't want to display anymore developer credit links you can disable it from *FES WordPress Newsletter Plugin > Settings > Credits* (Uncheck box).

