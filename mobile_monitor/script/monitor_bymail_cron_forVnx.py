# encoding:utf-8

'''
VNX挂盘监控
''' 

import os,time

#
HEAD_DIR = "/monitor_dir/vnx/"


# 需要通知的人
mailGroup = ['dept.moc']#['wqz','xhr','lqm']

# 超标组
storageGroup=[]

# 高阀值监控
storageGroup_not_need=['yiban_static_album','yiban_static_yybupload','yiban_static_upload','yiban_static_userphoto']

#获取挂盘目录
vnx_all = os.popen('/bin/ls /monitor_dir/vnx/').read().split()

#函数，获取容量百分比
def getSpace(dir):
    try:
        out = os.popen("df -h %s"%(HEAD_DIR+dir)).read().split()
        return out[11]
    except Exception, e:
        return 0


#main
for i in vnx_all:
    #筛选条件80
    if getSpace(i) == 0 or int(getSpace(i)[:-1]) >= 80 and i not in storageGroup_not_need:
        storageGroup.append(i)
        print i,getSpace(i)

for k in storageGroup_not_need:
    #筛选条件95
    if getSpace(k) == 0 or int(getSpace(k)[:-1]) >= 95:
        storageGroup.append(k)
        print k,getSpace(k)


#报警
if len(storageGroup) > 0:
    for j in mailGroup:
        os.popen('echo "%d个vnx目录容量报警:\n%s 存在问题" |mail -s vnx_dir_wrong %s@yiban.cn'%(len(storageGroup),'/'.join(storageGroup),j))

print  "time:%s ,monitorVnx is ok"%time.ctime()
