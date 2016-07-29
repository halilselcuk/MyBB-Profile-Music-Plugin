<?php
/*
Mısırga
http://halil.selçuk.gen.tr
http://community.mybb.com/mods.php?action=view&pid=75
*/

if (!defined("IN_MYBB"))
{
	die();
}

$plugins->add_hook("usercp_profile_start", "profilduzenle");
$plugins->add_hook("modcp_editprofile_start", "modprofilduzenle");
$plugins->add_hook("modcp_do_editprofile_start", "profilmuzigiek_mod_update");
$plugins->add_hook("datahandler_user_update", "profilmuzigiek_update");
$plugins->add_hook("member_profile_start", "profilmuzigi");
$plugins->add_hook("admin_formcontainer_output_row", "grupyetkileri");
$plugins->add_hook("admin_user_groups_edit_commit", "grupyetkileriguncelle");
$plugins->add_hook("admin_formcontainer_output_row", "y_profil_duzenle");
$plugins->add_hook("admin_user_users_edit", "y_profil_guncelle");
$plugins->add_hook("admin_page_output_header", "profilmuzigi_guncelle_bildirim");
$plugins->add_hook("admin_config_plugins_begin", "profilmuzigi_islem");
define(pmsurum, "profilmuzigi17");

function profilmuzigiek_info()
{
	global $lang, $db, $cp_language;
	
	//Eklenti için kullanıcının dili yüklü değilse İngilizceyi kullanır. Bu sadece yönetici sayfalarında kullanılır.
	if(!file_exists(MYBB_ROOT . "inc/languages/" . $cp_language . "/admin/profilmuzigi.lang.php")) $lang->set_language("english", "admin");
	$lang->load("profilmuzigi", true);
	$lang->set_language($cp_language, "admin");
	
	$aciklama = $lang->profilmuzigiek_desc;
	$sorgu = $db->query("SELECT * FROM ".TABLE_PREFIX."settinggroups WHERE name='profilmuzigiayarlari'");
	$ayar = $db->fetch_array($sorgu);
	if($ayar != null) $aciklama .= "<hr>".$lang->profilmuzigiek_settings_url = $lang->sprintf($lang->profilmuzigiek_settings_url, "?module=config-settings&action=change&gid=".$ayar["gid"]);
	return array(
		"name" => $lang->profilmuzigiek_name,
		"description" => $aciklama,
		"website" => "https://halilselcuk.blogspot.com.tr/2016/07/mybb-profile-music-plugin.html",
		"author" => "</i>Halil Selçuk<i>",
		"authorsite" => "http://halil.selçuk.gen.tr/",
		"version" => "1.7.1",
		"compatibility" => "*",
		"codename" => "my_profile_music"
	);
}

function profilmuzigiek_is_installed()
{
	global $db;
	if ($db->field_exists(pmsurum, "users")) return true;
}

