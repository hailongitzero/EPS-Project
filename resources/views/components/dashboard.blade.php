<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 10/3/2017
 * Time: 11:30 PM
 */
?>
<div class="m-content">
    <!--Begin::Main Portlet-->
    <div class="row">
        <div class="col-md-8 col-xl-8">
            <!--begin:: Widgets/Top Products-->
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
            <!--end:: Widgets/Top Products-->
        </div>
        <div class="col-xl-4 col-md-4">
            <!--begin:: Widgets/Blog-->
            <div class="m-portlet m-portlet--bordered-semi m-portlet--full-height ">
                <div class="m-portlet__head m-portlet__head--fit">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-action">
                            <button type="button" class="btn btn-sm m-btn--pill  btn-brand">
                                Tin Tức
                            </button>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="m-widget19">
                        <div class="m-widget19__pic m-portlet-fit--top m-portlet-fit--sides" style="min-height-: 286px">
                            <img src="/resources/assets/images/blog/blog1.jpg" alt="">
                            <a href="#">
                                <h3 class="m-widget19__title m--font-light">
                                    Introducing New Feature
                                </h3>
                            </a>
                            <div class="m-widget19__shadow"></div>
                        </div>
                        <div class="m-widget19__content mt-4">
                            {{--<div class="m-widget19__header">--}}
                                {{--<div class="m-widget19__user-img">--}}
                                    {{--<img class="m-widget19__img" src="/resources/assets/images/users/user1.jpg" alt="">--}}
                                {{--</div>--}}
                                {{--<div class="m-widget19__info">--}}
                                    {{--<span class="m-widget19__username">--}}
                                        {{--Anna Krox--}}
                                    {{--</span>--}}
                                    {{--<br>--}}
                                    {{--<span class="m-widget19__time">--}}
                                        {{--UX/UI Designer, Google--}}
                                    {{--</span>--}}
                                {{--</div>--}}
                                {{--<div class="m-widget19__stats">--}}
                                    {{--<span class="m-widget19__number m--font-brand">--}}
                                        {{--18--}}
                                    {{--</span>--}}
                                    {{--<span class="m-widget19__comment">--}}
                                        {{--Comments--}}
                                    {{--</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <div class="m-widget19__body">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry scrambled it to make text of the printing and typesetting.
                            </div>
                        </div>
                        <div class="m-widget19__action">
                            <p>
                                <a href="#">Tin Tức 1</a>
                            </p>
                            <p>
                                <a href="#">Tin Tức 2</a>
                            </p>
                            <p>
                                <a href="#">Tin Tức 3</a>
                            </p>
                            <p>
                                <a href="#">Tin Tức 4</a>
                            </p>
                            <p>
                                <a href="#">Tin Tức 5</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!--end:: Widgets/Blog-->
        </div>
    </div>
    <div class="row">
        <div class="col-xl-4">
            <!--begin:: Widgets/Top Products-->
            <div class="m-portlet m-portlet--full-height m-portlet--fit ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Top Người Dùng Tải Lên
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <!--begin::Widget5-->
                    <div class="m-widget4 m-widget4--chart-bottom" style="min-height: 280px">
                        <div class="m-widget4__item">
                            <div class="m-widget4__img m-widget4__img--logo">
                                <img src="/resources/assets/images/client-logos/logo3.png" alt="">
                            </div>
                            <div class="m-widget4__info">
                                <span class="m-widget4__title">
                                    Phyton
                                </span>
                                <br>
                                <span class="m-widget4__sub">
                                    A Programming Language
                                </span>
                            </div>
                            <span class="m-widget4__ext">
                                <span class="m-widget4__number m--font-brand">
                                    17
                                </span>
                            </span>
                        </div>
                        <div class="m-widget4__item">
                            <div class="m-widget4__img m-widget4__img--logo">
                                <img src="/resources/assets/images/client-logos/logo1.png" alt="">
                            </div>
                            <div class="m-widget4__info">
                                <span class="m-widget4__title">
                                    FlyThemes
                                </span>
                                <br>
                                <span class="m-widget4__sub">
                                    A Let's Fly Fast Again Language
                                </span>
                            </div>
                            <span class="m-widget4__ext">
                                <span class="m-widget4__number m--font-brand">
                                    300
                                </span>
                            </span>
                        </div>
                        <div class="m-widget4__item">
                            <div class="m-widget4__img m-widget4__img--logo">
                                <img src="/resources/assets/images/client-logos/logo4.png" alt="">
                            </div>
                            <div class="m-widget4__info">
                                <span class="m-widget4__title">
                                    Starbucks
                                </span>
                                <br>
                                <span class="m-widget4__sub">
                                    Good Coffee & Snacks
                                </span>
                            </div>
                            <span class="m-widget4__ext">
                                <span class="m-widget4__number m--font-brand">
                                    300
                                </span>
                            </span>
                        </div>
                    </div>
                    <!--end::Widget 5-->
                </div>
            </div>
            <!--end:: Widgets/Top Products-->
        </div>
        <div class="col-xl-4">
            <!--begin:: Widgets/Top Products-->
            <div class="m-portlet m-portlet--full-height m-portlet--fit ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Top Tài Liệu Tải Về
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <!--begin::Widget5-->
                    <div class="m-widget4 m-widget4--chart-bottom" style="min-height: 280px">
                        <div class="m-widget4__item">
                            <div class="m-widget4__img m-widget4__img--logo">
                                <img src="/resources/assets/images/client-logos/logo3.png" alt="">
                            </div>
                            <div class="m-widget4__info">
                                <span class="m-widget4__title">
                                    Phyton
                                </span>
                                <br>
                                <span class="m-widget4__sub">
                                    A Programming Language
                                </span>
                            </div>
                            <span class="m-widget4__ext">
                                <span class="m-widget4__number m--font-brand">
                                    +$17
                                </span>
                            </span>
                        </div>
                        <div class="m-widget4__item">
                            <div class="m-widget4__img m-widget4__img--logo">
                                <img src="/resources/assets/images/client-logos/logo1.png" alt="">
                            </div>
                            <div class="m-widget4__info">
                                <span class="m-widget4__title">
                                    FlyThemes
                                </span>
                                <br>
                                <span class="m-widget4__sub">
                                    A Let's Fly Fast Again Language
                                </span>
                            </div>
                            <span class="m-widget4__ext">
                                <span class="m-widget4__number m--font-brand">
                                    +$300
                                </span>
                            </span>
                        </div>
                        <div class="m-widget4__item">
                            <div class="m-widget4__img m-widget4__img--logo">
                                <img src="/resources/assets/images/client-logos/logo4.png" alt="">
                            </div>
                            <div class="m-widget4__info">
													<span class="m-widget4__title">
														Starbucks
													</span>
                                <br>
                                <span class="m-widget4__sub">
														Good Coffee & Snacks
													</span>
                            </div>
                            <span class="m-widget4__ext">
													<span class="m-widget4__number m--font-brand">
														+$300
													</span>
												</span>
                        </div>
                    </div>
                    <!--end::Widget 5-->
                </div>
            </div>
            <!--end:: Widgets/Top Products-->
        </div>
        <div class="col-xl-4">
            <!--begin:: Widgets/Top Products-->
            <div class="m-portlet m-portlet--full-height m-portlet--fit ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Top Tài Liệu Tải Về
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <!--begin::Widget5-->
                    <div class="m-widget4 m-widget4--chart-bottom" style="min-height: 280px">
                        <div class="m-widget4__item">
                            <div class="m-widget4__img m-widget4__img--logo">
                                <img src="/resources/assets/images/client-logos/logo3.png" alt="">
                            </div>
                            <div class="m-widget4__info">
                                <span class="m-widget4__title">
                                    Phyton
                                </span>
                                <br>
                                <span class="m-widget4__sub">
                                    A Programming Language
                                </span>
                            </div>
                            <span class="m-widget4__ext">
                                <span class="m-widget4__number m--font-brand">
                                    +$17
                                </span>
                            </span>
                        </div>
                        <div class="m-widget4__item">
                            <div class="m-widget4__img m-widget4__img--logo">
                                <img src="/resources/assets/images/client-logos/logo1.png" alt="">
                            </div>
                            <div class="m-widget4__info">
                                <span class="m-widget4__title">
                                    FlyThemes
                                </span>
                                <br>
                                <span class="m-widget4__sub">
                                    A Let's Fly Fast Again Language
                                </span>
                            </div>
                            <span class="m-widget4__ext">
                                <span class="m-widget4__number m--font-brand">
                                    +$300
                                </span>
                            </span>
                        </div>
                        <div class="m-widget4__item">
                            <div class="m-widget4__img m-widget4__img--logo">
                                <img src="/resources/assets/images/client-logos/logo4.png" alt="">
                            </div>
                            <div class="m-widget4__info">
													<span class="m-widget4__title">
														Starbucks
													</span>
                                <br>
                                <span class="m-widget4__sub">
														Good Coffee & Snacks
													</span>
                            </div>
                            <span class="m-widget4__ext">
													<span class="m-widget4__number m--font-brand">
														+$300
													</span>
												</span>
                        </div>
                    </div>
                    <!--end::Widget 5-->
                </div>
            </div>
            <!--end:: Widgets/Top Products-->
        </div>
    </div>
</div>
