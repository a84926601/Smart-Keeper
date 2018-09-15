/* 
 * Button_ISR
 * Pin2|Interupt0
 * Pin3|Interupt1
 * 長按|進入IDreset模式
 * 短按|進入開/關模式
 * volatile|中斷副程式裡用到的全域變數都要加
 */
#define Button_Pin 2
#define LED_Pin 4
bool NODE_STATUS=false;
volatile bool Button_Status;  // 目前狀態
int count=0;

void Button_ISR(){  /*中斷副程式不能有delay*/
    Button_Status=true;
}

void ID_RESET(){  /* ID清為-1，向Gateway重要新的ID 和 Gateway's MAC*/
    Serial.println(String("ID_RESET()!"));
    LED_Blink();
}

void setup() {  /* 順序別亂改www */
    Serial.begin(9600);
    attachInterrupt(0,Button_ISR,FALLING); // 0_Pin2, 上
    pinMode(Button_Pin,INPUT_PULLUP);
    pinMode(LED_Pin,OUTPUT);
    Button_Status=false;
}
void LED_Blink(){
    digitalWrite(LED_Pin,HIGH);
    delay(250);
    digitalWrite(LED_Pin,LOW);
    delay(250);
}
void Button_Press(){
      unsigned long start=millis();
      Serial.println(String("XD"));
      while(!digitalRead(Button_Pin)){
          if(millis()-start>=500){
              LED_Blink();}}
      if(millis()-start>=500){
          ID_RESET();
      }else{
          Serial.println(String("CHANGE!"));
      }
      Button_Status=false;
}

void loop() {
    if(Button_Status){
        Button_Press();
    }
    delay(3000);

    
}
