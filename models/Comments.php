<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 26.09.2016
 * Time: 15:57
 */

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "comments_v2".
 *
 * @property integer $id
 * @property integer $id_record
 * @property string $author
 * @property string $date
 * @property string $text
 *
 * @property Records $idRecord
 */
class Comments extends ActiveRecord
{
    public static function tableName()
    {
        return 'comments_v2';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_record', 'author', 'date', 'text'], 'required'],
            [['id_record'], 'integer'],
            [['date'], 'safe'],
            [['text'], 'string'],
            [['author'], 'string', 'max' => 30],
            [['id_record'], 'exist', 'skipOnError' => true, 'targetClass' => Records::className(), 'targetAttribute' => ['id_record' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_record' => 'Id Record',
            'author' => 'Author',
            'date' => 'Date',
            'text' => 'Text',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRecord()
    {
        return $this->hasOne(Records::className(), ['id' => 'id_record']);
    }
}