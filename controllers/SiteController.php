<?php

namespace app\controllers;

use app\models\Comments;
use app\models\CommentsForm;
use app\models\recordForm;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Html;
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
        if (strlen($string) > 97) {
            $tmp_str = mb_substr($string, 0, 97);
            if ($tmp_str[96] != " ") {
                $tmp_str = mb_substr($tmp_str, 0, strripos($tmp_str, " "));
            } else {
                $tmp_str = rtrim($tmp_str);
            }
            return $tmp_str . '...';
        } else {
            return $string;
        }
    }

    public function sortRecordsByCommentsCount($records)
    {
        $result = $records;

        for ($i = 0; $i < count($result); $i++) {
            for ($j = 0; $j < count($result); $j++) {
                if ($result[$i]->comments_count > $result[$j]->comments_count) {
                    $tmp = $result[$j];
                    $result[$j] = $result[$i];
                    $result[$i] = $tmp;
                }
            }
        }

        return $result;
    }


    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new recordForm();

        $query = Records::find();
        $records = $query->orderBy('date DESC')->all();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $now = new \DateTime();
            $now->setTimezone(new \DateTimeZone('Europe/Moscow'));

            $record = new Records();
            $record->author = Html::encode($model->author);
            $record->date = $now->format('Y-m-d H:i:s');
            $record->text = Html::encode($model->text);
            $record->save();

            array_unshift($records, $record);
        }


        foreach ($records as $record) {
            $record->trimmed_text = SiteController::trimTo100Char($record->text);
            $record->comments_count = Comments::find()->where(['id_record' => $record->id])->count();
        }

        $records_for_slider = array_slice(SiteController::sortRecordsByCommentsCount($records), 0, 5, true);

        return $this->render('index', [
            'model' => $model,
            'records' => $records,
            'records_for_slider' => $records_for_slider,
        ]);
    }

    public function actionRecord()
    {
        $model = new CommentsForm();

        $query = Records::find();
        $records = $query->orderBy('date DESC')->all();

        $current_record = null;
        foreach ($records as $record) {
            if ($record->id == Yii::$app->request->get('id')) {
                $current_record = $record;
            }
        }

        $query = Comments::find();
        $comments = $query->orderBy('date')->where(['id_record' => $current_record->id])->all();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $now = new \DateTime();
            $now->setTimezone(new \DateTimeZone('Europe/Moscow'));

            $comment = new Comments();
            $comment->id_record = $current_record->id;
            $comment->author = Html::encode($model->author);
            $comment->date =  $now->format('Y-m-d H:i:s');
            $comment->text = Html::encode($model->text);
            $comment->save();

            array_push($comments, $comment);
        }

        foreach ($records as $record) {
            $record->trimmed_text = SiteController::trimTo100Char($record->text);
            $record->comments_count = Comments::find()->where(['id_record' => $record->id])->count();
        }

        $records_for_slider = array_slice(SiteController::sortRecordsByCommentsCount($records), 0, 5, true);

        return $this->render('record', [
            'model' => $model,
            'records_for_slider' => $records_for_slider,
            'current_record' => $current_record,
            'comments' => $comments,
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
