var choose_levelone = $(".choose_levelone");
var choose_leveltwo = $(".choose_leveltwo");




var levelone =$("#levelone_input");
// var leveltwo =$("#leveltwo_input");
var taskcontent = $("#taskcontent_input");

choose_levelone.click(function(){
    // console.log(this.text);
    levelone.val(this.text);

});


// $("#dropdowngroup").on('show.bs.dropdown',function(){
//     setTimeout(function(){alert("1")},5000);
//     // sweetAlert("get it");
// });


// $("#levelone_btn").on('click',function(){
//     $(this).dropdown();
// });

// 清空输入框
$("#clear_btn").click(function(){
    levelone.val("");
    // leveltwo.val("");
    taskcontent.val("");
    $('#dealman_btn').html("默认处理人");
    $('#dealman_btn').val("default");

});

$(".choose_dealman").click(function(){
    $('#dealman_btn').html(this.text);
    $('#dealman_btn').val(this.getAttribute("value"));
});

$('#submit_btn').click(function(){
    var submit_levelone = levelone.val();
    // var submit_leveltwo = leveltwo.val();
    var submit_leveltask = taskcontent.val();
    var submit_levelman = $('#dealman_btn').val();
    var submit_levelman_display = $('#dealman_btn').html();
    sweetAlert("已经提交至:"+submit_levelman_display);
});

