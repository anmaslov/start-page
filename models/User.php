<?php
namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
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
            [['created_at', 'updated_at', 'status'], 'integer'],
            [['ip'], 'string', 'max' => 15],
            [['username'], 'string', 'max' => 255],
            [['ip'], 'unique'],
            [['style'], 'string', 'max' => 64],
            [['fa', 'im', 'ot'], 'string', 'max' => 128],
            [['ip'], 'default', 'value' => $this->remip],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
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
            self::STATUS_DELETED => Yii::t('app', 'BLOCK'),
            self::STATUS_ACTIVE => Yii::t('app', 'ACTIVE'),
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => Yii::t('app', 'NICKNAME'),
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'ip' => 'Ip',
            'status' => Yii::t('app', 'STATUS'),
            'created_at' => Yii::t('app', 'CREATED'),
            'updated_at' => Yii::t('app', 'UPDATED'),
            'style' => Yii::t('app', 'DESIGN'),
            'fa' => Yii::t('app', 'USER_FAMILY'),
            'im' => Yii::t('app', 'USER_NAME'),
            'ot' => Yii::t('app', 'USER_FATHER_NAME'),
            'dr' => Yii::t('app', 'BIRTH_DATE'),
        ];
    }
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public function findUser()
    {
        if (!$user = self::findOne(['ip' => $this->remip]))
        {
            $this->save();
            return $this;
        }

        return $user;
    }

    public function getRemIp()
    {
        $userIp = Yii::$app->getRequest()->getUserIP();
        return $userIp ? $userIp : 'noip';
    }
    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }


    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }


    public function login()
    {
        return Yii::$app->user->login($this->findUser(), 3600 * 24 * 30);
    }

    public static function loginGuest()
    {
        if (Yii::$app->user->isGuest)
        {
            $usr = new self;
            if ($usr->login())
                return true;
            else
                return false;
        }
        return false;
    }

    public static function getStyle($userId = null)
    {
        self::loginGuest();

        $user = !$userId ? \Yii::$app->user->id : $userId;
        return self::findOne($user)->style;
    }
}
