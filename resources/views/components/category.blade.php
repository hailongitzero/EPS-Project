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
                                Danh Mục Tổ - Phòng Ban
                            </h3>
                        </div>
                    </div>
                </div>
                <!--begin::Form-->
                <form class="m-form m-form--fit m-form--label-align-right">
                    <div class="m-portlet__body ">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group m-form__group">
                                    <label for="cbxDsTruSo">
                                        Nơi làm việc
                                    </label>
                                    <select class="form-control m-input m-input--air" id="cbxDsTruSo">
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
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit pt-3 pb-5">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group m-form__group">
                                    <label for="cbxDsPhongBan">
                                        Danh Sách Phòng Ban
                                    </label>
                                    <select class="form-control m-input" id="cbxDsPhongBan" size="10">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#m_insert_tab">
                                            Thêm Phòng Ban
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#m_update_tab">
                                            Cập Nhật Phòng Ban
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="m_insert_tab" role="tabpanel">
                                        <div class="form-group m-form__group">
                                            <input type="text" id="tenPhongBanAdd" class="form-control m-input m-input--air" placeholder="Tên Phòng Ban">
                                        </div>
                                        <div class="form-group m-form__group">
                                            <button type="button" class="btn btn-primary btn-block" id="btnThemPhongBan">
                                                Thêm Phòng Ban
                                            </button>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="m_update_tab" role="tabpanel">
                                        <div class="form-group m-form__group">
                                            <input type="hidden" id="maPhongBanUpd" value="">
                                            <input type="text" id="tenPhongBanUpd" class="form-control m-input m-input--air" placeholder="Tên Phòng Ban">
                                        </div>
                                        <div class="form-group m-form__group">
                                            <button type="button" class="btn btn-primary btn-block" id="btnCapNhatPhongBan">
                                                Cập Nhật Phòng Ban
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit pt-3 pb-5">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group m-form__group">
                                    <label for="cbxSrchPhongBan">
                                        Danh Sách Tổ
                                    </label>
                                    <select class="form-control m-input" id="cbxDsTo" size="10">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#m_insert_tab_t">
                                            Thêm Tổ
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#m_update_tab_t">
                                            Cập Nhật Tổ
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="m_insert_tab_t" role="tabpanel">
                                        <div class="form-group m-form__group">
                                            <input type="text" id="tenToCongTacAdd" class="form-control m-input m-input--air" placeholder="Tên Tổ Công Tác">
                                        </div>
                                        <div class="form-group m-form__group">
                                            <button type="button" class="btn btn-primary btn-block" id="btnThemTo">
                                                Thêm Tổ
                                            </button>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="m_update_tab_t" role="tabpanel">
                                        <div class="form-group m-form__group">
                                            <input type="hidden" id="maToCongTacUpd" value="">
                                            <input type="text" id="tenToCongTacUpd" class="form-control m-input m-input--air" placeholder="Tên Tổ Công Tác">
                                        </div>
                                        <div class="form-group m-form__group">
                                            <button type="button" class="btn btn-primary btn-block" id="btnCapNhatTo">
                                                Cập Nhật Tổ
                                            </button>
                                        </div>
                                        <div class="form-group m-form__group">
                                            <button type="button" class="btn btn-primary btn-block" id="btnXoaTo">
                                                Xóa Tổ
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                Danh Mục Tài Liệu Chung
                            </h3>
                        </div>
                    </div>
                </div>
                <!--begin::Form-->
                <form class="m-form m-form--fit m-form--label-align-right">
                    <div class="m-portlet__body ">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group m-form__group">
                                    <label for="cbxDanhMucChung">
                                        Danh Mục Tài Liệu Chung
                                    </label>
                                    <select class="form-control m-input m-input--air" id="cbxDanhMucChung">
                                        <option value="" selected>
                                            -----Chọn-----
                                        </option>
                                        @if( isset($dsDanhMuc))
                                            @foreach($dsDanhMuc as $dm)
                                                <option value="{{ $dm->ma_danh_muc_mo_rong }}">
                                                    {{ $dm->ten_danh_muc_mo_rong }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit pt-3 pb-5">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group m-form__group">
                                    <label for="cbxSrchPhongBan">
                                        Danh Mục Tài Liệu
                                    </label>
                                    <select class="form-control m-input" id="cbxDsDanhMucTaiLieu" size="10">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#m_insert_tab_d">
                                            Thêm Danh Mục
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#m_update_tab_d">
                                            Cập Nhật Danh Mục
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="m_insert_tab_d" role="tabpanel">
                                        <div class="form-group m-form__group">
                                            <input type="text" id="tenDMTaiLieuAdd" class="form-control m-input m-input--air" placeholder="Tên Danh Mục">
                                        </div>
                                        <div class="form-group m-form__group">
                                            <button type="button" class="btn btn-primary btn-block" id="btnThemDanhMuc">
                                                Thêm Danh Mục
                                            </button>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="m_update_tab_d" role="tabpanel">
                                        <div class="form-group m-form__group">
                                            <input type="hidden" id="maDMTaiLieuUpd" value="">
                                            <input type="text" id="tenDMTaiLieuUpd" class="form-control m-input m-input--air" placeholder="Tên Danh Mục">
                                        </div>
                                        <div class="form-group m-form__group">
                                            <button type="button" class="btn btn-primary btn-block" id="btnCapNhatDanhMuc">
                                                Cập Nhật Danh Mục
                                            </button>
                                        </div>
                                        <div class="form-group m-form__group">
                                            <button type="button" class="btn btn-primary btn-block" id="btnXoaDanhMuc">
                                                Xóa Danh Mục
                                            </button>
                                        </div>
                                    </div>
                                </div>
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