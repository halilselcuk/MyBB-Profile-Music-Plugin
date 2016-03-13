<?php

 # Mısırga                          
 # http://halil.xn--seluk-0ra.gen.tr
 # http://community.mybb.com/mods.php?action=view&pid=75

if(!defined("IN_MYBB"))
{
  die("Direct initialization of this file is not allowed.<br /><br />Please make sure IN_MYBB is defined.");
}

$plugins->add_hook("usercp_profile_start", "profilduzenle");
$plugins->add_hook("modcp_editprofile_start", "modprofilduzenle");
$plugins->add_hook("modcp_do_editprofile_start", "profilmuzigiek_mod_update");
$plugins->add_hook("datahandler_user_update", "profilmuzigiek_update");
$plugins->add_hook("member_profile_start", "profilmuzigi");
$plugins->add_hook("admin_formcontainer_output_row", "grupyetkileri");
$plugins->add_hook("admin_user_groups_edit_commit", "grupyetkileriguncelle");

function profilmuzigiek_info()
{
	global $lang;
	$lang->load("profilmuzigi", true);
	
  return array(
    "name"           => $lang->profilmuzigiek_name,
    "description"    => $lang->profilmuzigiek_desc,
    "website"        => "http://community.mybb.com/mods.php?action=view&pid=75",
    "author"         => "Halil Selçuk(Mısırga)",
    "authorsite"     => "http://halil.selçuk.gen.tr/",
    "version"        => "1.6.5.2",
    "guid"           => "",
    "compatibility"  => "18*, 16*"
  );
  
}

function profilmuzigiek_is_installed()
	{
		global $db, $mybb;

if($db->field_exists(sutunadi(), "users"))
		{
			return true;
		}
		return false;
	}
	
