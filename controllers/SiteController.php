<?php

namespace app\controllers;

use app\components\GoodException;
use Yii;
use yii\base\ErrorException;
use yii\base\Exception;
use yii\base\ExitException;
use yii\base\UserException;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Comments;
use app\models\CommentsForm;
use app\models\recordForm;
use app\models\Records;
use yii\web\HttpException;


class SiteController extends Controller
{
    public function beforeAction($action)
    {
        if ($action->id == 'error') {
            $this->layout = 'error_layout';
        }

        return parent::beforeAction($action);
    }

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
//        throw new HttpException(400, 'Ошибочка', 405);

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

        $this->view->params['records_for_slider'] = $records_for_slider;

        return $this->render('index', [
            'model' => $model,
            'records' => $records,
        ]);
    }

    /**
     * Record action.
     *
     * @return string
     */
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
        try {
            $comments = $query->orderBy('date')->where(['id_record' => $current_record->id])->all();
        }
        catch (ErrorException $e) {
            throw new HttpException(400, 'Такого пользователя не существует :(', 405);
        }

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

        $this->view->params['records_for_slider'] = $records_for_slider;

        return $this->render('record', [
            'model' => $model,
            'current_record' => $current_record,
            'comments' => $comments,
        ]);
    }
}
