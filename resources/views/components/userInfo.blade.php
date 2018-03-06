<?php
/**

 */
?>
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
                                Thông tin cá nhân
                            </h3>
                        </div>
                    </div>
                </div>
                <!--begin::Form-->
                <form class="m-form m-form--fit m-form--label-align-right">
                    @if(isset( $userData))
                        @foreach($userData as $ud)
                            <div class="m-portlet__body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group m-form__group">
                                            <label for="tenNhanVien">
                                                Tên Nhân Viên
                                            </label>
                                            <input type="text" class="form-control m-input" id="tenNhanVien" value="{{ isset($ud->ho_ten) ? $ud->ho_ten : "" }}" placeholder="Tên Nhân Viên" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group m-form__group">
                                            <label for="tenDangNhap">
                                                Tên Đăng Nhập
                                            </label>
                                            <input type="text" class="form-control m-input" id="tenDangNhap" value="{{ isset($ud->username) ? $ud->username : ""}}" placeholder="Tên Đăng Nhập" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-12">
                                        <div class="form-group m-form__group">
                                            <label for="cbxSrchTruSo">
                                                Phòng Ban
                                            </label>
                                            <input type="text" class="form-control m-input" id="tenPhongBan" value="{{ isset($ud->phongBan->ten_phong_ba) ? $ud->phongBan->ten_phong_ban : ""}}" placeholder="Phòng Ban" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group m-form__group">
                                            <label for="cbxSrchTruSo">
                                                Tổ Công Tác
                                            </label>
                                            <input type="text" class="form-control m-input" id="tenToCongTac" value="{{ isset($ud->toCongTac->ten_to_cong_tac) ? $ud->toCongTac->ten_to_cong_tac : ""}}" placeholder="Tổ Công Tác" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group m-form__group">
                                            <label for="cbxSrchPhongBan">
                                                Email
                                            </label>
                                            <input type="text" class="form-control m-input" id="email" value="{{ isset($ud->email) ? $ud->email : ""}}" placeholder="email" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group m-form__group">
                                            <label for="cbxSrchPhongBan">
                                                Địa Chỉ
                                            </label>
                                            <textarea type="text" class="form-control m-input" id="diaChi" rows="3" placeholder="Địa Chỉ">{{ isset($ud->dia_chi) ? $ud->dia_chi : ""}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group m-form__group">
                                            <label for="cbxSrchPhongBan">
                                                Số Điện Thoại
                                            </label>
                                            <input type="text" class="form-control m-input" id="dienThoai" value="{{ isset($ud->dien_thoai) ? $ud->dien_thoai : ""}}" placeholder="Điện thoại">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group m-form__group">
                                            <label for="cbxSrchPhongBan">
                                                Ngày Sinh
                                            </label>
                                            <input class="form-control m-input" type="date" value="{{ isset($ud->ngay_sinh) ? $ud->ngay_sinh : ""}}" id="ngaySinh">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
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
                            <select multiple="" class="form-control m-input" id="dsQuyenNhanVien" style="height: 250px">
                                @if(isset($userRole))
                                    @foreach( $userRole as $ur)
                                        <option value="{{ $ur->ma_nhom_quyen }}">{{isset($ur->pqTo) ? $ur->pqTo->ten_to_cong_tac : $ur->pqDanhMuc->ten_tai_lieu_mo_rong}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions">
                            <button type="reset" class="btn btn-primary" id="btnUpdateUserInfo">
                                Cập Nhật
                            </button>
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
                <button type="button" class="btn m-btn--pill btn-secondary" data-dismiss="modal">Đóng Lại</button>
                <button type="button" id="btnAddDSPhanQuyen" class="btn m-btn--pill btn-accent sbold">Thêm Quyền</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
