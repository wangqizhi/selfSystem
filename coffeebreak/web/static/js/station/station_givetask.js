var choose_levelone = $(".choose_levelone");
var choose_leveltwo = $(".choose_leveltwo");




var levelone =$("#levelone_input");
var taskcontent = $("#taskcontent_input");

choose_levelone.click(function(){
    levelone.val(this.text); 
    // levelone.attr("realval",this.id);

});


$("#clear_btn").click(function(){
    levelone.val("");
    taskcontent.val("");
    $('#dealman_btn').html("默认处理人");
    $('#dealman_btn').val("default");

});


// 派单-设置默认联系人
$(".choose_dealman").click(function(){
    $('#dealman_btn').html(this.text);
    $('#dealman_btn').val(this.getAttribute("value"));
});

$('#submit_btn').click(function(){

    // var submit_taskid = levelone.attr("realval").split('-')[1] || '';
    var submit_tasktype = levelone.val();
    // var submit_taskgroup = levelone.val().split('-')[0] || '';
    var submit_leveltask = taskcontent.val();
    var submit_levelman = $('#dealman_btn').val();
    var submit_levelman_display = $('#dealman_btn').html();


    $.post('/station/playstation/savetaskApi',
                        {tasktype:submit_tasktype,
                        defaulttaskuser:submit_levelman,
                        taskcontent:submit_leveltask
                        },function(data){
                            sweetAlert(data.detail);
                        });
    // sweetAlert("已经提交至:"+submit_levelman_display);
});

// 获取case内容
$('.case_a').click(function(){
    $.post('/station/playstation/gettaskApi',
                        {caseid:this.id
                        },function(data){
                            $('.show_case_detail').removeClass('show_case_detail');
                            $('#case_detail_id').html("Case:"+data.detail[0].id+" 详细内容");
                            $('#case_detail_id').attr("realcaseid",data.detail[0].id);
                            $('#case_detail_content').html(data.detail[0].taskContent);
                            $('#case_detail_user').html(data.detail[0].nowMan+'正在处理...');
                            // $.post('/station/playstation/getusrnameApi',{
                            //     usrid:data.detail[0].nowMan
                            // },function(data_in){
                            //     $('#case_detail_user').html(data_in.detail+'正在处理...');
                            // });
                            $('.group_btn_close').addClass('show_btn_close');
                            $('.group_btn_deal').removeClass('show_btn_deal');
                        });
});


// 获取需要关闭case内容
$('.case_c_a').click(function(){
    $.post('/station/playstation/gettaskApi',
                        {caseid:this.id
                        },function(data){
                            $('.show_case_detail').removeClass('show_case_detail');
                            $('#case_detail_id').html("Case:"+data.detail[0].id+" 详细内容");
                            $('#case_detail_id').attr("realcaseid",data.detail[0].id);
                            $('#case_detail_content').html(data.detail[0].taskContent);
                            $('#case_detail_user').html(data.detail[0].nowMan+'正在处理...');
                            // $.post('/station/playstation/getusrnameApi',{
                            //     usrid:data.detail[0].nowMan
                            // },function(data_in){
                            //     $('#case_detail_user').html(data_in.detail+'正在处理...');
                            // });
                            $('.group_btn_deal').addClass('show_btn_deal');
                            $('.group_btn_close').removeClass('show_btn_close');
                        });
});



$('#case_close').click(function(){
    var case_id = $('#case_detail_id').attr("realcaseid");
    swal({
      title: "确认关闭吗?", 
      type: "warning",
      showCancelButton: true
    }, function() {
      // $.post("/station/playstation/updatetaskApi",{
      //   case_action : 'case_close',
      //   case_id:case_id
      // },function(data){
      //   sweetAlert(data.detail);
      // });
        $.ajax({  
            type : "post",  
            url : "/station/playstation/updatetaskApi",  
            data : {
                case_action : 'case_close',
                case_saywhat : 'close', //||saywhat,
                case_id : case_id ,
            },  
        }).done(function(data){
            if (data.status==1) {
                // swal(data.detail);
                // $('.case_c_a#'+case_id).addClass('show_case_detail');
                location.href="/station/playstation/choose/givetask/rtask";
            } else{
                swal("出错啦！","关闭失败");
            };
        }).error(function(data){
            swal("出错啦！","这个错误似乎未知嘛...");
        });  
    });
});


$('.case_btn').click(function(){
    // alert(this.id);return;
    if ($('#case_detail_id').html() == '') {
        sweetAlert("请先选择事件");
    } else{
        var case_fun_titie="";
        var case_fun_action=this.id;
        // var case_fun_action_who=this.attr("");
        var case_fun_forwardman="";
        if (case_fun_action=='case_submit') {
            case_fun_titie="请留言";
        } else if(case_fun_action=='case_reject'){
            case_fun_titie="为啥拒绝呢";
        } else if(case_fun_action=='case_forward'){
            case_fun_titie="转发给了"+this.text+",告诉他点啥";
            case_fun_forwardman = this.getAttribute("value");
            // sweetAlert("in forward");
        } else{
            sweetAlert("竟然发生错误了！");
            return false;
        };

        swal({
            title: case_fun_titie, 
            // text: "输入留言", 
            type: "input",
            inputType: "text",
            showCancelButton: true,
            closeOnConfirm: false
            }, function(saywhat) {
                if (saywhat === false) {
                    return false;
                };

                if (saywhat === '') {
                        swal.showInputError("必须留言！");
                        return false;
                }else{
                    $.ajax({  
                        type : "post",  
                        url : "/station/playstation/updatetaskApi",  
                        data : {
                            case_action : case_fun_action,
                            case_saywhat : saywhat, //||saywhat,
                            case_id : $('#case_detail_id').attr("realcaseid") ,
                            case_forwardman : case_fun_forwardman
                        },  
                    }).done(function(data){
                        // alert("1");
                        if (data.status==1) {
                            // swal(data.detail);
                            // $('.case_a#'+$('#case_detail_id').attr("realcaseid")).addClass('show_case_detail');
                            location.href="/station/playstation/choose/givetask/rtask";
                        } else{
                            swal.showInputError(data.detail);
                        };
                    }).error(function(data){
                        swal("出错啦！","这个错误似乎未知嘛...");
                    });  
                }
        });
    };
  
});