<?php
/**

 */
?>
<!-- BEGIN: Subheader -->
<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Thư Viện Tài Liệu
            </h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="{{ url('') }}" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
                <li class="m-nav__separator">
                    -
                </li>
                @if( isset($danhMucTaiLieu))
                    @foreach( $danhMucTaiLieu as $dm)
                        <li class="m-nav__item">
                            <a href="{{ url('/tai-lieu/'.$dm->ma_tai_lieu_mo_rong) }}" class="m-nav__link">
                                <span class="m-nav__link-text">
                                    {{ $dm->ten_tai_lieu_mo_rong }}
                                </span>
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
</div>
<!-- END: Subheader -->
<div class="m-content">
    <div class="row">
        <div class="col-lg-3">
            <!--begin::Portlet-->
            <div class="m-portlet">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Danh Mục Tài Liệu
                            </h3>
                        </div>
                        <button type="button" class="btn m-btn--pill btn-primary" data-toggle="modal" data-target="#mdThemMoiDanhMucMoRong">
                            <span>
                                <i class="fa fa-plus"></i>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div id="mTreeDanhMucMoRong" class="tree-demo">
                        <ul>
                            <li data-jstree='{ "selected":true }'>
                                @if(isset($danhMucTaiLieu))
                                    @foreach($danhMucTaiLieu as $dm)
                                    <a href="#" class="linkDanhMucTaiLieuMoRong" data-content="{{ $dm->ma_tai_lieu_mo_rong }}">
                                        {{ $dm->ten_tai_lieu_mo_rong }}
                                    </a>
                                    @endforeach
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--end::Portlet-->
        </div>
        <div class="col-lg-9">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                @if( isset($danhMucTaiLieu))
                                    @foreach( $danhMucTaiLieu as $dm)
                                        {{ $dm->ten_tai_lieu_mo_rong }}
                                    @endforeach
                                @endif
                                <small id="tbTitleSec">

                                </small>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <!--begin: Search Form -->
                    <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                        <div class="row align-items-center">
                            <div class="col-xl-8 order-2 order-xl-1">
                                <div class="form-group m-form__group row align-items-center">
                                    <div class="col-md-8">
                                        <div class="m-input-icon m-input-icon--left">
                                            <input type="text" class="form-control m-input" placeholder="Tên Tài Liệu" id="m_form_search">
                                            <span class="m-input-icon__icon m-input-icon__icon--left">
                                                <span>
                                                    <i class="la la-search"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                                <a id="uploadTaiLieu"  href="#" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" data-toggle="modal" data-target="#mdThemMoiTaiLieu">
                                    <span>
                                        <i class="fa fa-upload"></i>
                                        <span>
                                            Tải Lên
                                        </span>
                                    </span>
                                </a>
                                <div class="m-separator m-separator--dashed d-xl-none"></div>
                            </div>
                        </div>
                    </div>
                    <!--end: Search Form -->
                    <!--begin: Datatable -->
                    <div class="m_datatable" id="mTbDocumentExt"></div>
                    <!--end: Datatable -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bs-modal-lg" id="mdThemMoiTaiLieu" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thêm Mới Tài Liệu <span id="mdAddDocumentTitle"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="m-dropzone dropzone" action="inc/api/dropzone/upload.php" id="m-document-dropzone">
                            <div class="m-dropzone__msg dz-message needsclick">
                                <h3 class="m-dropzone__msg-title">
                                    Kéo thả file vào hoặc click để upload
                                </h3>
                                <span class="m-dropzone__msg-desc">Chỉ cho phép upload file office và pdf</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-3">
                        <input type="text" id="tenTaiLieu" class="form-control" placeholder="Nhập Tên Tài Liệu">
                        <input type="hidden" id="maDanhMucTaiLieu" value="">
                    </div>
                    <div class="col-lg-12 mt-3">
                        <textarea class="form-control m-input" id="moTaTaiLieu" placeholder="Nhập mô tả công việc theo từng bước thực hiện" rows="3"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn m-btn--pill btn-secondary" data-dismiss="modal">Hủy</button>
                <button type="button" id="btnUploadTaiLieu" class="btn m-btn--pill btn-accent sbold">Tải Lên</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--END MODAL-->
<!-- BEGIN MODAL-->
<div class="modal fade bs-modal-lg" id="mdThemMoiDanhMucMoRong" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            @if( isset($danhMucTaiLieu))
                @foreach($danhMucTaiLieu as $dm)
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title"> {{ $dm->ten_tai_lieu_mo_rong }} </h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" id="tenTaiLieuMoRong" class="form-control" value="{{ $dm->ten_tai_lieu_mo_rong }}" placeholder="" disabled>
                                <input type="hidden" id="maTaiLieuMoRong" value="{{ $dm->ma_tai_lieu_mo_rong }}">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" id="tenDanhMuc" class="form-control" placeholder="Nhập tên danh mục tài liệu">
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            <div class="modal-footer">
                <button type="button" class="btn m-btn--pill btn-secondary" data-dismiss="modal">Hủy</button>
                <button type="button" id="btnThemMoiDanhMucMoRong" class="btn m-btn--pill btn-primary">Thêm Mới</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--END MODAL-->
