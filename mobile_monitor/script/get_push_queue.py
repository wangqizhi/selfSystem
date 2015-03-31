# encoding:utf-8

# 获取push队列 

import json,redis

r = redis.Redis(host='10.21.67.168',port=26581,db=0)


pushStacke =  ("pushStacke%s"%i for i in range(10))
iosPushQueue =  ("iosPushQueue%s"%i for i in range(101))


result = []

for i in pushStacke:
    result.append(r.llen(i))


for i in iosPushQueue:
    if i == "iosPushQueue0":
        continue
    result.append(r.llen(i))

print result