function profilmuzigiek_install()
	{
	
		global $db, $mybb, $lang, $cache;
		$lang->load("profilmuzigi", true);	
if($db->field_exists(sutunadi(), "users"))
{
	
}
else
{
  $db->query("ALTER TABLE ".TABLE_PREFIX."users ADD ".sutunadi()." VARCHAR(300) NOT NULL");
  $db->query("ALTER TABLE ".TABLE_PREFIX."users ADD profilmuzigiacik tinyint(1) NOT NULL DEFAULT '1'");
  $db->query("ALTER TABLE ".TABLE_PREFIX."usergroups ADD profilmuzigi tinyint(1) NOT NULL DEFAULT '1'");
  $cache->update_usergroups();
  
  
  	$soundcloud  = array(
		"tid" => "NULL",
		"title" => "profilmuzigiek_soundcloud",
		"template" => $db->escape_string('<br />
<iframe width="100%" height="100" scrolling="no" frameborder="no" src="//w.soundcloud.com/player/?url=//api.soundcloud.com/tracks/{$soundcloudid}&color=0066cc"></iframe>'),
		"sid" => "-1",
	);
	$db->insert_query("templates", $soundcloud);
  
  
  	$youtube  = array(
		"tid" => "NULL",
		"title" => "profilmuzigiek_youtube",
		"template" => $db->escape_string('<br />
<iframe width="300" height="200" src="http://www.youtube.com/embed/{$youtubeid}" frameborder="0" allowfullscreen></iframe>'),
		"sid" => "-1",
	);
	$db->insert_query("templates", $youtube);
  
  
  	$mp3  = array(
		"tid" => "NULL",
		"title" => "profilmuzigiek_mp3",
		"template" => $db->escape_string('<br />
<object type="application/x-shockwave-flash" data="{$mybb->settings[\'bburl\']}/mp3player.swf" width="300" height="20">
    <param name="movie" value="{$mybb->settings[\'bburl\']}/mp3player.swf" />
    <param name="bgcolor" value="#696969" />
    <param name="FlashVars" value="mp3={$mp3}&amp;width=300&amp;autoplay=1&amp;autoload=1&amp;showstop=1&amp;showinfo=1&amp;showvolume=1&amp;buttonwidth=40&amp;sliderwidth=2&amp;sliderheight=40&amp;volumewidth=50&amp;volumeheight=10&amp;loadingcolor=828282&amp;bgcolor=696969" />
</object>'),
		"sid" => "-1",
	);
	$db->insert_query("templates", $mp3);
  
  	$profilduzenle  = array(
		"tid" => "NULL",
		"title" => "profilmuzigiek_profilduzenle",
		"template" => $db->escape_string('<fieldset class="trow2">
 <legend><strong><img src="{$mybb->settings[\'bburl\']}/images/muzik.png" alt="profilmuzigi" title="profilmuzigi" /> {$lang->profilmuzigiek_usercp}</strong></legend>
 <table cellspacing="0" cellpadding="{$theme[\'tablespace\']}">
 <tr>
 <tr>
<td><span class="smalltext">{$lang->profilmuzigiek_usercp_yourmusic}</span></td>
 </tr>
 <tr>
 <td><input type="text" class="textbox" name="profilmuzigi" size="40" value="{$url}" /></td>
 </tr>
 </tr>
 </tr>
 </table>
  <font size="1">{$lang->profilmuzigiek_usercp_exp}</font>
 </fieldset>'),
		"sid" => "-1",
	);
	$db->insert_query("templates", $profilduzenle);
	
	
  	$modprofilduzenle  = array(
		"tid" => "NULL",
		"title" => "profilmuzigiek_modprofilduzenle",
		"template" => $db->escape_string('<fieldset class="trow2">
 <legend><strong><img src="{$mybb->settings[\'bburl\']}/images/muzik.png" alt="profilmuzigi" title="profilmuzigi" /> {$lang->profilmuzigiek_modcp}</strong></legend>
 <table cellspacing="0" cellpadding="{$theme[\'tablespace\']}">
 <tr>
 <tr>
<td><span class="smalltext">{$lang->profilmuzigiek_modcp_yourmusic}</span></td>
 </tr>
 <tr>
   <td><input type="text" class="textbox" name="profilmuzigi" size="40" value="{$url}" />  </br>
  <input type="checkbox" class="checkbox" name="profilmuzigiacik" value="{$kapalimi}" {$tik}/> {$lang->profilmuzigiek_modcp_user_can_add} </td> </tr>
 </tr>
 </table>
 </fieldset>'),
		"sid" => "-1",
	);
	$db->insert_query("templates", $modprofilduzenle);
	
	

	$profilmuzigiayarlari = array
	(
    'name' => 'profilmuzigiayarlari',
    'title' => $lang->profilmuzigiek_setting_title,
    'description' => '',
    'disporder' => 5, // The order your setting group will display
    'isdefault' => 0
	);

$gid = $db->insert_query("settinggroups", $profilmuzigiayarlari);



$profilmuzigiayarlar = array
(
    'profilmuzigiek_youtube' => array
	(
        'title' => $lang->profilmuzigiek_setting_youtube,
        'description' => '',
        'optionscode' => 'yesno',
        'value' => 1,
        'disporder' => 1
    ),
	
    'profilmuzigiek_soundcloud' => array
	(
        'title' => $lang->profilmuzigiek_setting_soundcloud,
        'description' => '',
        'optionscode' => 'yesno',
        'value' => 1,
        'disporder' => 1
    ),
	
    'profilmuzigiek_mp3' => array
	(
        'title' => $lang->profilmuzigiek_setting_mp3,
        'description' => '',
        'optionscode' => 'yesno',
        'value' => 1,
        'disporder' => 1
    ),
	
    'profilmuzigiek_mp3dogrulayici' => array
	(
        'title' => $lang->profilmuzigiek_setting_mp3validator,
        'description' => '',
        'optionscode' => 'yesno',
        'value' => 1,
        'disporder' => 1
    ),
);

foreach($profilmuzigiayarlar as $name => $setting)
{
    $setting['name'] = $name;
    $setting['gid'] = $gid;

    $db->insert_query('settings', $setting);
}
rebuild_settings();

}
	}

	


function profilmuzigiek_activate()
{
  global $db;

    require_once MYBB_ROOT."inc/adminfunctions_templates.php";
  find_replace_templatesets('modcp_editprofile','#{\$customfields\}#',
         '{$customfields}{$modprofilmuzigiduzenle}');

  find_replace_templatesets('usercp_profile','#{\$customfields\}#',
         '{$customfields}{$profilmuzigiduzenle}');

  find_replace_templatesets('member_profile','#{\$userstars\}<br />#',
         '{$userstars}<br />{$profilmuzigi}');
}

	function profilmuzigiek_uninstall()
	{
  global $db; 
	$db->query("ALTER TABLE ".TABLE_PREFIX."users DROP COLUMN ".sutunadi()."");
	$db->query("ALTER TABLE ".TABLE_PREFIX."users DROP COLUMN profilmuzigiacik");
	$db->query("ALTER TABLE ".TABLE_PREFIX."usergroups DROP COLUMN profilmuzigi");
	$db->delete_query("templates","title = 'profilmuzigiek_mp3'");
	$db->delete_query("templates","title = 'profilmuzigiek_youtube'");
	$db->delete_query("templates","title = 'profilmuzigiek_soundcloud'");
	$db->delete_query("templates","title = 'profilmuzigiek_modprofilduzenle'");
	$db->delete_query("templates","title = 'profilmuzigiek_profilduzenle'");
	$db->delete_query("settinggroups","name = 'profilmuzigiayarlari'");
	$db->delete_query("settings","name = 'profilmuzigiek_youtube'");
	$db->delete_query("settings","name = 'profilmuzigiek_soundcloud'");
	$db->delete_query("settings","name = 'profilmuzigiek_mp3'");
	$db->delete_query("settings","name = 'profilmuzigiek_mp3dogrulayici'");
  }


function profilmuzigiek_deactivate()
{
  global $db;  
  require_once MYBB_ROOT."inc/adminfunctions_templates.php";  
  
    find_replace_templatesets('modcp_editprofile', 
  preg_quote('#{$modprofilmuzigiduzenle}#'),'',0); 

  
  find_replace_templatesets('usercp_profile', 
  preg_quote('#{$profilmuzigiduzenle}#'),
      '',0);   
	 find_replace_templatesets('member_profile',
        preg_quote('#{$profilmuzigi}#'),
      '',0);
}



function langprofilmuzigi()
{
	global $lang, $mybb;
	$lang->load("profilmuzigi");
}

function youtubeidal($url)
{
$ytarray=explode("/", $url);
$ytendstring=end($ytarray);
$ytendarray=explode("?v=", $ytendstring);
$ytendstring=end($ytendarray);
$ytendarray=explode("&", $ytendstring);
$ytcode=$ytendarray[0];
return $ytcode;
}

function soundcloudidal($url)
{
$get = file_get_contents( 'http://soundcloud.com/oembed?url='.$url.'' );
preg_match('@tracks%2F(.*?)&@si',$get,$degisken);
return $degisken[1]; 
}

function validatemp3($url)
{
if (sitekontrol($url))
{
$headers = implode("", get_headers($url, 1));
if( strstr($headers,"mpeg") ) return 1;
else return 0;
}
else return 0;
}

function profilmuzigi()
{
	global $db,$mybb,$profilmuzigi,$templates,$lang;
	$lang->load("profilmuzigi", true);
	$user2 = intval($mybb->input[uid]);
	if($user2 == false)
	{
		$user2 = intval($mybb->user['uid']);
	}
	$query = $db->write_query("SELECT * FROM ".TABLE_PREFIX."users WHERE uid=".$user2);
	$user = $db->fetch_array($query);
	$url = $user[sutunadi()];
	if(empty($url))
	{
	$yazdir = '<!-- halilselcuk -->';
		eval("\$profilmuzigi = \"".$yazdir."\";");
	}
	else
	{
	if(izinvarmi($user))
{
$ilk7 = substr($url, 0, 7);
if ((filter_var($url, FILTER_VALIDATE_URL)) && ( ($ilk7 == 'http://') || ($ilk7 == 'https:/')))
{

	if((strstr($url,"youtube.com")) || (strstr($url,"youtu.be")))
	{
	if($mybb->settings['profilmuzigiek_youtube'])
	{
if(get_http_response_code('http://www.youtube.com/oembed?url='.$url.'') != "404")
{
$youtubeid = youtubeidal($url);
eval("\$profilmuzigi = \"".$templates->get("profilmuzigiek_youtube")."\";");
}
else $profilmuzigi = hatayaz($lang->profilmuzigiek_youtube_error, $user2);
	}
else $profilmuzigi = hatayaz($lang->profilmuzigiek_youtube_d_error, $user2);
}
	
else if(strstr($url,"//soundcloud.com"))
{
if($mybb->settings['profilmuzigiek_soundcloud'])
{
if(get_http_response_code('https://soundcloud.com/oembed?url='.$url.'') != "404")
{
$soundcloudid = soundcloudidal($url);
eval("\$profilmuzigi = \"".$templates->get("profilmuzigiek_soundcloud")."\";");
}
else $profilmuzigi = hatayaz($lang->profilmuzigiek_soundcloud_error, $user2);
}
else $profilmuzigi = hatayaz($lang->profilmuzigiek_soundcloud_d_error, $user2);
}	
	
	else if($mybb->settings['profilmuzigiek_mp3'])
	 {
	 $mp3 = $url;
if ($mybb->settings['profilmuzigiek_mp3dogrulayici'])
{
if (validatemp3($url))
{
		eval("\$profilmuzigi = \"".$templates->get("profilmuzigiek_mp3")."\";");
}
else $profilmuzigi = hatayaz($lang->profilmuzigiek_mp3_error, $user2);
}
else
{
eval("\$profilmuzigi = \"".$templates->get("profilmuzigiek_mp3")."\";");
}
	 }
else $profilmuzigi = hatayaz($lang->profilmuzigiek_mp3_d_error, $user2);
	 
	 
	}
	
else $profilmuzigi = hatayaz($lang->profilmuzigiek_link_not_valid, $user2);
}
else return 0;
}
}

function hatayaz($mesaj, $user2)
{

global $mybb, $lang, $templates, $theme, $user;
$user_perms = user_permissions($mybb->user['uid']);
if (($user2 == $mybb->user['uid']) || ($user_perms['issupermod'] == 1))
{

$lang->load("profilmuzigi", true);
if (($user_perms['issupermod'] == 1) && ($user2 != $mybb->user['uid']))
{
$title = $lang->profilmuzigiek_error_title;
$errorlist = $mesaj.' </br></br>'.$lang->profilmuzigiek_error_for_smod;
eval("\$errors = \"".$templates->get("error_inline")."\";");
return $errors;
}

else
{
$title = $lang->profilmuzigiek_error_title;
$errorlist = $mesaj;
eval("\$errors = \"".$templates->get("error_inline")."\";");
return $errors;
}

}
}

function izinvarmi($user)
{
//Üyenin ya da üyenin bulunduğu grubun profil müziği ekleme izni var mı kontrol eder.
global $mybb, $db;
	$user2 = intval($mybb->input[uid]);
	if($user2 == false)
	{
		$user2 = intval($mybb->user['uid']);
	}
	$user_perms = user_permissions($user2);
	if(($user_perms['profilmuzigi']) && ($user['profilmuzigiacik'])) return 1;
	else return 0;
}

function profilduzenle()
{
 global $mybb, $db, $lang, $templates, $profilmuzigiduzenle, $theme;
 	$query = $db->write_query("SELECT * FROM ".TABLE_PREFIX."users WHERE uid=".$mybb->user['uid']);
	$user = $db->fetch_array($query);
if (izinvarmi($user))
{
   	$lang->load("profilmuzigi");
	$url = $user[sutunadi()];
eval("\$profilmuzigiduzenle = \"".$templates->get("profilmuzigiek_profilduzenle")."\";");
}
}

function modprofilduzenle()
{
  global $mybb, $db, $lang, $user, $templates, $modprofilmuzigiduzenle, $theme;
  	$lang->load("profilmuzigi");
 	$query = $db->write_query("SELECT * FROM ".TABLE_PREFIX."users WHERE uid=".$user['uid']);
	$user = $db->fetch_array($query);
	$url = $user[sutunadi()];
	$kapalimi = $user['profilmuzigiacik'];
	if ($kapalimi == 1) $tik = 'checked="checked"';
	else  $tik = '';
eval("\$modprofilmuzigiduzenle = \"".$templates->get("profilmuzigiek_modprofilduzenle")."\";");
}

function profilmuzigiek_update()
{
  global $mybb, $db;
  
   	$query = $db->write_query("SELECT * FROM ".TABLE_PREFIX."users WHERE uid=".$mybb->user['uid']);
	$user = $db->fetch_array($query);
	
if($mybb->input['action'] == "do_profile" && $mybb->request_method == "post")
{
  if ($mybb->input['profilmuzigi'] == "1")
   {
     $temp_query = " ".sutunadi()." = '1', "; 
   }else{
        $temp_query = " ".sutunadi()." = '0', ";     
   }
   
         $temp_query = $temp_query . "".sutunadi()." = '" . $db->escape_string($mybb->input['profilmuzigi']) . "'";
      	 if ((strstr($temp_query, "\"") == false) && (izinvarmi($user)))
	{
     $db->query("UPDATE ".TABLE_PREFIX."users SET " . $temp_query . " WHERE uid = " . $mybb->user['uid']);
	 }
	 }
 }
 
function profilmuzigiek_mod_update()
{
  global $mybb, $db, $user;
  
if($mybb->input['action'] == "do_editprofile" && $mybb->request_method == "post")
{
  if ($mybb->input['profilmuzigi'] == "1")
   {
     $temp_query = " ".sutunadi()." = '1', "; 
   }
   else{
        $temp_query = " ".sutunadi()." = '0', ";     
   }
   
         $temp_query = $temp_query . "".sutunadi()." = '" . $db->escape_string($mybb->input['profilmuzigi']) . "'";
		 
  if ($mybb->input['profilmuzigiacik'] == "")
   {
     $temp_query2 = " profilmuzigiacik = '0' "; 
   }
   else
   {
        $temp_query2 = " profilmuzigiacik = '1' ";   		
   }
		 
      	 if (strstr($temp_query, "\"") == false)
	{
     $db->query("UPDATE ".TABLE_PREFIX."users SET " . $temp_query . " WHERE uid = " . $user['uid']);
     $db->query("UPDATE ".TABLE_PREFIX."users SET " . $temp_query2 . " WHERE uid = " . $user['uid']);
	 }
	 }
 }

function sitekontrol($url)
{
//Site ulaşılabilir mi kontrol eder. Bu fonksiyonun çalışması için MP3 doğrulayıcının açık olması gerekir, eğer kapalıysa 1 döndürür.
global $mybb;
if ($mybb->settings['profilmuzigiek_mp3dogrulayici'])
{
$parse = parse_url($url);
$alanadi = $parse['host'];

if($socket =@ fsockopen($alanadi, 80, $errno, $errstr, 30)) 
{
return 1;
fclose($socket);
} 
else return 0;
}
else return 1;
}
 
function get_http_response_code($url) 
{
global $mybb;
if ($mybb->settings['profilmuzigiek_mp3dogrulayici'])
{
if (sitekontrol($url))
{
    $headers = get_headers($url);
    return substr($headers[0], 9, 3);
}
else return '404';
}
else return 1;
}

function sutunadi()
{
return profilmuzigi165;
}

function grupyetkileri($pluginargs)
{
global $mybb, $form, $lang;

  	$lang->load("profilmuzigi");

if($pluginargs['title'] == $lang->misc && $lang->misc)
{
$pluginargs['content'].= "". $form->generate_check_box('profilmuzigi', 1, $lang->profilmuzigiek_setting_can_add_music, array('checked' => $mybb->input['profilmuzigi'], 'class' => 'checkbox_input', 'id' => 'profilmuzigi',));

}
}

function grupyetkileriguncelle()
{
	global $mybb, $updated_group;
	$updated_group['profilmuzigi'] = $mybb->input['profilmuzigi'];
}
?>