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
            'user' => 'Пользователь',
            'status' => 'Статус',
            'title' => 'Заголовок',
            'text' => 'Текст сообщения',
            'state' => 'Оформление',
            'created_at' => 'Создан',
            'updated_at' => 'Обновлен',
            'date_start' => 'Дата начала',
            'date_end' => 'Дата окончания',
            'ip_adr' => 'Разрешенные ip адреса',
            'hit' => 'Кол-во хитов',
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
