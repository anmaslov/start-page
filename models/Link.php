<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%link}}".
 *
 * @property integer $id
 * @property integer $block_id
 * @property integer $order
 * @property integer $status
 * @property string $title
 * @property string $href
 * @property string $icon
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Block $block
 */
class Link extends \yii\db\ActiveRecord
{

    const STATUS_DISABLE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_HIDDEN = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%link}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['block_id', 'title', 'href', 'icon', 'created_at', 'updated_at'], 'required'],
            [['block_id', 'order', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 64],
            [['href'], 'string', 'max' => 128],
            [['icon'], 'string', 'max' => 32],

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
            self::STATUS_DISABLE => 'Заблокирована',
            self::STATUS_ACTIVE => 'Активена',
            self::STATUS_HIDDEN => 'Скрыта',
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'block_id' => 'Block ID',
            'order' => 'Order',
            'status' => 'Статус',
            'title' => 'Имя',
            'href' => 'Ссылка',
            'icon' => 'Иконка',
            'created_at' => 'Создана',
            'updated_at' => 'Обновлена',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlock()
    {
        return $this->hasOne(Block::className(), ['id' => 'block_id']);
    }
}
