//上传图片
function uploadImg(){
    $.ajaxFileUpload({
        url:upload_image_url,
        secureuri:false,
        fileElementId:"file",        //file的id
        dataType:"json",                  //返回数据类型为文本
        success:function(response){
            if(response.status==0){
                var url = response.data.url;
                $('.image').val(url);
                $('.image-box').show().find('img').attr('src', url);
                $('.image-input-box').hide();
            }else{
                swal({title:"文件上传失败",text:response.msg, 'type':'error'});
            }
        }
    })
}

function deleteImage() {
    $('.image-input-box').show();
    $('.image-box').hide().find('.image').val('').siblings('img').attr('src', '');
    $('.image-img-input').val('');
}