<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Barismilestone;

/**
 * BarismilestoneSearch represents the model behind the search form about `app\models\Barismilestone`.
 */
class BarismilestoneSearch extends Barismilestone
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'kategoriId', 'siteId'], 'integer'],
            [['tanggal'], 'safe'],
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
        $query = Barismilestone::find();

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
            'tanggal' => $this->tanggal,
            'kategoriId' => $this->kategoriId,
            'siteId' => $this->siteId,
        ]);

        return $dataProvider;
    }
}
