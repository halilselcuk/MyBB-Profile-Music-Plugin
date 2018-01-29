<?php

//Admin CP Plugins
$l['profilmuzigiek_name'] = "Profile Music Plugin";
$l['profilmuzigiek_desc'] = 'This plugin, allows users to add profile music. Plugin support SoundCloud, YouTube and hotlink sound files (with HTML5).';
$l['profilmuzigiek_settings_url'] = 'If you have problems about plugin please check <strong><a href="{1}">plugin settings</a></strong>.';
$l['profilmuzigiek_update'] = '<b><font color="blue">Update:</font></b> You have been uploaded Profile Music Plugin\'s new version. The updater must be run by yourself to work correctly in the new version. <a href="{1}">Click here to run.</a>';
$l['profilmuzigiek_update_success'] = 'Profile Music Plugin updated succesfully.';
$l['profilmuzigiek_theme_change'] = '<strong>Theme Change: </strong> You must add plugin template codes to new templates on change theme. If you change your theme <a href="{1}">click here</a> to add codes. If you need more info visit <a href="https://github.com/halilselcuk/MyBB-Profile-Music-Plugin/wiki">Wiki</a>.';
$l['profilmuzigiek_add_template_code_success'] = 'Template codes added succesfully.';

//Edit Profile
$l['profilmuzigiek_usercp'] = "Profile Music";
$l['profilmuzigiek_usercp_yourmusic'] = "Your profile music link:";
$l['profilmuzigiek_usercp_exp'] = "Link must be SoundCloud, YouTube or hotlink sound file. Example: </br>
Soundcloud: https://soundcloud.com/cr2o3/tomb-raider-legend-main-theme</br>

Youtube: https://www.youtube.com/watch?v=vT8OU5WtfkQ</br>


Hotlink sound: https://demomybb.tk/demo.mp3</br>";


//MOD CP
$l['profilmuzigiek_modcp'] = "Profile Music";
$l['profilmuzigiek_modcp_music'] = "User profile music link:";
$l['profilmuzigiek_modcp_user_can_add'] = "User can add profile music?";



//Errors
$l['profilmuzigiek_error_title'] = "Profile Music Error";
$l['profilmuzigiek_link_not_valid'] = "Your link a not valid. Link must be HTTP or HTTPS.";
$l['profilmuzigiek_youtube_error'] = "Your YouTube link not valid or video unreachable. Please check your YouTube link.";
$l['profilmuzigiek_soundcloud_error'] = "Your SoundCloud link not valid or unreachable. Please check your SoundCloud link.";
$l['profilmuzigiek_mp3_error'] = "Your link not audio file or unreachable. Try add SoundCloud, YouTube or hotlink sound files.";
$l['profilmuzigiek_youtube_d_error'] = "YouTube support disabled by administrator.";
$l['profilmuzigiek_soundcloud_d_error'] = "SoundCloud support disabled by administrator.";
$l['profilmuzigiek_mp3_d_error'] = "Hotlink sound support disabled by administrator. In spite of your links are YouTube or SoundCloud getting this error please check your link.";
$l['profilmuzigiek_error_for_smod'] = "<i>Note: You are seeing this user's profile music error for you have super moderator permissions.</i>";
$l['profilmuzigiek_http_not_allowed'] = "Insecure connection is not allowed. The MP3 URL has to begin with https://.";

//Admin CP Settings
$l['profilmuzigiek_setting_title'] = "Profile Music Settings";
$l['profilmuzigiek_setting_validators'] = "Activate YouTube, SoundCloud and Hotlink Sound Verifiers";
$l['profilmuzigiek_setting_validators_desc'] = 'This feature checks whether the user\'s link is correct and reachable. Show warning message to user if link is not incorrect or cannot reachable. </br> SoundCloud and YouTube links are verifiying with oEmbed, but hotlink sound links are verifiying with audio tag which kind of MIME type.</br> <b> This feature works with URL Fopen. If PHP\'s allow_url_fopen setting is disabled, this setting will be disabled automatically.</b>';
$l['profilmuzigiek_setting_mp3'] = "Activate Hotlink Sound Support";
$l['profilmuzigiek_setting_youtube'] = "Activate YouTube Support";
$l['profilmuzigiek_setting_soundcloud'] = "Activate SoundCloud Support";
$l['profilmuzigiek_setting_soundcloud_desc'] = "<b>This feature needs cURL Library. If you don't have cURL Library this setting will be disabled automatically.</b>";
$l['profilmuzigiek_setting_soundcloud_parameters'] = "SoundCloud parameters:";
$l['profilmuzigiek_setting_soundcloud_parameters_desc'] = "For parameters and info: <a href=\"https://developers.soundcloud.com/docs/api/html5-widget\" target=\"_blank\">https://developers.soundcloud.com/docs/api/html5-widget</a> ";
$l['profilmuzigiek_setting_autoplay'] = "Activate Autoplay";
$l['profilmuzigiek_setting_autoplay_desc'] = "If you activate this setting musics will automatically start playing.";
$l['profilmuzigiek_setting_http_allowed'] = "Allow Insecure Connection";
$l['profilmuzigiek_setting_http_allowed_desc'] = "If your site supports secure connections, disable this setting. If you disable this setting, starting with HTTP URL's will be be denied.";

?>