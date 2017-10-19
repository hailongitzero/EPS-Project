/**
 * Created by HaiLong on 10/7/2017.
 */
var DatatableRemoteAjax = function() {
    var t = null;
    t = function() {
        var t = $("#mTbDocument").mDatatable({
                data: {
                    type: "remote",
                    source: {
                        read: {
                            url: 'http://localhost/danh-sach-tai-lieu',
                            method: 'GET',
                            params: {
                                // custom headers
                                headers: $('meta[name="csrf-token"]').attr('content'),
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                token: $('meta[name="csrf-token"]').attr('content'),
                                query: {
                                }
                            }
                        },
                    },
                    pageSize: 10,
                    saveState: {
                        cookie: !0,
                        webstorage: !0
                    },
                    serverPaging: !0,
                    serverFiltering: !0,
                    serverSorting: !0
                },
                layout: {
                    theme: "default",
                    class: "",
                    scroll: !1,
                    footer: !1
                },
                sortable: !0,
                filterable: !1,
                pagination: !0,
                columns: [{
                    field: "ten_tai_lieu",
                    title: "Tên Tài Liệu",
                    sortable: "asc",
                    filterable: !1,
                    width: 150,
                },{
                    field: "mo_ta_tai_lieu",
                    title: "Mô Tả",
                    width: 150,
                    template: function (t) {
                        return "<div class='m-input-icon'><input type='text' name='moTaTaiLieu' class='moTaTaiLieu form-control m-input' placeholder='Mô tả tài liệu' value='"+t.mo_ta_tai_lieu+"'></div>";
                    }
                }, {
                    field: "dung_luong",
                    title: "Dung Lượng",
                    width: 60,
                    template: function (t) {
                        return t.dung_luong / 1000 + ' kb'
                    }
                }, {
                    field: "tac_gia",
                    title: "Người Đăng",
                    template: function(t) {
                        return t.tac_gia.ho_ten;

                    }
                }, {
                    field: "ngay_tao",
                    title: "Ngày Đăng",
                    type: "date",
                    format: "MM/DD/YYYY"
                }, {
                    field: "dinh_dang",
                    title: "Định Dạng",
                    width: 60,
                    template: function(t) {
                        var e = {
                            'doc': {
                                title: "<i class='fa fa-file-word-o'></i>",
                            },
                            'docx': {
                                title: "<i class='fa fa-file-word-o'></i>",
                            },
                            'pdf': {
                                title: "<i class='fa fa-file-pdf-o'></i>",
                            },
                            'ppt': {
                                title: "<i class='fa fa-file-powerpoint-o'></i>",
                            },
                            'pptx': {
                                title: "<i class='fa fa-file-powerpoint-o'></i>",
                            },
                            'xlsx': {
                                title: "<i class='fa fa-file-excel-o'></i>",
                            },
                            'xls': {
                                title: "<i class='fa fa-file-excel-o'></i>",
                            },
                            'bin': {
                                title: "<i class='fa tfa-file-o'></i>",
                            }
                        };
                        return '<span class="btn btn-success">' + e[t.dinh_dang].title + "</span>"
                    }
                }, {
                    field: "Tùy Chọn",
                    width: 110,
                    title: "Tùy Chọn",
                    sortable: !1,
                    overflow: "visible",
                    template: function(t) {
                        return '\t\t\t\t\t\t<div class="dropdown ' + (t.getDatatable().getPageSize() - t.getIndex() <= 4 ? "dropup" : "") + '">\t\t\t\t\t\t\t<a href="#" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown"><i class="la la-ellipsis-h"></i></a>\t\t\t\t\t\t  \t<div class="dropdown-menu dropdown-menu-right">\t\t\t\t\t\t    \t<a class="dropdown-item" href="'+window.location.origin+ '/downloadTaiLieu/' + t.ma_tai_lieu +'"><i class="fa fa-arrow-circle-o-down"></i> Tải Về</a>\t\t\t\t\t\t    \t<a class="dropdown-item" href="'+window.location.origin+ '/resources/' + t.lien_ket +'" target="_blank"><i class="fa fa-eye"></i> Xem Trước</a>\t\t\t\t\t\t    \t</div>\t\t\t\t\t\t</div>\t\t\t\t\t\t<a href="#" class="saveDocument m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Save details" data-content="'+t.ma_tai_lieu+'">\t\t\t\t\t\t\t<i class="la la-save"></i>\t\t\t\t\t\t</a>\t\t\t\t\t\t<a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete">\t\t\t\t\t\t\t<i class="la la-trash"></i>\t\t\t\t\t\t</a>\t\t\t\t\t'
                    }
                }]
            }),
            f = t.setDataSourceParam('maDanhMuc', ''),
            e = t.getDataSourceQuery();
        $("#m_form_search").on("keyup", function(e) {
            var a = t.getDataSourceQuery();
            a.generalSearch = $(this).val().toLowerCase(), t.setDataSourceQuery(a);
            t.setDataSourceParam('tenTaiLieu', a), t.load();
        }).val(e.generalSearch), $("#m_form_status").on("change", function() {
            var e = t.getDataSourceQuery();
            e.Status = $(this).val().toLowerCase(), t.setDataSourceQuery(e), t.load()
        }).val(void 0 !== e.Status ? e.Status : ""), $("#m_form_type").on("change", function() {
            var e = t.getDataSourceQuery();
            e.Type = $(this).val().toLowerCase(), t.setDataSourceQuery(e), t.load()
        }).val(void 0 !== e.Type ? e.Type : ""), $("#m_form_status, #m_form_type").selectpicker(),
        $("#mTreeDanhMuc").on('changed.jstree', function (e, data) {
            var tb = $("#mTbDocument");
            var nodeId = $('#mTreeDanhMuc').jstree().get_selected("id")[0].id;
            var noteText = $('#mTreeDanhMuc').jstree().get_selected("id")[0].text;
            var maDanhMuc = $('#'+nodeId).find('a').attr('data-content');
            var level = $('#'+nodeId).attr('aria-level');
            if( level > 1){
                t.setDataSourceParam('maDanhMuc', maDanhMuc);
                t.load();
            }
        })
    };
    return {
        init: function() {
            t()
        },
    }
}();

