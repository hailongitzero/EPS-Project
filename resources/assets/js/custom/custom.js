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
    $('#btnThemMoiDanhMucMoRong').on('click', function () {
        var data = new FormData();
        data.append('maTaiLieuMoRong', $('#maTaiLieuMoRong').val());
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
        var inp = $(this).closest('tr').find('.moTaTaiLieu');
        if ($(this).closest('tr').find('.moTaTaiLieu').is(':disabled')){
            alert("Chưa cập nhật thông tin");
            return false;
        }
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
                inp.attr('disabled', 'disabled');
            },
            error: function (response) {
                alert("Lỗi hệ thống, vui lòng thử lại.");
            }
        });

        return false;
    });

    $('.m-datatable__table').on('click', 'tr td .editDocument', function () {
        $(this).closest('tr').find('.moTaTaiLieu').enable();
        return false;
    });
    
    $('#btnThemMoiGallery').on('click', function () {
        if ($('#tenGallery').val() == '' || $('#tenGallery').val() == 'undefined'){
            alert('Vui lòng nhập tên thư viện hình ảnh.');
            return false;
        }
        var data = new FormData();
        data.append('tenGallery', $('#tenGallery').val());
        data.append('_token', $('meta[name="csrf-token"]').attr('content'));
        data.append('header', $('meta[name="csrf-token"]').attr('content'));
        $.ajax({
            type: 'POST',
            url: '/themGallery',
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

    $('.m-datatable__table').on('click', 'tr td .themMoiHinhAnh', function ()  {
        var galleryName = $(this).closest('tr').find('.galleryName').text();
        var galleryId = $(this).closest('tr').find('.themMoiHinhAnh').attr('data-content');
        $('#mdThemMoiHinhAnh').find('.modal-title span').text(galleryName);
        $('#mdThemMoiHinhAnh').find('#galleryId').val(galleryId);

    });

    $('.m-datatable__table').on('click', 'tr td .deleteGallery', function ()  {
        var data = new FormData();
        var galleryId = $(this).closest('tr').find('.deleteGallery').attr('data-content');

        data.append('galleryId', galleryId);
        data.append('_token', $('meta[name="csrf-token"]').attr('content'));
        data.append('header', $('meta[name="csrf-token"]').attr('content'));

        $.ajax({
            type: 'POST',
            url: '/deleteGallery',
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

    $('#btnUploadImg').on('click', function () {
        var myFile = Dropzone.forElement('#add-gallery-image');
        if(!myFile.files || !myFile.files.length){
            alert("Bạn chưa nhập file!");
            return false;
        }
        var data = new FormData();
        data.append('fileCnt', myFile.files.length);
        for(var i = 0; i < myFile.files.length; i ++){
            data.append('file_' + i, myFile.files[i]);
        }
        data.append('maThuVien', $('#galleryId').val());
        data.append('tenThuVien', $('.modal-title span').text());
        data.append('_token', $('meta[name="csrf-token"]').attr('content'));
        data.append('header', $('meta[name="csrf-token"]').attr('content'));
        console.log($('.modal-title span').text());
        $.ajax({
            type: 'POST',
            url: '/themGalleryImages',
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
                this.on("error", function(file){if (!file.accepted) this.removeFile(file);});
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

var DropzoneImage = function() {
    var e = function() {
        Dropzone.options.addGalleryImage = {
            paramName: "galleryImageUpload",
            maxFilesize: 10,
            maxFiles: 10,
            autoProcessQueue:false,
            addRemoveLinks: true,
            init: function() {
                this.on("maxfilesexceeded", function(file) {
                    this.removeAllFiles();
                    this.addFile(file);
                });
                this.on("error", function(file){if (!file.accepted) this.removeFile(file);});
            },
            acceptedFiles: "image/*",
        }
    };
    return {
        init: function() {
            e()
        }
    }
}();
DropzoneImage.init();