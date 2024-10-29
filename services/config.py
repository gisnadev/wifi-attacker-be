mysql = {
	"host":"localhost",
    "db": "fighter",
    "user": "fighter",
    "password":"MzApodhaSAskj1324!?"
}

filepath={
	"path" :"/tmp/",
	"file" :"dabloo",
	"filePostfix":"-01.csv",
	"pcap":"-01.cap",
	"driver":"88XXau"
}
redisConn={
	"host":"localhost",
	"port":6379,
	"db":1,
	"password":"Mx9!lztyua09671KP"
}
def mysqlConfig():
	return mysql
def filepathConfig():
	return filepath
def redisConfig():
	return redisConn
