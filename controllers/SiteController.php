<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\RegForm;
use Yii;
use yii\base\ErrorException;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use app\models\Comments;
use app\models\CommentsForm;
use app\models\RecordForm;
use app\models\Records;
use app\models\User;
use yii\web\HttpException;


class SiteController extends BehaviorsController
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
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
//        throw new HttpException(400, 'Ошибочка', 405);

        $model = new RecordForm();

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
            $record->trimmed_text = $model->trimTo100Char(($record->text));
            $record->comments_count = Comments::find()->where(['id_record' => $record->id])->count();
        }

        $records_for_slider = array_slice($model->sortRecordsByCommentsCount($records), 0, 5, true);

        $this->view->params['records_for_slider'] = $records_for_slider;

        $dataProvider = new ArrayDataProvider([
            'allModels' => $records,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [
            'model' => $model,
            'records' => $records,
            'listDataProvider' => $dataProvider,
        ]);
    }

    /**
     * Registration
     *
     * @return string
     */
    public function actionReg()
    {
        $this->layout = 'reg_login';

        $model = new RegForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()):
            if ($user = $model->reg()):
                if ($user->status === User::STATUS_ACTIVE):
                    if (Yii::$app->getUser()->login($user)):
                        return $this->goHome();
                    endif;
                endif;
            else:
                Yii::$app->session->setFlash('error', 'Возникла ошибка регистрации');
                Yii::error('Ошибка при регистрации');
                return $this->redirect(\Yii::$app->request->getReferrer());
            endif;
        endif;


        return $this->render('reg', [
            'model' => $model,
        ]);
    }

    /**
     * Login
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest){
            return $this->goHome();
        }

        $this->layout = 'reg_login';

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()):
            $this->goBack();
        endif;



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
     * Display record
     *
     * @return string
     * @throws HttpException
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
            throw new HttpException(400, 'Такой записи не существует :(', 405);
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

        $modelRecord = new RecordForm();

        foreach ($records as $record) {
            $record->trimmed_text =  $modelRecord->trimTo100Char($record->text);
            $record->comments_count = Comments::find()->where(['id_record' => $record->id])->count();
        }

        $records_for_slider = array_slice($modelRecord->sortRecordsByCommentsCount($records), 0, 5, true);

        $this->view->params['records_for_slider'] = $records_for_slider;

        return $this->render('record', [
            'model' => $model,
            'current_record' => $current_record,
            'comments' => $comments,
        ]);
    }
}
