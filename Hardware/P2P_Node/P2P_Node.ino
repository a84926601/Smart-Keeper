static int Type=0;     /* 0:耗電量 */
static int NodeID=87;  /* 預設255個裝置 */
#include <SPI.h>
#include <LoRa.h>
#include <math.h>
#include <Timer.h>
#include "ACS712.h"

#define pin_SSR 2         /*SSR control pin 同時用LED顯示是否過電*/
#define Button 3          /*Button press*/
#define pin_Current A0     /*Current output pin*/
#define pin_Voltage A1     /*Voltage output pin*/
Timer sendrate;
ACS712 sensor(ACS712_20A, pin_Current);  /*電流感測器輸出腳位為 A0*/
float count;          /*sensor 次數*/
double P;             /*Watt 總計*/

void setup() {
  // put your setup code here, to run once:
  Serial.begin(9600);
  while (!Serial);

  /*LoRa part*/
  LoRa.setPins(9,8,7);
  if (!LoRa.begin(915E6)) {
    Serial.println("Starting LoRa failed!");
    while (1);}
  LoRa.setSignalBandwidth(62.5E3);
  
  sendrate.every(10000,sendmessage); //每10秒傳一次資料
  
  /*SSR Part*/
  pinMode(pin_SSR,OUTPUT);/*到時要改成Output*/
  digitalWrite(pin_SSR, HIGH);  /*目前先設為開啟狀態*/
  pinMode(Button,INPUT);
  digitalWrite(Button, LOW);

  /*Current Part*/
  Serial.println("Calibrating... Ensure that no current flows through the sensor at this moment");
  sensor.calibrate();
  Serial.println("Done!");
}

void loop() {
  float I;
  int V;

  delay(500);
  if(!digitalRead(Button)){ /*Press button?*/
    Serial.println("XDD");}
  
  count++;
  Serial.println(digitalRead(pin_SSR));
  if(digitalRead(pin_SSR)){ /*有電流通過*/
    I = sensor.getCurrentAC();
    V = getVoltageAC();
  }else{              /*無電流通過*/
    I = 0;
    V = 0;}
  P+=V*I*pow(2,-0.5);
  
  Serial.println(String("count : ") + count);
  Serial.println(String("I = ") + I + " A");
  Serial.println(String("V = ") + V + " V");
  Serial.println(String("P = ") + P + " Watts");
  Serial.println(String("P(平均) = ") + P/count + " Watts ");
  
  sendrate.update();
  delay(1000);
}

void sendmessage(){
  Serial.print("Sending packet: ");
  // send packet
  Serial.println("\n----------Begin Sending the message : ");
  
  LoRa.beginPacket();
  int Pint=P/count;
  int Premain=(P/count-Pint)*100;
  
  Serial.println(String("Type ")+Type+"ID "+NodeID+"P.avg "+P/count+" int "+Pint+" float "+Premain);
  
  LoRa.write(Type);
  LoRa.write(NodeID);
  LoRa.write(Premain);
  while(Pint!=0){
    LoRa.write(Pint%256);
    Pint/=256;}
  
  LoRa.endPacket();
  
  P=0;
  count=0;
}

int getVoltageAC(){
  int sensor_Value = analogRead(pin_Voltage);
  int output_Value = map(sensor_Value, 0, 1023, 0, 220); //正弦波最高為220V
  /*if(output_Value-110 < 220-output_Value)
    return 110;
  else
    return 220;*/
    return output_Value;
}
