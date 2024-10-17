<?php

namespace Kho8k\ThemePcc;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class ThemePccServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->setupDefaultThemeCustomizer();
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views/', 'themes');

        $this->publishes([
            __DIR__ . '/../resources/assets' => public_path('themes/pcc')
        ], 'pcc-assets');
    }

    protected function setupDefaultThemeCustomizer()
    {
        config(['themes' => array_merge(config('themes', []), [
            'pcc' => [
                'name' => 'Theme PccX',
                'author' => 'kho8k@gmail.com',
                'package_name' => 'kho8k/theme-pccx',
                'publishes' => ['pcc-assets'],
                'preview_image' => '',
                'options' => [
                    [
                        'name' => 'recommendations_limit',
                        'label' => 'Recommended movies limit',
                        'type' => 'number',
                        'value' => 10,
                        'wrapperAttributes' => [
                            'class' => 'form-group col-md-4',
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'per_page_limit',
                        'label' => 'Pages limit',
                        'type' => 'number',
                        'value' => 24,
                        'wrapperAttributes' => [
                            'class' => 'form-group col-md-4',
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'movie_related_limit',
                        'label' => 'Movies related limit',
                        'type' => 'number',
                        'value' => 12,
                        'wrapperAttributes' => [
                            'class' => 'form-group col-md-4',
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'latest',
                        'label' => 'Home Page',
                        'type' => 'code',
                        'hint' => 'display_label|relation|find_by_field|value|limit|show_more_url',
                        'value' => "Phim bộ mới||type|series|12|/danh-sach/phim-bo\r\nPhim lẻ mới||type|single|12|/danh-sach/phim-bo",
                        'attributes' => [
                            'rows' => 5
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'hotest',
                        'label' => 'Danh sách hot',
                        'type' => 'code',
                        'hint' => 'Label|relation|find_by_field|value|sort_by_field|sort_algo|limit',
                        'value' => "Top phim lẻ||type|single|view_total|desc|5\r\nTop phim bộ||type|series|view_total|desc|5",
                        'attributes' => [
                            'rows' => 5
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'additional_css',
                        'label' => 'Additional CSS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom CSS'
                    ],
                    [
                        'name' => 'body_attributes',
                        'label' => 'Body attributes',
                        'type' => 'text',
                        'value' => "",
                        'tab' => 'Custom CSS'
                    ],
                    [
                        'name' => 'additional_header_js',
                        'label' => 'Header JS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom JS'
                    ],
                    [
                        'name' => 'additional_body_js',
                        'label' => 'Body JS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom JS'
                    ],
                    [
                        'name' => 'additional_footer_js',
                        'label' => 'Footer JS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom JS'
                    ],
                    [
                        'name' => 'footer',
                        'label' => 'Footer',
                        'type' => 'code',
                        'value' => <<<EOT
                        <div class="container-fluid clearfix">
                            <div class="row footer-container">
                                <div class="col-xs-12">
                                    <div class="nav-footer">
                                        <ul id="menuFooter" class="menu-footer">
                                            <li>Liên hệ</li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- Phần contact_footer đã được thêm logo -->
                                <div class="contact_footer col-xs-12 col-sm-12 col-md-2">
                                    <!-- Phần 1: Logo -->
                                    <div class="logo-container">
                                        <a href="/">
                                            <img src="logo.png" alt="Logo" loading="lazy" width="140" height="50" sizes="140px" />
                                        </a>
                                    </div>

                                    <!-- Khoảng cách giữa phần logo và nội dung chính -->
                                    <div class="spacer" style="height: 10px;"></div>

                                    <!-- Phần 2: Nội dung chính -->
                                    <div class="main-content">
                                        <p>ThemePccX.com cung cấp cho bạn video khiêu dâm miễn phí không giới hạn với những diễn viên người lớn nóng bỏng nhất.
                                        Tận hưởng cộng đồng khiêu dâm nghiệp dư lớn nhất trên mạng cũng như các cảnh quay đầy đủ từ các studio XXX hàng đầu.
                                        Chúng tôi cập nhật video khiêu dâm hàng ngày để đảm bảo bạn luôn nhận được những bộ phim sex chất lượng tốt nhất.</p>
                                    </div>

                                    <!-- Khoảng cách giữa nội dung chính và nội dung thêm -->
                                    <div class="spacer" style="height: 10px;"></div>

                                    <!-- Phần 3: Nội dung thêm -->
                                    <div class="additional-content">
                                        <p>Copyright @ Ahihi.com</p>
                                    </div>
                                </div>
                                <!-- Điều chỉnh các cột khác thành flexbox -->
                                <div class="col-xs-12 col-sm-3 col-md-2 link-footer">
                                    <p class="title_footer" style="margin-top: 20px;"> Liên hệ </p>
                                    <span>admin@gmail.com</span>
                                </div>
                                <div class="col-xs-12 col-sm-3 col-md-2 link-footer">
                                    <p class="title_footer" style="margin-top: 20px;">Thể loại nổi bật</p>
                                    <ul>
                                        <li> <a title="JAV HD" href="/">JAV HD</a> </li>
                                        <li> <a title="Phim sex không che" href="/">Phim sex không che</a> </li>
                                        <li> <a title="Phim sex Trung Quốc" href="/">Phim sex Trung Quốc</a> </li>
                                        <li> <a title="Phim sex Việt Nam" href="/">Phim sex Việt Nam</a> </li>
                                    </ul>
                                </div>
                                <div class="col-xs-12 col-sm-3 col-md-2 link-footer">
                                    <p class="title_footer" style="margin-top: 20px;">Quốc gia nổi bật</p>
                                    <ul>
                                        <li> <a title="Nhật Bản" href="/">Nhật Bản</a> </li>
                                        <li> <a title="Trung Quốc" href="/">Trung Quốc</a> </li>
                                        <li> <a title="Việt Nam" href="/">Việt Nam</a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        EOT,
                        'tab' => 'Custom HTML'
                    ],
                    [
                        'name' => 'ads_header',
                        'label' => 'Ads header',
                        'type' => 'code',
                        'value' => <<<EOT
                        <img src="" alt="">
                        EOT,
                        'tab' => 'Ads'
                    ],
                    [
                        'name' => 'ads_catfish',
                        'label' => 'Ads catfish',
                        'type' => 'code',
                        'value' => <<<EOT
                        <img src="" alt="">
                        EOT,
                        'tab' => 'Ads'
                    ]
                ],
            ]
        ])]);
    }
}
