<?php

return [
    '/' => 'home/index',
    'authorization/<client_id>/<client_secret>' => 'authorization/index',
    'authenticate/<username>/<password>/<captcha>' => 'authenticate/index',
    'captcha' => 'authenticate/captcha',
    'danh-sach-tin-tuc/' => 'news/list-news',
    'danh-sach-the-loai/' => 'category/list-category'
];
