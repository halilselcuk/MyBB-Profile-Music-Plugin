<?php

// Admin CP Plugins
$l['profilmuzigiek_name'] = "Profil Müziği Eklentisi";
$l['profilmuzigiek_desc'] = 'Kullanıcıların profillerine müzik eklemesini sağlar. SoundCloud, YouTube ve direkt ses dosyası bağlantılarını destekler.';
$l['profilmuzigiek_settings_url'] = 'Eklentiyle ilgili sorun yaşıyorsanız <strong><a href="{1}">eklenti ayarlarını</a></strong> kontrol ediniz.';
$l['profilmuzigiek_update'] = '<b><font color="blue">Güncelleme:</font></b> Profil Müziği Eklentisinin yeni sürümü yüklendi. Güncelleyiciyi manuel olarak çalıştırmanız gerekmektedir. <a href="{1}">Çalıştırmak için tıklayın.</a>';
$l['profilmuzigiek_update_success'] = 'Profil Müziği Eklentisi başarıyla güncellendi.';
$l['profilmuzigiek_theme_change'] = '<strong>Tema Değişikliği:</strong> Tema değiştirdiğinizde eklenti şablon kodlarını yeni temaya eklemelisiniz. Temayı değiştirdiyseniz <a href="{1}">buradan</a> kod ekleyebilirsiniz. Ayrıntılı bilgi için <a href="https://github.com/halilselcuk/MyBB-Profile-Music-Plugin/wiki">Wiki sayfasını</a> ziyaret edin.';
$l['profilmuzigiek_add_template_code_success'] = 'Şablon kodları başarıyla eklendi.';

// Edit Profile
$l['profilmuzigiek_usercp'] = "Profil Müziği";
$l['profilmuzigiek_usercp_yourmusic'] = "Profil müziği bağlantınız:";
$l['profilmuzigiek_usercp_exp'] = "Bağlantı örnekleri: </br>
Direkt ses dosyası: https://mybb.halilselcuk.com/demo.mp3</br>
SoundCloud: https://soundcloud.com/cr2o3/tomb-raider-legend-main-theme</br>
YouTube: https://www.youtube.com/watch?v=OFnnXt2etmU</br>";

// MOD CP
$l['profilmuzigiek_modcp'] = "Profil Müziği";
$l['profilmuzigiek_modcp_music'] = "Kullanıcının profil müziği bağlantısı:";
$l['profilmuzigiek_modcp_user_can_add'] = "Kullanıcı profil müziği ekleyebilsin mi?";

// Errors
$l['profilmuzigiek_error_title'] = "Profil Müziği Hatası";
$l['profilmuzigiek_link_not_valid'] = "Geçersiz bağlantı. Bağlantı HTTPS protokolü ile başlamalıdır.";
$l['profilmuzigiek_youtube_error'] = "Geçersiz YouTube bağlantısı veya video ulaşılamıyor. Lütfen kontrol edin.";
$l['profilmuzigiek_soundcloud_error'] = "Geçersiz SoundCloud bağlantısı veya içerik ulaşılamıyor. Lütfen kontrol edin.";
$l['profilmuzigiek_mp3_error'] = "Ses dosyası bulunamadı veya geçersiz bağlantı. Lütfen SoundCloud, YouTube veya direkt ses dosyası kullanın.";
$l['profilmuzigiek_youtube_d_error'] = "YouTube desteği yönetici tarafından devre dışı bırakıldı.";
$l['profilmuzigiek_soundcloud_d_error'] = "SoundCloud desteği yönetici tarafından devre dışı bırakıldı.";
$l['profilmuzigiek_mp3_d_error'] = "Direkt ses dosyası desteği devre dışı.  Eğer SoundCloud/YouTube olduğu halde bu hatayı alıyorsanız eklediğiniz bağlantıyı kontrol ediniz.";
$l['profilmuzigiek_error_for_smod'] = "<i>Not: Bu hatayı süper moderatör yetkileriniz nedeniyle görüntülüyorsunuz.</i>";
$l['profilmuzigiek_http_not_allowed'] = "Güvenli olmayan bağlantılara izin verilmiyor. Ses bağlantısı HTTPS ile başlamalıdır.";

// Admin CP Settings
$l['profilmuzigiek_setting_title'] = "Profil Müziği Ayarları";
$l['profilmuzigiek_setting_validators'] = "Doğrulayıcıları Etkinleştir";
$l['profilmuzigiek_setting_validators_desc'] = 'YouTube, SoundCloud ve direkt ses dosyası bağlantılarını kontrol eder. Geçersiz bağlantılarda kullanıcıya uyarı gösterir. </br> 
SoundCloud/YouTube: oEmbed ile doğrulanır </br>
Ses dosyaları: MIME türü ile kontrol edilir </br>
<b>URL Fopen ve OpenSSL eklentisi gerektirir. Bu özellikler devre dışıysa doğrulama otomatik kapanır.</b>';
$l['profilmuzigiek_setting_mp3'] = "Direkt Ses Dosyası Desteği";
$l['profilmuzigiek_setting_youtube'] = "YouTube Desteği";
$l['profilmuzigiek_setting_soundcloud'] = "SoundCloud Desteği";
$l['profilmuzigiek_setting_soundcloud_desc'] = "Özelleştirme için şablonu düzenleyin. <a href=\"https://developers.soundcloud.com/docs/api/html5-widget\" target=\"_blank\">SoundCloud API Belgeleri</a>";
$l['profilmuzigiek_setting_autoplay'] = "Otomatik Oynatma";
$l['profilmuzigiek_setting_autoplay_desc'] = "Etkinleştirildiğinde müzikler otomatik başlar.";
$l['profilmuzigiek_setting_http_allowed'] = "Güvenli Olmayan Bağlantılar";
$l['profilmuzigiek_setting_http_allowed_desc'] = "Siteniz HTTPS destekliyorsa bu seçeneği devre dışı bırakın. Devre dışı bırakıldığında HTTP bağlantılarına izin verilmez.";

?>
