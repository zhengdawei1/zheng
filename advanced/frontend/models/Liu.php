<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "liu".
 *
 * @property int $id
 * @property string $name
 * @property string $neighbor
 */
class Liu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'liu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'neighbor'], 'required'],
            [['name'], 'string', 'max' => 30],
            [['neighbor'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'neighbor' => 'Neighbor',
        ];
    }
}
