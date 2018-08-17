#include <TimeLib.h>
#include <SPI.h>
#include <LoRa.h>
#include <ArduinoJson.h>
#include <WiFi.h>
#include <WiFiUdp.h>
#include <math.h>
#include <Timer.h>
#include <PubSubClient.h>

int status = WL_IDLE_STATUS;
char ssid[] = "ES711";  //  your network SSID (name)
char pass[] = "es711wifi";       // your network password
char mqttServer[] = "140.125.33.31";
char clientID[] = "amebaClientES711";
char publishTopic[] = "data";
String msgStr;
char json[40];
WiFiClient wifiClient;
PubSubClient client(mqttServer, 1883, wifiClient);

unsigned int localPort = 2390;      // local port to listen for UDP packets
unsigned long recTime=0;
Timer Sec;
IPAddress timeServer(118, 163, 81, 61); // time.stdtime.gov.tw NTP server
const int timeZone = 8;     // Beijing Time, Taipei Time
const int NTP_PACKET_SIZE = 48; // NTP time stamp is in the first 48 bytes of the message
byte packetBuffer[ NTP_PACKET_SIZE];  //buffer to hold incoming and outgoing packets

WiFiUDP Udp;  // A UDP instance to let us send and receive packets over UDP

void setup() {
  Serial.begin(9600);
  while (!Serial);

  Serial.println("Gateway setup");

  // check for the presence of the shield:
  if (WiFi.status() == WL_NO_SHIELD) {
    Serial.println("WiFi shield not present");  // don't continue:
    while (true);}

  // attempt to connect to Wifi network:
  while (status != WL_CONNECTED) {
    Serial.println(String("Attempting to connect to SSID: ")+ssid);
    status = WiFi.begin(ssid, pass);
    delay(10000);} // wait 10 seconds for connection:
  wdt_reset();
  Serial.println("Connected to wifi");
  printWifiStatus(); 
  Serial.println("\nStarting connection to server...");
  Udp.begin(localPort);

  recTime=getUnixTime();
  Serial.println(recTime);
  Sec.every(1000,passTime);
  
  Serial.println("LoRa Receiver");
  LoRa.setPins(9,8,7);
  if (!LoRa.begin(915E6)) {
    Serial.println("Starting LoRa failed!");
    while (1);}
  LoRa.setSignalBandwidth(62.5E3);
  wdt_disable();
}

void loop() {
  // receive packet from node
  if (LoRa.parsePacket()) {
    // received a packet
    Serial.print("Received packet '");
    int i=0;
    int Type;
    int ID;
    float Data=0;
    unsigned long getTime;
    while (LoRa.available()) {
      switch (i){
        case 0:
          Type=LoRa.read();
        break;
        case 1:
          ID=LoRa.read();
        break;
        case 2:
          Data+=(LoRa.read()/100.0);
        break;
        default:
          Data+=LoRa.read()*pow(255,i-3);
        break;}
      i++;}
      
    Serial.println(String("Type ")+Type+" ID "+ID+" Data "+Data);
    if(unsigned long temp=getUnixTime()){ /*處理時間*/
      Serial.println(String("recTime ")+recTime+" Net "+temp);
      recTime=temp;}
      
    // print RSSI of packet
    Serial.println(String("' with RSSI ")+LoRa.packetRssi());
    
    /*上傳至資料庫*/
    DynamicJsonBuffer jsonBuffer;
    JsonObject& root = jsonBuffer.createObject();
    root["Type"] = Type;
    root["ID"] = ID;
    root["Data"] = Data;
    root["Time"] = recTime;
    root.printTo(msgStr);
    int length=msgStr.length()+1;
    char msgbuffer[length];
    msgStr.toCharArray(msgbuffer,length+1);
    if (!client.connected()){
      reconnect();}
    client.loop();
    client.publish(publishTopic, msgbuffer);
    }
    Sec.update();
}

void reconnect(){
  Serial.print("connecting");
    while (!client.connected()){
        if (client.connect(clientID)){
            Serial.println("connected");
        }else{
            Serial.print("failed, rc=");
            Serial.print(client.state());
            Serial.println(" try again in 5 seconds");
            delay(1000);}}
}

void passTime(){
  recTime++;
}

unsigned long getUnixTime(){
  sendNTPpacket(timeServer); // send an NTP packet to a time server
  delay(1000);  // wait to see if a reply is available
  if ( Udp.read(packetBuffer, NTP_PACKET_SIZE) > 0 ) {
    unsigned long secsSince1970;
    // convert four bytes starting at location 40 to a long integer
    secsSince1970 =  (unsigned long)packetBuffer[40] << 24;
    secsSince1970 |= (unsigned long)packetBuffer[41] << 16;
    secsSince1970 |= (unsigned long)packetBuffer[42] << 8;
    secsSince1970 |= (unsigned long)packetBuffer[43];
    return secsSince1970 - 2208988800UL + timeZone * SECS_PER_HOUR;
  } else {
    Serial.println("No NTP Response :-(");
    return 0;} // return 0 if unable to get the time
}

// send an NTP request to the time server at the given address
void sendNTPpacket(IPAddress& address) {
  memset(packetBuffer, 0, NTP_PACKET_SIZE); // set all bytes in the buffer to 0
  // Initialize values needed to form NTP request
  packetBuffer[0] = 0b11100011;   // LI, Version, Mode
  packetBuffer[1] = 0;     // Stratum, or type of clock
  packetBuffer[2] = 6;     // Polling Interval
  packetBuffer[3] = 0xEC;  // Peer Clock Precision
  // 8 bytes of zero for Root Delay & Root Dispersion
  packetBuffer[12]  = 49;
  packetBuffer[13]  = 0x4E;
  packetBuffer[14]  = 49;
  packetBuffer[15]  = 52;
  // you can send a packet requesting a timestamp:
  Udp.beginPacket(address, 123); //NTP requests are to port 123
  Udp.write(packetBuffer, NTP_PACKET_SIZE);
  Udp.endPacket();
}

void printWifiStatus() {
  // print the SSID of the network you're attached to:
  Serial.println(String("SSID: ")+WiFi.SSID());

  // print your WiFi shield's IP address:
  IPAddress ip = WiFi.localIP();
  Serial.println(String("IP Address: ")+ip);

  // print the received signal strength:
  long rssi = WiFi.RSSI();
  Serial.println(String("signal strength (RSSI):")+rssi+" dBm");
}
