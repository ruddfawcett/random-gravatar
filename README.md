random-gravatar
===============

Changes the OctodexAPI profile's Gravatar every day to a new Octocat using Gravatar's XML-RPC API.

##Purpose
This is a little combo of [octodex.php (the OctodexAPI PHP wrapper)](https;//github.com/octodexapi/octodex.php) and [a Gravatar XML-RPC API Wrapper](http://www.phpclasses.org/package/5700-PHP-Send-requests-to-the-Gravatar-API-about-images.html) in order to change the Gravatar of this organization every day.  See ["Use"](#use) below to see how to use it and how it works.

##Use
**Warning: This deletes every Gravatar before adding a new one in order to avoid having a hundred Gravatars.**

###API Key
To obtain an API key, you need to login with your Gravatar/WordPress account into [Askimet](https://public-api.wordpress.com/oauth2/authorize/?client_id=973&response_type=code&blog_id=0&state=e4e530dd6d63fe7fa7fdacb5f2fabd4211cd309562b4d0358fde7038c5325114&redirect_uri=https%3A%2F%2Fakismet.com%2Fsignup%2F%3Fconnect%3Dyes%26action%3Drequest_access_token%26plan%3Dpersonal&variation=original&jetpack-code&jetpack-user-id=0&action=oauth2-login).  After loging in, you should be given an API Key.  

###Setup
With this API key, you need to update [line 8 of classes/randomizer.php]
(https://github.com/octodexapi/random-gravatar/blob/master/classes/randomizer.php#L8).  You then need to use the Gravatar/Wordpress email you signed up with [on the same line](https://github.com/octodexapi/random-gravatar/blob/master/classes/randomizer.php#L8).  With the API key and email, you can then initialize the class.

```php
$gravatarAPI = new GravatarRPC(YOUR_AKISMET_API_KEY, YOUR_GRAVATAR_EMAIL);
```

The next few lines in [randomize.php](classes/randomize.php) **remove all of the Gravatar's associated with your account** in order to avoid having lots of Gravatars.

The script then pulls a [random Octocat](https://github.com/octodexapi/octodex.php#random-octocat) and serves the URL to Gravatar, and then sets your Gravatar to that image.

###Cron Job
After you have obtained an API key and setup and configured the script, you need to set up a cron job.  The cron job allows the script to be automatically run at the same time everyday in order to randomize the Gravatar everyday.

This is really the heart of the project.  Without the cron, you can update it everyday, but this automates it for you, which is much nicer.

##Attribution
- [Gravatar XML-RPC API Wrapper](http://www.phpclasses.org/package/5700-PHP-Send-requests-to-the-Gravatar-API-about-images.html) - PHP Implementation by [Wouter van Vilet](http://www.interpotential.com).
- Uses [XML_RPC](http://pear.php.net/package/XML_RPC) by [Stig Bakken](http://pear.php.net/user/ssb) and [Daniel Convissor](http://pear.php.net/user/danielc).  There is an XML_RPC2, but I'm too lazy to update the Gravatar wrapper.

##Use of Octocats
Check out the GitHub Octodex frequently asked questions (http://octodex.github.com/faq), for specific use.  GitHub owns all of the Octocats, this allows you to set and update random Octocats for the OctodexAPI organization (which is not affiliated with or sponsered by GitHub).  Hopefully this abides with the FAQ question "Can I use an octocat as my avatar?", which states: 
> "You can use an octocat as your personal avatar, but not for your company or a product you're building. You are welcome to show your <3 for GitHub, but not appear as if you == GitHub."

As this is not a product or compnay and hopefully shows &#x2665; for GitHub.