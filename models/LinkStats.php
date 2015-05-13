<?php

namespace app\models;

use Yii;

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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['link_id', 'user_id', 'created_at'], 'required'],
            [['link_id', 'user_id'], 'integer'],
            [['created_at'], 'safe'],
            [['userip'], 'string', 'max' => 15],
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
