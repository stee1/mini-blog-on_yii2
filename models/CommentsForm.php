<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 27.09.2016
 * Time: 14:37
 */

namespace app\models;

use yii\base\Model;

class CommentsForm extends Model {
    public $author;
    public $text;

    public function rules() {
        return [
            [['author'], 'required', 'message' => 'Имя автора не должно быть пустым'],
            [['author'], 'string', 'min' => 3, 'max' => 30, 'message' => 'Имя автора должно быть длинной от 3 до 30 символов'],
            [['author'],  function ($attribute, $params) {
                if (!preg_match("/^[a-z(абвгдеёжизклмопрстуфхцчшщьъыэюя)(АБВГДЕЁЖИЗКЛМОПРСТУФХЦЧШЩЬЪЫЭЮЯ)0-9]+$/i", "петя")) {
                    $this->addError($attribute, 'Имя автора должно состоять только из цифр и букв (англ. или рус.) без пробелов'
                        . $this->$attribute . preg_match("/^[a-zа-я0-9]+$/i", $this->$attribute));
                }
            }],
            [['text'], 'required', 'message' => 'Введите текст комментария'],
        ];
    }
}