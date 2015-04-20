$('#insert_usr_btn').click(function(){
    $.post('/login/inviteapi',{
        usrid:$('#insert_usr_input').val()
    },function(data){
        sweetAlert(data.detail);
    });
});