<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 26.09.2016
 * Time: 15:39
 */
namespace app\models;

use yii\db\ActiveRecord;

class Records extends ActiveRecord {

    public $comments_count = 0;
    public $trimed_text = "";

    public static function tableName()
    {
        return 'records_v2';
    }
}