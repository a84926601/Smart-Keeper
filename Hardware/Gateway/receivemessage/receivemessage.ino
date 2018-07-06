/*
 * 107/07/02 接收資料 from node
 */
#include <SPI.h>
#include <LoRa.h>
#include <Timer.h>

void setup() {
  Serial.begin(9600);
  while (!Serial);

  Serial.println("Gateway setup");

  if (!LoRa.begin(915E6)) {
    Serial.println("Starting LoRa failed!");
    while (1);
  }
}

void loop() {
  // receive packet from node
  int packetSize = LoRa.parsePacket();
  if (packetSize) {
    // received a packet
    Serial.print("Received packet '");

    // read packet
    while (LoRa.available()) {
      Serial.print((char)LoRa.read());
    }

    // print RSSI of packet
    Serial.print("' with RSSI ");
    Serial.println(LoRa.packetRssi());
  }
}
