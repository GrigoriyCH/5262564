(function() {
var init = function() {
RamblerShare.init('.rambler-share', {
	"style": {
		"buttonHeight": 32,
		"borderRadius": 16,
		"borderColor": "#f5f1f5"
	},
	"utm": "utm_source=social",
	"counters": true,
	"buttons": [
		"vkontakte",
		"facebook",
		"odnoklassniki",
		"livejournal",
		"twitter",
		"moimir",
		"googleplus",
		"linkedin",
		"telegram",
		"viber",
		"whatsapp"
	]
});
};
var script = document.createElement('script');
script.onload = init;
script.async = true;
script.src = 'https://developers.rambler.ru/likes/widget.js';
document.head.appendChild(script);
})();