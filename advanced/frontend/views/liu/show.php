<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>留言板</title>
</head>
<body>
<center>
    <table>
        <tr>
            <th>用户编号</th>
            <th>用户昵称</th>
            <th>回复内容</th>
        </tr>
        <?php foreach($countries as $k=>$v) {?>
        <tr>
            <td><?=$v->id?></td>
            <td><?=$v->name?></td>
            <td><?=$v->neighbor?></td>
        </tr>
        <?php }?>
    </table>
    <?= LinkPager::widget(['pagination' => $pagination]) ?>

</center>
</body>
</html>