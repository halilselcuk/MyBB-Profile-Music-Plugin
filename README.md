Features:
Multilanguage Support
For now it's only support 2 language. You can help for add other languages on transifex.com.
https://www.transifex.com/halil-selcuk/m...ic-plugin/

Group Permissions
You can choose which group can add profile music.

User Permissions
You can block abusive users on Mod CP or Admin CP.

YouTube, SoundCloud and Hotlink Sound Support
It's can play YouTube videos, SoundCloud sounds and hotlink sound files. Each players using HTML5.

Customizing
Plugin Settings:
It's have 6 settings. You can activate autoplay feature, change SoundCloud API parameters, disable verifiers, SoundCloud, YouTube, hotlink sounds.
Templates:
You can customize YouTube player, HTML5 player, profile music update fields. This templates can be find with prefix profilmuzigiek_ in Global Templates.

Verifiers
This feature checks whether the user's link is correct and reachable. Show warning message to user if link is not incorrect or cannot reachable. SoundCloud and YouTube links are verifiying with oEmbed, but hotlink sound links are verifiying with audio tag which kind of MIME type.

Installion
Upload files to your MyBB root -> go your plugin manager -> Install & Activate: Profile Music Plugin.


Update 1.6.5.2 to 1.7:
Upload new files -> open your Admin CP -> you will see update message -> run update.



If player not showing on profile add this code to member_profile template.

Code:
{$profilmuzigi}
Thanks for the help to brother. Smile
Apologize for my bad English grammar. I hope it is understandable.  
