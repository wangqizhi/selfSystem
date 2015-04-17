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
                            $('#case_detail_content').html(data.detail[0].taskContent);
                        });
});



// 接单- 设置转发人
$('.forward_a').click(function(){
    // alert("in"+this.val());
    $('#forward_input').val(this.text);
    $('#forward_input').attr("forwardman",this.getAttribute('value'));
});


$('.case_btn').click(function(){
    if ($('#case_detail_id').html() == '') {
        sweetAlert("请先选择事件");
    } else{
        if (this.id=='case_forward' && $('#forward_input').attr("forwardman") == null) {
            sweetAlert("请选择转发人");
            return;
        };

        var case_fun_titie="";
        var case_fun_action=this.id;
        var case_fun_forwardman="";
        if (case_fun_action=='case_submit') {
            case_fun_titie="请留言";
        } else if(case_fun_action=='case_reject'){
            case_fun_titie="为啥拒绝呢";
        } else if(case_fun_action=='case_forward'){
            case_fun_titie="转发给了"+$('#forward_input').val()+",告诉他点啥";
            case_fun_forwardman = $('#forward_input').attr("forwardman");
        } else{
            sweetAlert("竟然发生错误了！");
            return;
        };

        swal({
            title: case_fun_titie, 
            // text: "输入留言", 
            type: "input",
            inputType: "text",
            showCancelButton: true,
            closeOnConfirm: false
            }, function(saywhat) {
                if (saywhat === '') {
                        swal.showInputError("必须留言！");
                        return false;
                }else{
                    $.ajax({  
                        type : "post",  
                        url : "/station/playstation/updatetaskApi",  
                        data : {
                            case_action : case_fun_action,
                            case_saywhat : "hello", //||saywhat,
                            case_forwardman : case_fun_forwardman
                        },  
                    }).done(function(data){
                        // alert("1");
                        if (data.status==1) {
                            swal(data.detail);
                        } else{
                            swal.showInputError(data.detail);
                        };
                        
                    }).error(function(data){
                        swal("hello","bad");

                    });  
                }

                // $.ajax({  
                //     type : "post",  
                //     url : "/station/playstation/updatetaskApi",  
                //     // data : "test=" + test,  
                //     async : false,  
                //     success : function(data){  
                //         sweetAlert(data.detail);
                //     }  
                // });  
        });




        // $.post('/station/playstation/updatetaskApi',{

        //         },function(data){
        //             sweetAlert("in post");
        //         });
        

    };
  
});