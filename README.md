VZ Woofer for Craft
===================

Fieldtype
---------

A simple fieldtype allows the content creator to select a form from Wufoo. The following tags will be made available in the template.

    {{ entry.fieldName.name }}
    {{ entry.fieldName.hash }}
    {{ entry.fieldName.description }}
    {{ entry.fieldName.message }}
    {{ entry.fieldName.url }}
    {{ entry.fieldName.prettyUrl }}
    {{ entry.fieldName.public }}
    {{ entry.fieldName.postDate }}
    {{ entry.fieldName.expiryDate }}
    {{ entry.fieldName.dateCreated }}
    {{ entry.fieldName.dateUpdated }}
    {{ entry.fieldName.embed }}

Widget
------

Displays a list of all the forms in your Wufoo account, with a link to view the entries.

Installation
------------

Download and unzip the extension. Upload the `vzwoofer` folder to your `/craft/plugins/` folder. Go to Settings -> Plugins in the Craft control panel and enable the VZ Woofer plugin.

That's it! Now you can use the Wufoo Form fieldtype anywhere you were previously using a plain text field.

Support
-------

Please post all bugs or feature requests in [GitHub Issues](https://github.com/elivz/VzWufoo-Craft/issues). I maintain this fieldtype in my spare time, but I will try to respond to questions as quickly as possible.

Roadmap
-------

* Redactor toolbar button (does not seem to be currently possible - script tags are stripped)
* Display form submissions in Craft
* Retrieve additional information about the webpage (OpenGraph, etc) and make it available in templates