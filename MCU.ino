#include <ESP8266WiFi.h>
//#include <ArduinoJson.h>
#include <FirebaseArduino.h>

#include <Adafruit_Sensor.h>
#include <DHT.h>

#define LED_status 16
#define M_outpin D3
#define T_outpin D4
#define DHTPIN D2 // what digital pin we're connected to
#define DHTTYPE DHT11

#define WIFI_SSID "Jaruwat-PC"
#define WIFI_PASSWORD "11111111"
#define FIREBASE_HOST "testlot-5e8c9.firebaseio.com"
#define FIREBASE_AUTH "UBRQ4HYYW5kMoQS9Fr20GLL14xveaJoszLcQCtAA"

DHT dht(DHTPIN, DHTTYPE);

void setup() {
  pinMode(M_outpin,OUTPUT); //output to relay
  pinMode(T_outpin,OUTPUT); //output to relay
  pinMode(LED_status,OUTPUT);
  Serial.begin(115200);
  Serial.println("DHT11 sensor test!");

  dht.begin(); //เปิดการใช้งาน DHT11 sensor
  WiFiConnection(); //Wifi connection
  Firebase.begin(FIREBASE_HOST,FIREBASE_AUTH); //Firebase connection
}

void loop() {
  delay(200);
  float h = dht.readHumidity();
  float t = dht.readTemperature(); // องศา
  //float f = dht.readTemperature(true); // ฟาเรนไฮ
  int maxH=Firebase.getInt("value/MaxHum"); // ความชื่นสูงสุด
  int minH=Firebase.getInt("value/MinHum"); // ความชื่นต่ำสุด
  
  int maxT=Firebase.getInt("value/MaxTemp"); // อุณหภูมิสูงสุด
  int minT=Firebase.getInt("value/MinTemp"); // อุณหภูมิต่ำสุด
  
  // เช็คถ้าอ่านค่าไม่สำเร็จให้เริ่มอ่านใหม่
  if(isnan(maxH) || isnan(minH)){
    Serial.println("Failed to read maxH and mainH from Firebase!");
    return; //หยุด loop
  }
  if(isnan(maxT) || isnan(minT)){
    Serial.println("Failed to read maxT and mainT from Firebase!");
    return; //หยุด loop
  }
  if (isnan(h) || isnan(t)) {
    Serial.println("Failed to read from DHT sensor!");
    return; //หยุด loop
  }

  
  Serial.println("Humidity: ");
  Serial.print(h);
  Serial.print(" %\t");
  Serial.print("Temperature: ");
  Serial.print(t);
  Serial.print(" *C \t| ");
//  Serial.print(f);
//  Serial.print(" *F\t\n");
  Serial.print(minH);
  Serial.print(" : ");
  Serial.print(maxH);
  Serial.print(" : \t");
  Serial.print(maxT);
  Serial.print(" : ");
  Serial.print(minT);

  //control M_outpin
  if(h>=maxH){
     digitalWrite(M_outpin,HIGH); //off
  }else if(h<=minH){
     digitalWrite(M_outpin,LOW); //on
  }
  //control T_outpin
  if(t>=maxT){
    digitalWrite(T_outpin,LOW); //off
  }else if(t<=minT){
    digitalWrite(T_outpin,HIGH); //on
  }

  //set data to Firebase
  Firebase.setInt("value/Humidity",h);
  Firebase.setInt("value/Temperature",t);
  
}

void WiFiConnection(){
  WiFi.begin(WIFI_SSID,WIFI_PASSWORD);
  Serial.print("Connecting");
  digitalWrite(LED_status,LOW);
  while(WiFi.status() != WL_CONNECTED){
    digitalWrite(LED_status,LOW);
    Serial.print(".");
    delay(500);
    digitalWrite(LED_status,HIGH);
  }
  digitalWrite(LED_status,HIGH);
  Serial.println("\n Connected : ");
  Serial.print(WiFi.localIP());
}
