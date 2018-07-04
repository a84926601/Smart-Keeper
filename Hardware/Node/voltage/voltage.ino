/*
 * 107/07/02
 * 參考https://www.taiwaniot.com.tw/product/ac-%E4%BA%A4%E6%B5%81%E9%9B%BB%E5%A3%93%E6%84%9F%E6%B8%AC%E5%99%A8-%E7%9B%B4%E6%B5%81%E9%9B%BB%E5%A3%93%E9%87%8F%E6%B8%AC-0-220v-%E9%9B%BB%E5%A3%93%E6%84%9F%E6%B8%AC/
 * 測量交流電為 110AC or 220VAC
 * 取最高值，對應到0~220，看其峰值離110近還是220來判斷此為110 or 220
 */
const int analogInPin = A0;
//const int analogOutPin = 3; 燈泡測試

int sensor_Value = 0;
int output_Value = 0;

void setup() {
  // put your setup code here, to run once:
  Serial.begin(9600);
  delay(2);
  Serial.println("Start");
}

void loop() {
  // put your main code here, to run repeatedly:
  sensor_Value = analogRead(analogInPin);
  output_Value = map(sensor_Value, 0, 1023, 0, 220); //正弦波最高為220V
  if(output_Value-110<220-output_Value)
    Serial.println("It's 110V!");
  else
    Serial.println("It's 220V!");
  
  /*Test Block*/
  //analogWrite(analogOutPin,output_Value);
  Serial.print("sensor = ");
  Serial.print(sensor_Value);
  Serial.print("t output = ");
  Serial.println(output_Value);
}
