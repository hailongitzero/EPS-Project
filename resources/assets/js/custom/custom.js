/**

 */
jQuery(document).ready(function () {
    "use strict";
    // Dropzone.autoDiscover = false;

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
        if($('#maDanhMucTaiLieu').val() == ''){
            alert("Bạn chưa chọn danh mục tài liệu!!");
            $('#mdThemMoiTaiLieu').modal('toggle');
            return false;
        }
        if(!myFile.files || !myFile.files.length){
            alert("Bạn chưa nhập file!");
            return false;
        }
        if ($('#tenTaiLieu').val() == ''){
            alert("Bạn chưa nhập tên file!");
            return false;
        }
        if ($('#moTaTaiLieu').val() == ''){
            alert("Bạn chưa nhập mô tả file!");
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
        var cf = false;
        cf = confirm('Bạn có muốn xóa thư viện hình này?');
        if (cf == false){
            return;
        }
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

    $('#cbxSrchTruSo').on('change', function () {
        $('#cbxSrchPhongBan').empty();
        var maTruSo = $('#cbxSrchTruSo option:selected').val();
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
                $('#cbxSrchPhongBan').append($('<option>', {
                    value: '',
                    text :'-----Chọn-----'
                }));
                $.each(response, function (i, res) {
                    $('#cbxSrchPhongBan').append($('<option>', {
                        value: res['ma_phong_ban'],
                        text : res['ten_phong_ban']
                    }));
                });
                $('#cbxSrchPhongBan').removeAttr('disabled');
            },
            error: function (response) {
            }
        });
    });

    $('#cbxDsTruSo').on('change', function () {
        $('#cbxDsPhongBan').empty();
        var maTruSo = $('#cbxDsTruSo option:selected').val();
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
                $.each(response, function (i, res) {
                    $('#cbxDsPhongBan').append($('<option>', {
                        value: res['ma_phong_ban'],
                        text : res['ten_phong_ban']
                    }));
                });
            },
            error: function (response) {
            }
        });
    });

    $('#cbxDsPhongBan').on('change', function () {
        $('#tenPhongBanUpd').val($('#cbxDsPhongBan option:selected').text());
        $('#maPhongBanUpd').val($('#cbxDsPhongBan option:selected').val());
        $('#cbxDsTo').empty();
        var maPhongBan = $('#cbxDsPhongBan option:selected').val();
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
                    $('#cbxDsTo').append($('<option>', {
                        value: res['ma_to_cong_tac'],
                        text : res['ten_to_cong_tac']
                    }));
                });
            },
            error: function (response) {
            }
        });
    });

    $('#cbxDsTo').on('change', function () {
        $('#tenToCongTacUpd').val($('#cbxDsTo option:selected').text());
        $('#maToCongTacUpd').val($('#cbxDsTo option:selected').val());
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
                $.each(response['rslPB'], function (i, res) {
                    $('#dsQuyenNhanVien').append($('<option>', {
                        value: res['ma_phong_ban'],
                        text : res['ten_phong_ban']
                    }));
                });
                $.each(response['rslDM'], function (i, res) {
                    $('#dsQuyenNhanVien').append($('<option>', {
                        value: res['ma_tai_lieu_mo_rong'],
                        text : 'Tài Liệu - ' + res['ten_tai_lieu_mo_rong']
                    }));
                });
                $('#btnUpdateAuth').attr('disabled', true);
                if ($('#dsQuyenNhanVien option').length > 0){
                    console.log("day");
                    $('#btnXoaQuyen').removeAttr('disabled');
                }else {
                    $('#btnXoaQuyen').attr('disabled', true);
                }
            },
            error: function (response) {
            }
        });
        return false;
    });

    $('#btnXoaQuyen').on('click', function () {
        if($('#dsQuyenNhanVien option:selected').length < 1){
            alert("Bạn chưa chọn quyền cần xóa.");
            return;
        }
        var status = confirm('Bạn chắc chắn muốn xóa quyền này?');
        if (status == true)
        $('#dsQuyenNhanVien option:selected').remove();
        $('#btnUpdateAuth').removeAttr('disabled');
    })
    
    $('#searchPhanQuyen').on('click', function () {
        $('#kqTimKiemNhanVien').empty();
        $(this).attr("disabled", true);
        var tenNhanVien = $('#tenNhanVien').val();
        var tenDangNhap = $('#tenDangNhap').val();
        var maPhongBan = '';
        if ($('#cbxSrchPhongBan option:selected').val() != undefined){
            maPhongBan = $('#cbxSrchPhongBan option:selected').val();
        }
        var data = new FormData();
        data.append('_token', $('meta[name="csrf-token"]').attr('content'));
        data.append('header', $('meta[name="csrf-token"]').attr('content'));
        data.append('tenNhanVien', tenNhanVien);
        data.append('tenDangNhap', tenDangNhap);
        data.append('maPhongBan', maPhongBan);
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
                        text : res['ma_nhan_vien'] + " - " + res['ho_ten']
                    }));
                });
                $('#searchPhanQuyen').removeAttr("disabled");
            },
            error: function (response) {
            }
        });
        return false;
    });

    $('#btnMdThemPhanQuyen').on('click', function () {
        $('#loaiPhanQuyen').val(0);
        if (!$('.phan-quyen-to').hasClass('hide')){
            $('.phan-quyen-to').addClass('hide');
        }
        if (!$('.phan-quyen-chung').hasClass('hide')){
            $('.phan-quyen-chung').addClass('hide');
        }
        $('#cbxTruSo').empty();
        $('#cbxPhongBan').empty();
        $('#cbxToCongTac').empty();
        $('#cbxDanhMucMoRong').empty();
        $('#cbxTaiLieuMoRong').empty();
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
                // $('#cbxPhongBan').append($('<option>', {
                //     value: '0',
                //     text :'-----Chọn-----'
                // }));
                $.each(response, function (i, res) {
                    $('#cbxPhongBan').append($('<option>', {
                        value: res['ma_phong_ban'],
                        text : res['ten_phong_ban']
                    }));
                });
                // $('#cbxPhongBan').removeAttr('disabled');
            },
            error: function (response) {
            }
        });
    });

    // $('#cbxPhongBan').on('change', function () {
    //     $('#cbxToCongTac').empty();
    //     var maPhongBan = $('#cbxPhongBan option:selected').val();
    //     var data = new FormData();
    //     data.append('_token', $('meta[name="csrf-token"]').attr('content'));
    //     data.append('header', $('meta[name="csrf-token"]').attr('content'));
    //     data.append('maPhongBan', maPhongBan);
    //     $.ajax({
    //         type: 'POST',
    //         url: '/get-ds-to-cong-tac',
    //         data: data,
    //         processData: false,  // tell jQuery not to process the data
    //         contentType: false,  // tell jQuery not to set contentType
    //         dataType: 'json',
    //         success: function (response) {
    //             $.each(response, function (i, res) {
    //                 $('#cbxToCongTac').append($('<option>', {
    //                     value: res['ma_to_cong_tac'],
    //                     text : res['ten_to_cong_tac']
    //                 }));
    //             });
    //         },
    //         error: function (response) {
    //         }
    //     });
    // });

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
            $('#cbxPhongBan option:selected').each(function () {
                maPhanQuyen = $(this).val();
                tenPhanQuyen = $(this).text();
                status = true;
                //kiem tra xem da ton tai hay chua
                $('#dsQuyenNhanVien option').each(function () {
                    console.log($(this).val() == maPhanQuyen);
                    if ($(this).val() == maPhanQuyen){
                        alert('Quyền ' + tenPhanQuyen +' đã tồn tại.');
                        status = false;
                    }
                });
                //neu chua ton tai thi status = true
                if (status == true){
                    $('#dsQuyenNhanVien').append($('<option>', {
                        value: maPhanQuyen,
                        text : tenPhanQuyen
                    }));
                }
            });
        }else if ($('#loaiPhanQuyen option:selected').val() == 2){
            $('#cbxTaiLieuMoRong option:selected').each(function () {
                maPhanQuyen = $(this).val();
                tenPhanQuyen = 'Tài Liệu - ' + $(this).text();
                status = true;
                //kiem tra xem da ton tai hay chua
                $('#dsQuyenNhanVien option').each(function () {
                    console.log($(this).val() == maPhanQuyen);
                    if ($(this).val() == maPhanQuyen){
                        alert('Quyền ' + tenPhanQuyen +' đã tồn tại.');
                        status = false;
                    }
                });
                //neu chua ton tai thi status = true
                if (status == true){
                    $('#dsQuyenNhanVien').append($('<option>', {
                        value: maPhanQuyen,
                        text : tenPhanQuyen
                    }));
                }
            });
        }else {
            alert("Vui lòng chọn loại phân quyền.")
            return;
        }
        alert("Thêm quyền mới thành công.");
        $('#btnUpdateAuth').removeAttr('disabled');
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

    $('#cbxDanhMucChung').on('change', function () {
        $('#cbxDsDanhMucTaiLieu').empty();
        var maDanhMuc = $('#cbxDanhMucChung option:selected').val();
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
                    $('#cbxDsDanhMucTaiLieu').append($('<option>', {
                        value: res['ma_tai_lieu_mo_rong'],
                        text : res['ten_tai_lieu_mo_rong']
                    }));
                });
            },
            error: function (response) {
            }
        });
    });

    $('#cbxDsDanhMucTaiLieu').on('change', function () {
        $('#tenDMTaiLieuUpd').val($('#cbxDsDanhMucTaiLieu option:selected').text());
        $('#maDMTaiLieuUpd').val($('#cbxDsDanhMucTaiLieu option:selected').val());
    });

    //them phong ban
    $('#btnThemPhongBan').on('click', function () {
        var cfm = confirm('Bạn chắc chắn muốn thêm phòng ban này?');
        if (cfm == false) return false;

        var maTruSo = $('#cbxDsTruSo').val();
        var tenPhongBan = $('#tenPhongBanAdd').val();

        if ( maTruSo == undefined || maTruSo ==''){
            alert('Bạn chưa nhập tên phòng ban.');
            $('#cbxDsTruSo').focus();
            return;
        }
        if ( tenPhongBan == undefined || tenPhongBan ==''){
            alert('Bạn chưa chọn trụ sở.');
            $('#tenPhongBanAdd').focus();
            return;
        }

        var data = new FormData();
        data.append('_token', $('meta[name="csrf-token"]').attr('content'));
        data.append('header', $('meta[name="csrf-token"]').attr('content'));
        data.append('maTruSo', maTruSo);
        data.append('tenPhongBan', tenPhongBan);

        $.ajax({
            type: 'POST',
            url: '/them-moi-phong-ban',
            data: data,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            dataType: 'json',
            success: function (response) {
                alert(response.Content);

                $('#cbxDsPhongBan').empty();
                $('#tenPhongBanAdd').val('');
                var maTruSo = $('#cbxDsTruSo option:selected').val();
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
                        $.each(response, function (i, res) {
                            $('#cbxDsPhongBan').append($('<option>', {
                                value: res['ma_phong_ban'],
                                text : res['ten_phong_ban']
                            }));
                        });
                    },
                    error: function (response) {
                    }
                });
                return;
            },
            error: function (response) {
                alert('Thêm mới danh mục lỗi');
                return;
            }
        });
        return false;
    });

    $('#btnCapNhatPhongBan').on('click', function () {
        var cfm = confirm('Bạn chắc chắn muốn cập nhật phòng ban này?');
        if (cfm == false) return false;

        var maPhongBan = $('#cbxDsPhongBan option:selected').val();
        var tenPhongBan = $('#tenPhongBanUpd').val();
        var maTruSo = $('#cbxDsTruSo').val();

        if ( maPhongBan == undefined || maPhongBan ==''){
            alert('Bạn chưa chọn phòng ban.');
            $('#cbxDsPhongBan').focus();
            return;
        }
        if ( tenPhongBan == undefined || tenPhongBan ==''){
            alert('Bạn chưa nhập tên phòng ban.');
            $('#tenPhongBanUpd').focus();
            return;
        }

        var data = new FormData();
        data.append('_token', $('meta[name="csrf-token"]').attr('content'));
        data.append('header', $('meta[name="csrf-token"]').attr('content'));
        data.append('maPhongBan', maPhongBan);
        data.append('tenPhongBan', tenPhongBan);
        data.append('maTruSo', maTruSo);

        $.ajax({
            type: 'POST',
            url: '/cap-nhat-phong-ban',
            data: data,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            dataType: 'json',
            success: function (response) {
                alert(response.Content);

                $('#cbxDsPhongBan').empty();
                $('#tenPhongBanUpd').val('');
                var maTruSo = $('#cbxDsTruSo option:selected').val();
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
                        $.each(response, function (i, res) {
                            $('#cbxDsPhongBan').append($('<option>', {
                                value: res['ma_phong_ban'],
                                text : res['ten_phong_ban']
                            }));
                        });
                    },
                    error: function (response) {
                    }
                });
                return;
            },
            error: function (response) {
                alert('Thêm mới danh mục lỗi');
                return;
            }
        });
        return false;
    });

    $('#btnThemTo').on('click', function () {
        var cfm = confirm('Bạn chắc chắn muốn thêm tổ công tác này?');
        if (cfm == false) return false;

        var maPhongBan = $('#cbxDsPhongBan option:selected').val();
        var tenTo = $('#tenToCongTacAdd').val();

        if ( maPhongBan == undefined || maPhongBan ==''){
            alert('Bạn chưa chọn phòng ban.');
            $('#cbxDsPhongBan').focus();
            return;
        }
        if ( tenTo == undefined || tenTo ==''){
            alert('Bạn chưa nhập tên tổ.');
            $('#tenToCongTacAdd').focus();
            return;
        }

        var data = new FormData();
        data.append('_token', $('meta[name="csrf-token"]').attr('content'));
        data.append('header', $('meta[name="csrf-token"]').attr('content'));
        data.append('maPhongBan', maPhongBan);
        data.append('tenTo', tenTo);

        $.ajax({
            type: 'POST',
            url: '/them-moi-to',
            data: data,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            dataType: 'json',
            success: function (response) {
                alert(response.Content);

                $('#cbxDsTo').empty();
                $('#tenToCongTacAdd').val('');
                var maPhongBan = $('#cbxDsPhongBan option:selected').val();
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
                            $('#cbxDsTo').append($('<option>', {
                                value: res['ma_to_cong_tac'],
                                text : res['ten_to_cong_tac']
                            }));
                        });
                    },
                    error: function (response) {
                    }
                });
                return;
            },
            error: function (response) {
                alert('Thêm mới danh mục lỗi');
                return;
            }
        });
        return false;
    });

    $('#btnCapNhatTo').on('click', function () {
        var cfm = confirm('Bạn chắc chắn muốn cập nhật tổ công tác này?');
        if (cfm == false) return false;

        var maTo = $('#cbxDsTo option:selected').val();
        var tenTo = $('#tenToCongTacUpd').val();
        var maPhongBan = $('#cbxDsPhongBan option:selected').val();

        if ( maTo == undefined || maTo ==''){
            alert('Bạn chưa chọn tổ.');
            $('#cbxDsTo').focus();
            return;
        }
        if ( tenTo == undefined || tenTo ==''){
            alert('Bạn chưa nhập tên tổ.');
            $('#tenToCongTacUpd').focus();
            return;
        }

        var data = new FormData();
        data.append('_token', $('meta[name="csrf-token"]').attr('content'));
        data.append('header', $('meta[name="csrf-token"]').attr('content'));
        data.append('maTo', maTo);
        data.append('tenTo', tenTo);
        data.append('maPhongBan', maPhongBan);

        $.ajax({
            type: 'POST',
            url: '/cap-nhat-to',
            data: data,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            dataType: 'json',
            success: function (response) {
                alert(response.Content);

                $('#cbxDsTo').empty();
                $('#tenToCongTacUpd').val('');
                var maPhongBan = $('#cbxDsPhongBan option:selected').val();
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
                            $('#cbxDsTo').append($('<option>', {
                                value: res['ma_to_cong_tac'],
                                text : res['ten_to_cong_tac']
                            }));
                        });
                    },
                    error: function (response) {
                    }
                });
                return;
            },
            error: function (response) {
                alert('Thêm mới danh mục lỗi');
                return;
            }
        });
        return false;
    });

    $('#btnXoaTo').on('click', function () {
        var cfm = confirm('Bạn chắc chắn muốn xóa tổ công tác này?');
        if (cfm == false) return false;

        var maTo = $('#cbxDsTo option:selected').val();
        var status = 0;

        if ( maTo == undefined || maTo ==''){
            alert('Bạn chưa chọn tổ.');
            $('#cbxDsTo').focus();
            return;
        }

        var data = new FormData();
        data.append('_token', $('meta[name="csrf-token"]').attr('content'));
        data.append('header', $('meta[name="csrf-token"]').attr('content'));
        data.append('maTo', maTo);
        data.append('status', status);

        $.ajax({
            type: 'POST',
            url: '/cap-nhat-to',
            data: data,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            dataType: 'json',
            success: function (response) {
                alert(response.Content);

                $('#cbxDsTo').empty();
                $('#tenToCongTacUpd').val('');
                var maPhongBan = $('#cbxDsPhongBan option:selected').val();
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
                            $('#cbxDsTo').append($('<option>', {
                                value: res['ma_to_cong_tac'],
                                text : res['ten_to_cong_tac']
                            }));
                        });
                    },
                    error: function (response) {
                    }
                });
                return;
            },
            error: function (response) {
                alert('Thêm mới danh mục lỗi');
                return;
            }
        });
        return false;
    });

    $('#btnThemDanhMuc').on('click', function () {
        var cfm = confirm('Bạn chắc chắn muốn thêm danh mục tài liệu này?');
        if (cfm == false) return false;

        var tenDanhMucTaiLieu = $('#tenDMTaiLieuAdd').val();
        var maDanhMuc = $('#cbxDanhMucChung').val();
        var data = new FormData();
        if ( tenDanhMucTaiLieu == undefined || tenDanhMucTaiLieu ==''){
            alert('Bạn chưa nhập tên danh mục tài liệu.');
            $('#tenDMTaiLieuAdd').focus();
            return;
        }
        if ( maDanhMuc == undefined || maDanhMuc ==''){
            alert('Bạn chưa chọn danh mục.');
            $('#cbxDanhMucChung').focus();
            return;
        }

        data.append('_token', $('meta[name="csrf-token"]').attr('content'));
        data.append('header', $('meta[name="csrf-token"]').attr('content'));
        data.append('maDanhMuc', maDanhMuc);
        data.append('tenDanhMucTaiLieu', tenDanhMucTaiLieu);

        $.ajax({
            type: 'POST',
            url: '/them-moi-danh-muc-tai-lieu-mo-rong',
            data: data,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            dataType: 'json',
            success: function (response) {
                alert(response.Content);

                $('#cbxDsDanhMucTaiLieu').empty();
                $('#tenDMTaiLieuAdd').val('');
                var maDanhMuc = $('#cbxDanhMucChung option:selected').val();
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
                            $('#cbxDsDanhMucTaiLieu').append($('<option>', {
                                value: res['ma_tai_lieu_mo_rong'],
                                text : res['ten_tai_lieu_mo_rong']
                            }));
                        });
                    },
                    error: function (response) {
                    }
                });
                return;
            },
            error: function (response) {
                alert('Thêm mới danh mục lỗi');
                return;
            }
        });
        return false;
    });

    $('#btnCapNhatDanhMuc').on('click', function () {
        var cfm = confirm('Bạn chắc chắn muốn cập nhật danh mục tài liệu này?');
        if (cfm == false) return false;

        var maDanhMuc = $('#cbxDsDanhMucTaiLieu option:selected').val();
        var tenDanhMuc = $('#tenDMTaiLieuUpd').val();

        if ( maDanhMuc == undefined || maDanhMuc ==''){
            alert('Bạn chưa chọn danh mục tài liệu.');
            $('#cbxDsDanhMucTaiLieu').focus();
            return;
        }
        if ( tenDanhMuc == undefined || tenDanhMuc ==''){
            alert('Bạn chưa nhập tên danh mục.');
            $('#tenDMTaiLieuUpd').focus();
            return;
        }

        var data = new FormData();
        data.append('_token', $('meta[name="csrf-token"]').attr('content'));
        data.append('header', $('meta[name="csrf-token"]').attr('content'));
        data.append('maDanhMuc', maDanhMuc);
        data.append('tenDanhMuc', tenDanhMuc);

        $.ajax({
            type: 'POST',
            url: '/cap-nhat-danh-muc-tai-lieu-mo-rong',
            data: data,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            dataType: 'json',
            success: function (response) {
                alert(response.Content);

                $('#cbxDsDanhMucTaiLieu').empty();
                $('#tenDMTaiLieuUpd').val('');
                var maDanhMuc = $('#cbxDanhMucChung option:selected').val();
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
                            $('#cbxDsDanhMucTaiLieu').append($('<option>', {
                                value: res['ma_tai_lieu_mo_rong'],
                                text : res['ten_tai_lieu_mo_rong']
                            }));
                        });
                    },
                    error: function (response) {
                    }
                });
                return;
            },
            error: function (response) {
                alert('Thêm mới danh mục lỗi');
                return;
            }
        });
        return false;
    });

    $('#btnXoaDanhMuc').on('click', function () {
        var cfm = confirm('Bạn chắc chắn muốn xóa danh mục tài liệu này?');
        if (cfm == false) return false;

        var maDanhMuc = $('#cbxDsDanhMucTaiLieu option:selected').val();
        var status = 0;

        if ( maDanhMuc == undefined || maDanhMuc ==''){
            alert('Bạn chưa chọn danh mục tài liệu.');
            $('#cbxDsDanhMucTaiLieu').focus();
            return;
        }

        var data = new FormData();
        data.append('_token', $('meta[name="csrf-token"]').attr('content'));
        data.append('header', $('meta[name="csrf-token"]').attr('content'));
        data.append('maDanhMuc', maDanhMuc);
        data.append('status', status);

        $.ajax({
            type: 'POST',
            url: '/cap-nhat-danh-muc-tai-lieu-mo-rong',
            data: data,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            dataType: 'json',
            success: function (response) {
                alert(response.Content);

                $('#cbxDsDanhMucTaiLieu').empty();
                $('#tenDMTaiLieuUpd').val('');
                var maDanhMuc = $('#cbxDanhMucChung option:selected').val();
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
                            $('#cbxDsDanhMucTaiLieu').append($('<option>', {
                                value: res['ma_tai_lieu_mo_rong'],
                                text : res['ten_tai_lieu_mo_rong']
                            }));
                        });
                    },
                    error: function (response) {
                    }
                });
                return;
            },
            error: function (response) {
                alert('Thêm mới danh mục lỗi');
                return;
            }
        });
        return false;
    });

    //    user information
    $('#btnUpdateUserInfo').on('click', function () {
        // var hoTen = $('#tenNhanVien').val();
        var diaChi = $('#diaChi').val();
        var soDienThoai = $('#dienThoai').val();
        var ngaySinh = $('#ngaySinh').val();

        var data = new FormData();
        data.append('_token', $('meta[name="csrf-token"]').attr('content'));
        data.append('header', $('meta[name="csrf-token"]').attr('content'));
        // data.append('hoTen', hoTen);
        data.append('diaChi', diaChi);
        data.append('soDienThoai', soDienThoai);
        data.append('ngaySinh', ngaySinh);
        $.ajax({
            type: 'POST',
            url: '/cap-nhat-thong-tin-ca-nhan',
            data: data,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            dataType: 'json',
            success: function (response) {
                alert(response.Content);
                location.reload();
            },
            error: function (response) {
                alert('Cập nhật thông tin lỗi, vui lòng thử lại.');
                return;
            }
        });
        return false;
    });

    $('#searchUserInfo').on('click', function () {
        $('#searchUserInfoResult').empty();
        $(this).attr("disabled", true);
        var tenNhanVien = $('#tenNhanVien').val();
        var tenDangNhap = $('#tenDangNhap').val();
        var maPhongBan = '';
        if ($('#cbxSrchPhongBan option:selected').val() != undefined){
            maPhongBan = $('#cbxSrchPhongBan option:selected').val();
        }
        var data = new FormData();
        data.append('_token', $('meta[name="csrf-token"]').attr('content'));
        data.append('header', $('meta[name="csrf-token"]').attr('content'));
        data.append('tenNhanVien', tenNhanVien);
        data.append('tenDangNhap', tenDangNhap);
        data.append('maPhongBan', maPhongBan);
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
                    $('#searchUserInfoResult').append($('<option>', {
                        value: res['ma_nhan_vien'],
                        text : res['ma_nhan_vien'] + " - " + res['ho_ten']
                    }));
                });
                $('#searchUserInfo').removeAttr("disabled");
            },
            error: function (response) {
            }
        });
        return false;
    });

    $('#searchUserInfoResult').on('change',function () {
        var maNhanVien = $('#searchUserInfoResult option:selected').val();
        $('#cbxSrchPhongBanUpdate').empty();
        var data = new FormData();
        data.append('_token', $('meta[name="csrf-token"]').attr('content'));
        data.append('header', $('meta[name="csrf-token"]').attr('content'));
        data.append('maNhanVien', maNhanVien);
        $.ajax({
            type: 'POST',
            url: '/thong-tin-nguoi-dung',
            data: data,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            dataType: 'json',
            success: function (response) {
                // console.log(response['rslTo']);
                $.each(response['userInfo'], function (i, res) {
                    $('#txtMaNhanVien').val(res['id']);
                    $('#txtTenNhanVien').val(res['ho_ten']);
                    $('#txtTenDangNhap').val(res['ma_nhan_vien']);
                    $('#cbxSrchPhongBanUpdate').append($('<option>', {
                        value: res['phong_ban']['ma_phong_ban'],
                        text : res['phong_ban']['ten_phong_ban']
                    }));
                    $('#cbxSrchToCongTacUpdate').append($('<option>', {
                        value: res['to_cong_tac']['ma_to_cong_tac'],
                        text : 'Tổ - ' + res['to_cong_tac']['ten_to_cong_tac']
                    }));
                    $('#txtChucVu').val(res['chuc_vu']);
                    $('#userEmail').val(res['email']);
                    $('#userAddress').val(res['dia_chi']);
                    $('#userPhone').val(res['dien_thoai']);
                    $('#userBirthDay').val(res['ngay_sinh']);
                    $('#cbxIsAdmin').val(res['phan_quyen']);
                    $('#cbxUserStatus').val(res['trang_thai']);
                });
                $('#cbxSrchPhongBanUpdate').attr("disabled", true);
                $('#cbxSrchToCongTacUpdate').attr("disabled", true);
            },
            error: function (response) {
            }
        });
        return false;
    });

    $('#cbxSrchTruSoUpdate').on('change', function () {
        $('#cbxSrchPhongBan').empty();
        var maTruSo = $('#cbxSrchTruSoUpdate option:selected').val();
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
                $('#cbxSrchPhongBanUpdate').append($('<option>', {
                    value: '',
                    text :'-----Chọn-----'
                }));
                $.each(response, function (i, res) {
                    $('#cbxSrchPhongBanUpdate').append($('<option>', {
                        value: res['ma_phong_ban'],
                        text : res['ten_phong_ban']
                    }));
                });
                $('#cbxSrchPhongBanUpdate').removeAttr('disabled');
            },
            error: function (response) {
            }
        });
    });

    $('#cbxSrchPhongBanUpdate').on('change', function () {
        $('#cbxSrchToCongTacUpdate').empty();
        var maPhongBan = $('#cbxSrchPhongBanUpdate option:selected').val();
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
                    $('#cbxSrchToCongTacUpdate').append($('<option>', {
                        value: res['ma_to_cong_tac'],
                        text : res['ten_to_cong_tac']
                    }));
                });
                $('#cbxSrchToCongTacUpdate').removeAttr('disabled');
            },
            error: function (response) {
            }
        });
    });
    
    $('#btnUpdateUserInfoMgmt').on('click', function () {
        var maNhanVien = $('#txtMaNhanVien').val();
        var tenDangNhap = $('#txtTenDangNhap').val();
        var tenNhanVien = $('#txtTenNhanVien').val();
        var maPhongBan = $('#cbxSrchPhongBanUpdate option:selected').val();
        var maToCongTac = $('#cbxSrchToCongTacUpdate option:selected').val();
        var chucVu = $('#txtChucVu').val();
        var email = $('#userEmail').val();
        var diaChi = $('#userAddress').val();
        var phone = $('#userPhone').val();
        var ngaySinh = $('#userBirthDay').val();
        var phanQuyen = $('#cbxPhanQuyen option:selected').val();
        var trangThai = $('#cbxUserStatus option:selected').val();
        var data = new FormData();

        data.append('_token', $('meta[name="csrf-token"]').attr('content'));
        data.append('header', $('meta[name="csrf-token"]').attr('content'));
        data.append('maNhanVien', maNhanVien);
        data.append('tenDangNhap', tenDangNhap);
        data.append('tenNhanVien', tenNhanVien);
        data.append('maPhongBan', maPhongBan);
        data.append('maToCongTac', maToCongTac);
        data.append('chucVu', chucVu);
        data.append('email', email);
        data.append('diaChi', diaChi);
        data.append('phone', phone);
        data.append('ngaySinh', ngaySinh);
        data.append('phanQuyen', phanQuyen);
        data.append('trangThai', trangThai);

        $.ajax({
            type: 'POST',
            url: '/update-user-info-by-admin',
            data: data,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            dataType: 'json',
            success: function (response) {
                alert(response.Content);
            },
            error: function (response) {
                alert('Cập nhật thông tin người dùng thất bại, vui lòng thử lại.');
            }
        });
        return false;
    });

    // DropzoneImage.init();
    // DropzoneDemo.init();
    //
    $('.modal button.close').on('click', function () {
        if ($('#m-document-dropzone').length > 0){
            Dropzone.forElement('#m-document-dropzone').removeAllFiles(true);
        }
        if( $('#add-gallery-image').length > 0){
            Dropzone.forElement('#add-gallery-image').removeAllFiles(true);
        }
    });
});

var DropzoneDemo = function() {
    var e = function() {
        Dropzone.options.mDocumentDropzone = {
            url: "inc/api/dropzone/upload.php",
            paramName: "fileDocumentUpload",
            maxFiles: 1,
            maxFilesize: 100,
            init: function() {
                this.on("maxfilesexceeded", function(file) {
                    this.removeAllFiles();
                    this.addFile(file);
                });
                this.on("error", function(file){if (!file.accepted) this.removeFile(file);});
                // this.on("complete", function(file) {
                //     this.removeAllFiles(file);
                // });
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
                // this.on("complete", function(file) {
                //     this.removeAllFiles(file);
                // });
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
DropzoneDemo.init();