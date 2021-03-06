<?php
/**

 */?>
<!--extends master template-->
@extends('layouts.main')
<!--end extends master template-->

<!--title site setting-->
@section('title', isset($title) ? $title : 'EPS - Thư viện điện tử')
<!--end title site setting-->

@section('meta-title', isset($metaTitle) ? $metaTitle : 'EPS - Thư viện điện tử')
<!--end title site setting-->

<!--description site setting-->
@section('description', isset($description) ? $description : 'EPS - Thư viện điện tử')
<!--end description site setting-->

<!--content site section-->
@section('dashboard-content')
    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">
    @include('components.header', $userInfo)
    <!-- begin::Body -->
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
            <!-- BEGIN: Left Aside -->
            <button class="m-aside-left-close  m-aside-left-close--skin-light " id="m_aside_left_close_btn">
                <i class="la la-close"></i>
            </button>
            <div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-light ">
                @include('components.leftMenu', $menuData)
            </div>
            <!-- END: Left Aside -->
            <div class="m-grid__item m-grid__item--fluid m-wrapper">
                {{--@include('components.subHeader')--}}
                @include('components.authority', $dsTruSo)
            </div>
        </div>
        <!-- end:: Body -->
        <!-- begin::Footer -->
    @include('components.footer')
    <!-- end::Footer -->
    </div>
    <!-- end:: Page -->
    <!-- begin::Quick Sidebar -->
    <div id="m_quick_sidebar" class="m-quick-sidebar m-quick-sidebar--tabbed m-quick-sidebar--skin-light">
        @include('components.quickSidebar')
    </div>
    <!-- end::Quick Sidebar -->
    <!-- begin::Scroll Top -->
    <div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500" data-scroll-speed="300">
        <i class="la la-arrow-up"></i>
    </div>
    <!-- end::Scroll Top -->
    {{--<!-- begin::Quick Nav -->--}}
    {{--<ul class="m-nav-sticky" style="margin-top: 30px;">--}}
    {{--<li class="m-nav-sticky__item" data-toggle="m-tooltip" title="Purchase" data-placement="left">--}}
    {{--<a href="#" target="_blank">--}}
    {{--<i class="la la-cart-arrow-down"></i>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--<li class="m-nav-sticky__item" data-toggle="m-tooltip" title="Documentation" data-placement="left">--}}
    {{--<a href="#" target="_blank">--}}
    {{--<i class="la la-code-fork"></i>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--<li class="m-nav-sticky__item" data-toggle="m-tooltip" title="Support" data-placement="left">--}}
    {{--<a href="#" target="_blank">--}}
    {{--<i class="la la-life-ring"></i>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--</ul>--}}
@endsection