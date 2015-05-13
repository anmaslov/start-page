<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%link_stats}}".
 *
 * @property integer $id
 * @property integer $link_id
 * @property integer $user_id
 * @property string $userip
 * @property string $userhost
 * @property string $useragent
 * @property string $created_at
 *
 * @property Link $link
 * @property User $user
 */
class LinkStats extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%link_stats}}';
    }

    public function behaviors()
    {
        return [
         [
             'class' => TimestampBehavior::className(),
             'updatedAtAttribute' => 'created_at',
             'value' => new Expression('NOW()'),
         ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['link_id', 'user_id'], 'required'],
            [['link_id', 'user_id'], 'integer'],
            [['created_at'], 'safe'],
            [['userip'], 'string', 'max' => 15],
            ['userip', 'default', 'value' => Yii::$app->getRequest()->getUserIP()],
            ['userhost', 'default', 'value' => Yii::$app->getRequest()->getUserHost()],
            ['useragent', 'default', 'value' => Yii::$app->getRequest()->getUserAgent()],

            [['userhost'], 'string', 'max' => 150],
            [['useragent'], 'string', 'max' => 500]

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'link_id' => 'Link ID',
            'user_id' => 'User ID',
            'userip' => 'Userip',
            'userhost' => 'Userhost',
            'useragent' => 'Useragent',
            'created_at' => 'Created At',
        ];
    }

    public static function create($link)
    {
        $linkS = new self;
        $linkS->link_id = $link;
        $linkS->user_id = Yii::$app->user->id;

        if(!$linkS->save())
            return $linkS->getErrors();
        else
            return true;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLink()
    {
        return $this->hasOne(Link::className(), ['id' => 'link_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
