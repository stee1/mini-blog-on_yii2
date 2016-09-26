<?php

namespace app\controllers;

use app\models\Comments;
use app\models\recordForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Records;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    //Обрезает строку до 100 символов, учитывая добавляемое "...", с учетом слов
    public function trimTo100Char($string)
    {
        if ( strlen ($string) > 97) {
            $tmp_str = mb_substr($string, 0, 97);
            if ($tmp_str[96] != " ") {
                $tmp_str = mb_substr($tmp_str, 0, strripos($tmp_str, " "));
            } else {
                $tmp_str = rtrim($tmp_str);
            }
            return $tmp_str . '...';
        }
        else {
            return $string;
        }
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new recordForm();

        $validated = false;

        $query = Records::find();

        $records = $query->orderBy('date DESC')->all();


        foreach ($records as $record) {
            $record->trimed_text = SiteController::trimTo100Char($record->text);
            $record->comments_count = Comments::find()->where(['id_record' => $record->id])->count();
        }


        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $validated = true;
        }

        return $this->render('index', [
            'model' => $model,
            'validated' => $validated,
            'records' => $records,
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
