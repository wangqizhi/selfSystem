# encoding:utf-8

import os,time


try:
    #file_size = os.popen("du /monitor_dir/hadoop/template1.log |awk -F ' ' '{printf $1}'").read()
    # print "in"
    # print "du /monitor_dir/hadoop/logs/template_pro_2015%s.log |awk -F ' ' '{printf $1}'"%time.strftime('%m',time.localtime(time.time()))
    file_size = os.popen("du /monitor_dir/hadoop/logs/template_pro_2015%s.log |awk -F ' ' '{printf $1}'"%time.strftime('%m',time.localtime(time.time()))).read()
    print int(file_size)
except Exception, e:
    print 0
