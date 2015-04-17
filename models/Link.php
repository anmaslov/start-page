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
            [['block_id', 'title', 'href'], 'required'],
            [['block_id', 'order', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 64],
            [['href'], 'string', 'max' => 128],
            [['icon'], 'string', 'max' => 32],
            ['order', 'default', 'value' => 1],

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

    public static function getStatusesArrayValue()
    {
        $valueArr = [];
        foreach(self::getStatusesArray() as $key => $arItem)
        {
            $valueArr[] = [
                'value' => $key, 'text' => $arItem,
            ];
        }
        return $valueArr;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'block_id' => 'Блок',
            'order' => 'Сортировка',
            'status' => 'Статус',
            'title' => 'Имя',
            'href' => 'Ссылка',
            'icon' => 'Иконка',
            'created_at' => 'Создана',
            'updated_at' => 'Обновлена',
        ];
    }

    public static function sortUpdate($items = array())
    {
        if (!is_array($items))
            return false;

        foreach($items as $item)
        {
            $linkId = (int)str_replace('link', '', $item['linkId']);
            $blockId = (int)str_replace('block', '', $item['id']);

            $link = self::findOne($linkId);

            if ($link->order != $item['order'] || $link->block_id != $blockId){
                $link->order = $item['order'];
                $link->block_id = $blockId;
                if(!$link->save())
                    return false;
            }
        }
        return true;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlock()
    {
        return $this->hasOne(Block::className(), ['id' => 'block_id']);
    }
}
