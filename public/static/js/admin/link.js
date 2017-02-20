$(function () {

    $('.delete-image').click(function () {
        deleteImage();
    })

    $('.save-link').click(function () {
        saveBanner();
    });
    
    $('.delete-item').click(function () {
        var id = parseInt($(this).val());
        deleteLink(id);
    })
});

function saveBanner() {
    $('.link-banner').text('保存中...').attr('disabled', true);

    var data ={};
    data.name = $.trim($('.link-content .name').val());
    data.url = $.trim($('.link-content .url').val());
    data.description = $.trim($('.link-content .description').val());
    data._token = $.trim($('.link-content ._token').val());
    data.image = $.trim($('.link-content .image').val());
    data.rank = parseInt($('.link-content .rank').val());
    data.id = parseInt($('.link-content .id').val());
    data.status = 0;

    if ($('.link-content .status').is(':checked')) {
        data.status = 1;
    }

    console.log(data);

    if (!data.name) {
        swal({title:"保存失败",text:"名称不能为空", 'type':'error', 'confirmButtonText':'确定'});
        $('.link-banner').text('保 存').attr('disabled', false);
        return false;
    }

    if (data.rank < 0 || data.rank > 255) {
        swal({title:"保存失败",text:"排序取值范围为0-255", 'type':'error', 'confirmButtonText':'确定'});
        $('.link-banner').text('保 存').attr('disabled', false);
        return false;
    } else if (isNaN(data.rank) || data.rank == undefined) {
         swal({title:"保存失败",text:"排序不能为空", 'type':'error', 'confirmButtonText':'确定'});
         $('.link-banner').text('保 存').attr('disabled', false);
         return false;
    }

    $.ajax({
        type:'POST',
        dataType:'JSON',
        url:save_link_url,
        data:data,
        success:function(response){
            if(response.status==0){
                window.location.href = link_url;
            }else{
                swal({title:"保存失败",text:response.msg, 'type':'error', 'confirmButtonText':'确定'});
                $('.save-banner').text('保 存').removeAttr('disabled');
                return false;
            }
        }
    });
}

function deleteLink(id){
    swal({
        title: "您确定要删除此链接吗？",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "删除",
        cancelButtonText: "取消",
        closeOnConfirm: false,
        closeOnCancel:false
    }, function (isConfirm) {
        if(!isConfirm){
            swal({title:"已取消",text:"您取消了删除操作！",type:"error",confirmButtonText:'确定'});
        }else{

            var data = {id:id,_token:_token}
            $.ajax({
                type:'DELETE',
                dataType:'JSON',
                url:delete_link_url,
                data:data,
                success:function(response){
                    if(response.status==0){
                        swal({title:"删除成功!",type:"success",confirmButtonText:'确定'},
                            function(){
                                window.location.reload();
                            });
                    }else{
                        swal({title:"删除失败",text:response.msg, 'type':'error'});
                    }
                }
            });
        }
    });
}
