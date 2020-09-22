=== Contentools Integration ===
Contributors: Luciano Camargo Cruz, Brunno Schardosin, Vinicius Bossle Fagundes
Donate link: 
Tags: Contentools, integration, marketing, platform, content marketing
Requires at least: 4.6
Tested up to: 5.2
Stable tag: 3.0.6
Requires PHP: 5.6
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

This plugin enables the integration between Contentools e your blog, and also the Edit in WordPress and Live Preview functions.

== Description ==

Contentools is a content marketing automation platform to centralize, streamline and manage content creation.
https://go.contentools.com/


This plugin enables the integration between the Contentools Platform and Wordpress.

Current Features:

1. Allow X-Frame-Options
When you access the WP-admin page we add the field `X-Frame-Options` with value `https://go.contentools.com/` in header.
This allows your wp-admin page be accessed inside Contentools Platform

2. Set WP Contentools enabled plugin
It adds "WP-Contentools" flag on HTTP headers with value "true".

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Activate the plugin through the 'Plugins' screen in WordPress
2. Go to your Contentools account, on the left side menu go to Settings > Media Integration > Add Account > WordPress.

== Frequently Asked Questions ==

Nothing yet

== Upgrade Notice ==

Nothing yet

== Screenshots ==

`/assets/screenshot-1.png`

== Changelog ==
= 3.0.5 =
* Token auto generated

= 3.0.4 =
* HTTPS update

= 3.0 =
* Added new integration method and authorization by Token with Contentools.

= 2.2 =
* Added allowed methods

= 2.1 =
* Fixed X-Frame-Options not showing in a few screens

= 2.0 =
* Add support to the Wordpress REST API

= 1.0 =
* Add support to allow X-Frame-Options
* Add "WP-Contentools" flag on HTTP headers
