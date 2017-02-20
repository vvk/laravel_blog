$(function () {
    $(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",});

    $('.delete-image').click(function () {
        deleteImage();
    })

    $('.save-banner').click(function () {
        saveBanner();
    });
});

function saveBanner() {
    $('.save-banner').text('保存中...').attr('disabled', true);

    var data ={};
    data.name = $.trim($('.banner-content .name').val());
    data.url = $.trim($('.banner-content .url').val());
    data.image = $.trim($('.banner-content .image').val());
    data.remark = $.trim($('.banner-content .remark').val());
    data._token = $.trim($('.banner-content ._token').val());
    data.rank = parseInt($('.banner-content .rank').val());
    data.id = parseInt($('.banner-content .id').val());
    data.target = data.status = 0;

    if ($('.banner-content .target').is(':checked')) {
        data.target = 1;
    }

    if ($('.banner-content .status').is(':checked')) {
        data.status = 1;
    }

    console.log(data);

    if (!data.name) {
        swal({title:"保存失败",text:"轮播图名称不能为空", 'type':'error', 'confirmButtonText':'确定'});
        $('.save-banner').text('保 存').attr('disabled', false);
        return false;
    }

    if (data.rank < 0 || data.rank > 255) {
        swal({title:"保存失败",text:"排序取值范围为0-255", 'type':'error', 'confirmButtonText':'确定'});
        $('.save-banner').text('保 存').attr('disabled', false);
        return false;
    } else if (isNaN(data.rank) || data.rank == undefined) {
     swal({title:"保存失败",text:"排序不能为空", 'type':'error', 'confirmButtonText':'确定'});
     $('.save-banner').text('保 存').attr('disabled', false);
     return false;
     }

    if (!data.image) {
        swal({title:"保存失败",text:"请上传轮播图", 'type':'error', 'confirmButtonText':'确定'});
        $('.save-banner').text('保 存').attr('disabled', false);
        return false;
    }

    $.ajax({
        type:'POST',
        dataType:'JSON',
        url:save_banner_url,
        data:data,
        success:function(response){
            if(response.status==0){
                window.location.href = banner_url;
            }else{
                swal({title:"保存失败",text:response.msg, 'type':'error', 'confirmButtonText':'确定'});
                $('.save-banner').text('保 存').removeAttr('disabled');
                return false;
            }
        }
    });

}