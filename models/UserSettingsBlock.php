<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\base\ErrorException;
use yii\helpers\ArrayHelper;
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
 * @property string $state
 *
 * @property State $state0
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
            [['user_id', 'block_id'], 'required'],
            [['user_id', 'block_id', 'column', 'order', 'hidden', 'created_at', 'updated_at'], 'integer'],
            [['state'], 'string', 'max' => 64]
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
            'column' => 'Столбец',
            'order' => 'Сортировка',
            'hidden' => 'Hidden',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
            'state' => 'Цветовое оформление',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getState0()
    {
        return $this->hasOne(State::className(), ['name' => 'state']);
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

    /***
     * sync userBlock
     * @param $userId
     */
    public static function sync($userId)
    {
        $blocks = Block::find()->where(['type' => Block::TYPE_BLOCK])->all(); //TODO add this template
        $userBlocks = self::find()->where(['user_id' => $userId])->indexBy('block_id')->all();

        foreach($blocks as $block)
        {
            if(!array_key_exists($block->id, $userBlocks))
            {
                $ub = new self;
                $ub->attributes = $block->attributes;

                $ub->user_id = $userId;
                $ub->block_id = $block->id;
                $ub->save();
            }
        }

        $blocksId = ArrayHelper::map($blocks, 'id', 'id');
        self::deleteAll('block_id NOT IN (' . implode(', ', $blocksId) . ') and user_id = '.$userId);
    }

    /***
     * delete all usersetting
     * @param $userId
     */
    public static function del($userId)
    {
        return self::deleteAll(['user_id' => $userId]);
    }

    /***
     * @param $userId
     * @param array $items
     * @return bool
     */
    public static function sortUpdate($userId, $items = array())
    {
        //TODO add collapse and close
        if (!is_array($items))
            return false;

        try{
            foreach($items as $item)
            {
                $itemId = (int)str_replace('item', '', $item['id']);
                $block = self::find()->where(['user_id' => $userId, 'id' => $itemId])->one();

                $colId = (int)str_replace('column', '', $item['column']);
                $block->column = $colId==0?1:$colId;
                $block->order = $item['order'];
                if(!$block->save())
                    return false;
            }
            return true;
        }catch (ErrorException $e){
            return false;
        }
    }

}
