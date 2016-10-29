<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 29.10.2016
 * Time: 11:07
 */

namespace app\models;

use yii\base\Model;
use Yii;

class RegForm extends Model {

    public $username;
    public $email;
    public $password;
    public $status;

    public function rules() {
        return [
            [['username', 'email', 'password'], 'filter', 'filter' => 'trim'],
            [['username', 'email', 'password'], 'required'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['password', 'string', 'min' => 6, 'max' => 255],
            ['username', 'unique',
                'targetClass' => User::className(),
                'message' => 'Это имя уже занято'],
            ['email', 'email'],
            ['email', 'unique',
                'targetClass' => User::className(),
                'message' => 'Эта почта уже зарегистрированна'],
            ['status', 'default', 'value' => User::STATUS_ACTIVE, 'on' => 'default'],
            ['status', 'in', 'range' => [
                User::STATUS_NOT_ACTIVE,
                User::STATUS_ACTIVE
            ]]

        ];
    }

    public function attributeLabels() {
        return [
            'username' => 'Имя пользователя',
            'email' => 'Эл. почта',
            'password' => 'Пароль'
        ];
    }

    /**
     * Add new user to table users
     *
     * @return User
     */
    public function reg() {
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->status = $this->status;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        return $user->save() ? $user : null;
    }
}
