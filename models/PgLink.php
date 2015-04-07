<?php

namespace app\models;

use Yii;

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
class PgLink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%link}}';
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
            [['icon'], 'string', 'max' => 32]
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
            'status' => 'Status',
            'title' => 'Title',
            'href' => 'Href',
            'icon' => 'Icon',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
