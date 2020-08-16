<?php

namespace frontend\modules\v1\controllers;

use Yii;
use yii\rest\Controller;
use app\models\Products;

/**
 * Default controller for the `v1` module
 */
class ApiController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function actionIndex()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $item = array();
        $products = Products::find()->all();
        foreach($products as $product) {
            array_push($item, $product);
        }
        return $item;
    }

    public function actionCreate($slug)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $products = new Products();
        $products->name = $slug;
        $products->chek =  0;
        $products->count = 0;
        $products->save();

        $item = array();
        $products = Products::find()->all();
        foreach($products as $product) {
            array_push($item, $product);
        }
        return $item;
    }

    public function actionUpdate($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $product = Products::findOne($id);
        if ($product->chek == 0){
            $product->chek = 1;
        }elseif ($product->chek == 1){
            $product->chek = 0;
        }
        $product->save();
    }
    public function actionDelete($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        Products::findOne($id)->delete();

        $item = array();
        $products = Products::find()->all();
        foreach($products as $product) {
            array_push($item, $product);
        }
        return $item;
    }
}

