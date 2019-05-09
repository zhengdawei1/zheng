<?php

namespace frontend\controllers;
use Yii;
use app\models\Liu;
use yii\data\Pagination;

class LiuController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = new Liu();
        $url="http://localhost/month10/yue/advanced/frontend/web/index.php?r=liu/index";
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($model->save())
            {
                return $this->redirect(['liu/show']);
            }
        }
        return $this->render('index', ['model' => $model]);
    }

    public function actionShow(){
        $query = Liu::find();

        $pagination = new Pagination([
            'defaultPageSize' => 3,
            'totalCount' => $query->count(),
        ]);

        $countries = $query->orderBy('id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('show', [
            'countries' => $countries,
            'pagination' => $pagination,
        ]);
    }
}
