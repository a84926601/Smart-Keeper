#define Button 3
void setup(){
  Serial.begin(9600);
  while (!Serial);
  digitalWrite(Button, LOW);
}
void loop(){
  if(!digitalRead(Button)){
    Serial.println("XDD");
    delay(500);
  }
}

