<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%block}}".
 *
 * @property integer $id
 * @property integer $column
 * @property integer $order
 * @property string $title
 * @property integer $hidden
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Link[] $links
 */
class Block extends \yii\db\ActiveRecord
{

    const STATUS_HIDDEN = 0;
    const STATUS_SHOW = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%block}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['column', 'order', 'hidden', 'created_at', 'updated_at'], 'integer'],
            [['title', 'created_at', 'updated_at'], 'required'],
            [['title'], 'string', 'max' => 32],
            ['status', 'in', 'range' => array_keys(self::getStatusesArray())]
        ];
    }

    public function getStatusName()
    {
        $statuses = self::getStatusesArray();
        return isset($statuses[$this->status]) ? $statuses[$this->status] : '';
    }

    public static function getStatusesArray()
    {
        return [
            self::STATUS_HIDDEN => 'Скрыт',
            self::STATUS_SHOW => 'Отображается',
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'column' => 'Column',
            'order' => 'Order',
            'title' => 'Title',
            'hidden' => 'Hidden',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLinks()
    {
        return $this->hasMany(Link::className(), ['block_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserSettingsBlocks()
    {
        return $this->hasMany(UserSettingsBlock::className(), ['block_id' => 'id']);
    }

    public function getInfoLink()
    {
        return Link::find()->where(['block_id' => $this->id])->all();
    }

}