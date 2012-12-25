--------------------
Extra: LikeDislike
--------------------
Version: 1.0.3-rc1
Since: August 12th, 2012
Author: Valentin Rasulov <info@artdevue.com>

LikeDislike flexible extension of voting for MODX Revolution. It allows visitors to vote for anything you want on your website.

Homepage and documentation - http://like.artdevue.com
The source code - - http://github.com/artdevue/LikeDislike
Issues  - https://github.com/artdevue/LikeDislike/issues

# Quick Start
In a convenient location site template you need to insert a snippet

[[likeCssjs]]
that connects CSS and JS files needed to run LikeDislike. 
Note! If you have a web site is not connected JQuery, then the call must specify the &jsConnect=`true`, and the call should look like this
[[likeCssjs? &jsConnect=`true`]]

# Basic Configuration
Before you start using LikeDislike, you can customize it to fit your work priorities. You can configure Cookies, IP and user id
The main settings are located in LikeDislike System Settings, in the section "likedislike".
All tips are described in the comments for each configuration.

# Admin panel
By selecting the top menu under "Components" - LikeDislike, you are in control LikeDislike.
You can keep track of your objects, delete them, close the vote. Added to the blocked IP addresses of users who are not eligible to vote.

# Creating
You can create LikeDislike click anywhere on the page. To do this, add the snippet call:

[[!LikeDislike? &name=`ITEM_NAME`]]
The item name (in bold) may be omitted if you visit a call LikeDislike, because the default name equally [[*pagetitle]].

Remember! , that the element name must be unique on a single resource or exclusion.
Call LikeDislike should NOT CACHE

# More on the election of the template and output format on the page http://like.artdevue.com/en/help.html