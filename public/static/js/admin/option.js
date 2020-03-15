$(document).ready(function(){
    $(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",});
    $('.save-option-btn').click(function () {
        saveOption();
    });
});

function saveOption() {
    var data = getOptionData();
    var saveBtn = $('.save-option-btn');
    var defaultBtnText = '保存';
    saveBtn.attr('disabled', 'true').text('保存中...');
    $.ajax({
        type:'POST',
        dataType:'JSON',
        url:saveUrl,
        data: data,
        success:function(response){
            if (response.status==0) {
                swal({title:"保存成功",text:response.msg, 'type':'success', 'confirmButtonText':'确定'});
            } else {
                swal({title:"保存失败",text:response.msg, 'type':'error', 'confirmButtonText':'确定'});
            }
            saveBtn.removeAttr('disabled').text(defaultBtnText);
        },
        error: function () {
            swal({title:"保存失败", 'text':'保存失败，请稍后重试', 'type':'error', 'confirmButtonText':'确定'});
            saveBtn.removeAttr('disabled').text(defaultBtnText);
            return false;
        }
    });

}

function getOptionData() {
    var data = {};
    $(".option-form input[type='text'], .option-form textarea，, .option-form select").each(function (k, v) {//input
        data[$(this).attr('name')] = $.trim($(this).val());
    });

    $(".option-form .onoffswitch input[type='checkbox']").each(function (k, v) {//input
        var name = $(this).attr('name');
        if ($(this).is(':checked')) {
            data[name] = 1;
        } else {
            data[name] = 0;
        }
    });

    $(".option-form .checkbox-inline input[type='checkbox']").each(function (k, v) {
        var name = $(this).attr('name');
        console.log(name)
        if (!data.hasOwnProperty(name)) {
            data[name] = [];
        }
        if ($(this).is(':checked')) {
            data[name].push(parseInt($(this).val()));
        }
    });

    $(".option-form .radio-inline input[type='radio']").each(function (k, v) {
        var name = $(this).attr('name');
        if (!data.hasOwnProperty(name)) {
            data[name] = 0;
        }
        if ($(this).is(':checked')) {
            data[name] = parseInt($(this).val());
        }
    });

    data._token = $(".option-form input[name='_token']").val();
    return data;
}