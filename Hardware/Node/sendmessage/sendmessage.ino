/*
 *107/07/02 每10秒傳平均值 
 */
#include <SPI.h>
#include <LoRa.h>
#include <Timer.h>
Timer sendrate;
int counter = 0;

void message(){
  Serial.print("Sending packet: ");
  Serial.println(counter);

  // send packet
  LoRa.beginPacket();
  LoRa.print("hello ");
  LoRa.print(counter);
  LoRa.endPacket();

  counter++;
}

void setup() {
  Serial.begin(9600);
  while (!Serial);

  Serial.println("Node setup");

  if (!LoRa.begin(915E6)) {
    Serial.println("Starting LoRa failed!");
    while (1);
  }
  sendrate.every(2000,message); //每10秒傳一次資料
}

void loop() {
  sendrate.update();
}