var DatatableTraCuu = function() {
    var t = null;
    t = function() {
        var t = $("#mTbTraCuu").mDatatable({
                data: {
                    type: "remote",
                    source: {
                        read: {
                            url: 'http://localhost/tra-cuu-tai-lieu',
                            method: 'GET',
                            params: {
                                // custom headers
                                headers: $('meta[name="csrf-token"]').attr('content'),
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                token: $('meta[name="csrf-token"]').attr('content'),
                                query: {
                                }
                            }
                        },
                    },
                    pageSize: 10,
                    saveState: {
                        cookie: !0,
                        webstorage: !0
                    },
                    serverPaging: !0,
                    serverFiltering: !0,
                    serverSorting: !0
                },
                layout: {
                    theme: "default",
                    class: "",
                    scroll: !1,
                    footer: !1
                },
                sortable: !0,
                filterable: !1,
                pagination: !0,
                columns: [{
                    field: "ma_tai_lieu",
                    title: "Mã Tài Liệu",
                    sortable: !1,
                    filterable: !1,
                    width: 100,
                    selector: !1,
                    textAlign: "center"
                }, {
                    field: "ten_tai_lieu",
                    title: "Tên Tài Liệu",
                    sortable: "asc",
                    filterable: !1,
                    width: 150,
                }, {
                    field: "dung_luong",
                    title: "Dung Lượng",
                    width: 60,
                    template: function (t) {
                        return t.dung_luong / 1000 + ' kb'
                    }
                }, {
                    field: "nguoi_dang",
                    title: "Người Đăng",
                }, {
                    field: "ngay_tao",
                    title: "Ngày Đăng",
                    type: "date",
                    format: "MM/DD/YYYY"
                }, {
                    field: "dinh_dang",
                    title: "Định Dạng",
                    width: 60,
                    template: function(t) {
                        var e = {
                            'doc': {
                                title: "<i class='fa fa-file-word-o'></i>",
                            },
                            'docx': {
                                title: "<i class='fa fa-file-word-o'></i>",
                            },
                            'pdf': {
                                title: "<i class='fa fa-file-pdf-o'></i>",
                            },
                            'ppt': {
                                title: "<i class='fa fa-file-powerpoint-o'></i>",
                            },
                            'pptx': {
                                title: "<i class='fa fa-file-powerpoint-o'></i>",
                            },
                            'xlsx': {
                                title: "<i class='fa fa-file-excel-o'></i>",
                            },
                            'xls': {
                                title: "<i class='fa fa-file-excel-o'></i>",
                            },
                            'bin': {
                                title: "<i class='fa tfa-file-o'></i>",
                            }
                        };
                        return '<span class="btn btn-success">' + e[t.dinh_dang].title + "</span>"
                    }
                }, {
                    field: "Tùy Chọn",
                    width: 110,
                    title: "Tùy Chọn",
                    sortable: !1,
                    overflow: "visible",
                    template: function(t) {
                        return '\t\t\t\t\t\t<div class="dropdown ' + (t.getDatatable().getPageSize() - t.getIndex() <= 4 ? "dropup" : "") + '">\t\t\t\t\t\t\t<a href="#" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown"><i class="la la-ellipsis-h"></i></a>\t\t\t\t\t\t  \t<div class="dropdown-menu dropdown-menu-right">\t\t\t\t\t\t    \t<a class="dropdown-item" href="'+window.location.origin+ '/downloadTaiLieu/' + t.ma_tai_lieu +'"><i class="fa fa-arrow-circle-o-down"></i> Tải Về</a>\t\t\t\t\t\t    \t<a class="dropdown-item" href="'+window.location.origin+ '/resources/' + t.lien_ket +'" target="_blank"><i class="fa fa-eye"></i> Xem Trước</a>\t\t\t\t\t\t    \t</div>\t\t\t\t\t\t</div>\t\t\t\t\t\t<a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details">\t\t\t\t\t\t\t<i class="la la-edit"></i>\t\t\t\t\t\t</a>\t\t\t\t\t\t<a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete">\t\t\t\t\t\t\t<i class="la la-trash"></i>\t\t\t\t\t\t</a>\t\t\t\t\t'
                    }
                }]
            }),
            e = t.getDataSourceQuery();
        $("#fsNguoiDang").on("keyup", function(e) {
            var a = t.getDataSourceQuery();
            a.generalSearch = $(this).val().toLowerCase(), t.setDataSourceQuery(a);
            t.setDataSourceParam('tenNhanVien', a), t.load();
        }).val(e.generalSearch),$("#fsTenTaiLieu").on("keyup", function(e) {
            var a = t.getDataSourceQuery();
            a.generalSearch = $(this).val().toLowerCase(), t.setDataSourceQuery(a);
            t.setDataSourceParam('tenTaiLieu', a), t.load();
        }).val(e.generalSearch)
    };
    return {
        init: function() {
            t()
        },
        bind: function (param, value) {
            var table = $("#mTbDocument").fn.mDatatable();
            console.log(table);
        }
    }
}();

