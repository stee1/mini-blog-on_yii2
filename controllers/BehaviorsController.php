<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 30.10.2016
 * Time: 11:04
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;

class BehaviorsController extends Controller
{
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'denyCallback' => function ($rule, $action) {
                    throw new \Exception('Нет доступа');
                },
                'rules' => [
                    [
                        'allow' => true,
                        'controllers' => ['site'],
                        'actions' => ['reg', 'login'],
                        'verbs' => ['GET', 'POST'],
                        'roles' => ['?']
                    ],
                    [
                        'allow' => true,
                        'controllers' => ['site'],
                        'actions' => ['logout'],
                        'verbs' => ['POST'],
                        'roles' => ['@']
                    ],
                    [
                        'allow' => true,
                        'controllers' => ['site'],
                        'actions' => ['index', 'record'],
                    ]
                ]
            ]
        ];
    }
}