<?php

namespace frontend\modules\v1;

use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\Cors;
use yii\helpers\ArrayHelper;
use yii\rest\UrlRule;

/**
 * v1 module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'frontend\modules\v1\controllers';

    /**
     * {@inheritdoc}
     */


    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'corsFilter' => [
                'class' => Cors::class,
                'cors' => [
                    'Origin' => static::allowedDomains(),
                ],
            ],
        ]);
    }
    public function init()
    {
        error_reporting(2215);
        parent::init();

        // custom initialization code goes here
    }

    public static $urlRules = [
        [
            'class' => '\yii\rest\UrlRule',
            'controller' => 'v1/api',
            'extraPatterns' => [
                'OPTIONS <action>' => 'options',
//                'GET index' => 'index',
//                'POST create/<slug:\S+>' => 'create',
//                'PUT update/<id:[0-9]+>' => 'update',
                'GET index' => 'index',
                'GET create/<slug:\S+>' => 'create',
                'GET update/<id:[0-9]+>' => 'update',
                'GET delete/<id:[0-9]+>' => 'delete',
            ],
            'pluralize' => false,
        ],
    ];

    public static function allowedDomains()
    {
        return [
            '*',
        ];
    }
}
