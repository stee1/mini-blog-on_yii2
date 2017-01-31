<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 26.09.2016
 * Time: 15:39
 */
namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "records_v2".
 *
 * @property integer $id
 * @property string $author
 * @property string $date
 * @property string $text
 *
 * @property Comments[] $comments
 */
class Records extends ActiveRecord {

    public $comments_count;
    public $trimmed_text;

    public static function tableName()
    {
        return 'records_v2';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author', 'date', 'text'], 'required'],
            [['date'], 'safe'],
            [['text'], 'string'],
            [['author'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author' => 'Author',
            'date' => 'Date',
            'text' => 'Text',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommentsV2s()
    {
        return $this->hasMany(Comments::className(), ['id_record' => 'id']);
    }
}