<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 11/5/2017
 * Time: 3:53 PM
 */?>
<!-- BEGIN: Subheader -->
<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                @if(isset($gallery))
                    {{ $gallery->ten_thu_vien }}
                @endif
            </h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="{{ url('') }}" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                        Trang Chủ
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- END: Subheader -->
<div class="m-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                @if(isset($gallery))
                                    {{ $gallery->ten_thu_vien }}
                                @endif
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                        <div class="row align-items-center">
                            <div class="col-xl-12 order-2 order-xl-1">
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        @if(isset($imageGallery))
                                            @foreach($imageGallery as $key=>$value)
                                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="{{$key == 0 ? 'active' : ''}}"></li>
                                            @endforeach
                                        @endif
                                    </ol>
                                    <div class="carousel-inner" role="listbox">
                                        @if(isset($imageGallery))
                                            @foreach($imageGallery as $key=>$value)
                                                <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                                                    <img class="d-block img-fluid" src="{{ url('resources/'.$value->lien_ket) }}" alt="">
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>