// sweetAlert("Hello world!");

var login_usr = $("#login_usr");
var login_pwd = $("#login_pwd");
var login_btn = $("button.login_btn")

//绑定回车
$("body").keydown(function() {
    if (event.keyCode == "13") {//keyCode=13是回车键
        login_btn.click();
    }
});

//登陆事件
login_btn.click(function(){
    $.post("/login/loginapi",
        {
            usr : login_usr.val(),
            pwd : login_pwd.val(),
        },function(data,status){
            //返回值是1的时候跳转
            if (data.status == "1") {
                location.href="station/playstation"
                // console.log(data);
            }
            else {
                sweetAlert("认证失败，失败代码:"+data.detail);
            };
        });
});
