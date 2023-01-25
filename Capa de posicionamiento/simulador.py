
import time
import requests
import random
url ="http://192.168.1.95:1026/v2/entities/p10/attrs"
url2 ="http://192.168.1.95:1026/v2/entities/p20/attrs"


# Grafo = nx.Graph()
class PuntosM:
    def __init__(self,n, x, y):
        self.n=n
        self.x=x
        self.y=y
    def __str__(self) -> str:
        return str(self.x)+","+str(self.y)
    

p1=PuntosM(1,-150,0)
p2=PuntosM(2,-50,0)
p3=PuntosM(3,-50,100)
p4=PuntosM(4,-110,100)
p5=PuntosM(5,-110,230)
p6=PuntosM(6,-200,230)
p7=PuntosM(7,-50,270)
p8=PuntosM(8,40,230)
p9=PuntosM(9,-40,200)
p10=PuntosM(10,110,200)
p12=PuntosM(11,200,250)
p13=PuntosM(12,130,130)
p14=PuntosM(13,250,130)
p11=PuntosM(14,250,250)
p15=PuntosM(15,-50,-120)
p16=PuntosM(16,-240,-120)
p17=PuntosM(17,-240,100)
puntos=[p1,p2,p3,p4,p5,p6,p7,p8,p9,p10,p11,p12,p13,p14,p15,p16,p17]
tabla=list()

tabla.append([2,3,4,15])
tabla.append([1,3,15])
tabla.append([1,2,4,13])
tabla.append([1,3,5])
tabla.append([4,6,7,8,9])
tabla.append([5])
tabla.append([5,8,9])
tabla.append([5,7,9])
tabla.append([5,7,8])
tabla.append([12,13])
tabla.append([12,14])
tabla.append([10,11])
tabla.append([3,10,14])
tabla.append([11,13])
tabla.append([1,2,16])
tabla.append([15,17])
tabla.append([16])

actual=0
actual2=7
anterior=-1
# while 0==1:
for x in range(50):
    vecinos=tabla[actual]
    vecinos2=tabla[actual2]
    destino=vecinos[random.randint(0,len(vecinos)-1)]
    destino2=vecinos2[random.randint(0,len(vecinos2)-1)]
    # ban=1
    # while ban==1:
    #     destino=vecinos[random.randint(0,len(vecinos)-1)]
    #     if destino-1 != anterior:
    #         ban=0
    

    values = """
    {
        "batteryLevel": {
            "value": 0.75
        },
        "dateFirstUsed": {
            "type": "DateTime",
            "value": "2022-08-11T11:00:00Z"
        },
        "serialNumber": {
            "value": "9845A"
        },
        "rssi": {
            "value": 0.92
        },
        "ipAddress": {
            "value": "192.168.1.78"
        },
        "deviceState": {
            "value": "ok"
        },
        "location": {
        "type": "Point",
        "value": ["""+str(puntos[destino-1].x)+""","""+str(puntos[destino-1].y)+"""]
        },
        "owner": {
            "value": 1
        }
    }
    """
    values2 = """
    {
        "batteryLevel": {
            "value": 0.63
        },
        "dateFirstUsed": {
            "type": "DateTime",
            "value": "2022-08-11T11:00:00Z"
        },
        "serialNumber": {
            "value": "9845A"
        },
        "rssi": {
            "value": 0.86
        },
        "ipAddress": {
            "value": "192.168.1.87"
        },
        "deviceState": {
            "value": "ok"
        },
        "location": {
        "type": "Point",
        "value": ["""+str(puntos[destino2-1].x)+""","""+str(puntos[destino2-1].y)+"""]
        },
        "owner": {
            "value": 2
        }
    }
    """

    headers = {
    'Content-Type': 'application/json'
    }
    response = requests.put(url, data=values, headers=headers)
    response = requests.put(url2, data=values2, headers=headers)
    # print(response.status_code)
    print(x)
    print("Origen "+str(puntos[actual].n)+": "+str(puntos[actual].x)+","+str(puntos[actual].y))
    print("Destino: "+str(puntos[destino-1].n)+": "+str(puntos[destino-1].x)+","+str(puntos[destino-1].y))
    if response.status_code==204:
        anterior=actual
        actual=destino-1
    time.sleep(2)
    