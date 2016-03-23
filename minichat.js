function getXMLHttpRequest() {
	var xhr = null;
	
	if (window.XMLHttpRequest || window.ActiveXObject) {
		if (window.ActiveXObject) {
			try {
				xhr = new ActiveXObject("Msxml2.XMLHTTP");
			} catch(e) {
				xhr = new ActiveXObject("Microsoft.XMLHTTP");
			}
		} else {
			xhr = new XMLHttpRequest(); 
		}
	} else {
		alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
		return null;
	}
	
	return xhr;
}


function refreshChat()
{
var xhr = getXMLHttpRequest();
xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                document.getElementById('minichat').innerHTML = xhr.responseText; // Donn�es textuelles r�cup�r�es
               
        }
};

xhr.open("GET", "minichat_pdo.php", true);
xhr.send(null);
}

function submitChat()
{
var xhr = getXMLHttpRequest();
var pseudo = encodeURIComponent(document.getElementById('pseudo').value);
var message = encodeURIComponent(document.getElementById('message').value);
document.getElementById('message').value = ""; // on vide le message sur la page

xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                document.getElementById('minichat').innerHTML = xhr.responseText; // Donn�es textuelles r�cup�r�es
        }
};

xhr.open("POST", "minichat_pdo.php", true);
xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
xhr.send("pseudo="+pseudo+"&message="+message);

}
var timer=setInterval("refreshChat()", 5000); // r�p�te toutes les 5s