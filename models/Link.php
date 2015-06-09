<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Url;

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
 * @property integer $tooltip
 * @property string $version
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
            [['href', 'tooltip'], 'string', 'max' => 128],
            [['icon'], 'string', 'max' => 32],
            ['order', 'default', 'value' => 1],
            [['version'], 'string', 'max' => 10],

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
            self::STATUS_DISABLE => Yii::t('app', 'LINK_BLOCK'),
            self::STATUS_ACTIVE => Yii::t('app', 'LINK_ACTIVE'),
            self::STATUS_HIDDEN => Yii::t('app', 'LINK_HIDDEN'),
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
            'block_id' => Yii::t('app', 'BLOCK'),
            'order' => Yii::t('app', 'ORDER'),
            'status' => Yii::t('app', 'STATUS'),
            'title' => Yii::t('app', 'NAME'),
            'href' => Yii::t('app', 'LINK'),
            'icon' => Yii::t('app', 'ICON'),
            'created_at' => Yii::t('app', 'CREATED'),
            'updated_at' => Yii::t('app', 'UPDATED'),
            'tooltip' => Yii::t('app', 'TOOLTIP'),
            'version' => Yii::t('app', 'VERSION'),
        ];
    }

    public function getStat()
    {
        return Url::to(['link-stats/go', 'link' => $this->href, 'id' => $this->id]);
    }

    public function getVer()
    {
        if (strlen(trim($this->version))>0)
            return $this->version;
        else
            return false;
    }

    public function getSubTitle($length = 40)
    {
        $append = '';
        if (mb_strlen($this->title, 'UTF-8') > $length)
            $append = '...';

        return mb_substr($this->title, 0, $length, 'UTF-8') . $append;
    }

    public static function getLinksBlocks()
    {
        $data = self::find()
            ->with('block')
            ->orderBy('block_id')
            ->where(['{{%link}}.status' => self::STATUS_ACTIVE])
            ->all();

        $out = [];
        foreach ($data as $d) {
            $out[] = [
                'value' => $d->title,
                'stat' => $d->stat,
                'data' => [
                    'category' => $d->block->title
                ]
            ];
        }

        return $out;
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