var DatatableGallery = function() {
    var t = null;
    t = function() {
        var t = $("#mTbThuVienHinh").mDatatable({
                data: {
                    type: "remote",
                    source: {
                        read: {
                            url: 'http://localhost/thu-vien-hinh',
                            method: 'GET',
                            params: {
                                // custom headers
                                headers: $('meta[name="csrf-token"]').attr('content'),
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                token: $('meta[name="csrf-token"]').attr('content'),
                                query: {
                                }
                            }
                        },
                    },
                    pageSize: 10,
                    saveState: {
                        cookie: !0,
                        webstorage: !0
                    },
                    serverPaging: !0,
                    serverFiltering: !0,
                    serverSorting: !0
                },
                layout: {
                    theme: "default",
                    class: "",
                    scroll: !1,
                    footer: !1
                },
                sortable: !0,
                filterable: !1,
                pagination: !0,
                columns: [{
                    field: "ten_thu_vien",
                    title: "Thư viện hình",
                    sortable: "asc",
                    width: 200,
                    selector: !1,
                    textAlign: "center",
                    template: function (t) {
                        return '<a href="#" data-content="'+ t.ma_thu_vien + '" data-toggle="modal" data-target="#mdGallery'+ t.ma_thu_vien + '">' + t.ten_thu_vien + '</a>'
                    }
                }, {
                    field: "nguoi_tao",
                    title: "Người Tạo",
                    sortable: "asc",
                    filterable: !1,
                    template: function(t) {
                        return t.nguoi_dang.ho_ten;

                    }
                }, {
                    field: "ngay_tao",
                    title: "Ngày Đăng",
                    type: "date",
                    format: "MM/DD/YYYY"
                }, {
                    field: "nguoi_cap_nhat",
                    title: "Người Cập Nhật",
                    sortable: "asc",
                    filterable: !1,
                    width: 150,
                }, {
                    field: "ngay_cap_nhat",
                    title: "Ngày Cập Nhật",
                    type: "date",
                    format: "MM/DD/YYYY"
                }, {
                    field: "Tùy Chọn",
                    width: 110,
                    title: "Tùy Chọn",
                    sortable: !1,
                    overflow: "visible",
                    template: function(t) {
                        return '\t\t\t\t\t\t<a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Thêm">\t\t\t\t\t\t\t<i class="la la-cloud-upload"></i>\t\t\t\t\t\t</a>\t\t\t\t\t'
                    }
                }]
            }),
            e = t.getDataSourceQuery();
        $("#fsTenThuVienHinh").on("keyup", function(e) {
            var a = t.getDataSourceQuery();
            a.generalSearch = $(this).val().toLowerCase(), t.setDataSourceQuery(a);
            t.setDataSourceParam('tenThuVienHinh', a), t.load();
        }).val(e.generalSearch)
    };
    return {
        init: function() {
            t()
        }
    }
}();

jQuery(document).ready(function() {
    if ($("#mTbDocument").length > 0){
        DatatableRemoteAjax.init();
    }

    if ($("#mTbTraCuu").length > 0){
        DatatableTraCuu.init();
    }

    if ($("#mTbThuVienHinh").length > 0){
        DatatableGallery.init();
    }
});