$('.btn_usr_open').click(function(){
    $.post('/admin/mainadmin/openusrApi',{
        usrid:this.id
    },function(data){
        location.href="/admin/mainadmin";
        // if(data.detail){
            
        // }else{
        //     sweetAlert("失败");
        // }
    });
});