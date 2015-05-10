<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Projectteam;

/**
 * ProjectteamSearch represents the model behind the search form about `app\models\Projectteam`.
 */
class ProjectteamSearch extends Projectteam
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'proyekId'], 'integer'],
            [['nik'], 'safe'],
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

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Projectteam::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'proyekId' => $this->proyekId,
        ]);

        $query->andFilterWhere(['like', 'nik', $this->nik]);

        return $dataProvider;
    }
}
