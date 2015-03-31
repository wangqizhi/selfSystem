# encoding:utf-8

# 获取push队列 

import json,redis,os
import time

r = redis.Redis(host='127.0.0.1',port=6379,db=1)


pushStacke =  ("pushStacke%s"%i for i in range(10))
iosPushQueue =  ("iosPushQueue%s"%i for i in range(101))


result = []

for i in pushStacke:
    result.append(r.llen(i))


for i in iosPushQueue:
    if i == "iosPushQueue0":
        continue
    result.append(r.llen(i))

nums = 0
for j in result:
    nums = nums+j

if nums != 0:#判断是否队列为0
    os.popen('echo "push_queue:%s" |mail -s push_wrong wqz@yiban.cn'%nums)


# try:
#     file_size = os.popen("du /monitor_dir/hadoop/template1.log |awk -F ' ' '{printf $1}'").read()
#     r.set("pre_num",int(file_size))
#     now_num = int(file_size)
#     pre_num = r.get("pre_num")
#     print now_num,pre_num
#     if now_num == int(pre_num):#判断日志是否继续生成
#         os.popen('echo "hadoop_log_wrong-1" |mail -s hadoop_log_wrong wqz@yiban.cn')
# except Exception, e:
#         os.popen('echo "hadoop_log_wrong-2" |mail -s hadoop_log_wrong wqz@yiban.cn')




hadoop_out = os.popen('df -h |grep hadoop| sed -n "2p"').read()
real_hadoop_out = []

for i in hadoop_out.split(" "):
    if i != "":
        real_hadoop_out.append(i)


#if int(real_hadoop_out[3][:-1]) >= 99:#如果容量超过99了报警
if real_hadoop_out[2][-1:]=="G" and float(real_hadoop_out[2][:-1])<800:
    #pass
    os.popen('echo "isilon over load :%s/%s"|mail -s isilon_storage_wrong wqz@yiban.cn'%(real_hadoop_out[2],real_hadoop_out[0]) )
    os.popen('echo "isilon over load :%s/%s"|mail -s isilon_storage_wrong dhx@yiban.cn'%(real_hadoop_out[2],real_hadoop_out[0]) )
    os.popen('echo "isilon over load :%s/%s"|mail -s isilon_storage_wrong jianghuan@yiban.cn'%(real_hadoop_out[2],real_hadoop_out[0]) )
    os.popen('echo "isilon over load :%s/%s"|mail -s isilon_storage_wrong lwt@yiban.cn'%(real_hadoop_out[2],real_hadoop_out[0]) )
    os.popen('echo "isilon over load :%s/%s"|mail -s isilon_storage_wrong hufei@yiban.cn'%(real_hadoop_out[2],real_hadoop_out[0]) )
    # print "wrong"


import get_nodeinfo
node_out =  get_nodeinfo.get_result()
redis_time = int(node_out[1][:-2]) + int(node_out[6][:-2]) + int(node_out[11][:-2]) + int(node_out[16][:-2])
if redis_time >= 200:#延迟超过200ms报警
    os.popen('echo "node_im_redis load over :%d"|mail -s node_server_wrong wqz@yiban.cn'%(redis_time))
    # print type(str(redis_time))
if node_out[4] == node_out[9] == node_out[14] == node_out[19] == "25" :#在线服务列表不准确了报警
    # print "ok"
    print node_out[19]
    pass
else:
    # os.popen('echo "node server lost"|mail -s hadoop_log_wrong wqz@yiban.cn')
    os.popen('echo "node server lost"|mail -s node_server_wrong wqz@yiban.cn')
    os.popen('echo "node server lost"|mail -s node_server_wrong wwy@yiban.cn')


print  "time:%s ,monitor is ok"%time.ctime()
