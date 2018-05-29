<?php
/**

 */?>

<div class="m-content">
    <div class="row">
        <div class="col-md-6">
            <!--begin::Portlet-->
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Tìm Kiếm
                            </h3>
                        </div>
                    </div>
                </div>
                <!--begin::Form-->
                <form class="m-form m-form--fit m-form--label-align-right">
                    <div class="m-portlet__body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group m-form__group">
                                    <label for="tenNhanVien">
                                        Tên Nhân Viên
                                    </label>
                                    <input type="text" class="form-control m-input" id="tenNhanVien" placeholder="Tên Nhân Viên">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group m-form__group">
                                    <label for="tenDangNhap">
                                        Tên Đăng Nhập
                                    </label>
                                    <input type="text" class="form-control m-input" id="tenDangNhap" placeholder="Tên Đăng Nhập">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <div class="form-group m-form__group">
                                    <label for="cbxSrchTruSo">
                                        Nơi làm việc
                                    </label>
                                    <select class="form-control m-input m-input--air" id="cbxSrchTruSo">
                                        <option value="" selected>
                                            -----Chọn-----
                                        </option>
                                        @if( isset($dsTruSo))
                                            @foreach($dsTruSo as $ts)
                                                <option value="{{ $ts->ma_tru_so }}">
                                                    {{ $ts->ten_tru_so }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group m-form__group">
                                    <label for="cbxSrchPhongBan">
                                        Phòng Ban
                                    </label>
                                    <select class="form-control m-input m-input--air" id="cbxSrchPhongBan" disabled>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions">
                                <button type="reset" class="btn btn-primary" id="searchPhanQuyen">
                                    Tìm Kiếm
                                </button>
                                <button type="reset" class="btn btn-secondary">
                                    Hủy
                                </button>
                            </div>
                        </div>
                        <div class="form-group m-form__group">
                            <label for="exampleSelect2">
                                Kết Quả
                            </label>
                            <select class="form-control m-input" id="kqTimKiemNhanVien" size="10">
                            </select>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
            </div>
            <!--end::Portlet-->
        </div>
        <div class="col-md-6">
            <!--begin::Portlet-->
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Phân Quyền
                            </h3>
                        </div>
                    </div>
                </div>
                <!--begin::Form-->
                <form class="m-form m-form--fit m-form--label-align-right">
                    <div class="m-portlet__body">
                        <div class="form-group m-form__group">
                            <label for="tenNhanVienPQ">
                                Tên Nhân Viên
                            </label>
                            <input type="text" class="form-control m-input" id="tenNhanVienPQ" placeholder="Tên Nhân Viên" disabled>
                        </div>
                        <div class="form-group m-form__group">
                            <label for="exampleSelect2">
                                Quyền
                            </label>
                            <select class="form-control m-input" id="dsQuyenNhanVien" size="15">
                            </select>
                        </div>
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions">
                                <button type="button" class="btn btn-danger" id="btnXoaQuyen" disabled>
                                    Xóa Quyền
                                </button>
                                <button type="button" id="btnMdThemPhanQuyen" class="btn btn-success" data-toggle="modal" data-target="#mdThemPhanQuyen">
                                    Phân Quyền
                                </button>
                                <button type="reset" class="btn btn-primary" id="btnUpdateAuth" disabled>
                                    Cập Nhật
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
            </div>
            <!--end::Portlet-->
        </div>
    </div>
</div>
<div class="modal fade bs-modal-lg" id="mdThemPhanQuyen" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thêm Phân Quyền<span id="mdAddDocumentTitle"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group m-form__group">
                            <label for="loaiPhanQuyen">
                                Loại Phân Quyền
                            </label>
                            <select class="form-control m-input m-input--air" id="loaiPhanQuyen">
                                <option value="0">
                                    -----Chọn-----
                                </option>
                                <option value="1">
                                    Phân Quyền theo tổ
                                </option>
                                <option value="2">
                                    Phân quyền Tài Liệu Chung
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 phan-quyen-to hide">
                        <div class="form-group m-form__group">
                            <label for="exampleSelect1">
                                Trụ Sở
                            </label>
                            <select class="form-control m-input m-input--air" id="cbxTruSo">
                            </select>
                        </div>
                    </div>
                    {{--<div class="col-md-6 phan-quyen-to hide">--}}
                        {{--<div class="form-group m-form__group">--}}
                            {{--<label for="exampleSelect1">--}}
                                {{--Phòng Ban--}}
                            {{--</label>--}}
                            {{--<select class="form-control m-input m-input--air" id="cbxPhongBan" disabled>--}}
                            {{--</select>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="col-lg-12 mt-3  phan-quyen-to hide">
                        <label for="exampleSelect2">
                            Quyền
                        </label>
                        <select multiple="" class="form-control m-input" id="cbxPhongBan" size="10">
                        </select>
                    </div>
                    <div class="col-md-12 phan-quyen-chung hide">
                        <div class="form-group m-form__group">
                            <label for="exampleSelect1">
                                Danh Mục Chung
                            </label>
                            <select class="form-control m-input m-input--air" id="cbxDanhMucMoRong">
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-3 phan-quyen-chung hide">
                        <label for="exampleSelect2">
                            Quyền
                        </label>
                        <select multiple="" class="form-control m-input" id="cbxTaiLieuMoRong" size="10">
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn  btn-secondary" data-dismiss="modal">Đóng Lại</button>
                <button type="button" id="btnAddDSPhanQuyen" class="btn  btn-accent sbold">Thêm Quyền</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>