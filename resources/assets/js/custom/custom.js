/**
 * Created by HaiLong on 10/6/2017.
 */
jQuery(document).ready(function () {
    "use strict";

    $('#clickmewow').click(function()
    {
        $('#radio1003').attr('checked', 'checked');
    });
        // $('#documentTable').DataTable( {
        //     responsive: true,
        //     "pageLength": 10
        // } );
    
    $('a.getDoc').on('click', function () {
        var tbName = '#documentTable'+$(this).attr('data');
        $('.documentTable').fadeOut(100);
        $(tbName).fadeIn(100);
    });

    $('#btnThemMoiDanhMuc').on('click', function () {
        var data = new FormData();
        data.append('maTo', $('#maTocCongTac').val());
        data.append('tenDanhMuc', $('#tenDanhMuc').val());
        data.append('_token', $('meta[name="csrf-token"]').attr('content'));
        data.append('header', $('meta[name="csrf-token"]').attr('content'));
        $.ajax({
            type: 'POST',
            url: '/themDanhMuc',
            data: data,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            dataType: 'json',
            success: function (response) {
                alert(response.Content);
                location.reload();
            },
            error: function (response) {
                alert("Lỗi hệ thống, vui lòng thử lại.");
            }
        });

        return false;
    });

    $('#btnUploadTaiLieu').on('click', function () {
        var data = new FormData();
        var myFile = Dropzone.forElement('#m-document-dropzone');
        console.log(myFile.files[0]);
        if(!myFile.files || !myFile.files.length){
            alert("Bạn chưa nhập file!");
            return false;
        }
        if ($('#tenTaiLieu').val() == ''){
            alert("Bạn chưa nhập tên file!");
            return false;
        }
        if($('#maDanhMucTaiLieu').val() == ''){
            alert("Bạn chưa chọn danh mục tài liệu!!");
            return false;
        }
        var fileName = myFile.files[0].name;

        data.append('maDanhMuc', $('#maDanhMucTaiLieu').val());
        data.append('tenTaiLieu', $('#tenTaiLieu').val());
        data.append('moTaTaiLieu', $('#moTaTaiLieu').val())
        data.append('file', myFile.files[0]);
        data.append('_token', $('meta[name="csrf-token"]').attr('content'));
        data.append('header', $('meta[name="csrf-token"]').attr('content'));
        $.ajax({
            type: 'POST',
            url: '/uploadTaiLieu',
            data: data,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            dataType: 'json',
            success: function (response) {
                alert(response.Content);
                location.reload();
            },
            error: function (response) {
                alert("Lỗi hệ thống, vui lòng thử lại.");
            }
        });

        return false;
    });
    $('.m-datatable__table').on('click', 'tr td .saveDocument', function () {
        var data = new FormData();

        var maTaiLieu = $(this).attr('data-content');
        var moTaTaiLieu = $(this).closest('tr').find('.moTaTaiLieu').val();

        data.append('maTaiLieu', maTaiLieu);
        data.append('moTaTaiLieu', moTaTaiLieu);
        data.append('_token', $('meta[name="csrf-token"]').attr('content'));
        data.append('header', $('meta[name="csrf-token"]').attr('content'));
        $.ajax({
            type: 'POST',
            url: '/cap-nhat-mo-ta-tai-lieu',
            data: data,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            dataType: 'json',
            success: function (response) {
                alert(response.Content);
                // location.reload();
            },
            error: function (response) {
                alert("Lỗi hệ thống, vui lòng thử lại.");
            }
        });

        return false;
    });
});

var DropzoneDemo = function() {
    var e = function() {
        Dropzone.options.mDocumentDropzone = {
            paramName: "fileDocumentUpload",
            maxFiles: 1,
            maxFilesize: 100,
            autoProcessQueue:false,
            init: function() {
                this.on("maxfilesexceeded", function(file) {
                    this.removeAllFiles();
                    this.addFile(file);
                });
            },
            acceptedFiles: ".xls,.xlsx,.doc,.docx,.pdf,.ppt,.pptx",
        }
    };
    return {
        init: function() {
            e()
        }
    }
}();
DropzoneDemo.init();