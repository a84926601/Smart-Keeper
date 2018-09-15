/*
 * LoRa_setup()
 * LoRa_Recv()
 * LoRa_Send(int mode)
 */
void LoRa_Setup(){
    Serial.println("LoRa Sender");
    LoRa.setPins(LORA_SS_PIN,LORA_RESET_PIN,LORA_RESET_PIN);
    LoRa.setFrequency(LORA_F);
    LoRa.setSpreadingFactor(LORA_SF);
    LoRa.setSignalBandwidth(LORA_BW);
    LoRa.setSyncWord(LORA_SW);
    if (!LoRa.begin(LORA_F)) {
        Serial.println("Starting LoRa failed!");
        while (1);}
}

/*
 * mode
 * 0: node 開關 status
 * 1: node 註冊
 * default: error msg 
 */
int LoRa_Recv(){
    Serial.print("Recving packet: ");
    if(LoRa.available()){
        LR_NodeType=LoRa.read();
        if((LR_NodeType & 0x3F)!=NODE_TYPE){
            Serial.println(String("LR_NodeType = ")+LR_NodeType+" no match to NODE_TYPE = "+NODE_TYPE);
            return;}
        int mode=(unsigned int)(LR_NodeType & 0xC0)>>6;
        Serial.println(String("LR_NodeType = ")+NODE_TYPE+" matched!");
        
        LR_NodeID=LoRa.read();
        if(LR_NodeID!=NODE_ID){
            Serial.println(String("LR_NodeID = ")+LR_NodeID+" no match to NODE_ID = "+NODE_ID);
            return;}
        Serial.println(String("LR_NodeID = ")+LR_NodeID+" matched!");

        switch(mode){
            case 0:{  /*開關*/
                LR_NodeStatus=LoRa.read();
                break;}
            case 1:{  /*註冊*/
                LR_NodeID=LoRa.read();
                break;}
            default:{ /*ERROR*/
                Serial.println(String("ERROR LoRa_Recv() mode=")+mode);
                break;}
        }
    }
}

/*
 * Send msg to gateway through LoRa
 * mode
 * 0: sensor data
 * 1: node 開關 status
 * 2: node 註冊
 * default: error msg
 */
void LoRa_Send(int mode){
    Serial.println(String("mode=")+mode+" : node 註冊\nSending packet: ");
    switch(mode){
        case 0:{  /* periodic */
            Serial.println(String("NODE_TYPE : ")+NODE_TYPE+"/NODE_ID : "+NODE_ID+"/LS_NodeRem : "+LS_NodeRem+"/LS_NodeInt : "+LS_NodeInt);
            LoRa.beginPacket();
            LoRa.write(NODE_TYPE|(mode<<6));
            LoRa.write(NODE_ID);
            LoRa.write(LS_NodeRem);
            while(LS_NodeInt!=0){
                LoRa.write(LS_NodeInt%256);
                LS_NodeInt/=256;}
            LoRa.endPacket();}
            break;
        case 1:{   /* Button_Press() */
            Serial.println(String("NODE_TYPE : ")+NODE_TYPE+"/NODE_ID : "+NODE_ID+"/NODE_status : "+NODE_status);
            LoRa.beginPacket();
            LoRa.write(NODE_TYPE|(mode<<6));
            LoRa.write(NODE_ID);
            LoRa.write(NODE_status);
            LoRa.endPacket();}
            break;
        case 2:{  /* ID_reset() */
            Serial.println(String("NODE_TYPE : ")+NODE_TYPE+"/NODE_ID : "+NODE_ID);
            LoRa.beginPacket();
            LoRa.write(NODE_TYPE|(mode<<6));
            LoRa.write(NODE_ID);
            LoRa.endPacket();}
            break;
        default:  /*ERROR*/
            Serial.println("Error LoRA_Send() mode");
            break;
    }
}
