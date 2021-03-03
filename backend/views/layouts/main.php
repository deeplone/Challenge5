<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => 'Home',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
                ['label' => 'Home', 'url' => ['/'], 'items' => null, 'parent' => null],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Đặng nhập', 'url' => ['/login'], 'items' => null, 'parent' => null];
            } else {
                $callback = function ($menu) {
                    return [
                        'label' => $menu['name'],
                        'url' => $menu['route'],
                        'items' => $menu['children'],
                        'parent' => $menu['parent']
                    ];
                };
                $menuItems = mdm\admin\components\MenuHelper::getAssignedMenu(Yii::$app->user->getId(), null, $callback);
                $menuItems[] = ['label' => 'Thoát', 'url' => ['/logout'], 'items' => null, 'parent' => null];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
            ?>

            <div class="container">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">2015 &copy; Suppertheme by VAS.</p>

                <p class="pull-right">&nbsp;</p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
