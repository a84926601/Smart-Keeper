/*
 * NODE_TYPE_ADDR = 0
 * NODE_ID_ADDR = 1
 */
#include <SPI.h>
#include <LoRa.h>
#include <Timer.h>
#include "ACS712.h"
#include <math.h>
#include <EEPROM.h>

#define SSR_PIN     4
#define BUTTON_PIN  2
#define LED_PIN     5
#define NODE_TYPE_ADDR 0
#define NODE_ID_ADDR 1
#define NODE_TYPE 0       /*0 :智慧插座*/ /* 4個modes * 64種types*/
int NODE_ID=-1;        /*預設255個裝置|兩層保護*/
bool NODE_status=true;  /*預設為開*/
volatile bool BUTTON_flag;  // 目前狀態

/*Sersor/Timer------------------------------------------------------------*/
#define CURRENT_PIN A0
#define VOLTAGE_PIN A1
#define SENSOR_RATE 60000  /*1 minutes*/
#define SENSOR_MIN 10     /*send data every time slat*/
ACS712 SENSOR_CURRENT(ACS712_20A, CURRENT_PIN);   /*電流感測器輸出腳位為 A0*/
Timer   SENSOR_TIMER;       /*每 1 min sensor一次 | 每 10min 傳一次*/
long int SENSOR_count;  /*sensor 次數*/
double  SENSOR_power;   /*Watt 總計*/
/*------------------------------------------------------------*/

/*LoRa------------------------------------------------------------*/
#define LORA_SS_PIN    10
#define LORA_RESET_PIN  9
#define LORA_RESET_PIN  8
#define LORA_DIO0_PIN   7
#define LORA_F         920E6
#define LORA_SF        12
#define LORA_BW        125
#define LORA_SW        0x12

int LS_NodeInt = 0;
int LS_NodeRem =0;

int LR_NodeType = 0;
int LR_NodeID = 0;
int LR_NodeStatus = 0;
/*------------------------------------------------------------*/

void setup() {
    Serial.begin(9600);
    while (!Serial);
    
    LoRa_Setup();
    BUTTON_Setup();
    pinMode(SSR_PIN,OUTPUT);
    digitalWrite(SSR_PIN, LOW);  /*預設為關閉*/
    pinMode(LED_PIN,OUTPUT);
    digitalWrite(LED_PIN, LOW);  /*預設為關閉*/
    
    SENSOR_CURRENT.calibrate(); /*Ensure that no current flows through the sensor at this moment*/
    
    SENSOR_TIMER.every(SENSOR_RATE,SNESOR_Data);
    ID_Reset();
    Serial.println("Setup Done!");
}

void loop() {
  

}

/*
 * get the average data each minute, then send the average data each ten minutes 
 */
void SNESOR_Data(){
  static int sensor_time=0;
  static double sensor_power=0;
  sensor_time++;
  sensor_power+=SENSOR_power/SENSOR_count;
  if(sensor_time==SENSOR_MIN){
    LS_NodeInt=sensor_power/sensor_time;
    LS_NodeRem=(sensor_power/sensor_time-LS_NodeInt)*100; /*取小數點後兩位*/
    LoRa_Send(0); /*0: send sensor data*/
    sensor_time=0;
    sensor_power=0;}
}

int GET_Voltage(){
    int sensor_Value = analogRead(VOLTAGE_PIN);
    int output_Value = map(sensor_Value, 0, 1023, 0, 255);
    return output_Value;
}
