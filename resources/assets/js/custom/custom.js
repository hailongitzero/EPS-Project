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
        if ($('#moTaTaiLieu').val() == ''){
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
        $(this).closest('tr').find('.dropdown, .dropdown-menu').removeClass('show');
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

    $('.m-datatable__table').on('click', 'tr td .deleteDocument', function () {
        var cfm = confirm('Bạn chắc chắn muốn xóa tài liệu này?');
        if (cfm == false) return false;
        var data = new FormData();

        var maTaiLieu = $(this).attr('data-content');

        data.append('maTaiLieu', maTaiLieu);
        data.append('_token', $('meta[name="csrf-token"]').attr('content'));
        data.append('header', $('meta[name="csrf-token"]').attr('content'));
        $.ajax({
            type: 'POST',
            url: '/xoa-tai-lieu',
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

    $('.m-datatable__table').on('click', 'tr td .editDocument', function () {
        $(this).closest('tr').find('.dropdown, .dropdown-menu').removeClass('show');
        $(this).closest('tr').find('.moTaTaiLieu').enable().focus();
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

    $('#logout').on('click', function () {
        var data = new FormData();
        data.append('_token', $('meta[name="csrf-token"]').attr('content'));
        data.append('header', $('meta[name="csrf-token"]').attr('content'));
        $.ajax({
            type: 'POST',
            url: '/logout',
            data: data,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            dataType: 'json',
            success: function (response) {
                window.location.reload();
            },
            error: function (response) {
                window.location.reload();
            }
        });
        return false;
    })

    $('#loaiPhanQuyen').on('change', function () {
        if ($('#loaiPhanQuyen option:selected').val() == 1){
            if ($('.phan-quyen-to').hasClass('hide')){
                $('.phan-quyen-to').removeClass('hide');
            }
            if (!$('.phan-quyen-chung').hasClass('hide')){
                $('.phan-quyen-chung').addClass('hide');
            }
        }else if ($('#loaiPhanQuyen option:selected').val() == 2){
            if ($('.phan-quyen-chung').hasClass('hide')){
                $('.phan-quyen-chung').removeClass('hide');
            }
            if (!$('.phan-quyen-to').hasClass('hide')){
                $('.phan-quyen-to').addClass('hide');
            }
        }
        else {
            if (!$('.phan-quyen-to').hasClass('hide')){
                $('.phan-quyen-to').addClass('hide');
            }
            if (!$('.phan-quyen-chung').hasClass('hide')){
                $('.phan-quyen-chung').addClass('hide');
            }
        }
    });
    $('#kqTimKiemNhanVien').on('change',function () {
        $('#dsQuyenNhanVien').empty();
        $('#tenNhanVienPQ').val($('#kqTimKiemNhanVien option:selected').text());
        var maNhanVien = $('#kqTimKiemNhanVien option:selected').val();
        var data = new FormData();
        data.append('_token', $('meta[name="csrf-token"]').attr('content'));
        data.append('header', $('meta[name="csrf-token"]').attr('content'));
        data.append('maNhanVien', maNhanVien);
        $.ajax({
            type: 'POST',
            url: '/tim-phan-quyen-nhan-vien',
            data: data,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            dataType: 'json',
            success: function (response) {
                // console.log(response['rslTo']);
                $.each(response['rslTo'], function (i, res) {
                    $('#dsQuyenNhanVien').append($('<option>', {
                        value: res['ma_to_cong_tac'],
                        text : 'Tổ - ' + res['ten_to_cong_tac']
                    }));
                });
                $.each(response['rslDM'], function (i, res) {
                    $('#dsQuyenNhanVien').append($('<option>', {
                        value: res['ma_tai_lieu_mo_rong'],
                        text : 'Tài Liệu - ' + res['ten_tai_lieu_mo_rong']
                    }));
                });
            },
            error: function (response) {
            }
        });
        return false;
    });

    $('#btnXoaQuyen').on('click', function () {
        $('#dsQuyenNhanVien option:selected').remove();
    })
    
    $('#searchPhanQuyen').on('click', function () {
        $('#kqTimKiemNhanVien').empty();
        var tenNhanVien = $('#tenNhanVien').val();
        var tenDangNhap = $('#tenDangNhap').val();
        var data = new FormData();
        data.append('_token', $('meta[name="csrf-token"]').attr('content'));
        data.append('header', $('meta[name="csrf-token"]').attr('content'));
        data.append('tenNhanVien', tenNhanVien);
        data.append('tenDangNhap', tenDangNhap);
        $.ajax({
            type: 'POST',
            url: '/tim-nhan-vien-phan-quyen',
            data: data,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            dataType: 'json',
            success: function (response) {
                // for (var i = 0; i < response.length; i++){
                //     console.log(response[i]['ma_nhan_vien']);
                // }
                $.each(response, function (i, res) {
                    $('#kqTimKiemNhanVien').append($('<option>', {
                        value: res['ma_nhan_vien'],
                        text : res['ho_ten']
                    }));
                });
            },
            error: function (response) {
            }
        });
        return false;
    });

    $('#loaiPhanQuyen').on('change',function () {
        var data = new FormData();
        data.append('_token', $('meta[name="csrf-token"]').attr('content'));
        data.append('header', $('meta[name="csrf-token"]').attr('content'));
        if ($('#loaiPhanQuyen option:selected').val() == 1){
            $('#cbxTruSo').empty();
            $.ajax({
                type: 'POST',
                url: '/get-ds-tru-so',
                data: data,
                processData: false,  // tell jQuery not to process the data
                contentType: false,  // tell jQuery not to set contentType
                dataType: 'json',
                success: function (response) {
                    $('#cbxTruSo').append($('<option>', {
                        value: '0',
                        text :'-----Chọn-----'
                    }));
                    $.each(response, function (i, res) {
                        $('#cbxTruSo').append($('<option>', {
                            value: res['ma_tru_so'],
                            text : res['ten_tru_so']
                        }));
                    });
                },
                error: function (response) {
                }
            });
            return false;
        }else if ($('#loaiPhanQuyen option:selected').val() == 2){
            $('#cbxDanhMucMoRong').empty();
            $.ajax({
                type: 'POST',
                url: '/get-ds-danh-muc',
                data: data,
                processData: false,  // tell jQuery not to process the data
                contentType: false,  // tell jQuery not to set contentType
                dataType: 'json',
                success: function (response) {
                    $('#cbxDanhMucMoRong').append($('<option>', {
                        value: '0',
                        text :'-----Chọn-----'
                    }));
                    $.each(response, function (i, res) {
                        $('#cbxDanhMucMoRong').append($('<option>', {
                            value: res['ma_danh_muc_mo_rong'],
                            text : res['ten_danh_muc_mo_rong']
                        }));
                    });
                },
                error: function (response) {
                }
            });
        }
    });

    $('#cbxTruSo').on('change', function () {
        $('#cbxPhongBan').empty();
        var maTruSo = $('#cbxTruSo option:selected').val();
        var data = new FormData();
        data.append('_token', $('meta[name="csrf-token"]').attr('content'));
        data.append('header', $('meta[name="csrf-token"]').attr('content'));
        data.append('maTruSo', maTruSo);
        $.ajax({
            type: 'POST',
            url: '/get-ds-phong-ban',
            data: data,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            dataType: 'json',
            success: function (response) {
                $('#cbxPhongBan').append($('<option>', {
                    value: '0',
                    text :'-----Chọn-----'
                }));
                $.each(response, function (i, res) {
                    $('#cbxPhongBan').append($('<option>', {
                        value: res['ma_phong_ban'],
                        text : res['ten_phong_ban']
                    }));
                });
            },
            error: function (response) {
            }
        });
    });

    $('#cbxPhongBan').on('change', function () {
        $('#cbxToCongTac').empty();
        var maPhongBan = $('#cbxPhongBan option:selected').val();
        var data = new FormData();
        data.append('_token', $('meta[name="csrf-token"]').attr('content'));
        data.append('header', $('meta[name="csrf-token"]').attr('content'));
        data.append('maPhongBan', maPhongBan);
        $.ajax({
            type: 'POST',
            url: '/get-ds-to-cong-tac',
            data: data,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            dataType: 'json',
            success: function (response) {
                $.each(response, function (i, res) {
                    $('#cbxToCongTac').append($('<option>', {
                        value: res['ma_to_cong_tac'],
                        text : res['ten_to_cong_tac']
                    }));
                });
            },
            error: function (response) {
            }
        });
    });

    $('#cbxDanhMucMoRong').on('change', function () {
        $('#cbxTaiLieuMoRong').empty();
        var maDanhMuc = $('#cbxDanhMucMoRong option:selected').val();
        var data = new FormData();
        data.append('_token', $('meta[name="csrf-token"]').attr('content'));
        data.append('header', $('meta[name="csrf-token"]').attr('content'));
        data.append('maDanhMuc', maDanhMuc);
        $.ajax({
            type: 'POST',
            url: '/get-ds-tai-lieu-mo-rong',
            data: data,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            dataType: 'json',
            success: function (response) {
                $.each(response, function (i, res) {
                    $('#cbxTaiLieuMoRong').append($('<option>', {
                        value: res['ma_tai_lieu_mo_rong'],
                        text : res['ten_tai_lieu_mo_rong']
                    }));
                });
            },
            error: function (response) {
            }
        });
    });
    
    $('#btnAddDSPhanQuyen').on('click', function () {
        var maPhanQuyen = '';
        var tenPhanQuyen = '';
        var status = true;
        if ($('#loaiPhanQuyen option:selected').val() == 1){
            maPhanQuyen = $('#cbxToCongTac option:selected').val();
            tenPhanQuyen = 'Tổ - ' + $('#cbxToCongTac option:selected').text();
        }else if ($('#loaiPhanQuyen option:selected').val() == 2){
            maPhanQuyen = $('#cbxTaiLieuMoRong option:selected').val();
            tenPhanQuyen = 'Tài Liệu - ' + $('#cbxTaiLieuMoRong option:selected').text();
        }else {
            alert("Vui lòng chọn loại phân quyền.")
            return;
        }

        $('#dsQuyenNhanVien option').each(function () {
            if ($(this).val() == maPhanQuyen){
                alert('Quyền này đã tồn tại.');
                status = false;
                return false;
            }
        });
        if (status == true){
            $('#dsQuyenNhanVien').append($('<option>', {
                value: maPhanQuyen,
                text : tenPhanQuyen
            }));
        }
    });
    
    $('#btnUpdateAuth').on('click', function () {
        var jsonVar = {};
        var arrPQ = [];
        var data = new FormData();
        var maNhanVien = $('#kqTimKiemNhanVien option:selected').val();

        jsonVar['maNhanVien'] = maNhanVien;

        if ( maNhanVien == undefined || maNhanVien ==''){
            alert('Vui lòng chọn nhân viên cần phân quyền');
            return;
        }
        $('#dsQuyenNhanVien option').each(function () {
            arrPQ.push($(this).val());
        });
        jsonVar['dsPhanQuyen'] = arrPQ;

        data.append('_token', $('meta[name="csrf-token"]').attr('content'));
        data.append('header', $('meta[name="csrf-token"]').attr('content'));
        data.append('dsPhanQuyen', arrPQ);
        data.append('maNhanVien', maNhanVien);

        $.ajax({
            type: 'POST',
            url: '/cap-nhat-phan-quyen-user',
            data: data,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            dataType: 'json',
            success: function (response) {
                alert(response.Content);
                return;
            },
            error: function (response) {
                alert('Cập nhật phân quyền lỗi');
                return;
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