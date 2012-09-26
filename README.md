# LikeDislike
========

**LikeDislike flexible extension of voting for MODX Revolution. It allows visitors to vote for anything you want on your website.**

[Homepage](http://like.artdevue.com)

[MODX extras](http://modx.com/extras/package/likedislike)

## Quick Start

In a convenient location site template you need to insert a snippet

```php
[[likeCssjs]]
```

that connects CSS and JS files needed to run LikeDislike. 

**Note!** If you have a web site is not connected JQuery, then the call must specify the *&jsConnect=`true`*, and the call should look like this

```php
[[likeCssjs? &jsConnect=`true`]]
```

## Basic Configuration

Before you start using LikeDislike, you can customize it to fit your work priorities. You can configure Cookies, IP and user id

The main settings are located in LikeDislike System Settings, in the section *"likedislike"*.

All tips are described in the comments for each configuration.

## Admin panel

By selecting the top menu under *"Components"* - LikeDislike, you are in control LikeDislike.

You can keep track of your objects, delete them, close the vote. Added to the blocked IP addresses of users who are not eligible to vote.

## Creating

You can create LikeDislike click anywhere on the page. To do this, add the snippet call:

```php
[[!LikeDislike? &name=`ITEM_NAME`]]
```

The item name (ITEM_NAME) may be omitted if you visit a call LikeDislike, because the default name equally **pagetitle**.

**Remember!** , that the element name must be unique on a single resource or exclusion.

Call LikeDislike should **NOT CACHE**

### More on the election of the template and output format on the page [help](http://like.artdevue.com/en/help.html)

### Authors
<table>
  <tr>
    <td><img src="http://www.gravatar.com/avatar/39ef1c740deff70b054c1d9ae8f86d02?s=60"></td><td valign="middle">Valentin Rasulov<br>artdevue.com<br><a href="http://artdevue.com">http://artdevue.com</a></td>
  </tr>
</table>
