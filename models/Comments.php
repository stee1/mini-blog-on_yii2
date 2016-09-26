<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 26.09.2016
 * Time: 15:57
 */

namespace app\models;

use yii\db\ActiveRecord;

class Comments extends ActiveRecord
{
    public static function tableName()
    {
        return 'comments_v2';
    }
}