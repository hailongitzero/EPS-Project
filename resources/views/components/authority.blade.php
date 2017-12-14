<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 12/7/2017
 * Time: 10:58 PM
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
                        <div class="form-group m-form__group">
                            <label for="tenNhanVien">
                                Tên Nhân Viên
                            </label>
                            <input type="text" class="form-control m-input" id="tenNhanVien" placeholder="Tên Nhân Viên">
                        </div>
                        <div class="form-group m-form__group">
                            <label for="tenDangNhap">
                                Tên Đăng Nhập
                            </label>
                            <input type="text" class="form-control m-input" id="tenDangNhap" placeholder="Tên Đăng Nhập">
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
                            <select multiple="" class="form-control m-input" id="kqTimKiemNhanVien" style="height: 250px">
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
                            <select multiple="" class="form-control m-input" id="dsQuyenNhanVien" style="height: 250px">
                            </select>
                        </div>
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions">
                                <button type="button" class="btn btn-danger" id="btnXoaQuyen">
                                    Xóa Quyền
                                </button>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#mdThemPhanQuyen">
                                    Phân Quyền
                                </button>
                                <button type="reset" class="btn btn-primary" id="btnUpdateAuth">
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
                    <div class="col-md-6 phan-quyen-to hide">
                        <div class="form-group m-form__group">
                            <label for="exampleSelect1">
                                Trụ Sở
                            </label>
                            <select class="form-control m-input m-input--air" id="cbxTruSo">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 phan-quyen-to hide">
                        <div class="form-group m-form__group">
                            <label for="exampleSelect1">
                                Phòng Ban
                            </label>
                            <select class="form-control m-input m-input--air" id="cbxPhongBan">
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-3  phan-quyen-to hide">
                        <label for="exampleSelect2">
                            Quyền
                        </label>
                        <select multiple="" class="form-control m-input" id="cbxToCongTac" style="height: 250px">
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
                        <select multiple="" class="form-control m-input" id="cbxTaiLieuMoRong" style="height: 250px">
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn m-btn--pill btn-secondary" data-dismiss="modal">Hủy</button>
                <button type="button" id="btnAddDSPhanQuyen" class="btn m-btn--pill btn-accent sbold">Thêm Quyền</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>