void setup() {
  // put your setup code here, to run once:
  uint32_t checksum = 0;
  for(uint16_t u = 0; u < 2048; u++)
  {
    checksum += * ( (byte *) u );//checksum += the byte number u in the ram
  }
  Serial.begin(115200);
  Serial.println(checksum , HEX);
}

void loop() {
  // put your main code here, to run repeatedly:
  Serial.println("Hello!");
}
