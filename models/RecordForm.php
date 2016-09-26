<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 26.09.2016
 * Time: 13:56
 */

namespace app\models;

use yii\base\Model;

class RecordForm extends Model {
    public $author;
    public $text;

    public function rules() {
        return [
            //more rules
            [['author'], 'required', 'message' => 'Имя автора не должно быть пустым'],
            [['author'], 'string', 'min' => 3, 'max' => 30, 'message' => 'Имя автора должно быть длинной от 3 до 30 символов'],
            [['author'],  function ($attribute, $params) {
                if (!ctype_alnum($this->$attribute)) {
                    $this->addError($attribute, 'Имя автора должно состоять только из цифр и букв');
                }
            }],
            [['text'], 'required', 'message' => 'Введите текст публикации'],
        ];
    }
}