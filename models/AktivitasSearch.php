<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Aktivitas;

/**
 * AktivitasSearch represents the model behind the search form about `app\models\Aktivitas`.
 */
class AktivitasSearch extends Aktivitas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'siteId'], 'integer'],
            [['tanggal', 'judul', 'status', 'foto', 'keterangan', 'status_approval_pm', 'status_approval_supervi', 'creator'], 'safe'],
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
        $query = Aktivitas::find();

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
            'siteId' => $this->siteId,
        ]);

        $query->andFilterWhere(['like', 'judul', $this->judul])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'foto', $this->foto])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan])
            ->andFilterWhere(['like', 'status_approval_pm', $this->status_approval_pm])
            ->andFilterWhere(['like', 'status_approval_supervi', $this->status_approval_supervi])
            ->andFilterWhere(['like', 'creator', $this->creator]);

        return $dataProvider;
    }
}
