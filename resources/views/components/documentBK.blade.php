<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 10/6/2017
 * Time: 8:31 AM
 */
?>
<!-- BEGIN: Subheader -->
<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Remote Data
            </h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="data-ajax.html#" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
                <li class="m-nav__separator">
                    -
                </li>
                <li class="m-nav__item">
                    <a href="data-ajax.html" class="m-nav__link">
											<span class="m-nav__link-text">
												Datatables
											</span>
                    </a>
                </li>
                <li class="m-nav__separator">
                    -
                </li>
                <li class="m-nav__item">
                    <a href="data-ajax.html" class="m-nav__link">
											<span class="m-nav__link-text">
												Base
											</span>
                    </a>
                </li>
                <li class="m-nav__separator">
                    -
                </li>
                <li class="m-nav__item">
                    <a href="data-ajax.html" class="m-nav__link">
											<span class="m-nav__link-text">
												Ajax Data
											</span>
                    </a>
                </li>
            </ul>
        </div>
        <div>
            <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover" aria-expanded="true">
                <a href="data-ajax.html#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
                    <i class="la la-plus m--hide"></i>
                    <i class="la la-ellipsis-h"></i>
                </a>
                <div class="m-dropdown__wrapper">
                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                    <div class="m-dropdown__inner">
                        <div class="m-dropdown__body">
                            <div class="m-dropdown__content">
                                <ul class="m-nav">
                                    <li class="m-nav__section m-nav__section--first m--hide">
															<span class="m-nav__section-text">
																Quick Actions
															</span>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="data-ajax.html" class="m-nav__link">
                                            <i class="m-nav__link-icon flaticon-share"></i>
                                            <span class="m-nav__link-text">
																	Activity
																</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="data-ajax.html" class="m-nav__link">
                                            <i class="m-nav__link-icon flaticon-chat-1"></i>
                                            <span class="m-nav__link-text">
																	Messages
																</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="data-ajax.html" class="m-nav__link">
                                            <i class="m-nav__link-icon flaticon-info"></i>
                                            <span class="m-nav__link-text">
																	FAQ
																</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="data-ajax.html" class="m-nav__link">
                                            <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                            <span class="m-nav__link-text">
																	Support
																</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__separator m-nav__separator--fit"></li>
                                    <li class="m-nav__item">
                                        <a href="data-ajax.html#" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">
                                            Submit
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div id="mTreeDanhMuc" class="tree-demo">
                        <ul>
                            @if( isset($toCongTac))
                                <li class="jstree-open">
                                    @foreach( $toCongTac as $to)
                                        {{ $to->ten_to_cong_tac }}
                                        @if( isset($to->danhMucTaiLieu))
                                            <ul>
                                                @foreach( $to->danhMucTaiLieu as $dm)
                                                    <li>
                                                        <a href="#" class="linkDanhMucTaiLieu" data-content="{{ $dm->ma_danh_muc }}">
                                                            {{ $dm->ten_danh_muc }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    @endforeach
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="alert alert-success m--margin-top-10 text-center">
                        <button type="button" class="btn m-btn--pill btn-primary" data-toggle="modal" data-target="#mdThemMoiDanhMuc">
                            Thêm Mới Danh Mục
                        </button>
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
                                @if( isset($toCongTac))
                                    @foreach( $toCongTac as $to)
                                    {{ $to->ten_to_cong_tac }}
                                    @endforeach
                                @endif
                                <small id="tbTitleSec">

                                </small>
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover" aria-expanded="true">
                                    <a href="data-ajax.html#" class="
            m-portlet__nav-link m-portlet__nav-link--icon m-portlet__nav-link--icon-xl m-dropdown__toggle">
                                        <i class="la la-plus m--hide"></i>
                                        <i class="la la-ellipsis-h m--font-brand"></i>
                                    </a>
                                    <div class="m-dropdown__wrapper">
                                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                        <div class="m-dropdown__inner">
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__content">
                                                    <ul class="m-nav">
                                                        <li class="m-nav__section m-nav__section--first">
                                                                                <span class="m-nav__section-text">
                                                                                    Quick Actions
                                                                                </span>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="data-ajax.html" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-share"></i>
                                                                <span class="m-nav__link-text">
                                                                                        Create Post
                                                                                    </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="data-ajax.html" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                                <span class="m-nav__link-text">
                                                                                        Send Messages
                                                                                    </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="data-ajax.html" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-multimedia-2"></i>
                                                                <span class="m-nav__link-text">
                                                                                        Upload File
                                                                                    </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__section">
                                                                                <span class="m-nav__section-text">
                                                                                    Useful Links
                                                                                </span>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="data-ajax.html" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-info"></i>
                                                                <span class="m-nav__link-text">
                                                                                        FAQ
                                                                                    </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="data-ajax.html" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                                <span class="m-nav__link-text">
                                                                                        Support
                                                                                    </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__separator m-nav__separator--fit m--hide"></li>
                                                        <li class="m-nav__item m--hide">
                                                            <a href="data-ajax.html#" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">
                                                                Submit
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <!--begin: Search Form -->
                    <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                        <div class="row align-items-center">
                            <div class="col-xl-8 order-2 order-xl-1">
                                <div class="form-group m-form__group row align-items-center">
                                    <div class="col-md-4">
                                        <div class="m-form__group m-form__group--inline">
                                            <div class="m-form__label">
                                                <label>
                                                    Status:
                                                </label>
                                            </div>
                                            <div class="m-form__control">
                                                <select class="form-control m-bootstrap-select" id="m_form_status">
                                                    <option value="">
                                                        All
                                                    </option>
                                                    <option value="1">
                                                        Pending
                                                    </option>
                                                    <option value="2">
                                                        Delivered
                                                    </option>
                                                    <option value="3">
                                                        Canceled
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="d-md-none m--margin-bottom-10"></div>
                                    </div>
                                    <!--<div class="col-md-4">
                                        <div class="m-form__group m-form__group--inline">
                                            <div class="m-form__label">
                                                <label class="m-label m-label--single">
                                                    Type:
                                                </label>
                                            </div>
                                            <div class="m-form__control">
                                                <select class="form-control m-bootstrap-select" id="m_form_type">
                                                    <option value="">
                                                        All
                                                    </option>
                                                    <option value="1">
                                                        Online
                                                    </option>
                                                    <option value="2">
                                                        Retail
                                                    </option>
                                                    <option value="3">
                                                        Direct
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="d-md-none m--margin-bottom-10"></div>
                                    </div>-->
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
                                <a href="#" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" data-toggle="modal" data-target="#mdThemMoiTaiLieu">
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
                    <div class="m_datatable" id="mTbDocument"></div>
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
<div class="modal fade bs-modal-lg" id="mdThemMoiDanhMuc" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            @if( isset($toCongTac))
                @foreach($toCongTac as $to)
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title"> {{ $to->ten_to_cong_tac }} </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="text" id="tenToCongTac" class="form-control" value="{{ $to->ten_to_cong_tac }}" placeholder="" disabled>
                            <input type="hidden" id="maTocCongTac" value="{{ $to->ma_to_cong_tac }}">
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
                <button type="button" id="btnThemMoiDanhMuc" class="btn m-btn--pill btn-primary">Thêm Mới</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--END MODAL-->