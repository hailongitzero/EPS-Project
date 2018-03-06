<?php
/**

 */?>
<div class="m-content" style="padding-top: 10px; padding-bottom: 0px">
    <!--Begin::Main Portlet-->
    <div class="m-portlet">
        <div class="m-portlet__body  m-portlet__body--no-padding">
            <div class="row m-row--no-padding m-row--col-separator-xl">
                <div class="col-xl-4">
                    <!--begin:: Widgets/Stats2-1 -->
                    <div class="m-widget1">
                        <div class="m-widget1__item">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <h3 class="m-widget1__title">
                                        Số tài liệu tải lên
                                    </h3>
                                    <span class="m-widget1__desc">
															Tính trung bình theo tuần
														</span>
                                </div>
                                <div class="col m--align-right">
														<span class="m-widget1__number m--font-brand">
															+200
														</span>
                                </div>
                            </div>
                        </div>
                        <div class="m-widget1__item">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <h3 class="m-widget1__title">
                                        Số lượt tải về
                                    </h3>
                                    <span class="m-widget1__desc">
															Tính trung bình theo tuần
														</span>
                                </div>
                                <div class="col m--align-right">
														<span class="m-widget1__number m--font-danger">
															+500
														</span>
                                </div>
                            </div>
                        </div>
                        <div class="m-widget1__item">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <h3 class="m-widget1__title">
                                        Số lượt người truy cập
                                    </h3>
                                    <span class="m-widget1__desc">
															Tính trung bình theo tuần
														</span>
                                </div>
                                <div class="col m--align-right">
														<span class="m-widget1__number m--font-success">
															+27,49%
														</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end:: Widgets/Stats2-1 -->
                </div>
                <div class="col-xl-4">
                    <!--begin:: Widgets/Daily Sales-->
                    <div class="m-widget14">
                        <div class="m-widget14__header m--margin-bottom-30">
                            <h3 class="m-widget14__title">
                                Lượt đồ tải lên hằng ngày
                            </h3>
                            <span class="m-widget14__desc">
													Di chuyển con trỏ lên biểu đồ để xem số liệu chi tiết
												</span>
                        </div>
                        <div class="m-widget14__chart" style="height:120px;">
                            <canvas  id="m_chart_daily_sales"></canvas>
                        </div>
                    </div>
                    <!--end:: Widgets/Daily Sales-->
                </div>
                <div class="col-xl-4">
                    <!--begin:: Widgets/Profit Share-->
                    <div class="m-widget14">
                        <div class="m-widget14__header">
                            <h3 class="m-widget14__title">
                                Tỷ lệ các loại tài liệu
                            </h3>
                            <span class="m-widget14__desc">
													Trên tổng số tài liệu được tải lên
												</span>
                        </div>
                        <div class="row  align-items-center">
                            <div class="col">
                                <div id="m_chart_profit_share" class="m-widget14__chart" style="height: 160px">
                                    <div class="m-widget14__stat">
                                        45
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="m-widget14__legends">
                                    <div class="m-widget14__legend">
                                        <span class="m-widget14__legend-bullet m--bg-accent"></span>
                                        <span class="m-widget14__legend-text">
																37% Tài liệu hành chính
															</span>
                                    </div>
                                    <div class="m-widget14__legend">
                                        <span class="m-widget14__legend-bullet m--bg-warning"></span>
                                        <span class="m-widget14__legend-text">
																47% Tài liệu kỹ thuật
															</span>
                                    </div>
                                    <div class="m-widget14__legend">
                                        <span class="m-widget14__legend-bullet m--bg-brand"></span>
                                        <span class="m-widget14__legend-text">
																19% Khác
															</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end:: Widgets/Profit Share-->
                </div>
            </div>
        </div>
    </div>
    <!--End::Main Portlet-->
    <!--Begin::Main Portlet-->
    <div class="row">
        <div class="col-xl-6">
            <div class="m-portlet m-portlet--full-height ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text" style="font-weight: bold; color: #2f70a7">
                                Hình ảnh công ty EPS
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    @if(isset($slider))
                        @foreach( $slider as $sld)
                            <div id="carouselDashboard" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    @if(isset($sld->hinhAnh ))
                                        @foreach($sld->hinhAnh as $key=>$value)
                                            <li data-target="#carouselDashboard" data-slide-to="0" class="{{$key == 0 ? 'active' : ''}}"></li>
                                        @endforeach
                                    @endif
                                </ol>
                                <div class="carousel-inner" role="listbox">
                                    @if(isset($sld->hinhAnh))
                                        @foreach($sld->hinhAnh as $key=>$value)
                                            <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                                                <img class="d-block img-fluid" src="{{ url('resources/'.$value->lien_ket) }}" alt="">
                                            </div>
                                            <div class="carousel-caption">
                                                <h3>{{$sld->ten_thu_vien}}</h3>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <a class="carousel-control-prev" href="#carouselDashboard" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselDashboard" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <!--begin:: Widgets/Support Tickets -->
            <div class="m-portlet m-portlet--full-height ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text" style="font-weight: bold;color: #2f70a7">
                                Danh sách các bài đăng (Mới)
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover" aria-expanded="true">
                                <a href="html.html#" class="m-portlet__nav-link m-portlet__nav-link--icon m-portlet__nav-link--icon-xl m-dropdown__toggle">
                                    <i class="la la-ellipsis-h m--font-brand"></i>
                                </a>
                                <div class="m-dropdown__wrapper">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__content">
                                                <ul class="m-nav">
                                                    <li class="m-nav__item">
                                                        <a href="html.html" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-share"></i>
                                                            <span class="m-nav__link-text">
																					Activity
																				</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="html.html" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                            <span class="m-nav__link-text">
																					Messages
																				</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="html.html" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-info"></i>
                                                            <span class="m-nav__link-text">
																					FAQ
																				</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="html.html" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                            <span class="m-nav__link-text">
																					Support
																				</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="m-widget3">
                        <div class="m-widget3__item">
                            <div class="m-widget3__header">
                                <div class="m-widget3__user-img">
                                    <img class="m-widget3__img" src="assets/app/media/img/users/user1.jpg" alt="">
                                </div>
                                <div class="m-widget3__info">
														<span class="m-widget3__username" style="color: red; font-size:20px">
															Nguyễn Văn A
														</span>
                                    <br>
                                    <span class="m-widget3__time">
															Cách đây 1 giờ
														</span>
                                </div>
                                <span class="m-widget3__status m--font-info">
														<a href="#">*.pdf</a>
													</span>
                            </div>
                            <div class="m-widget3__body">
                                <p class="m-widget3__text" style="padding-left: 14px">
                                    Đã tải lên tài liệu "Hướng dẫn cách sử dụng Power Point 2010 của Microsoft"
                                </p>
                            </div>
                        </div>
                        <div class="m-widget3__item">
                            <div class="m-widget3__header">
                                <div class="m-widget3__user-img">
                                    <img class="m-widget3__img" src="assets/app/media/img/users/user4.jpg" alt="">
                                </div>
                                <div class="m-widget3__info">
														<span class="m-widget3__username" style="color: red; font-size:20px">
															Nguyễn Văn B
														</span>
                                    <br>
                                    <span class="m-widget3__time">
															Cách đây 2 giờ 30 phút
														</span>
                                </div>
                                <span class="m-widget3__status m--font-brand">
														<a href="#">*.xlsx</a>
													</span>
                            </div>
                            <div class="m-widget3__body">
                                <p class="m-widget3__text"style="padding-left: 14px">
                                    Đã tải lên tài liệu "Hướng dẫn cách sử dụng & cài đặt phần mềm ERP"
                                </p>
                            </div>
                        </div>
                        <div class="m-widget3__item">
                            <div class="m-widget3__header">
                                <div class="m-widget3__user-img">
                                    <img class="m-widget3__img" src="assets/app/media/img/users/user5.jpg" alt="">
                                </div>
                                <div class="m-widget3__info">
														<span class="m-widget3__username" style="color: red; font-size:20px">
															Nguyễn Văn C
														</span>
                                    <br>
                                    <span class="m-widget3__time">
															Cách đây 6 giờ
														</span>
                                </div>
                                <span class="m-widget3__status m--font-success">
														<a href="#">*.pdf</a>
													</span>
                            </div>
                            <div class="m-widget3__body">
                                <p class="m-widget3__text"style="padding-left: 14px">
                                    Đã tải lên tài liệu "Hướng dẫn cách cài đặt và thiết lập hệ thống SAM"
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end:: Widgets/Support Tickets -->
        </div>
    </div>
    <!--End::Main Portlet-->
    <!--Begin::Main Portlet-->
    <div class="row">
        <div class="col-xl-4">
            <!--begin:: Widgets/Audit Log-->
            <div class="m-portlet m-portlet--full-height ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text" style="font-weight: bold; color: #2f70a7">
                                <i class="fa fa-upload" style="font-weight: bold;color: #F3565D"></i> Top tải về
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
                            {{--<li class="nav-item m-tabs__item">--}}
                            {{--<a class="nav-link m-tabs__link active" data-toggle="tab" href="html.html#m_widget4_tab1_content" role="tab">--}}
                            {{--Tuần--}}
                            {{--</a>--}}
                            {{--</li>--}}
                            {{--<li class="nav-item m-tabs__item">--}}
                            {{--<a class="nav-link m-tabs__link" data-toggle="tab" href="html.html#m_widget4_tab2_content" role="tab">--}}
                            {{--Tháng--}}
                            {{--</a>--}}
                            {{--</li>--}}
                            {{--<li class="nav-item m-tabs__item">--}}
                            {{--<a class="nav-link m-tabs__link" data-toggle="tab" href="html.html#m_widget4_tab3_content" role="tab">--}}
                            {{--Năm--}}
                            {{--</a>--}}
                            {{--</li>--}}
                        </ul>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="m_widget4_tab1_content">
                            <div class="m-scrollable" data-scrollable="true" data-max-height="400" style="height: 400px; overflow: hidden;">
                                <div class="m-list-timeline m-list-timeline--skin-light">
                                    <div class="m-list-timeline__items">
                                        <div class="m-list-timeline__item">
                                            <span class="m-list-timeline__badge m-list-timeline__badge--success"></span>
                                            <span class="m-list-timeline__text">
																	Nguyễn Văn G
																	<span class="m-badge m-badge--success m-badge--wide">
																		01
																	</span>
																</span>
                                            <span class="m-list-timeline__time">
																	1000 tài liệu
																</span>
                                        </div>
                                        <div class="m-list-timeline__item">
                                            <span class="m-list-timeline__badge m-list-timeline__badge--info"></span>
                                            <span class="m-list-timeline__text">
																	Nguyễn Văn H
																	<span class="m-badge m-badge--success m-badge--wide">
																		02
																	</span>
																</span>
                                            <span class="m-list-timeline__time">
																	950 tài liệu
																</span>
                                        </div>
                                        <div class="m-list-timeline__item">
                                            <span class="m-list-timeline__badge m-list-timeline__badge--danger"></span>
                                            <span class="m-list-timeline__text">
																	Nguyễn Văn T
																	<span class="m-badge m-badge--success m-badge--wide">
																		03
																	</span>
																</span>
                                            <span class="m-list-timeline__time">
																	888 tài liệu
																</span>
                                        </div>
                                        <div class="m-list-timeline__item">
                                            <span class="m-list-timeline__badge m-list-timeline__badge--danger"></span>
                                            <span class="m-list-timeline__text">
																	Nguyễn Văn A
																	<span class="m-badge m-badge--success m-badge--wide">
																		04
																	</span>
																</span>
                                            <span class="m-list-timeline__time">
																	788 tài liệu
																</span>
                                        </div>
                                        <div class="m-list-timeline__item">
                                            <span class="m-list-timeline__badge m-list-timeline__badge--danger"></span>
                                            <span class="m-list-timeline__text">
																	Nguyễn Văn B
																	<span class="m-badge m-badge--success m-badge--wide">
																		05
																	</span>
																</span>
                                            <span class="m-list-timeline__time">
																	748 tài liệu
																</span>
                                        </div>
                                        <div class="m-list-timeline__item">
                                            <span class="m-list-timeline__badge m-list-timeline__badge--danger"></span>
                                            <span class="m-list-timeline__text">
																	Nguyễn Văn C
																	<span class="m-badge m-badge--success m-badge--wide">
																		06
																	</span>
																</span>
                                            <span class="m-list-timeline__time">
																	448 tài liệu
																</span>
                                        </div>
                                        <div class="m-list-timeline__item">
                                            <span class="m-list-timeline__badge m-list-timeline__badge--danger"></span>
                                            <span class="m-list-timeline__text">
																	Nguyễn Văn E
																	<span class="m-badge m-badge--success m-badge--wide">
																		07
																	</span>
																</span>
                                            <span class="m-list-timeline__time">
																	321 tài liệu
																</span>
                                        </div>
                                        <div class="m-list-timeline__item">
                                            <span class="m-list-timeline__badge m-list-timeline__badge--danger"></span>
                                            <span class="m-list-timeline__text">
																	Nguyễn Văn S
																	<span class="m-badge m-badge--success m-badge--wide">
																		08
																	</span>
																</span>
                                            <span class="m-list-timeline__time">
																	121 tài liệu
																</span>
                                        </div>
                                        <div class="m-list-timeline__item">
                                            <span class="m-list-timeline__badge m-list-timeline__badge--danger"></span>
                                            <span class="m-list-timeline__text">
																	Nguyễn Văn J
																	<span class="m-badge m-badge--success m-badge--wide">
																		09
																	</span>
																</span>
                                            <span class="m-list-timeline__time">
																	021 tài liệu
																</span>
                                        </div>
                                        <div class="m-list-timeline__item">
                                            <span class="m-list-timeline__badge m-list-timeline__badge--danger"></span>
                                            <span class="m-list-timeline__text">
																	Nguyễn Văn K
																	<span class="m-badge m-badge--success m-badge--wide">
																		10
																	</span>
																</span>
                                            <span class="m-list-timeline__time">
																	011 tài liệu
																</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="m_widget4_tab2_content"></div>
                        <div class="tab-pane" id="m_widget4_tab3_content"></div>
                    </div>
                </div>
            </div>
            <!--end:: Widgets/Audit Log-->
        </div>
        <div class="col-xl-4">
            <!--begin:: Widgets/Audit Log-->
            <div class="m-portlet m-portlet--full-height ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text" style="font-weight: bold; color: #2f70a7">
                                <i class="fa fa-download" style="font-weight: bold;color: #F3565D"></i> Tài liệu mới tải lên
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
                            {{--<li class="nav-item m-tabs__item">--}}
                            {{--<a class="nav-link m-tabs__link active" data-toggle="tab" href="html.html#m_widget4_tab1_content" role="tab">--}}
                            {{--Tuần--}}
                            {{--</a>--}}
                            {{--</li>--}}
                            {{--<li class="nav-item m-tabs__item">--}}
                            {{--<a class="nav-link m-tabs__link" data-toggle="tab" href="html.html#m_widget4_tab2_content" role="tab">--}}
                            {{--Tháng--}}
                            {{--</a>--}}
                            {{--</li>--}}
                            {{--<li class="nav-item m-tabs__item">--}}
                            {{--<a class="nav-link m-tabs__link" data-toggle="tab" href="html.html#m_widget4_tab3_content" role="tab">--}}
                            {{--Năm--}}
                            {{--</a>--}}
                            {{--</li>--}}
                        </ul>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="m_widget4_tab1_content">
                            <div class="m-scrollable" data-scrollable="true" data-max-height="400" style="height: 400px; overflow: hidden;">
                                <div class="m-list-timeline m-list-timeline--skin-light">
                                    <div class="m-list-timeline__items">
                                        <div class="m-list-timeline__item">
                                            <span class="m-list-timeline__badge m-list-timeline__badge--success"></span>
                                            <span class="m-list-timeline__text">
																	Nguyễn Văn P
																	<span class="m-badge m-badge--success m-badge--wide">
																		01
																	</span>
																</span>
                                            <span class="m-list-timeline__time">
																	1000 tài liệu
																</span>
                                        </div>
                                        <div class="m-list-timeline__item">
                                            <span class="m-list-timeline__badge m-list-timeline__badge--info"></span>
                                            <span class="m-list-timeline__text">
																	Nguyễn văn K
																	<span class="m-badge m-badge--success m-badge--wide">
																		02
																	</span>
																</span>
                                            <span class="m-list-timeline__time">
																	950 tài liệu
																</span>
                                        </div>
                                        <div class="m-list-timeline__item">
                                            <span class="m-list-timeline__badge m-list-timeline__badge--danger"></span>
                                            <span class="m-list-timeline__text">
																	Nguyễn Văn N
																	<span class="m-badge m-badge--success m-badge--wide">
																		03
																	</span>
																</span>
                                            <span class="m-list-timeline__time">
																	888 tài liệu
																</span>
                                        </div>
                                        <div class="m-list-timeline__item">
                                            <span class="m-list-timeline__badge m-list-timeline__badge--danger"></span>
                                            <span class="m-list-timeline__text">
																	Nguyễn Văn A
																	<span class="m-badge m-badge--success m-badge--wide">
																		04
																	</span>
																</span>
                                            <span class="m-list-timeline__time">
																	788 tài liệu
																</span>
                                        </div>
                                        <div class="m-list-timeline__item">
                                            <span class="m-list-timeline__badge m-list-timeline__badge--danger"></span>
                                            <span class="m-list-timeline__text">
																	Nguyễn Văn B
																	<span class="m-badge m-badge--success m-badge--wide">
																		05
																	</span>
																</span>
                                            <span class="m-list-timeline__time">
																	748 tài liệu
																</span>
                                        </div>
                                        <div class="m-list-timeline__item">
                                            <span class="m-list-timeline__badge m-list-timeline__badge--danger"></span>
                                            <span class="m-list-timeline__text">
																	Nguyễn Văn C
																	<span class="m-badge m-badge--success m-badge--wide">
																		06
																	</span>
																</span>
                                            <span class="m-list-timeline__time">
																	448 tài liệu
																</span>
                                        </div>
                                        <div class="m-list-timeline__item">
                                            <span class="m-list-timeline__badge m-list-timeline__badge--danger"></span>
                                            <span class="m-list-timeline__text">
																	Nguyễn Văn L
																	<span class="m-badge m-badge--success m-badge--wide">
																		07
																	</span>
																</span>
                                            <span class="m-list-timeline__time">
																	321 tài liệu
																</span>
                                        </div>
                                        <div class="m-list-timeline__item">
                                            <span class="m-list-timeline__badge m-list-timeline__badge--danger"></span>
                                            <span class="m-list-timeline__text">
																	Nguyễn Văn V
																	<span class="m-badge m-badge--success m-badge--wide">
																		08
																	</span>
																</span>
                                            <span class="m-list-timeline__time">
																	121 tài liệu
																</span>
                                        </div>
                                        <div class="m-list-timeline__item">
                                            <span class="m-list-timeline__badge m-list-timeline__badge--danger"></span>
                                            <span class="m-list-timeline__text">
																	Nguyễn Văn E
																	<span class="m-badge m-badge--success m-badge--wide">
																		09
																	</span>
																</span>
                                            <span class="m-list-timeline__time">
																	021 tài liệu
																</span>
                                        </div>
                                        <div class="m-list-timeline__item">
                                            <span class="m-list-timeline__badge m-list-timeline__badge--danger"></span>
                                            <span class="m-list-timeline__text">
																	Nguyễn Văn R
																	<span class="m-badge m-badge--success m-badge--wide">
																		10
																	</span>
																</span>
                                            <span class="m-list-timeline__time">
																	011 tài liệu
																</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="m_widget4_tab2_content"></div>
                        <div class="tab-pane" id="m_widget4_tab3_content"></div>
                    </div>
                </div>
            </div>
            <!--end:: Widgets/Audit Log-->
        </div>
        <div class="col-xl-4">
            <!--begin:: Widgets/Audit Log-->
            <div class="m-portlet m-portlet--full-height ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text" style="font-weight: bold; color: #2f70a7">
                                <i class="fa fa-book" style="font-weight: bold;color: #F3565D"></i> Tài liệu xem nhiều
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
                            {{--<li class="nav-item m-tabs__item">--}}
                            {{--<a class="nav-link m-tabs__link active" data-toggle="tab" href="html.html#m_widget4_tab1_content" role="tab">--}}
                            {{--Tuần--}}
                            {{--</a>--}}
                            {{--</li>--}}
                            {{--<li class="nav-item m-tabs__item">--}}
                            {{--<a class="nav-link m-tabs__link" data-toggle="tab" href="html.html#m_widget4_tab2_content" role="tab">--}}
                            {{--Tháng--}}
                            {{--</a>--}}
                            {{--</li>--}}
                            {{--<li class="nav-item m-tabs__item">--}}
                            {{--<a class="nav-link m-tabs__link" data-toggle="tab" href="html.html#m_widget4_tab3_content" role="tab">--}}
                            {{--Năm--}}
                            {{--</a>--}}
                            {{--</li>--}}
                        </ul>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="m_widget4_tab1_content">
                            <div class="m-scrollable" data-scrollable="true" data-max-height="400" style="height: 400px; overflow: hidden;">
                                <div class="m-list-timeline m-list-timeline--skin-light">
                                    <div class="m-list-timeline__items">
                                        <div class="m-list-timeline__item">
                                            <span class="m-list-timeline__badge m-list-timeline__badge--info"></span>
                                            <span class="m-list-timeline__text" >
																	Hướng dẫn sử dụng PowerPoint 2010
																	<span class="m-badge m-badge--success m-badge--wide">
																		<a href="#">*.pdf</a>
																	</span>
																</span>
                                            <span class="m-list-timeline__time">
																	1000 lượt
																</span>
                                        </div>
                                        <div class="m-list-timeline__item">
                                            <span class="m-list-timeline__badge m-list-timeline__badge--info"></span>
                                            <span class="m-list-timeline__text">
																	Hướng dẫn sử dụng Excel 2010
																	<span class="m-badge m-badge--success m-badge--wide">
																		<a href="#">*.pdf</a>
																	</span>
																</span>
                                            <span class="m-list-timeline__time">
																	592 lượt
																</span>
                                        </div>
                                        <div class="m-list-timeline__item">
                                            <span class="m-list-timeline__badge m-list-timeline__badge--info"></span>
                                            <span class="m-list-timeline__text">
																	Hướng dẫn sử dụng Word 2010
																	<span class="m-badge m-badge--success m-badge--wide">
																		<a href="#">*.pdf</a>
																	</span>
																</span>
                                            <span class="m-list-timeline__time">
																	289 lượt
																</span>
                                        </div>
                                        <div class="m-list-timeline__item">
                                            <span class="m-list-timeline__badge m-list-timeline__badge--info"></span>
                                            <span class="m-list-timeline__text">
																	Hướng dẫn sử dụng Phần mềm HRMS
																	<span class="m-badge m-badge--success m-badge--wide">
																		<a href="#">*.docx</a>
																	</span>
																</span>
                                            <span class="m-list-timeline__time">
																	100 lượt
																</span>
                                        </div>
                                        <div class="m-list-timeline__item">
                                            <span class="m-list-timeline__badge m-list-timeline__badge--info"></span>
                                            <span class="m-list-timeline__text">
																	Kỹ thuật A
																	<span class="m-badge m-badge--success m-badge--wide">
																		<a href="#">*.docx</a>
																	</span>
																</span>
                                            <span class="m-list-timeline__time">
																	99 lượt
																</span>
                                        </div>
                                        <div class="m-list-timeline__item">
                                            <span class="m-list-timeline__badge m-list-timeline__badge--info"></span>
                                            <span class="m-list-timeline__text">
																	Kỹ thuật B
																	<span class="m-badge m-badge--success m-badge--wide">
																		<a href="#">*.docx</a>
																	</span>
																</span>
                                            <span class="m-list-timeline__time">
																	50 lượt
																</span>
                                        </div>
                                        <div class="m-list-timeline__item">
                                            <span class="m-list-timeline__badge m-list-timeline__badge--info"></span>
                                            <span class="m-list-timeline__text">
																	Kỹ thuật B
																	<span class="m-badge m-badge--success m-badge--wide">
																		<a href="#">*.docx</a>
																	</span>
																</span>
                                            <span class="m-list-timeline__time">
																	50 lượt
																</span>
                                        </div>
                                        <div class="m-list-timeline__item">
                                            <span class="m-list-timeline__badge m-list-timeline__badge--info"></span>
                                            <span class="m-list-timeline__text">
																	Kỹ thuật B
																	<span class="m-badge m-badge--success m-badge--wide">
																		<a href="#">*.docx</a>
																	</span>
																</span>
                                            <span class="m-list-timeline__time">
																	50 lượt
																</span>
                                        </div>
                                        <div class="m-list-timeline__item">
                                            <span class="m-list-timeline__badge m-list-timeline__badge--info"></span>
                                            <span class="m-list-timeline__text">
																	Kỹ thuật B
																	<span class="m-badge m-badge--success m-badge--wide">
																		<a href="#">*.docx</a>
																	</span>
																</span>
                                            <span class="m-list-timeline__time">
																	50 lượt
																</span>
                                        </div>
                                        <div class="m-list-timeline__item">
                                            <span class="m-list-timeline__badge m-list-timeline__badge--info"></span>
                                            <span class="m-list-timeline__text">
																	Kỹ thuật B
																	<span class="m-badge m-badge--success m-badge--wide">
																		<a href="#">*.docx</a>
																	</span>
																</span>
                                            <span class="m-list-timeline__time">
																	50 lượt
																</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="m_widget4_tab2_content"></div>
                        <div class="tab-pane" id="m_widget4_tab3_content"></div>
                    </div>
                </div>
            </div>
            <!--end:: Widgets/Audit Log-->
        </div>
    </div>
</div>