<?php
/* @var $this yii\web\View */

$this->title = 'NHẠC CHỜ DOANH NGHIỆP';

$callback = function ($menu) {
    return [
        'label' => $menu['name'],
        'url' => $menu['route'],
        'items' => $menu['children'],
        'parent' => $menu['parent']
    ];
};
$menuItems = \mdm\admin\components\MenuHelper::getAssignedMenu(Yii::$app->user->getId(), null, $callback);
?>
<div class="site-index">

    <div class="alert alert-info">
        <h2>Chào mừng, 
            <a href="/site/change?id=<?php echo Yii::$app->user->getId() ?>">
                <?php echo \yii\helpers\Html::encode(Yii::$app->user->identity->username); ?>!
            </a>
        </h2>
        <p>Nhấn vào các liên kết bên dưới để thực hiện các tác vụ.</p>
    </div>

    <div class="body-content">
        <div class="row">
            <div class="span8">
                <div class="widget widget-table">
                    <?php foreach ($menuItems as $item) { ?>
                        <?php $childs = $item['items']; ?>
                        <div class="widget-header">
                            <span class="icon-list-alt"></span>
                            <h3><?php echo \yii\helpers\Html::encode($item['label']); ?></h3>
                        </div>
                        <div class="widget-content">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <?php $i = 0; ?>
                                        <?php foreach ($childs as $c) { ?>                                            
                                            <td>
                                                <a href="<?php echo \yii\helpers\Html::encode($c['url']); ?>">
                                                    <?php echo \yii\helpers\Html::encode($c['label']); ?>
                                                </a>                              
                                            </td>
                                            <?php
                                            $i++;
                                            if ($i == 3) {
                                                echo '</tr><tr>';
                                                $i = 0;
                                            }
                                            ?>
                                        <?php } ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>        
    </div>
</div>

