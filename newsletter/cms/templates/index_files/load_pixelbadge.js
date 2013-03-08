var x = document.getElementById('webutation-pixelbadge-link');
var imgNode = document.createElement("img");
if (typeof domain == 'undefined' || domain == '') {
	domain = window.location.hostname;
}
badge_url = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'www.webutation.net/images/pixelbadge.png';
imgNode.setAttribute('src', badge_url);
imgNode.setAttribute('alt', 'Webutation');
imgNode.setAttribute('height', '15');
imgNode.setAttribute('width', '80');
imgNode.setAttribute('id', 'webutation-pixelbadge-image');
imgNode.style.border = '0px';
x.innerHTML = '';
x.appendChild(imgNode);