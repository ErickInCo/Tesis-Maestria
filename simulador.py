from urllib2 import Request, urlopen
import networkx as nx

Grafo = nx.Graph()
coordenadas=[[12,0],[12,10],[12,20],[12,30],[12,40],\
            [12,50],[22,50],[32,50],[42,50],[52,50],\
            [52,40],[62,40],[72,40],[82,40],[92,40],\
            [92,50],[92,60],[92,70],[92,80],[92,90],]

datos= """
{
    "id": "p30",
    "type": "Device",
    "category": {
        "value": ["celphone"]
    },
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
        "value": 0.86
    },
    "ipAddress": {
        "value": "192.168.1.78"
    },
    "deviceState": {
        "value": "ok"
    },
    "location": {
      "type": "Point",
      "value": [50,100]
    },
    "owner": {
        "value": 3
    }
}
"""

headers = {
  'Content-Type': 'application/json'
}
while True:
    request = Request('http://orion.lab.fiware.org/v2/entities/{entityId}/attrs?type=&options=', data=datos, headers=headers)
    response_body = urlopen(request).read()
    print (response_body)