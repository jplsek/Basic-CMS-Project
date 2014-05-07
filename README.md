Basic-CMS-Project
=================

This was a learning experience. You can use it if you want, but be prepared for horribly written code! Have fun!

* The CMS can allow you to add, edit, and delete articles (blogging)

* The CMS can allow you to upload, browse, and delete content (images, video, etc)

* The CMS can allow you to add, edit, and delete pages, like stylesheets, indexes, etc

![alt text](https://github.com/jplsek/Basic-CMS-Project/tree/master/uploads/example.png "Image of the welcome page")


## Installation
1. **You must have a webserver with PHP version 5.5.0 or higher!**

2. MYSQL must be installed.

3. The docroot must be owned by the webserver user!

4. Put the "cms" folder into the docroot (or everything).

5. Change the settings according your setup in /cms/settings.php AND /cms/aSettings.php

6. You should use index.php in the root (NOT cms) for how to set up the 'blogging' portion. However, right now, this isn't very clear...

## Credentials:
Username: admin

Password: password

## The way it works (cms):
example: /cms/addPage.php

&nbsp;&nbsp;&nbsp;&nbsp;opens headerCont.php (cms file, has stuff for the `<head>` tag)

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;opens settings.php

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;headContent.php actual content

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;opens aSettings.php

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;opens $header (your file, from `<html>` to an open `<head>` tag)

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;headContent.php cms `<head>` content

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;opens nav.php (your file, ends `<head>` tag, and has your navigation, containers, etc)

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;headContent.php cms content

&nbsp;&nbsp;&nbsp;&nbsp;addPage.php cms content

&nbsp;&nbsp;&nbsp;&nbsp;opens footer.php (cms footer file)

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;footer.php cms content

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;opens $footer (your file, has the end of your containers, etc, and has the footer of your site)

(this is all set in settings.php)

## Currently working on:
2. Ability to change article settings in the CMS

3. Make articles work nicely with the pages and easier to understand

4. Welcome Page

5. More flexible addition of pages

6. Make installation easier?

7. 1.0?

Stretch goals (I don't care too much about these...):

1. Make a 'first run' installer?

2. Adding users? (This will probably add users to a database, but the admin credentails will stay in a seperate file like it is now (check key.php). This is because if you don't want to use the 'blog' functionality of the CMS, you won't have to rely on requiring MYSQL.)

3. Switch to sqlite?

## Bugs
1. All of the $footer's decided to not follow the rules in footer.php(>headcontent.php>settings.php) in add/edit/delete.php because of including connect.php (using a fix on line 25 of connect.php..)

If you find bugs, you can message me if you want to.
