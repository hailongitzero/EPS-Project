<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 10/6/2017
 * Time: 8:31 AM
 */
?>
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <!--begin::Portlet-->
        <div class="m-portlet ml-3">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Danh Mục Tài Liệu
                        </h3>
                    </div>
                    <button type="button" class="btn m-btn--pill btn-primary right" data-toggle="modal" data-target="#mdThemMoiDanhMuc">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="m-portlet__body">
                <div id="mTreeDanhMuc" class="tree-demo">
                    <ul>
                        @if( isset($toCongTac))
                        <li data-jstree='{ "opened" : true }'>
                            @foreach( $toCongTac as $to)
                            {{ $to->ten_to_cong_tac }}
                            @if( isset($to->danhMucTaiLieu))
                                <ul>
                                @foreach( $to->danhMucTaiLieu as $dm)
                                <li>
                                    <a href="{{ url('tai-lieu/'.$to->ma_to_cong_tac.'/danh-muc/'.$dm->ma_danh_muc) }}" class="linkDanhMucTaiLieu" data-content="{{ $dm->ma_danh_muc }}">
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
            </div>
        </div>
        <!--end::Portlet-->
    </div>
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="m-portlet m-portlet--mobile">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span id="tbTaiLieuTitle" class="caption-subject bold uppercase"></span>
                </div>
                <!--<div class="actions">-->
                <!--<div class="btn-group btn-group-devided" data-toggle="buttons">-->
                <!--<label class="btn btn-transparent dark btn-outline btn-circle btn-sm active">-->
                <!--<input type="radio" name="options" class="toggle" id="option1">Actions</label>-->
                <!--<label class="btn btn-transparent dark btn-outline btn-circle btn-sm">-->
                <!--<input type="radio" name="options" class="toggle" id="option2">Settings</label>-->
                <!--</div>-->
                <!--</div>-->
            </div>
            <div class="m-portlet__body">
                <div class="table-toolbar">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <a class="btn btn-accent m-btn--pill sbold" data-toggle="modal" href="#mdAddNewDoc"> Tải Lên <i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        {{--<div class="col-md-6">--}}
                            {{--<div class="btn-group pull-right">--}}
                                {{--<button class="btn green  btn-accent dropdown-toggle" data-toggle="dropdown">Tools</button>--}}
                                {{--<ul class="dropdown-menu pull-right">--}}
                                    {{--<li>--}}
                                        {{--<a href="javascript:;">--}}
                                            {{--<i class="fa fa-print"></i> Print </a>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<a href="javascript:;">--}}
                                            {{--<i class="fa fa-file-pdf-o"></i> Save as PDF </a>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<a href="javascript:;">--}}
                                            {{--<i class="fa fa-file-excel-o"></i> Export to Excel </a>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="documentTable">
                    <thead>
                    <tr>
                        <th width="30px">
                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                <input type="checkbox" class="group-checkable" data-set="#sample_1_2 .checkboxes" />
                                <span></span>
                            </label>
                        </th>
                        <th> Tên Tài Liệu </th>
                        <th> Người Đăng </th>
                        <th> Định Dạng </th>
                        <th>Dung Lượng</th>
                        <th> Ngày Đăng </th>
                        <th> Tùy Chọn </th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th> </th>
                        <th> </th>
                        <th> </th>
                        <th> </th>
                        <th> </th>
                        <th> </th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @if( isset($taiLieu))
                        @foreach($taiLieu as $tl)
                            <tr class="odd gradeX">
                        <td>
                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                <input type="checkbox" class="checkboxes" value="1" />
                                <span></span>
                            </label>
                        </td>
                        <td> {{$tl->ten_tai_lieu}} </td>
                        <td>
                            <a href="mailto:shuxer"> {{$tl->tacGia->ho_ten}} </a>
                        </td>
                        <td>
                            <span class="label label-sm label-success"> {{$tl->dinh_dang}} </span>
                        </td>
                        <td>
                            {{ $tl->dung_luong / 1000 }} mb
                        </td>
                        <td class="center"> {{$tl->ngay_tao}} </td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-action btn-success dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Tùy Chọn
                                </button>
                                <ul class="dropdown-menu pull-left" role="menu">
                                    <li>
                                        <a href="{{url('downloadTaiLieu/'.$tl->ma_tai_lieu)}}" data-content="{{ $tl->ma_tai_lieu }}" class="downloadTaiLieu">
                                            <i class="icon-cloud-download"></i> Tải Về </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="icon-eye"></i> Xem Trước </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
<div class="modal fade bs-modal-lg" id="mdAddNewDoc" tabindex="-1" role="dialog" aria-hidden="true">
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