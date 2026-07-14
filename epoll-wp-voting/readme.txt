=== ePoll – Contest Poll Survey & Voting ===
Contributors: infothemecom, omkritindia, infotheme.com
Donate link: https://infotheme.net/epoll-pro/
Tags: poll, voting, contest, survey, election
Requires at least: 5.0
Tested up to: 7.0
Stable tag: 3.9
Requires PHP: 7.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

ePoll is a free poll and voting tool. Create custom, responsive online elections, contests, and surveys with images and videos on your site.

== Description ==

ePoll helps you create polls and conduct voting contests or online elections easily. This feature-rich tool comes with multiple templates and add-ons that make it easier to create responsive and customizable polls and contests. This feature-rich Poll plugin comes with over 100+ features, multiple templates and add-ons that make it easier to create responsive and customizable polls and contests. This Poll & Voting plugin comes with advanced technology like (IP-based voting, VPN detection, device detection with Pro Version) and cookies etc. This Poll plugin ensures the integrity of your voting process and prevents any manipulation in votings. The Poll plugin offers a seamless user experience with its In-List and Grid style user interface. You can embed the poll or voting contest to any page or post using its shortcode.


### Voting & Poll Plugin 

* [WordPress Poll plugin demo](https://infotheme.in/plugins/epoll/v3.1/demo/)
* [Poll Voting Contest Demo](https://infotheme.in/plugins/epoll/v3.1/demo/all-voting-contests/)
* [Poll Demo](https://infotheme.in/plugins/epoll/v3.1/demo/all-polls/)
* [ePoll Pricing](https://infotheme.net/item/wordpress/plugin/poll-maker-and-voting-plugin/)
* [Poll plugin Documentation](https://infotheme.net/documentation/epoll-3-1-pro/)
* [Poll plugin Video Tutorial](https://www.youtube.com/playlist?list=PLqcsIS05a4oc5XB2nVcZhWimJdAcTJfjK)

https://www.youtube.com/watch?v=ou-buaC1XYg&t=26s


> **Poll shortcode**
> **[IT_EPOLL_VOTING id="Your_Contest_ID" type="list/grid"][/IT_EPOLL_VOTING]**
> **Voting Contest shortcode**
> **[IT_EPOLL_POLL id="Your_Poll_ID" type="list/grid"][/IT_EPOLL_POLL]**

**Features**

* Create polls and voting contests from a single tool.
* Templates and add-on system with many customization options.
* Shortcodes to place polls and contests anywhere on your site.
* In-list and grid views for voting contests.
* Schedule voting end times.
* Customize colors to match your site.
* Voting access codes for private polls.
* Cookie and browser session voting restrictions.
* hCaptcha support to help prevent bot voting (when configured).
* View and export voting results.
* Control result visibility on the frontend.
* Social sharing via Facebook, Twitter, and WhatsApp.
* Localization support.

**[Poll plugin PRO](https://infotheme.net/item/wordpress/plugin/poll-maker-and-voting-plugin/) Features**

* IP-based voting to prevent duplicate voting from the same IP address.
* VPN detection to prevent fraudulent voting from Virtual Private Networks.
* Cookies and device detection to prevent multiple voting from the same device.
* One-Time Password (OTP) based voting through email, SMS, or WhatsApp for added security.
* Responsive and customizable templates for visually appealing polls.
* Easy embedding with Shortcodes for seamless integration into your content.
* Voter data collection through a form builder for user information collection.
* Pay per vote or pay per voting slab feature for monetization through payment gateways.
* Live voting with real-time results for an engaging experience.
* Google Analytics integration for tracking voter behavior and optimization.
* hCaptcha integration to prevent bots and spammers from fraudulent voting.
* Private voting with access code for added security.
* Comments on voting for gathering feedback and insights.
* Social network and messenger sharing for increased reach.
* Visibility control of voting results on the frontend.
* Send Thank you messages to voter via email, SMS, or WhatsApp after successful voting.
* Localization for translation into any language.
* Voting results reporting in Excel, PDF, or JSON format for analysis and sharing.

**Single Poll plugin to create & manage all your polls & voting contests, Let's give it a TRY!!**

== How to Create a Voting Contest in WordPress Website? - Poll plugin & Voting plugin ==
https://www.youtube.com/watch?v=l4FgDCrxtxc&t=4s

== How to Create a Poll in WordPress Website? - Poll plugin & Voting plugin ==
https://www.youtube.com/watch?v=whGZFR4rfcc&t=6s

== External services ==

This plugin may connect to the following third-party services when the related features are used.

= hCaptcha =

This plugin can load the hCaptcha script on poll and voting pages when hCaptcha protection is enabled in your poll settings.

* **What it is used for:** To verify that a visitor is human before accepting a vote.
* **What data is sent and when:** When hCaptcha is enabled and a visitor loads a poll page or submits a vote, the visitor's browser loads scripts from hCaptcha and may send challenge/response data required to complete the captcha.
* **Service provider:** Intuition Machines, Inc.
* **Terms of service:** https://www.hcaptcha.com/terms
* **Privacy policy:** https://www.hcaptcha.com/privacy

= InfoTheme Store API =

When you open the ePoll admin screens for templates, add-ons, documentation, or FAQs, the plugin may request catalog and help content from InfoTheme servers.

* **What it is used for:** To display available templates, add-ons, documentation links, and support resources inside the WordPress admin.
* **What data is sent and when:** When an administrator opens the relevant ePoll admin pages, the plugin sends HTTP requests to InfoTheme endpoints. No visitor voting data is sent by this feature.
* **Service provider:** InfoTheme
* **Terms of service:** https://infotheme.net/terms
* **Privacy policy:** https://infotheme.net/privacy-policy

== Installation ==

* Unzip the downloaded package and upload the folder `epoll-wp-voting` to `/wp-content/plugins/`.
* Activate the plugin through the Plugins menu in WordPress.
* Go to **ePoll** in the admin menu to create a poll or contest.
* Use the provided shortcodes to embed polls on pages and posts.

== Frequently Asked Questions ==

= How many poll options or contest candidates can I add? =

You can add unlimited poll options and contest candidates.

= Can I make voting private? =

Yes. Use the voting access code feature in poll settings.

= Can I use shortcodes? =

Yes. Use `[IT_EPOLL_VOTING id="Your Poll ID" type="list/grid"][/IT_EPOLL_VOTING]` for contests and `[IT_EPOLL_POLL id="Your Poll ID" type="list/grid"][/IT_EPOLL_POLL]` for polls.

== Screenshots ==

1. Front end voting contest preview
2. Front end poll preview
3. Voting contest list view preview
4. Backend poll options
5. Backend dashboard and voting results

== Changelog ==

= 3.9 =
* WordPress.org automated review compliance update.
* Enabled built-in features previously marked premium-only: multiple choice voting, after-vote-end result visibility, poll start scheduling, and color customization.
* Frontend branding/credit links now require explicit administrator opt-in.
* Removed custom add-on/template ZIP upload and executable PHP installation from uploads.
* Replaced PHP sessions with cookie-based vote tracking to avoid full-page cache bypass.
* Bundled templates and add-ons only; no remote executable installs.

= 3.8 =
* WordPress.org review compliance update.
* Removed Google Analytics tracking integration.
* Fixed plugin license header and text domain (`epoll-wp-voting`).
* Added external services documentation.
* Improved input sanitization, nonce verification, and direct file access protection.
* User-uploaded templates and add-ons are now stored in the uploads directory.
* Disabled remote executable package installation.
* Updated jQuery Validation library to 1.22.1.
* Removed backup translation files from the distribution package.

= 3.7 =
* Removed violation content from readme and plugin.

= 3.6 =
* Fixed jQuery conflict during voting and ensured voting applies to selected contests.
