<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%user_settings_block}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $block_id
 * @property integer $column
 * @property integer $order
 * @property integer $hidden
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 * @property Block $block
 */
class UserSettingsBlock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_settings_block}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'block_id', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'block_id', 'column', 'order', 'hidden', 'created_at', 'updated_at'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'block_id' => 'Block ID',
            'column' => 'Column',
            'order' => 'Order',
            'hidden' => 'Hidden',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlock()
    {
        return $this->hasOne(Block::className(), ['id' => 'block_id']);
    }
}
