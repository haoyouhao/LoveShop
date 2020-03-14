import requests
import json
import sys

# content = "https://mp.weixin.qq.com/mp/homepage?__biz=MzU5MTkxMjE4MA==&hid=1&sn=b114713fd99a73c32c23a0bcb1c04a89"
content = "欢迎操作RPA+OCR互动体验。OCR识别启动成功！！"


userID = sys.argv[1]
token = sys.argv[2]
url_msg ='https://api.weixin.qq.com/cgi-bin/message/custom/send?'
body = {
        "touser": userID, #这里必须是关注公众号测试账号后的用户id
        "msgtype":"text",
        "text":{
        "content":content
        }
    }

res =requests.post(url=url_msg,params = {
        'access_token': token #这里是我们上面获取到的token
    },data=json.dumps(body,ensure_ascii=False).encode('utf-8'))