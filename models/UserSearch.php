<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;
use yii\db\Query;

/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class UserSearch extends User
{
    public $role;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'ip', 'style', 'fa', 'im', 'ot', 'dr', 'role'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'role' => Yii::t('app', 'ACCESS_TYPE'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function getUsersByRole($role)
    {
        if (empty($role)) {
            return [];
        }

        $query = (new Query)->select('b.*')
            ->from(['a' => '{{%auth_assignment}}', 'b' => '{{%user}}'])
            ->where('{{a}}.[[user_id]]={{b}}.[[id]]')
            ->andWhere(['a.item_name' => (string) $role]);
           // ->andWhere(['b.type' => Item::TYPE_ROLE]);

        $users = [];
        foreach ($query->all() as $row) {
            $users[$row['id']] = $row;
        }
        return $users;
    }
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'dr' => $this->dr,
        ]);

        $query->andFilterWhere(['in', 'id', $this->getUsersByRole($this->role)]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'style', $this->style])
            ->andFilterWhere(['like', 'fa', $this->fa])
            ->andFilterWhere(['like', 'im', $this->im])
            ->andFilterWhere(['like', 'ot', $this->ot]);

        return $dataProvider;
    }
}
