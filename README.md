Basic-CMS-Project
=================

This was a learning experience. You can use it if you want, but be prepared for horribly written code! Have fun!

* The CMS can allow you to add, edit, and delete articles (blogging)

* The CMS can allow you to upload, browse, and delete content (images, video, etc)

* The CMS can allow you to add, edit, and delete pages, like stylesheets, indexes, etc

* If blogging: An (almost) empty canvas to create your own theme (check assets/style.css)

![Screenshot of welcomepage](https://raw.githubusercontent.com/jplsek/Basic-CMS-Project/master/uploads/example.png)


## Installation
1. **You must have a webserver with PHP version 5.5.0 or higher!**

2. MYSQL must be installed if blogging.

3. The docroot must be owned by the webserver user.

4. Put the "cms" folder (and "blog" folder if blogging) into the docroot (or everything).

5. Change the settings according your setup in /cms/settings.php

6. If blogging...

7. Once the CMS in installed, login and change the 'Settings' arcordingly.

8. Check index.php for an example of setting up posts.

9. Done?

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

1. Create a better functioning settings changer

1. Combine edit article / delete article and edit page / delete page -- list articles / pages similar to 'browse files'

2. Make tags work

3. Welcome Page

4. Make installation easier?

5. 1.0?

6. Session timeout?

Notes from quick usage test from a friend and self notes:

* Remove summary (get $summary from content)

* ID's, gray them out because they are readonly

* Explain how to insert tags properly

* Add a 'copy' button next to links to insert (also find a way to make this work properly when pasteing into WYSIWYG editor)

* Remove unnecessary slashes in links...

* Add a preview for posts and pages when editing

* Create only a file explanation

* Continue editing button for pages / articles (after adding and editing them)

Stretch goals (I don't care too much about these...):

1. Make a 'first run' installer?

2. Adding users? (This will probably add users to a database, but the admin credentails will stay in a seperate file like it is now (check key.php). This is because if you don't want to use the 'blog' functionality of the CMS, you won't have to rely on requiring MYSQL.)

3. Switch to sqlite?

## Bugs

If you find bugs, you can message me if you want to.
