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
                                <button type="reset" class="btn btn-primary" id="searchUserInfo">
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
                            <select multiple="" class="form-control m-input" id="searchUserInfoResult" style="height: 250px">
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
                                Cập Nhật Thông Tin
                            </h3>
                        </div>
                    </div>
                </div>
                <!--begin::Form-->
                <form class="m-form m-form--fit m-form--label-align-right">
                    <div class="m-portlet__body">
                        <div class="form-group m-form__group">
                            <label for="txtTenNhanVien">
                                Tên Nhân Viên
                            </label>
                            <input type="hidden" id="txtMaNhanVien">
                            <input type="text" class="form-control m-input" id="txtTenNhanVien" placeholder="Tên Nhân Viên" disabled>
                        </div>
                        <div class="form-group m-form__group">
                            <label for="tenNhanVienPQ">
                                Tên Đăng Nhập
                            </label>
                            <input type="text" class="form-control m-input" id="txtTenDangNhap" placeholder="Tên Nhân Viên">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group m-form__group">
                                    <label for="cbxSrchTruSoUpdate">
                                        Nơi làm việc
                                    </label>
                                    <select class="form-control m-input m-input--air" id="cbxSrchTruSoUpdate">
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
                                    <label for="cbxSrchPhongBanUpdate">
                                        Phòng Ban
                                    </label>
                                    <select class="form-control m-input m-input--air" id="cbxSrchPhongBanUpdate" disabled>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group m-form__group">
                            <label for="cbxSrchToCongTacUpdate">
                                Tổ Công Tác
                            </label>
                            <select class="form-control m-input m-input--air" id="cbxSrchToCongTacUpdate" disabled>
                            </select>
                        </div>
                        <div class="form-group m-form__group">
                            <label for="txtChucVu">
                                Chức Vụ
                            </label>
                            <input type="text" class="form-control m-input" id="txtChucVu" value="" placeholder="Chức vụ">
                        </div>
                        <div class="form-group m-form__group">
                            <label for="userEmail">
                                Email
                            </label>
                            <input type="text" class="form-control m-input" id="userEmail" value="" placeholder="email" disabled>
                        </div>
                        <div class="form-group m-form__group">
                            <label for="userAddress">
                                Địa Chỉ
                            </label>
                            <textarea type="text" class="form-control m-input" id="userAddress" rows="3" placeholder="Địa Chỉ"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group m-form__group">
                                    <label for="userPhone">
                                        Số Điện Thoại
                                    </label>
                                    <input type="text" class="form-control m-input" id="userPhone" value="" placeholder="Điện thoại">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group m-form__group">
                                    <label for="cbxIsAdmin">
                                        Quyền
                                    </label>
                                    <select class="form-control m-input m-input--air" id="cbxPhanQuyen">
                                        <option value="0">Nhân Viên</option>
                                        <option value="1">Quản Lý</option>
                                        <option value="2">Quản trị viên</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group m-form__group">
                                    <label for="userBirthDay">
                                        Ngày Sinh
                                    </label>
                                    <input class="form-control m-input" type="date" value="" id="userBirthDay">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group m-form__group">
                                    <label for="cbxUserStatus">
                                        Trạng Thái
                                    </label>
                                    <select class="form-control m-input m-input--air" id="cbxUserStatus">
                                        <option value="0">Khóa</option>
                                        <option value="1">Hoạt Động</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions">
                                <button type="reset" class="btn btn-primary" id="btnUpdateUserInfoMgmt">
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
                <button type="button" class="btn  btn-secondary" data-dismiss="modal">Đóng Lại</button>
                <button type="button" id="btnAddDSPhanQuyen" class="btn  btn-accent sbold">Thêm Quyền</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
