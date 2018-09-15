/*
 * Button_setup()
 * ID_RESET()
 * Button_ISR()
 * Button_Press(
 */

void BUTTON_Setup(){
    attachInterrupt(0,Button_ISR,FALLING); // 0_Pin2, 下緣觸發
    pinMode(BUTTON_PIN,INPUT_PULLUP);
    BUTTON_flag=false;
}

void ID_Reset(){  /* ID清為-1，向Gateway重要新的ID 和 Gateway's MAC*/
    LED_Blink();
    switch(NODE_ID){
        case -1:{
            Serial.println("ID = -1 | Thanks for using Smaer-Keeper for the first time!");
            break;}
        case 0:{  /*正常不會出現*/
            Serial.println("ID = 0 | ERROR : invalid ID\nPlease request Gateway for a valid ID!");
            break;}
        default:{
            Serial.println(String("ID = ")+NODE_ID+" | Button trigger ID_Reset()");
            break;}
    }
    EEPROM.write(NODE_ID_ADDR, 0);
    Serial.println(String("ID ")+EEPROM.read(NODE_ID_ADDR));
    LED_Blink();
    LoRa_Send(2);
    LED_Blink();
    
}

#define LED_FREQ 250
void LED_Blink(){
    digitalWrite(LED_PIN,HIGH);
    delay(LED_FREQ);
    digitalWrite(LED_PIN,LOW);
    delay(LED_FREQ);
}

void Button_ISR(){  /*中斷副程式不能有delay*/
    BUTTON_flag=true;
}

#define BUTTON_CHECK_TIME 500
void BUTTON_Press(){
      unsigned long start=millis();
      Serial.println(String("XD"));
      while(!digitalRead(BUTTON_PIN)){
          if(millis()-start>=BUTTON_CHECK_TIME){
              ID_Reset();}}
      if(millis()-start<BUTTON_CHECK_TIME)
          Serial.println(String("CHANGE!"));
      BUTTON_flag=false;
}
