<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Site;

/**
 * SiteSearch represents the model behind the search form about `app\models\Site`.
 */
class SiteSearch extends Site
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'proyek'], 'integer'],
            [['nama', 'titik_nominal', 'status_kepemilikan', 'tipe_antena', 'keterangan', 'foto', 'status_kerja'], 'safe'],
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
        $query = Site::find();

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
            'proyek' => $this->proyek,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'titik_nominal', $this->titik_nominal])
            ->andFilterWhere(['like', 'status_kepemilikan', $this->status_kepemilikan])
            ->andFilterWhere(['like', 'tipe_antena', $this->tipe_antena])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan])
            ->andFilterWhere(['like', 'foto', $this->foto])
            ->andFilterWhere(['like', 'status_kerja', $this->status_kerja]);

        return $dataProvider;
    }
}
