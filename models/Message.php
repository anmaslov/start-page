<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%message}}".
 *
 * @property integer $id
 * @property integer $user
 * @property integer $status
 * @property string $title
 * @property string $text
 * @property string $state
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $date_start
 * @property string $date_end
 * @property string $ip_adr
 * @property integer $hit
 *
 * @property State $state0
 * @property User $user0
 */
class Message extends \yii\db\ActiveRecord
{

    const STATUS_SHOW = 0;
    const STATUS_HIDDEN = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%message}}';
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
            [['text'], 'required'],
            [['user', 'status', 'created_at', 'updated_at', 'hit'], 'integer'],
            ['user', 'default', 'value' => \Yii::$app->user->id],
            [['text'], 'string'],
            ['status', 'in', 'range' => array_keys(self::getStatusesArray())],
            [['title'], 'string', 'max' => 255],
            [['state'], 'string', 'max' => 64],
            [['date_start', 'date_end'], 'safe'],
            [['ip_adr'], 'string', 'max' => 15]
        ];
    }

    public static function getStatusesArray()
    {
        return [
            self::STATUS_HIDDEN => Yii::t('app', 'HIDDEN'),
            self::STATUS_SHOW => Yii::t('app', 'SHOWED'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user' => Yii::t('app', 'USER'),
            'status' => Yii::t('app', 'STATUS'),
            'title' => Yii::t('app', 'TITLE'),
            'text' => Yii::t('app', 'TEXT'),
            'state' => Yii::t('app', 'DESIGN'),
            'created_at' => Yii::t('app', 'CREATED'),
            'updated_at' => Yii::t('app', 'UPDATED'),
            'date_start' => 'date start',
            'date_end' => 'date end',
            'ip_adr' => 'allowed ip address',
            'hit' => 'hit count',
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
    public function getUser0()
    {
        return $this->hasOne(User::className(), ['id' => 'user']);
    }
}
