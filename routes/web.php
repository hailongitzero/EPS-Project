<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function (){
    Route::get('/phan-quyen', 'AdminController@loadPhanQuyen');
    Route::get('/tai-lieu/{id}', 'DocumentController@dsDanhMucTheoTo');

    Route::get('/tai-lieu-mat/{id}', 'DocumentController@dsDanhMucMoRong');

    Route::get('/tai-lieu-chia-se', 'DocumentController@shareDocument');

    Route::get('/thu-vien-hinh-anh/', 'GalleryController@getAllGallery');

    Route::get('themDanhMuc', 'DocumentController@themMoiDanhMuc');
    Route::post('themDanhMuc', 'DocumentController@themMoiDanhMuc');

    Route::post('danh-sach-tai-lieu', 'DocumentController@dsTaiLieuTheoDanhMuc');
    Route::get('danh-sach-tai-lieu', 'DocumentController@dsTaiLieuTheoDanhMuc');

    Route::get('tra-cuu', 'DocumentController@fnTraCuuForm');
    Route::post('tra-cuu-tai-lieu', 'DocumentController@fnTraCuu');
    Route::get('tra-cuu-tai-lieu', 'DocumentController@fnTraCuu');

    Route::get('/tai-lieu/{id}/danh-muc/{id-danh-muc}', 'DocumentController@dsTaiLieuTheoDanhMucTo');

    Route::get('/downloadTaiLieu/{id}', 'DocumentController@downloadTaiLieu');

    Route::post('/uploadTaiLieu', 'DocumentController@uploadTaiLieu');
    Route::get('uploadTaiLieu', 'DocumentController@uploadTaiLieu');

    Route::post('/xoa-tai-lieu', 'DocumentController@capNhatTrangThaiTaiLieu');
    Route::get('xoa-tai-lieu', 'DocumentController@capNhatTrangThaiTaiLieu');

    Route::post('/cap-nhat-mo-ta-tai-lieu', 'DocumentController@capNhatMoTaTaiLieu');
    Route::get('cap-nhat-mo-ta-tai-lieu', 'DocumentController@capNhatMoTaTaiLieu');

    Route::post('/chia-se-tai-lieu', 'DocumentController@chiaSeTaiLieu');
    Route::get('chia-se-tai-lieu', 'DocumentController@chiaSeTaiLieu');

    Route::post('/thu-vien-hinh', 'GalleryController@getThuVienHinh');
    Route::get('/thu-vien-hinh', 'GalleryController@getThuVienHinh');

    Route::post('/themGallery', 'GalleryController@themMoiGallery');
    Route::get('/themGallery', 'GalleryController@themMoiGallery');

    Route::post('/themGalleryImages', 'GalleryController@themMoiGalleryImages');
    Route::get('/themGalleryImages', 'GalleryController@themMoiGalleryImages');

    Route::post('/deleteGallery', 'GalleryController@updateGalleryStatus');
    Route::get('/deleteGallery', 'GalleryController@updateGalleryStatus');

//    Route::post('/deleteGallery', 'GalleryController@downloadImageZip');
    Route::get('/download-gallery/{id}', 'GalleryController@downloadImageZip');

    Route::get('/slide-hinh/{id}', 'GalleryController@showImageGallery');

    //Route phan quyen
    Route::post('/tim-nhan-vien-phan-quyen', 'AdminController@getUserPhanQuyen');
    Route::get('/tim-nhan-vien-phan-quyen', 'AdminController@getUserPhanQuyen');

    Route::post('/tim-phan-quyen-nhan-vien', 'AdminController@getAuthListOfUser');
    Route::get('/tim-phan-quyen-nhan-vien', 'AdminController@getAuthListOfUser');

    Route::post('/get-ds-tru-so', 'AdminController@getDsTruSo');
    Route::get('/get-ds-tru-so', 'AdminController@getDsTruSo');

    Route::post('/get-ds-danh-muc', 'AdminController@getDsDanhMuc');
    Route::get('/get-ds-danh-muc', 'AdminController@getDsDanhMuc');

    Route::post('/get-ds-tai-lieu-mo-rong', 'AdminController@getDsTaiLieuMoRong');
    Route::get('/get-ds-tai-lieu-mo-rong', 'AdminController@getDsTaiLieuMoRong');

    Route::post('/get-ds-phong-ban', 'AdminController@getDsPhongBan');
    Route::get('/get-ds-phong-ban', 'AdminController@getDsPhongBan');

    Route::post('/get-ds-to-cong-tac', 'AdminController@getDsToCongTac');
    Route::get('/get-ds-to-cong-tac', 'AdminController@getDsToCongTac');

    Route::post('/cap-nhat-phan-quyen-user', 'AdminController@updateUserAuthority');
    Route::get('/cap-nhat-phan-quyen-user', 'AdminController@updateUserAuthority');

    Route::get('/quan-ly-danh-muc', 'AdminController@categoryManager');

    Route::post('/them-moi-danh-muc-tai-lieu-mo-rong', 'AdminController@addNewExtDocumentCategory');
    Route::get('/them-moi-danh-muc-tai-lieu-mo-rong', 'AdminController@addNewExtDocumentCategory');

    Route::post('/cap-nhat-danh-muc-tai-lieu-mo-rong', 'AdminController@updateExtDocumentCategory');
    Route::get('/cap-nhat-danh-muc-tai-lieu-mo-rong', 'AdminController@updateExtDocumentCategory');

    Route::post('/cap-nhat-phong-ban', 'AdminController@updateDepartment');
    Route::get('/cap-nhat-phong-ban', 'AdminController@updateDepartment');

    Route::post('/them-moi-phong-ban', 'AdminController@addDepartment');
    Route::get('/them-moi-phong-ban', 'AdminController@addDepartment');

    Route::post('/cap-nhat-to', 'AdminController@updateToCT');
    Route::get('/cap-nhat-to', 'AdminController@updateToCT');

    Route::post('/them-moi-to', 'AdminController@addToCT');
    Route::get('/them-moi-to', 'AdminController@addToCT');

    Route::get('/thong-tin-ca-nhan', 'AdminController@userInformation');

    Route::post('/cap-nhat-thong-tin-ca-nhan', 'AdminController@updateUserInformation');
    Route::get('/cap-nhat-thong-tin-ca-nhan', 'AdminController@updateUserInformation');

    Route::get('/my-file', 'AdminController@userUploadList');

    Route::post('user-upload-file', 'AdminController@getUserUploadFiles');
    Route::get('user-upload-file', 'AdminController@getUserUploadFiles');

    Route::get('/quan-ly-nguoi-dung', 'AdminController@userManagement');

    Route::post('thong-tin-nguoi-dung', 'AdminController@getUserProfile');
    Route::get('thong-tin-nguoi-dung', 'AdminController@getUserProfile');

    Route::post('update-user-info-by-admin', 'AdminController@updateUserProfileByAdmin');
    Route::get('update-user-info-by-admin', 'AdminController@updateUserProfileByAdmin');

    Route::post('delete-category', 'DocumentController@deleteCategory');
    Route::get('delete-category', 'DocumentController@deleteCategory');

    Route::post('danh-sach-tai-lieu-chia-se', 'DocumentController@loadShareDocument');
    Route::get('danh-sach-tai-lieu-chia-se', 'DocumentController@loadShareDocument');
});