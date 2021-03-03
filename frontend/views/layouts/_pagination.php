<nav aria-label="Page navigation example">
    <?php
    echo \yii\widgets\LinkPager::widget([
        'pagination' => $pages,
        'options' => ['class' => 'pagination'],
        'linkOptions' => ['class' => 'page-link'],
        'disabledListItemSubTagOptions' => ['tag' => 'a', 'class' => 'page-link'],
        'pageCssClass' => 'page-item',
        'firstPageCssClass' => 'page-item',
        'lastPageCssClass' => 'page-item',
        'prevPageCssClass' => 'page-item',
        'prevPageCssClass' => 'page-item',
        'nextPageCssClass' => 'page-item',
        'maxButtonCount' => 5,
    ]);
    ?>
</nav>