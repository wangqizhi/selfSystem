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

