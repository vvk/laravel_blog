var DragImgUpload = function (id, options) {
    this.me = $(id);
    var defaultOpt = {
        uploadBtn: $('.upload-btn-box .upload-btn'),
        imageBox: $('.upload-img-box'),
        uploadMsg: $('.upload-msg'),
        maxFileSize: 5, //M
        uploadBtnText: '上传图片',
        uploadImgBoxText: '点击选择图片或将照片拖到这里',
        uploadImgInfo: '点击图片重新选择图片',
    }
    this.opts = $.extend(true, defaultOpt, {}, options);
    this.init();
    this.callback = this.opts.callback;
}
DragImgUpload.prototype = {
    init: function() {
        this.uploadBoxInit();
        this.setUploadMsg('', '');
        this.eventClickInit();
    },
    uploadBoxInit: function() {
        var html = '<div><img src="/static/image/image-upload-bg.png"><p>'+this.opts.uploadImgBoxText+'</p></div>';
        this.opts.imageBox.html(html);
        this.opts.uploadBtn.addClass('hide');
    },
    setUploadMsg: function(msg, color) {
        this.opts.uploadMsg.html(msg).css('color', color);
    },
    onDragover: function(e) {
        e.stopPropagation();
        e.preventDefault();
        e.dataTransfer.dropEffect = 'copy';
    },
    onDrop: function(e) {
        this.setUploadMsg('', '');
        e.stopPropagation();
        e.preventDefault();
        var fileList = e.dataTransfer.files;
        if (fileList.length == 0) {
            return false;
        }
        if (!this.setUploadBox(fileList[0])) {
            return false;
        }
        if (this.callback) {
            this.callback(fileList);
        }
    },
    eventClickInit: function() {
        var self = this;
        this.me.unbind().click(function() {
            self.createImageUploadDialog(true);
        })
        var dp = this.me[0];
        dp.addEventListener('dragover', function(e) {
            self.onDragover(e);
        });
        dp.addEventListener("drop", function(e) {
            self.onDrop(e);
        });
    },
    setUploadBox: function(file) {
        if (file.type.indexOf('image') === -1) {
            this.setUploadMsg('您选择的文件类型不合法，请选择图片！', 'red');
            return false;
        }
        var fileSize = ((file.size) / 1024 / 1024).toFixed(5);
        if (fileSize > this.opts.maxFileSize) {
            this.setUploadMsg('图片不能超过 '+ this.opts.maxFileSize + ' M', 'red');
            return false;
        }

        var img = window.URL.createObjectURL(file);
        var filename = file.name;
        var imgHtml = '<img src="'+img+'" title="'+filename+'">';
        this.opts.imageBox.html(imgHtml);
        this.opts.uploadBtn.removeClass('hide').text(this.opts.uploadBtnText);
        this.setUploadMsg(this.opts.uploadImgInfo, '#ccc');
        return true;
    },
    onChangeUploadFile: function() {
        var fileInput = this.fileInput;
        var files = fileInput.files;
        var file = files[0];
        if (!this.setUploadBox(file)) {
            return false;
        }
        if (this.callback) {
            console.log('onChangeUploadFile 1');
            console.log(files);
            console.log('onChangeUploadFile 2');
            this.callback(files);
        }
    },
    createImageUploadDialog: function(click) {
        console.log('createImageUploadDialog')
        var fileInput = this.fileInput;
        if (!fileInput) {
            fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.name = 'ime-images';
            fileInput.multiple = true;
            fileInput.onchange = this.onChangeUploadFile.bind(this);
            this.fileInput = fileInput;
        }

        if (click) {
            fileInput.click();
        }
    },
    resetUploadDialog: function(){
        $("input[name='ime-images']").remove();
        this.fileInput = null;
        this.createImageUploadDialog(false);
    },
    resetUpload: function () {
        this.opts.uploadBtn.removeClass('continue-upload');
        this.uploadBoxInit();
        this.setUploadMsg('', '');
        this.opts.uploadImgInfo = '';
        this.resetUploadDialog();
        var that = this;
        this.me.bind().click(function () {
            that.createImageUploadDialog(true);
        });
    }
}

