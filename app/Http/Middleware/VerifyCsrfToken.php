<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'danh-sach-tai-lieu/*',
        'danh-sach-tai-lieu',
        'tra-cuu-tai-lieu/*',
        'tra-cuu-tai-lieu',
        'thu-vien-hinh/*',
        'thu-vien-hinh',
        'user-upload-file',
    ];
}
