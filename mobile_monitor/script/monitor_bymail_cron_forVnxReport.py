# # encoding:utf-8

# '''
# 容量每日report
# ''' 


import os,time
import sys 
import smtplib
from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart


#发送邮件函数
def sendEmail(msgTo, content, type):
    (attachment,html) = content
    msg = MIMEMultipart()
    msg['Subject'] = type
    msg['From'] = 'wqz@yiban.cn'
    msg['To'] = msgTo
    html_att = MIMEText(html, 'html', 'utf-8')
    att = MIMEText(attachment, 'plain', 'utf-8')
    msg.attach(html_att)
    msg.attach(att)
    try:
        smtp = smtplib.SMTP()
        smtp.connect('smtp.yiban.cn', 25)
        smtp.login(msg['From'], '***')
        smtp.sendmail(msg['From'], msg['To'].split(','), msg.as_string())
    except Exception,e:
        print e



#监控vnx目录
HEAD_DIR = "/monitor_dir/vnx/"


# 需要通知的人
mailGroup = ['dept.moc']#['wqz','xhr','lqm']


#获取挂盘目录
vnx_all = os.popen('/bin/ls /monitor_dir/vnx/').read().split()
isilon_b =os.popen("df -h |grep hadoop| sed -n '2p' |awk '{print $4}'").read().strip()
isilon_all =os.popen("df -h |grep hadoop| sed -n '2p' |awk '{print $1}'").read().strip()

#函数，获取容量百分比
def getSpace(dir):
    try:
        out = os.popen("df -h %s"%(HEAD_DIR+dir)).read().split()
        return out[11]
    except Exception, e:
        return 0

#函数，获取总容量
def getSpaceAll(dir):
    try:
        out = os.popen("df -h %s"%(HEAD_DIR+dir)).read().split()
        return out[8]
    except Exception, e:
        return 0

#函数，获取挂载点
def getSpacePoint(dir):
    try:
        out = os.popen("df -h %s"%(HEAD_DIR+dir)).read().split()
        return out[7]
    except Exception, e:
        return 0

#邮件content
mail_text_head="""
<!doctype html>
<head>
    <meta charset="UTF-8" />
    <style type="text/css">
        text-align: center;
    </style>
</head>
<body>
    <table border="1">
        <tr>
            <td><b>挂载信息</td>
            <td><b>总容量</td>
            <td><b>使用百分比</td>
            <td><b>说明</td>
        </tr>

"""
mail_text_foot="""
    </table>
</body>
</html>

"""
mail_text_head = mail_text_head + "<tr><td>10.21.57.41:/ifs/</td><td>%s</td><td>%s</td></td><td>Isilon</td></tr>"%(isilon_all,isilon_b)


try:
    for i in vnx_all:
        mail_text_head = mail_text_head+'<tr><td>'+getSpacePoint(i)+"</td><td>"+getSpaceAll(i)+"</td><td>"+getSpace(i)+"</td>"+'<td>'+i+"</td></tr>"
except Exception, e:
    mail_text="<tr><td>监测容量存在异常，请联系wqz@yiban.cn</td><td>"

mail_text = mail_text_head + mail_text_foot

for j in mailGroup:
    sendEmail(j+"@yiban.cn", ("Auto send,don't reply", mail_text), u'存储情况日报(%s)'%time.ctime())

print  "time:%s ,monitorVnxReport is ok"%time.ctime()