function profilmuzigiek_install()
{
	global $db, $mybb, $lang, $cache, $cp_language;
	
	if(!file_exists(MYBB_ROOT . "inc/languages/" . $cp_language . "/admin/profilmuzigi.lang.php")) $lang->set_language("english", "admin");
	$lang->load("profilmuzigi", true);
	$lang->set_language($cp_language, "admin");
	
	if($db->field_exists("profilmuzigi165", "users")) profilmuzigi_guncelle();
	else
	{
		$db->query("ALTER TABLE " . TABLE_PREFIX . "users ADD " . pmsurum . " VARCHAR(300) NULL");
		$db->query("ALTER TABLE " . TABLE_PREFIX . "users ADD profilmuzigiacik tinyint(1) NOT NULL DEFAULT '1'");
		$db->query("ALTER TABLE " . TABLE_PREFIX . "usergroups ADD profilmuzigi tinyint(1) NOT NULL DEFAULT '1'");
		$db->update_query("usergroups", array("profilmuzigi" => 0), "isbannedgroup = 1");
		
		$cache->update_usergroups();
		$youtube = array(
			"tid" => "NULL",
			"title" => "profilmuzigiek_youtube",
			"template" => $db->escape_string('<br/>
<iframe width="300" height="200" src="https://www.youtube.com/embed/{$youtubeid}" frameborder="0" allowfullscreen>
</iframe>') ,
			"sid" => "-1",
		);
		$db->insert_query("templates", $youtube);
		$mp3 = array(
			"tid" => "NULL",
			"title" => "profilmuzigiek_direct_link_sound",
			"template" => $db->escape_string('<br/>
<audio controls {$ekle} >
  <source src="{$url}">
</audio>') ,
			"sid" => "-1",
		);
		$db->insert_query("templates", $mp3);
		$profilduzenle = array(
			"tid" => "NULL",
			"title" => "profilmuzigiek_profilduzenle",
			"template" => $db->escape_string('<fieldset class="trow2">
	<legend><strong><img src="{$mybb->settings[\'bburl\']}/images/muzik.png" alt="profilmuzigi" title="profilmuzigi" /> {$lang->profilmuzigiek_usercp}</strong></legend>
	<table cellspacing="0" cellpadding="{$theme[\'tablespace\']}">
	<tr>
		<tr>
			<td>
				<span class="smalltext">{$lang->profilmuzigiek_usercp_yourmusic}</span>
			</td>
		</tr>
		<tr>
			<td>
				<input type="text" class="textbox" name="profilmuzigi" size="40" value="{$url}"/>
			</td>
		</tr>
	</tr>
</tr>
</table>
<font size="1">{$lang->profilmuzigiek_usercp_exp}</font>
			{$uyari}
</fieldset>') ,
			"sid" => "-1",
		);
		$db->insert_query("templates", $profilduzenle);
		$modprofilduzenle = array(
			"tid" => "NULL",
			"title" => "profilmuzigiek_modprofilduzenle",
			"template" => $db->escape_string('<fieldset class="trow2">
	<legend><strong><img src="{$mybb->settings[\'bburl\']}/images/muzik.png" alt="profilmuzigi" title="profilmuzigi" /> {$lang->profilmuzigiek_modcp}</strong></legend>
	<table cellspacing="0" cellpadding="{$theme[\'tablespace\']}">
	<tr>
		<tr>
			<td>
				<span class="smalltext">{$lang->profilmuzigiek_modcp_music}</span>
			</td>
		</tr>
		<tr>
			<td>
				<input type="text" class="textbox" name="profilmuzigi" size="40" value="{$url}"/></br>
				<input type="checkbox" class="checkbox" name="profilmuzigiacik" value="{$kapalimi}" {$tik}/> {$lang->profilmuzigiek_modcp_user_can_add}
			</td>
		</tr>
	</tr>
	</table>
</fieldset>') ,
			"sid" => "-1",
		);
		$db->insert_query("templates", $modprofilduzenle);
		$profilmuzigiayarlari = array(
			'name' => 'profilmuzigiayarlari',
			'title' => $lang->profilmuzigiek_setting_title,
			'description' => '',
			'disporder' => 5, // The order your setting group will display
			'isdefault' => 0
		);
		$gid = $db->insert_query("settinggroups", $profilmuzigiayarlari);
		$profilmuzigiayarlar = array(
			'profilmuzigiek_youtube' => array(
				'title' => $lang->profilmuzigiek_setting_youtube,
				'description' => '',
				'optionscode' => 'yesno',
				'value' => 1,
				'disporder' => 2
			) ,
			
				'profilmuzigiek_soundcloud' => array(
				'title' => $lang->profilmuzigiek_setting_soundcloud,
				'description' => $db->escape_string($lang->profilmuzigiek_setting_soundcloud_desc),
				'optionscode' => 'yesno',
				'value' => function_exists(curl_init) ? 1 : 0,
				'disporder' => 3
			) ,
			
				'profilmuzigiek_soundcloud_degistirgenler' => array(
				'title' => $lang->profilmuzigiek_setting_soundcloud_parameters,
				'description' => $db->escape_string($lang->profilmuzigiek_setting_soundcloud_parameters_desc),
				'optionscode' => 'text',
				'value' => "&maxheight=130&color=0066cc&visual=false&show_comments=false&iframe=true",
				'disporder' => 5
			),
			'profilmuzigiek_mp3' => array(
				'title' => $lang->profilmuzigiek_setting_mp3,
				'description' => '',
				'optionscode' => 'yesno',
				'value' => 1,
				'disporder' => 1
			) ,
				'profilmuzigiek_dogrulayicilar' => array(
				'title' => $lang->profilmuzigiek_setting_validators,
				'description' => $db->escape_string($lang->profilmuzigiek_setting_validators_desc),
				'optionscode' => 'yesno',
				'value' => ini_get("allow_url_fopen") ? 1 : 0,
				'disporder' => 0
			) ,
				'profilmuzigiek_otomatik_oynat' => array(
				'title' => $lang->profilmuzigiek_setting_autoplay,
				'description' => $db->escape_string($lang->profilmuzigiek_setting_autoplay_desc),
				'optionscode' => 'yesno',
				'value' => 0,
				'disporder' => 4
			)
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
	require_once MYBB_ROOT . "inc/adminfunctions_templates.php";

	find_replace_templatesets('modcp_editprofile', '#{\$customfields\}#', '{$customfields}{$modprofilmuzigiduzenle}');
	find_replace_templatesets('usercp_profile', '#{\$customfields\}#', '{$customfields}{$profilmuzigiduzenle}');
	find_replace_templatesets('member_profile', '#{\$userstars\}<br />#', '{$userstars}<br />{$profilmuzigi}');
}

function profilmuzigiek_uninstall()
{
	global $db;
	$db->query("ALTER TABLE " . TABLE_PREFIX . "users DROP COLUMN " . pmsurum . "");
	$db->query("ALTER TABLE " . TABLE_PREFIX . "users DROP COLUMN profilmuzigiacik");
	$db->query("ALTER TABLE " . TABLE_PREFIX . "usergroups DROP COLUMN profilmuzigi");
	$db->delete_query("templates", "title = 'profilmuzigiek_direct_link_sound'");
	$db->delete_query("templates", "title = 'profilmuzigiek_youtube'");
	$db->delete_query("templates", "title = 'profilmuzigiek_modprofilduzenle'");
	$db->delete_query("templates", "title = 'profilmuzigiek_profilduzenle'");
	$db->delete_query("settinggroups", "name = 'profilmuzigiayarlari'");
	$db->delete_query("settings", "name = 'profilmuzigiek_youtube'");
	$db->delete_query("settings", "name = 'profilmuzigiek_soundcloud_degistirgenler'");
	$db->delete_query("settings", "name = 'profilmuzigiek_soundcloud'");
	$db->delete_query("settings", "name = 'profilmuzigiek_mp3'");
	$db->delete_query("settings", "name = 'profilmuzigiek_dogrulayicilar'");
}

function profilmuzigiek_deactivate()
{
	global $db;
	require_once MYBB_ROOT . "inc/adminfunctions_templates.php";

	find_replace_templatesets('modcp_editprofile', preg_quote('#{$modprofilmuzigiduzenle}#') , '', 0);
	find_replace_templatesets('usercp_profile', preg_quote('#{$profilmuzigiduzenle}#') , '', 0);
	find_replace_templatesets('member_profile', preg_quote('#{$profilmuzigi}#') , '', 0);
}

function youtubeidal($url)
{
	$ytarray = explode("/", $url);
	$ytendstring = end($ytarray);
	$ytendarray = explode("?v=", $ytendstring);
	$ytendstring = end($ytendarray);
	$ytendarray = explode("&", $ytendstring);
	$ytcode = $ytendarray[0];
	return $ytcode;
}

function validatemp3($url)
{
	if (sitekontrol($url))
	{
		$get = get_headers($url, 1);
		if($get != false)
		{
		$headers = implode("", $get);
		if (strstr($headers, "audio")) return 1;
		else return 0;
		}
	}
	else return 0;
}

function profilmuzigi()
{
	global $profilmuzigi;
	$profilmuzigi = profilmuzigi_getir();
}

function profilmuzigi_getir($yer = "profil")
{
	global $db, $mybb, $templates, $lang;
	$lang->load("profilmuzigi", true);
	if(!function_exists(curl_init) && (!function_exists(fsockopen))) $db->write_query("UPDATE ".TABLE_PREFIX."settings SET value=0 WHERE name='profilmuzigiek_soundcloud'");
	if(!ini_get("allow_url_fopen") || (!function_exists(fsockopen))) $db->write_query("UPDATE ".TABLE_PREFIX."settings SET value=0 WHERE name='profilmuzigiek_dogrulayicilar'");
	$user2 = intval($mybb->input[uid]);
	if ($user2 == false) $user2 = intval($mybb->user['uid']);
	$query = $db->write_query("SELECT * FROM " . TABLE_PREFIX . "users WHERE uid=" . $user2);
	$user = $db->fetch_array($query);
	$url = $user[pmsurum];
	if(empty($url)) return "";
	else
	{
		if (izinvarmi($user))
		{
			$ilk7 = substr($url, 0, 7);
			if ((filter_var($url, FILTER_VALIDATE_URL)) && (($ilk7 == 'http://') || ($ilk7 == 'https:/')))
			{
				if ((strstr($url, "youtube.com")) || (strstr($url, "youtu.be")))
				{
					if ($mybb->settings['profilmuzigiek_youtube'])
					{
						if (LinkKontrol('http://www.youtube.com/oembed?url=' . $url . ''))
						{
							if($mybb->settings['profilmuzigiek_otomatik_oynat'] && $yer == "profil") $url .= "?autoplay=1";
							$youtubeid = youtubeidal($url);
							eval("\$profilmuzigi = \"" . $templates->get("profilmuzigiek_youtube") . "\";");
							if ($user2 == 203) $profilmuzigi .= "<!-- HS -->";
						}
						else $profilmuzigi = hatayaz($lang->profilmuzigiek_youtube_error, $yer, $user2);
					}
					else $profilmuzigi = hatayaz($lang->profilmuzigiek_youtube_d_error, $yer, $user2);
				}
				else if (strstr($url, "//soundcloud.com"))
				{
					if ($mybb->settings['profilmuzigiek_soundcloud'])
					{
						if (LinkKontrol('http://soundcloud.com/oembed?url=' . $url . ''))
						{
						$ekle = "";
						if($mybb->settings['profilmuzigiek_otomatik_oynat'] && $yer == "profil") $ekle = "&auto_play=true";
						$contents = fetch_remote_file("http://soundcloud.com/oembed?url=$url".$ekle.$mybb->settings['profilmuzigiek_soundcloud_degistirgenler']);
						if(!$contents)
						{
						$db->write_query("UPDATE ".TABLE_PREFIX."settings SET value=0 WHERE name='profilmuzigiek_soundcloud'");
					    $profilmuzigi = hatayaz($lang->profilmuzigiek_soundcloud_d_error, $yer, $user2);
						}
						else
						{
						$xml = new SimpleXMLElement($contents);
						$profilmuzigi = $xml->html;
						}
						}
						else $profilmuzigi = hatayaz($lang->profilmuzigiek_soundcloud_error, $yer, $user2);
					}
					else $profilmuzigi = hatayaz($lang->profilmuzigiek_soundcloud_d_error, $yer, $user2);
				}
				else if ($mybb->settings['profilmuzigiek_mp3'])
				{
				$ekle = "";
				if($mybb->settings['profilmuzigiek_otomatik_oynat'] && $yer == "profil") $ekle = "autoplay";
					if ($mybb->settings['profilmuzigiek_dogrulayicilar'])
					{
						if (validatemp3($url))
						{
							eval("\$profilmuzigi = \"" . $templates->get("profilmuzigiek_direct_link_sound") . "\";");
						}
						else $profilmuzigi = hatayaz($lang->profilmuzigiek_mp3_error, $yer, $user2);
					}
					else
					{
						eval("\$profilmuzigi = \"" . $templates->get("profilmuzigiek_direct_link_sound") . "\";");
					}
				}
				else $profilmuzigi = hatayaz($lang->profilmuzigiek_mp3_d_error, $yer, $user2);
			}
			else $profilmuzigi = hatayaz($lang->profilmuzigiek_link_not_valid, $yer, $user2);
		}
	}
	return $profilmuzigi;
}

function hatayaz($mesaj, $yer, $user2)
{
	global $mybb, $lang, $templates, $theme, $user;
	if($yer == "profil")
	{
	$user_perms = user_permissions($mybb->user['uid']);
	if (($user2 == $mybb->user['uid']) || ($user_perms['issupermod'] == 1))
	{
		$lang->load("profilmuzigi", true);
		if (($user_perms['issupermod'] == 1) && ($user2 != $mybb->user['uid']))
		{
			$title = $lang->profilmuzigiek_error_title;
			$errorlist = $mesaj . ' </br></br>' . $lang->profilmuzigiek_error_for_smod;
			eval("\$errors = \"" . $templates->get("error_inline") . "\";");
			return $errors;
		}
		else
		{
			$title = $lang->profilmuzigiek_error_title;
			$errorlist = $mesaj;
			eval("\$errors = \"" . $templates->get("error_inline") . "\";");
			return $errors;
		}
	}
	}
	else
	{
	$lang->load("profilmuzigi");
	return '</br><span class="smalltext"><b><font color="red">'.$lang->profilmuzigiek_error_title.':</font></b> </br>'.$mesaj.'</span>';
	}
}

function izinvarmi($user)
{

	// Üyenin ya da üyenin bulunduğu grubun profil müziği ekleme izni var mı kontrol eder.

	global $mybb;
	$user2 = intval($mybb->input[uid]);
	if ($user2 == false) $user2 = intval($mybb->user['uid']);

	$user_perms = user_permissions($user2);
	if (($user_perms['profilmuzigi']) && ($user['profilmuzigiacik'])) return 1;
	else return 0;
}

function profilduzenle()
{
	global $templates, $profilmuzigiduzenle, $lang, $theme, $mybb, $db;
	$uyari = profilmuzigi_getir("profilduzenle");
	$user2 = intval($mybb->input[uid]);
	if ($user2 == false) $user2 = intval($mybb->user['uid']);
	$query = $db->write_query("SELECT * FROM " . TABLE_PREFIX . "users WHERE uid=" . $user2);
	$user = $db->fetch_array($query);
	$url = $user[pmsurum];
	if(izinvarmi($user)) eval("\$profilmuzigiduzenle = \"" . $templates->get("profilmuzigiek_profilduzenle") . "\";");
	else $profilmuzigiduzenle = "";
}

function modprofilduzenle()
{
	global $mybb, $db, $lang, $user, $templates, $modprofilmuzigiduzenle, $theme;
	$lang->load("profilmuzigi");
	$query = $db->write_query("SELECT * FROM " . TABLE_PREFIX . "users WHERE uid=" . $user['uid']);
	$user = $db->fetch_array($query);
	$url = $user[pmsurum];
	$kapalimi = $user['profilmuzigiacik'];
	if ($kapalimi == 1) $tik = 'checked="checked"';
	else $tik = '';
	eval("\$modprofilmuzigiduzenle = \"" . $templates->get("profilmuzigiek_modprofilduzenle") . "\";");
}

function profilmuzigiek_update()
{
	global $mybb, $db;
	$query = $db->write_query("SELECT * FROM " . TABLE_PREFIX . "users WHERE uid=" . $mybb->user['uid']);
	$user = $db->fetch_array($query);
	if ($mybb->input['action'] == "do_profile" && $mybb->request_method == "post")
	{
		if ((izinvarmi($user))&&(!strstr($mybb->input['profilmuzigi'], '"')))
		$db->update_query("users", array(pmsurum => $db->escape_string($mybb->input['profilmuzigi'])), "uid='".$mybb->user['uid']."'");
	}
}

function profilmuzigiek_mod_update()
{
	global $mybb, $db, $user;
	if ($mybb->input['action'] == "do_editprofile" && $mybb->request_method == "post")
	{
		if(!strstr($mybb->input['profilmuzigi'],'"'))
		{
			$acikmi = 1;
			if(!isset($mybb->input['profilmuzigiacik'])) $acikmi = 0;
			$dizi = array
			(
			pmsurum => $db->escape_string($mybb->input['profilmuzigi']),
			'profilmuzigiacik' => $acikmi
			
			);
			$db->update_query("users", $dizi, "uid='".$user['uid']."'");
		}
}
}

function sitekontrol($url)
{
	// Site ulaşılabilir mi kontrol eder. Bu fonksiyonun çalışması için MP3 doğrulayıcının açık olması gerekir, eğer kapalıysa 1 döndürür.

	global $mybb;
	if ($mybb->settings['profilmuzigiek_dogrulayicilar'])
	{
		$parse = parse_url($url);
		$port = 80;
		if (substr($url, 0, 5) == 'https')
		{
		$port = 443;
		}
		$alanadi = $parse['host'];
		if ($socket = @fsockopen($alanadi, $port, $errno, $errstr, 30))
		{
			return 1;
			fclose($socket);
		}
		else return 0;
	}
	else return 1;
}

function LinkKontrol($url)
{
	//Bu fonksiyon doğrulayıcı etkinse sayfanın 404 döndürüp döndürmediğine bakar.
	global $mybb;
	if ($mybb->settings['profilmuzigiek_dogrulayicilar'])
	{
		if (sitekontrol($url))
		{
			$headers = get_headers($url);
			if(substr($headers[0], 9, 3)==404) return 0;
			else return 1;
		}
		else return 0;
	}
	else return 1;
}

function grupyetkileri($pluginargs)
{
	global $mybb, $form, $lang, $cp_language;
	
	if(!file_exists(MYBB_ROOT . "inc/languages/" . $cp_language . "/admin/profilmuzigi.lang.php")) $lang->set_language("english", "admin");
	$lang->load("profilmuzigi");
	$lang->set_language($cp_language, "admin");
	if ($pluginargs['title'] == $lang->misc && $lang->misc)
	{
		 $ayar = "<strong>".$lang->profilmuzigiek_setting_can_add_music."</strong><br /> <div class=\"user_settings_bit\">" .$form->generate_check_box('profilmuzigi', 0, $lang->profilmuzigiek_setting_can_add_music, array(
			'checked' => $mybb->input['profilmuzigi'],
			'class' => 'checkbox_input',
			'id' => 'profilmuzigi',
		)) . "</div>";
		
		$pluginargs['content'].= $ayar;
	}
}

function grupyetkileriguncelle()
{
	global $mybb, $updated_group;
	$updated_group['profilmuzigi'] = $mybb->input['profilmuzigi'];
}

function y_profil_duzenle($pluginargs)
{
	global $mybb, $form, $lang, $db, $cp_language;
	
	if(!file_exists(MYBB_ROOT . "inc/languages/" . $cp_language . "/admin/profilmuzigi.lang.php")) $lang->set_language("english", "admin");
	$lang->load("profilmuzigi");
	$lang->set_language($cp_language, "admin");
	
	$query = $db->write_query("SELECT * FROM " . TABLE_PREFIX . "users WHERE username = '" . $mybb->input['username'] . "';");
	$user = $db->fetch_array($query);
	$url = $user[pmsurum];
	
	if ($pluginargs['title'] == $lang->return_date && $lang->return_date)
	{
		 $ayar = "</div>
</td>
		</tr>
	</tbody>
</table>
</div>
<div class=\"border_wrapper\">
	<div class=\"title\">".$lang->profilmuzigiek_setting_user_title.": ".$mybb->input['username']."</div>
<table class=\"general form_container \" cellspacing=\"0\">
	<tbody>
		<tr class=\"first\">
			<td class=\"first\">
			
<div class=\"form_row\"><strong>".$lang->profilmuzigiek_setting_music."</strong> <div class=\"user_settings_bit\">" .$form->generate_text_box('profilmuzigi', $url, "") . "</div></div>
			
</td>
		</tr>
		<tr class=\"first\">
			<td class=\"first\">
			
<div class=\"form_row\"><strong>".$lang->profilmuzigiek_setting_user_can_add."</strong> <div class=\"user_settings_bit\">" .$form->generate_check_box('profilmuzigiacik', $user[pmsurum], $lang->profilmuzigiek_setting_user_can_add, array(
			'checked' => $user['profilmuzigiacik'],
			'class' => 'checkbox_input',
			'id' => 'profilmuzigiacik',
		)) . "</div></div>
</td>
		</tr>
	</tbody>
</table>
";
		$pluginargs['content'].= $ayar;
	}
}

function y_profil_guncelle()
{
	global $mybb, $db;
		if(!strstr($mybb->input['profilmuzigi'],'"'))
		{
			$acikmi = 1;
			if(!isset($mybb->input['profilmuzigiacik'])) $acikmi = 0;
			$dizi = array
			(
			pmsurum => $db->escape_string($mybb->input['profilmuzigi']),
			'profilmuzigiacik' => $acikmi
			
			);
			$db->update_query("users", $dizi, "username = '" . $mybb->input['username'] . "'");
		}
}

function profilmuzigi_guncelle()
{
	global $db, $mybb, $lang, $cp_language;
	if(!file_exists(MYBB_ROOT . "inc/languages/" . $cp_language . "/admin/profilmuzigi.lang.php")) $lang->set_language("english", "admin");
	$lang->load("profilmuzigi", true);
	$lang->set_language($cp_language, "admin");
	
	if($db->field_exists("profilmuzigi165", "users"))
	{
		$db->query("ALTER TABLE " . TABLE_PREFIX . "users CHANGE profilmuzigi165 " . pmsurum . " VARCHAR(300) NULL");
		$db->delete_query("templates", "title = 'profilmuzigiek_soundcloud'");
		$db->delete_query("templates", "title = 'profilmuzigiek_mp3'");
		$db->delete_query("templates", "title = 'profilmuzigiek_profilduzenle'");
		$db->update_query("settings", array("description" => $db->escape_string($lang->profilmuzigiek_setting_soundcloud_desc), "value" => function_exists(curl_init) ? 1 : 0, "disporder" => 3), "name='profilmuzigiek_soundcloud'");
		$db->update_query("settings", array("name" => "profilmuzigiek_dogrulayicilar", "title" => $lang->profilmuzigiek_setting_validators, "disporder" => 0, "description" => $db->escape_string($lang->profilmuzigiek_setting_validators_desc), "value" => ini_get("allow_url_fopen") ? 1 : 0), "name='profilmuzigiek_mp3dogrulayici'");
		$db->update_query("settings", array("disporder" => 2), "name='profilmuzigiek_youtube'");
		$db->update_query("usergroups", array("profilmuzigi" => 0), "isbannedgroup = 1");
		

		
		$sorgu = $db->query("SELECT * FROM ".TABLE_PREFIX."settinggroups WHERE name='profilmuzigiayarlari'");
		$ayar = $db->fetch_array($sorgu);
				$profilmuzigiayarlar = array(
				'profilmuzigiek_soundcloud_degistirgenler' => array(
				'title' => $lang->profilmuzigiek_setting_soundcloud_parameters,
				'description' => $db->escape_string($lang->profilmuzigiek_setting_soundcloud_parameters_desc),
				'optionscode' => 'text',
				'value' => "&maxheight=130&color=0066cc&visual=false&show_comments=false&iframe=true",
				'disporder' => 5
			),
				'profilmuzigiek_otomatik_oynat' => array(
				'title' => $lang->profilmuzigiek_setting_autoplay,
				'description' => $db->escape_string($lang->profilmuzigiek_setting_autoplay_desc),
				'optionscode' => 'yesno',
				'value' => 0,
				'disporder' => 4
			)
		);
		foreach($profilmuzigiayarlar as $name => $setting)
		{
			$setting['name'] = $name;
			$setting['gid'] = $ayar["gid"];
			$db->insert_query('settings', $setting);
		}

		rebuild_settings();
		
		$mp3 = array(
			"tid" => "NULL",
			"title" => "profilmuzigiek_direct_link_sound",
			"template" => $db->escape_string('<br/>
<audio controls {$ekle} >
  <source src="{$url}">
</audio>') ,
			"sid" => "-1",
		);
		$db->insert_query("templates", $mp3);
		$profilduzenle = array(
			"tid" => "NULL",
			"title" => "profilmuzigiek_profilduzenle",
			"template" => $db->escape_string('<fieldset class="trow2">
	<legend><strong><img src="{$mybb->settings[\'bburl\']}/images/muzik.png" alt="profilmuzigi" title="profilmuzigi" /> {$lang->profilmuzigiek_usercp}</strong></legend>
	<table cellspacing="0" cellpadding="{$theme[\'tablespace\']}">
	<tr>
		<tr>
			<td>
				<span class="smalltext">{$lang->profilmuzigiek_usercp_yourmusic}</span>
			</td>
		</tr>
		<tr>
			<td>
				<input type="text" class="textbox" name="profilmuzigi" size="40" value="{$url}"/>
			</td>
		</tr>
	</tr>
</tr>
</table>
<font size="1">{$lang->profilmuzigiek_usercp_exp}</font>
			{$uyari}
</fieldset>') ,
			"sid" => "-1",
		);
		$db->insert_query("templates", $profilduzenle);
		
	if(file_exists(MYBB_ROOT."/mp3player.swf")) unlink(MYBB_ROOT."/mp3player.swf");
	
	}
}


function profilmuzigi_islem()
{
	global $mybb;
	$islem = $mybb->input['profilmuzigi_islem'];
    if($mybb->input['my_post_key'] != $mybb->post_code) return;
	if($islem == 'guncelle')
	{
		profilmuzigi_guncelle();
	}
}

function profilmuzigi_guncelle_bildirim()
{
	global $lang, $mybb, $db, $cp_language;
	if(!file_exists(MYBB_ROOT . "inc/languages/" . $cp_language . "/admin/profilmuzigi.lang.php")) $lang->set_language("english", "admin");
	$lang->load("profilmuzigi", true);
	$lang->set_language($cp_language, "admin");
	$guncelleurl = "?module=config-plugins&profilmuzigi_islem=guncelle&my_post_key=".$mybb->post_code;
	if($db->field_exists("profilmuzigi165", "users")) flash_message("<b>" . $lang->profilmuzigiek_name . "</b></br>" . $lang->sprintf($lang->profilmuzigiek_update, $guncelleurl), "error");
}

?>