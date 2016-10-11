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
            [['author'], 'required', 'message' => 'Имя автора не должно быть пустым'],
            [['author'], 'string', 'min' => 3, 'max' => 30, 'message' => 'Имя автора должно быть длинной от 3 до 30 символов'],
            [['author'],  function ($attribute, $params) {
                if (!preg_match("/^[a-z(абвгдеёжизклмопрстуфхцчшщьъыэюя)(АБВГДЕЁЖИЗКЛМОПРСТУФХЦЧШЩЬЪЫЭЮЯ)0-9]+$/i", $this->$attribute)) {
                    $this->addError($attribute, 'Имя автора должно состоять только из цифр и букв (англ. или рус.) без пробелов');
                }
            }],
            [['text'], 'required', 'message' => 'Введите текст публикации'],
        ];
    }

    /**
     *
     * Trim string to 100 chars
     *
     * @param $string
     * @return string
     */
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

    /**
     *
     * Sorting records array by record comments count
     *
     * @param $records
     * @return mixed
     */
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
}