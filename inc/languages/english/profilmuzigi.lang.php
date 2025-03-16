<?php

// Admin CP Plugins
$l['profilmuzigiek_name'] = "Profile Music Plugin";
$l['profilmuzigiek_desc'] = 'This plugin allows users to add music to their profiles. It supports SoundCloud, YouTube, and direct audio file links.';
$l['profilmuzigiek_settings_url'] = 'If you encounter any issues with the plugin, please check the <strong><a href="{1}">plugin settings</a></strong>.';
$l['profilmuzigiek_update'] = '<b><font color="blue">Update:</font></b> A new version of the Profile Music Plugin has been uploaded. You must run the updater manually to ensure the new version works correctly. <a href="{1}">Click here to run the updater.</a>';
$l['profilmuzigiek_update_success'] = 'The Profile Music Plugin has been updated successfully.';
$l['profilmuzigiek_theme_change'] = '<strong>Theme Change: </strong> When changing your theme, you must add the plugin template codes to the new templates. If you have changed your theme, <a href="{1}">click here</a> to add the codes. For more information, visit the <a href="https://github.com/halilselcuk/MyBB-Profile-Music-Plugin/wiki">Wiki</a>.';
$l['profilmuzigiek_add_template_code_success'] = 'Template codes have been added successfully.';

// Edit Profile
$l['profilmuzigiek_usercp'] = "Profile Music";
$l['profilmuzigiek_usercp_yourmusic'] = "Your profile music link:";
$l['profilmuzigiek_usercp_exp'] = "The link must be from SoundCloud, YouTube, or a direct audio file. Examples: </br>
Direct audio file: https://mybb.halilselcuk.com/demo.mp3</br>
SoundCloud: https://soundcloud.com/cr2o3/tomb-raider-legend-main-theme</br>
YouTube: https://www.youtube.com/watch?v=OFnnXt2etmU</br>";

// MOD CP
$l['profilmuzigiek_modcp'] = "Profile Music";
$l['profilmuzigiek_modcp_music'] = "User profile music link:";
$l['profilmuzigiek_modcp_user_can_add'] = "Allow profile music?";

// Errors
$l['profilmuzigiek_error_title'] = "Profile Music Error";
$l['profilmuzigiek_link_not_valid'] = "Your link is not valid. The link must start with HTTP or HTTPS.";
$l['profilmuzigiek_youtube_error'] = "Your YouTube link is invalid or the video is unreachable. Please check your YouTube link.";
$l['profilmuzigiek_soundcloud_error'] = "Your SoundCloud link is invalid or unreachable. Please check your SoundCloud link.";
$l['profilmuzigiek_mp3_error'] = "Your link is not an audio file or is unreachable. Please use SoundCloud, YouTube, or direct audio file links.";
$l['profilmuzigiek_youtube_d_error'] = "YouTube support has been disabled by the administrator.";
$l['profilmuzigiek_soundcloud_d_error'] = "SoundCloud support has been disabled by the administrator.";
$l['profilmuzigiek_mp3_d_error'] = "Direct audio file support has been disabled by the administrator. If you are receiving this error despite using YouTube or SoundCloud links, please check your link.";
$l['profilmuzigiek_error_for_smod'] = "<i>Note: You are seeing this user's profile music error because you have super moderator permissions.</i>";
$l['profilmuzigiek_http_not_allowed'] = "Insecure connections are not allowed. The sound URL must begin with https://.";

// Admin CP Settings
$l['profilmuzigiek_setting_title'] = "Profile Music Settings";
$l['profilmuzigiek_setting_validators'] = "Enable YouTube, SoundCloud, and Direct Audio File Validators";
$l['profilmuzigiek_setting_validators_desc'] = 'This feature checks if the user\'s link is valid and reachable. A warning message will be shown if the link is incorrect or unreachable. </br> SoundCloud and YouTube links are verified using oEmbed, while direct audio file links are verified using the audio tag\'s MIME type.</br> <b> This feature requires the URL Fopen and OpenSSL extensions. If PHP\'s allow_url_fopen setting or the OpenSSL extension is disabled, this setting will be automatically disabled.</b>';
$l['profilmuzigiek_setting_mp3'] = "Enable Direct Audio File Support";
$l['profilmuzigiek_setting_youtube'] = "Enable YouTube Support";
$l['profilmuzigiek_setting_soundcloud'] = "Enable SoundCloud Support";
$l['profilmuzigiek_setting_soundcloud_desc'] = "You can customize this by editing the template. For parameters and more information, visit: <a href=\"https://developers.soundcloud.com/docs/api/html5-widget\" target=\"_blank\">https://developers.soundcloud.com/docs/api/html5-widget</a>";;
$l['profilmuzigiek_setting_autoplay'] = "Enable Autoplay";
$l['profilmuzigiek_setting_autoplay_desc'] = "If enabled, music will automatically start playing.";
$l['profilmuzigiek_setting_http_allowed'] = "Allow Insecure Connections";
$l['profilmuzigiek_setting_http_allowed_desc'] = "If your site supports secure connections, disable this setting. If disabled, URLs starting with HTTP will be denied.";

?>
