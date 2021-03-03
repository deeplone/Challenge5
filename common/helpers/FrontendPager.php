<?php


namespace common\helpers;

use yii\widgets\LinkPager;

class FrontendPager extends LinkPager
{
    public $options = ['class' => 'pagination'];
    public $linkOptions = ['class' => 'page-link'];
    public $disabledListItemSubTagOptions = "['tag' => 'a', 'class' => 'page-link']";
    public $pageCssClass = 'page-item';
    public $firstPageCssClass = 'page-item';
    public $lastPageCssClass = 'page-item';
    public $prevPageCssClass = 'page-item';
    public $nextPageCssClass = 'page-item';
    public $maxButtonCount = 5;
}