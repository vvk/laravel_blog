var markdownEditor = ueditor = '';

$(function () {
    $('.form-group').on('click', '.add-category', function () {
        addCategory(this);
    });

    $('.form-group').on('click', '.delete-category', function () {
        deleteCategory(this);
    });

    $('.is_reprint').click(function(){
        if ($(this).is(':checked')) {
            $('.reprint_url_box').show().find('reprint_url').val('');
        } else {
            $('.reprint_url_box').hide().find('reprint_url').val('');
        }
    });

    $('.delete-image').click(function(){
        deleteImage();
    });

    //var ue = UE.getEditor('editor');

    $(".article-save-btn-box button").click(function () {
        var type = parseInt($(this).val());
        saveArticle(this, type);
    });

    $(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",})

    var editorType = parseInt($('.editor_type').val());

    var content = $.trim($('.article-content').html());
    if (editorType == 2) {
        loadUeditor(content);
    } else {
        loadMarkdown(content);
    }

    $('.editor_type').change(function () {
        if ($(this).val() == 2) {
            var data = markdownEditor.getHTML();
            loadUeditor(data);
        } else {
            var data = UE.getEditor('editor').getContent();
            loadMarkdown(data);
        }
    });
})

function addCategory(obj) {
    var html = '<div class="category-content input-group">';
    html += '<select class="form-control category_id" name="category_id" style="position: initial">';
    html += '<option value="0">--请选择分类--</option>';
    html += category;
    html += '</select>';
    html += '<span class="input-group-btn">';
    html += '<button style="position: initial" type="button" class="btn btn-primary add-category"><i class="fa fa-plus-square"></i> 添加</button>';
    html += '<button style="position: initial" type="button" class="btn btn-danger delete-category"><i class="fa fa-trash"></i> 删除</button>';
    html += '</span></div>';

    $(obj).hide().parents('.category-content').after(html);
}

function deleteCategory(obj) {
    // $(obj).parents('.category-content').remove().prev().find('.add-category').show();
    console.log($(obj).parents('.category-content').next().length)
    if ($(obj).parents('.category-content').next().length == 0) {
        $(obj).parents('.category-content').prev().find('.add-category').show();
    }
    $(obj).parents('.category-content').remove();
}

function saveArticle(obj, type) {
    var text = $.trim($(obj).text());
    $(obj).text('提交中...').attr('disabled', true);

    var data = {};
    data.name = $.trim($('.name').val());
    if (!data.name) {
        swal({title:"保存失败",text:"文章名称不能为空", 'type':'error', 'confirmButtonText':'确定'});
        $(obj).text(text).removeAttr('disabled');
        return false;
    }

    data.keywords = $.trim($('.keywords').val());
    data.description = $.trim($('.description').val());
    data.category_id = Array();

    var category_id = 0;
    $('.category_id').each(function (k, v) {
        category_id = parseInt($(this).val());
        if (category_id > 0 && $.inArray(category_id, data.category_id) == -1) {
            data.category_id.push(parseInt($(this).val()));
        }
    })

    if (data.category_id.length == 0) {
        swal({title:"保存失败",text:"请选择文章分类", 'type':'error', 'confirmButtonText':'确定'});
        $(obj).text(text).removeAttr('disabled');
        return false;
    }

    if($('.is_reprint').is(':checked')){
        data.is_reprint=  1;
        data.reprint_url = $.trim($('.reprint_url').val());
        if (!data.reprint_url) {
            swal({title:"保存失败",text:"请填写转载文章地址", 'type':'error', 'confirmButtonText':'确定'});
            $(obj).text(text).removeAttr('disabled');
            return false;
        }
    }else{
        data.is_reprint = 0;
        data.reprint_url = '';
    }

    data.recommend = 0;
    if ($('.recommend').is(':checked')) {
        data.recommend = 1;
    }

    data.thumb = $.trim($('.image').val());

    data.editor_type = parseInt($('.editor_type').val());
    if (data.editor_type == 2) {
        data.content = UE.getEditor('editor').getContent();
    } else {
        data.content = markdownEditor.getHTML();
        data.markdown = markdownEditor.getMarkdown();
    }

    if (!data.content) {
        swal({title:"保存失败",text:"文章内容不能为空", 'type':'error', 'confirmButtonText':'确定'});
        $(obj).text(text).removeAttr('disabled');
        return false;
    }

    data.tag = Array();
    $('.tag').each(function () {
        if ($(this).is(':checked')) {
            data.tag.push($(this).val());
        }
    });

    if (data.tag.length <1) {
        swal({title:"保存失败",text:"请选择文章标签", 'type':'error', 'confirmButtonText':'确定'});
        $(obj).text(text).removeAttr('disabled');
        return false;
    }

    data.id = parseInt($('.id').val());
    data._token = $.trim($('._token').val());
    data.type = type;

    $.ajax({
        type:'POST',
        dataType:'JSON',
        url:save_article_url,
        data:data,
        success:function(response){
            if(response.status==0){
                if (type == 1) {
                    if (data.id == 0) {  //新增
                        window.location.href = base_url + '/admin/article/'+response.data.id+'/edit';
                    } else { //
                        swal({title:"保存成功", 'type':'success', 'confirmButtonText':'确定'});
                        $(obj).text(text).removeAttr('disabled');
                    }
                } else {
                    window.location.href = article_list_url;
                }
            }else{
                swal({title:"保存失败",text:response.msg, 'type':'error', 'confirmButtonText':'确定'});
                $(obj).text(text).removeAttr('disabled');
                return false;
            }
        }
    });
}

/**
 * 设置markdown内容
 * @param content
 */
function loadMarkdown(content){
    content = $.trim(String(content))
    markdownEditor = editormd("markdown-container", {
        value: content,
        htmlDecode: "style,script,iframe",
        height: 400,
        path : '/plugins/markdown/lib/',
        codeFold : true,
        saveHTMLToTextarea : true,    // 保存 HTML 到 Textarea
        searchReplace : true,
        htmlDecode : "style,script,iframe|on*",            // 开启 HTML 标签解析，为了安全性，默认不开启
        taskList : true,
        tocm            : true,         // Using [TOCM]
        sequenceDiagram : true,       // 开启时序/序列图支持，默认关闭,
        imageUpload : true,
        imageFormats : ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
        imageUploadURL : "/upload/markdown"
    });

    // @todo editormd.js:2247 Uncaught TypeError: Cannot read property 'setValue' of undefined
    //markdownEditor.setValue(content);
    $('#ueditor-container').addClass('hidden').siblings('div').removeClass('hidden');
}

/**
 * 设置ueditor内容
 * @param content
 */
function loadUeditor(content){
    content = $.trim(content)
    $('#markdown-container').addClass('hidden').siblings('div').removeClass('hidden');

    if (!ueditor) {
        var html = '<script id="editor" type="text/plain" >'+content+'</script>';
        $('#ueditor-container').html(html);
        ueditor = UE.getEditor('editor');
        ueditor.ready(function() {
            ueditor.setContent(content);
        });
    } else {
        ueditor.setContent(content);
    }
}