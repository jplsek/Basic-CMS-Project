Basic-CMS-Project
=================

This was a learning experience. You can use it if you want, but be prepared for horribly written code! Have fun!

* The CMS can allow you to add, edit, and delete articles (blogging)

* The CMS can allow you to upload, browse, and delete content (images, video, etc)

* The CMS can allow you to edit static pages, like stylesheets, indexes, etc (right now, this is hard-coded, and not dynamic)

## Installation
1. **You must have a webserver with PHP version 5.5.0 or higher!**

2. MYSQL must be installed.

2. The docroot must be owned by the websever user!

3. Change the settings according your setup in /cms/settings.php

## The way it works
cms/index.php

opens header.php (your file, from <html> to an open <head> tag)

opens headerCont.php (cms file, has stuff for the <head> tag)

opens nav.php (your file, ends <head> tag, and has your navigation, containers, etc)

opens itself

opens footer.php (your file, has the end of your containers, etc, and has the footer of your site)

(this is all set in settings.php)

## Credentials:
Username: admin

Password: password

## Currently working on:
1. Dynamically look for files within docroot (edit static content)

2. Add pages into docroot

3. Changing password (I have this in place and commented out, but not created)

4. Adding users?

5. Switch to sqlite?

6. Make it nicer looking by default?

If you find bugs, you can message me if you want to.