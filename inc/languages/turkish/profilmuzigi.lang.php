<?php

//Admin CP Plugins
$l['profilmuzigiek_name'] = "Profil Müziği Eklentisi";
$l['profilmuzigiek_desc'] = 'Bu eklenti sayesinde üyeleriniz profiline müzik ekleyebilir. Eklenti SoundCloud, YouTube ve doğrudan bağlantılı ses dosyalarını (HTML5 ile) destekler.';
$l['profilmuzigiek_settings_url'] = 'Eğer eklentiyle ilgili bir sorun yaşıyorsanız <strong><a href="{1}">eklenti ayarları</a></strong>nı kontrol ediniz.';
$l['profilmuzigiek_update'] = '<b><font color="blue">Güncelleme:</font></b> Profil Müziği Eklentisinin yeni sürümünü yüklediniz. Yeni sürümün doğru çalışabilmesi için güncelleyiciyi çalıştırmalısınız. <a href="{1}">Çalıştırmak için buraya tıklayınız.</a>';
$l['profilmuzigiek_update_success'] = 'Profil Müziği Eklentisi başarıyla güncellendi.';
$l['profilmuzigiek_theme_change'] = '<strong>Tema Değişikliği: </strong> Tema değişikliğinde eklentinin şablon kodları yeni şablonlara yeniden eklenmelidir. Temanızı değiştirdiyseniz kodları eklemek için <a href="{1}"> buraya tıklayın.</a> Daha fazla yardım gerekiyorsa <a href="http://www.halilselcuk.net/2016/07/mybb-profil-muzigi-eklentisi.html">yardım sayfasını ziyaret edin.</a>';
$l['profilmuzigiek_add_template_code_success'] = 'Şablon kodları başarıyla eklendi.';

//Edit Profile
$l['profilmuzigiek_usercp'] = "Profil Müziği";
$l['profilmuzigiek_usercp_yourmusic'] = "Eklemek istediğiniz ses dosyasının bağlantısı:";
$l['profilmuzigiek_usercp_exp'] = "Link SoundCloud, YouTube ya da doğrudan bağlantılı ses dosyası olmalıdır. Örnek: </br>
Soundcloud: https://soundcloud.com/cr2o3/tomb-raider-legend-main-theme</br>

Youtube: https://www.youtube.com/watch?v=vT8OU5WtfkQ</br>


Doğrudan bağlantılı ses dosyası: https://demomybb.tk/demo.mp3</br>";


//MOD CP
$l['profilmuzigiek_modcp'] = "Profil Müziği";
$l['profilmuzigiek_modcp_music'] = "Kullanıcının eklediği profil müziğinin bağlantısı:";
$l['profilmuzigiek_modcp_user_can_add'] = "Kullanıcı profil müziği ekleyebilsin mi?";



//Errors
$l['profilmuzigiek_error_title'] = "Profil Müziği Hatası";
$l['profilmuzigiek_link_not_valid'] = "Eklediğiniz profil müziğinin bağlantısı hatalı. Eklediğiniz bağlantının başında https:// olduğundan emin olun.";
$l['profilmuzigiek_youtube_error'] = "Eklediğiniz YouTube video bağlantısı hatalı ya da ulaşılamıyor. Lütfen girmiş olduğunuz bağlantıyı kontrol edin.";
$l['profilmuzigiek_soundcloud_error'] = "Eklediğiniz SoundCloud bağlantısı hatalı ya da dosyaya ulaşılamıyor. Lütfen girmiş olduğunuz bağlantıyı kontrol edin.";
$l['profilmuzigiek_mp3_error'] = "Eklediğiniz bağlantı ses dosyası değil ya da sunucuya ulaşılamıyor. Şunlardan birini deneyiniz: SoundCloud, YouTube ya da doğrudan bağlantılı ses dosyası.";
$l['profilmuzigiek_youtube_d_error'] = "YouTube desteği yönetici tarafından kapatılmış.";
$l['profilmuzigiek_soundcloud_d_error'] = "SoundCloud desteği yönetici tarafından kapatılmış.";
$l['profilmuzigiek_mp3_d_error'] = "Doğrudan bağlantılı ses dosyası desteği yönetici tarafından kapatılmış. Eğer SoundCloud ya da YouTube eklediğiniz halde bu hatayı alıyorsanız eklediğiniz bağlantıyı kontrol edin.";
$l['profilmuzigiek_error_for_smod'] = "<i>Not: Bu kullanıcının profil müziği hatasını süper moderatör yetkisine sahip olduğunuz için görüyorsunuz.</i>";
$l['profilmuzigiek_http_not_allowed'] = "Güvenli olmayan bağlantıya izin verilmiyor. MP3 bağlantısı https:// ile başlamalıdır.";

//Admin CP Settings
$l['profilmuzigiek_setting_title'] = "Profil Müziği Eklentisi Ayarları";
$l['profilmuzigiek_setting_validators'] = "Doğrudan bağlantılı ses dosyası, SoundCloud ve YouTube doğrulayıcı açılsın mı?";
$l['profilmuzigiek_setting_validators_desc'] = 'Bu özellik kullanıcının girdiği bağlantı doğru mu ve ulaşılabilir mi denetler. Eğer kullanılabilir değilse kullanıcıya uyarı gösterilir. </br> SoundCloud ve YouTube bağlantıları oEmbed\'leri ile, doğrudan bağlantılı ses dosyaları ise MIME türleri ile doğrulanır.</br> <b>Bu özellik URL Fopen\'a ihtiyaç duyar. Eğer PHP\'nin allow_url_fopen ayarı kapalıysa bu ayar kendiliğinden kapanacaktır.</b>';
$l['profilmuzigiek_setting_mp3'] = "Doğrudan bağlantılı ses dosyası desteği açılsın mı?";
$l['profilmuzigiek_setting_youtube'] = "YouTube desteği açılsın mı?";
$l['profilmuzigiek_setting_soundcloud'] = "SoundCloud desteği açılsın mı?";
$l['profilmuzigiek_setting_soundcloud_desc'] = "<b>Bu özelliğin çalışması için cURL ya da fsockopen etkin olmalıdır. Eğer gereksinimler sağlanmıyorsa ayar kendiliğinden kapanacaktır.</b>";
$l['profilmuzigiek_setting_soundcloud_parameters'] = "SoundCloud değiştirgenleri(parametre):";
$l['profilmuzigiek_setting_soundcloud_parameters_desc'] = "Değiştirgenler ve bilgi için: <a href=\"https://developers.soundcloud.com/docs/api/html5-widget\" target=\"_blank\">https://developers.soundcloud.com/docs/api/html5-widget</a> ";
$l['profilmuzigiek_setting_autoplay'] = "Otomatik oynatma özelliği açılsın mı?";
$l['profilmuzigiek_setting_autoplay_desc'] = "Bu ayarı açarsanız kullanıcının profiline girildiğinde müzik çalmaya başlar.";
$l['profilmuzigiek_setting_http_allowed'] = "Güvenli olmayan ses dosyası bağlantılarına izin verilsin mi?";
$l['profilmuzigiek_setting_http_allowed_desc'] = "Eğer siteniz güvenli bağlantı destekliyorsa bu ayarı devre dışı bırakın. Bu ayarı devre dışı bıraktığınızda HTTP ile başlayan ses dosyaları kabul edilmeyecek.";

?>