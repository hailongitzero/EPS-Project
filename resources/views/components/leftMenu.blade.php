<?php
/**

 */
//dd($menuData)
?>
<!-- BEGIN: Aside Menu -->
<div
    id="m_ver_menu"
    class="m-aside-menu  m-aside-menu--skin-light m-aside-menu--submenu-skin-light"
    data-menu-vertical="true"
    data-menu-scrollable="false" data-menu-dropdown-timeout="500">
    <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
        <li class="m-menu__item  m-menu__item--active" aria-haspopup="true" >
            <a  href="{{ url('') }}" class="m-menu__link ">
                <i class="m-menu__link-icon flaticon-line-graph" style="color: #e32526"></i>
                <span class="m-menu__link-title">
                <span class="m-menu__link-wrap">
                    <span class="m-menu__link-text">
                        Trang Chủ
                    </span>
                </span>
            </span>
            </a>
        </li>
        <li class="m-menu__section">
            <h4 class="m-menu__section-text">
                Menu
            </h4>
            <i class="m-menu__section-icon flaticon-more-v3"></i>
        </li>
        <li class="m-menu__item" aria-haspopup="true">
            <a  href="{{ url('tra-cuu') }}" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon flaticon-search" style="color: #e32526"></i>
                <span class="m-menu__link-text">Tra Cứu</span>
            </a>
        </li>
        <li class="m-menu__item" aria-haspopup="true">
            <a  href="{{ url('tai-lieu-chia-se') }}" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon flaticon-share" style="color: #e32526"></i>
                <span class="m-menu__link-text">Tài Liệu Chia Sẻ</span>
            </a>
        </li>
        @if( \Illuminate\Support\Facades\Auth::user()->phan_quyen == 2)
            <li class="m-menu__item" aria-haspopup="true">
                <a  href="{{ url('phan-quyen') }}" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-user-ok" style="color: #e32526"></i>
                    <span class="m-menu__link-text">Phân Quyền</span>
                </a>
            </li>
            <li class="m-menu__item" aria-haspopup="true">
                <a  href="{{ url('quan-ly-danh-muc') }}" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-list-2" style="color: #e32526"></i>
                    <span class="m-menu__link-text">Quản Lý Danh Mục</span>
                </a>
            </li>
            <li class="m-menu__item" aria-haspopup="true">
                <a  href="{{ url('quan-ly-nguoi-dung') }}" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-user" style="color: #e32526"></i>
                    <span class="m-menu__link-text">Quản Lý Người Dùng</span>
                </a>
            </li>
        @endif
        <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
            <a  href="#" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon flaticon-layers" style="color: #e32526"></i>
                <span class="m-menu__link-text">Văn bản - Tài liệu mẫu</span>
                <i class="m-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="m-menu__submenu">
                <span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">
                    <li class="m-menu__item  m-menu__item--parent" style="color: #e32526" aria-haspopup="true" >
                        <a  href="javascript:void(0)" class="m-menu__link ">
                            <span class="m-menu__link-text">Văn bản - Tài liệu mẫu</span>
                        </a>
                    </li>
                    @if(isset($menuPhongBan))
                        @foreach($menuPhongBan as $menu)
                            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
                                <a  href="javascript:void(0)" class="m-menu__link m-menu__toggle">
                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot" style="color: #e32526">
                                        <span></span>
                                    </i>
                                    <span class="m-menu__link-text">{{ $menu->ten_tru_so }}</span>
                                    <i class="m-menu__ver-arrow la la-angle-right" style="color: #e32526"></i>
                                </a>
                                <div class="m-menu__submenu">
                                    <span class="m-menu__arrow"></span>
                                    <ul class="m-menu__subnav">
                                        @if( isset($menu->phongBan) )
                                            @foreach($menu->phongBan as $phong)
                                                <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
                                                    <a  href="javascript:void(0)" class="m-menu__link m-menu__toggle">
                                                        <i class="m-menu__link-bullet m-menu__link-bullet--dot" style="color: #e32526">
                                                            <span></span>
                                                        </i>
                                                        <span class="m-menu__link-text">{{ $phong->ten_phong_ban }}</span>
                                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                    </a>
                                                    <div class="m-menu__submenu">
                                                        <span class="m-menu__arrow"></span>
                                                        <ul class="m-menu__subnav">
                                                            @if( isset($phong->toCongTac) )
                                                                @foreach($phong->toCongTac as $to)
                                                                    <li class="m-menu__item " style="color: #e32526" aria-haspopup="true" >
                                                                        <a  href="{{ url('tai-lieu/'.$to->ma_to_cong_tac) }}" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot" style="color: #e32526">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">{{ $to->ten_to_cong_tac }}</span>
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </li>
        @if( isset($menuMoRong) )
            @foreach($menuMoRong as $mr)
                <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
                    <a  href="#" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon flaticon-layers" style="color: #e32526"></i>
                        <span class="m-menu__link-text">{{ $mr->ten_danh_muc_mo_rong }}</span>
                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="m-menu__submenu">
                        <span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item  m-menu__item--parent" style="color: #e32526" aria-haspopup="true" >
                                <a  href="html.html#" class="m-menu__link ">
                                    <span class="m-menu__link-text">{{ $mr->ten_danh_muc_mo_rong }}</span>
                                </a>
                            </li>
                            @if( isset($mr->taiLieuMoRong) )
                                @foreach($mr->taiLieuMoRong as $tl)
                                    <li class="m-menu__item " aria-haspopup="true" >
                                        <a  href="{{ url('tai-lieu-mat/'.$tl->ma_tai_lieu_mo_rong) }}" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot" style="color: #e32526">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text">{{$tl->ten_tai_lieu_mo_rong}}</span>
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </li>
            @endforeach
        @endif
        <li class="m-menu__item" aria-haspopup="true">
            <a  href="{{ url('thu-vien-hinh-anh') }}" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon flaticon-imac" style="color: #e32526"></i>
                <span class="m-menu__link-text">Hình Ảnh</span>
            </a>
        </li>
    </ul>
</div>
<!-- END: Aside Menu -->
