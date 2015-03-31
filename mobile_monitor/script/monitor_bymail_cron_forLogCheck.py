# encoding:utf-8

'''
数据采集日志crontab监控
''' 

import json,redis,os
import time

r = redis.Redis(host='127.0.0.1',port=6379,db=1)



try:
    log_month = time.strftime('%Y%m',time.localtime(time.time()))
    file_size = os.popen("du /monitor_dir/hadoop/logs/%s/template_pro_%s_52.log |awk -F ' ' '{printf $1}'"%(log_month,log_month)).read()
    file_size2 = os.popen("du /monitor_dir/hadoop/logs/%s/template_pro_%s_60.log |awk -F ' ' '{printf $1}'"%(log_month,log_month)).read()
    now_num = int(file_size)
    now_num2 = int(file_size2)
    pre_num = r.get("pre_num")
    pre_num2 = r.get("pre_num2")
    r.set("pre_num",int(file_size))
    r.set("pre_num2",int(file_size2))
    print now_num,pre_num,now_num2,pre_num2
    if now_num == int(pre_num):#判断日志是否继续生成
        os.popen('echo "hadoop_log_wrong:52 is wrong" |mail -s hadoop_log_wrong wqz@yiban.cn')
    if now_num2 == int(pre_num2):
        os.popen('echo "hadoop_log_wrong:60 is wrong" |mail -s hadoop_log_wrong wqz@yiban.cn')

except Exception, e:
        os.popen('echo "hadoop_log_wrong:monitor error - %s" |mail -s hadoop_log_wrong wqz@yiban.cn'%e)



print  "time:%s ,monitor2 is ok"%time.ctime()
