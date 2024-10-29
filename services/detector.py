import config
import threading
import mysql.connector
from datetime import datetime
import os
import redis
import time
import pyshark
import json


mysqlConfig = config.mysqlConfig()
pathConfig  = config.filepathConfig()
redisConfig = config.redisConfig()
deauthFilter = "wlan.fc.type_subtype == 0x00c"
eapolFilter = "eapol"
filter = eapolFilter
caps = pyshark.FileCapture(pathConfig["path"]+pathConfig["file"]+pathConfig["pcap"],display_filter=filter,use_json=True)
caps.set_debug()
caps_len = len(caps)
redthis = redis.Redis(host=redisConfig["host"], port=redisConfig["port"], db=redisConfig["db"],password=redisConfig["password"])
mysqlDb = mysql.connector.connect(
  host=mysqlConfig["host"],
  user=mysqlConfig["user"],
  database = mysqlConfig["db"],
  password=mysqlConfig["password"]
)
mysqlCursor = mysqlDb.cursor()

if __name__ == '__main__':
    #while True:
    #print("Hello")
    while True:
        for pkt in caps:
            #print(pkt)
            print("Transmitter",pkt['WLAN'].ta_resolved,"Victim",pkt['WLAN'].da_resolved,"Number of Hhake",pkt['EAPOL'].msgnr)
            #print(pkt['WLAN.MGT'].all.reason_code)
            #print("Transmitter Address :",(pkt['WLAN'].ta_resolved),"Victim Address",pkt['WLAN'].da_resolved,"Reason",pkt['WLAN.MGT'].all.reason_code)
            #print(i)

            

