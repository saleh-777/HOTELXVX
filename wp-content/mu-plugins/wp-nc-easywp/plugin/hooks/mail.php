<?php

/*
|--------------------------------------------------------------------------
| Mail filter
|--------------------------------------------------------------------------
|
| Here we're going to add our own filter to the mail sender.
|
|
*/


// Filter the mail sender email with max priority.
add_filter('wp_mail_from', function ($email) {
  $site_url = get_site_url();
  $re       = '/^https?:\/\/|www./m';
  $domain   = preg_replace($re, '', $site_url);
  $domain   = (strpos($domain, 'easywp.') === false) ? $domain : 'easywp.com';

  return 'wordpress@' . $domain;
}, PHP_INT_MAX);

// Filter the mail sender name
add_filter('wp_mail_from_name', function ($name) {
  return 'EasyWP';
});
