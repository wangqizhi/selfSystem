#-*- coding:utf-8 -*-

import urllib,urllib2
import json,redis
import time


# r = redis.Redis(host='127.0.0.1',port=6379,db=0)


urls = [
'http://10.21.67.24:4202/monitor?ip=10.21.67.25&port=4251',
'http://10.21.67.24:4202/monitor?ip=10.21.67.25&port=4252',
'http://10.21.67.24:4202/monitor?ip=10.21.67.26&port=4261',
'http://10.21.67.24:4202/monitor?ip=10.21.67.26&port=4262'
]

online = 0

all_out = []

for url in urls:

    out_json = urllib2.urlopen(url).read()
    out = json.loads(out_json)
    counts = out["onlineInfo"]["onlineCount"]
    cost_1 = out["nodeToRedis"][0].items()[0][1]
    cost_2 = out["nodeToRedis"][1].items()[0][1]
    cost = cost_1 + cost_2
    pMsg = out["onlineInfo"]["personMessage"]
    gMsg = out["onlineInfo"]["groupMessage"]
    onlineList = out["serverList"]
    n = 0
    for i in onlineList.items():
        n = n + len(i[1])

    all_out.append(str(counts))
    all_out.append(str(cost)+"ms")
    all_out.append(str(pMsg))
    all_out.append(str(gMsg))
    all_out.append(str(n))
    # print "[%s,%s,%s,%s,%s]"%(counts,cost,pMsg,gMsg,n)



    # print url,":",counts
    # online = online + int(counts)
# nowTime =int(time.time())
# save_data = ":".join(all_out)
# r.set(nowTime,save_data)
print all_out


def get_result():
    return all_out