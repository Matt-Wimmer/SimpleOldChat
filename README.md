
# Simple Old Chat

It is what the name suggests. A simple chat program in the style of the old SFWest chats.
I miss Brak's Chat. So I made this easily clonable knock-off.

**DO NOT use this without replacing the values in user_settings.env. There is a password that should not be re-used. Besides, you should make this your own.**

![Alt text](https://i.postimg.cc/Nfx9C5g5/Screenshot-20250928-215340.png "Image of this in action")

All you have to do is install Docker with Compose and bring up the compose in this repo on your server.
Be aware, this is set-up to just be a stand alone site at port 80. If you want this to be on a sub-domain or anything, adjustments will need to be made.
Bear in mind, the site.conf file replaces default.conf in the Nginx container. This is probably a good starting point.

It's also important to note that I did not include any sort of login or username protection here. I may add it in the future.