var figureBedInit = false;
$(function () {
    if (figureBedInit == false) {
        var imgUpload = new DragImgUpload(".upload-container",{
            isInit: figureBedInit,
            callback: function (f) {
                //回调函数，可以传递给后台等等
                this.opts.uploadBtn.click(function () {
                    console.log('click')
                    if ($(this).attr('disabled')) {
                        return false;
                    }

                    var files = imgUpload.fileInput.files;
                    if (imgUpload.opts.uploadBtn.hasClass('continue-upload')) {
                        imgUpload.resetUpload();
                        return false;
                    }

                    var file = files[0];
                    if (!file) {
                        return;
                    }

                    imgUpload.me.unbind();
                    imgUpload.setUploadMsg(imgUpload.opts.uploadImgInfo, '#ccc');
                    imgUpload.opts.uploadBtn.prop('disabled', true).text('上传中...');
                    var formData = new FormData();
                    formData.append('file', file);
                    formData.append('_token', $("meta[name='csrf-token']").attr('content'));
                    console.log(formData);
                    $.ajax({
                        url: uploadUrl,
                        type: "post",
                        dataType: "json",
                        cache: false,
                        data: formData,
                        timeout : 10000, //超时时间设置，单位毫秒
                        processData: false,// 不处理数据
                        contentType: false, // 不设置内容类型
                        success: function (response) {
                            if (response.status == 0) {
                                imgUpload.opts.uploadBtn.removeAttr('disabled').text('继续上传').addClass('continue-upload');
                                imgUpload.setUploadMsg('上传完成', 'green');
                                appleImgUlr(response.data.url);
                            } else {
                                if (response.status == 403) {
                                    imgUpload.opts.uploadBtn.remove();
                                } else {
                                    imgUpload.opts.uploadBtn.removeAttr('disabled').text('重新上传').addClass('continue-upload');
                                }
                                imgUpload.setUploadMsg(response.msg, 'red');
                            }
                        },
                        error: function () {
                            imgUpload.opts.uploadBtn.removeAttr('disabled').text('重新上传').addClass('continue-upload');
                            imgUpload.setUploadMsg('上传失败，请稍后重试', 'red');
                            imgUpload.me.bind().click(function () {
                                imgUpload.createImageUploadDialog(true);
                            });
                        }
                    });
                })
            }
        });

        $("[data-toggle='popover']").popover();
        var clipboard = new Clipboard('.copy-url');
        clipboard.on('success', function(e) {
            var dom = $(e.trigger);
            dom.popover()
            setTimeout(function () {
                dom.popover('hide');
            }, 2000);
            e.clearSelection();
        });

        clipboard.on('error', function(e) {
            console.log('复制失败');
        });
    }

    figureBedInit = true;

    function appleImgUlr(url) {
        var className = getRandStr(15);
        var html = '<div class="form-group" style="display: none">\n' +
            '    <label class="col-sm-2 control-label">地址：</label>\n' +
            '    <div class="col-md-8 img-url-item">\n' +
            '        <input type="text" class="form-control img-url '+className+'" value="'+url+'" readonly>\n' +
            '    </div>\n' +
            '    <button type="button" class="btn btn-default copy-url" data-clipboard-action="copy" data-clipboard-target=".'+className+'" data-placement="top" data-toggle="popover" data-content="复制成功">复制</button>\n' +
            '</div>';
        $('.url-container').removeClass('hide').find('.form-horizontal').append(html).find('.form-group:last').slideDown(100);
    }

    function getRandStr(length) {
        var result = '';
        var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        var charactersLength = characters.length;
        for (var i = 0; i < length; i++ ) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }
})
