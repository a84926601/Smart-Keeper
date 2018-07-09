/*
 * 107/07/06 可以讀取電流跟電壓，模擬 SSR control，再透過LoRa傳訊
 */
#include <SPI.h>
#include <LoRa.h>
#include <Timer.h>
Timer sendrate;

#include "ACS712.h"
#define pin_SSR 2 /*SSR control pin*/
#define pin_Current A0  /*Current output pin*/
#define pin_Voltage A1  /*Voltage output pin*/
ACS712 sensor(ACS712_20A, pin_Current);  /*電流感測器輸出腳位為 A0*/
float count;  /*sensor 次數*/
float W; /*Watt 總計*/

void message(){
  Serial.print("Sending packet: ");

  // send packet
  Serial.println("\n----------Begin Sending the message : ");
  
  LoRa.beginPacket();
  LoRa.print(W/count);
  LoRa.endPacket();
  W=0;
  count=0;
}

int getVoltageAC(){
  int sensor_Value = analogRead(pin_Voltage);
  int output_Value = map(sensor_Value, 0, 1023, 0, 220); //正弦波最高為220V
  if(output_Value-110 < 220-output_Value)
    return 110;
  else
    return 220;
}

void setup() {
  // put your setup code here, to run once:
  Serial.begin(9600);
  while (!Serial);

  /*LoRa part*/
  if (!LoRa.begin(915E6)) {
    Serial.println("Starting LoRa failed!");
    while (1);
  }
  sendrate.every(10000,message); //每10秒傳一次資料
  
  /*SSR Part*/
  pinMode(pin_SSR,INPUT);
  //digitalWrite(pin_SSR, HIGH);  /*目前先設為開啟狀態*/

  /*Current Part*/
  Serial.println("Calibrating... Ensure that no current flows through the sensor at this moment");
  sensor.calibrate();
  Serial.println("Done!");
}

void loop() {
  float I;
  int V;

  count++;
  Serial.println(digitalRead(pin_SSR));
  if(digitalRead(pin_SSR)){ /*有電流通過*/
    I = sensor.getCurrentAC();
    V = getVoltageAC();
  }else{              /*無電流通過*/
    I = 0;
    V = 0;
  }
  
  Serial.println(String("count : ") + count);
  Serial.println(String("I = ") + I + " A");
  Serial.println(String("V = ") + V + " V");
  Serial.println(String("P = ") + V*I + " Watts");

  W+=V*I;
  Serial.println(String("W(總計) = ") + W + " Watts");
  
  sendrate.update();
  delay(1000);
}
