<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\BugReport;

/**
 * BugReportSearch represents the model behind the search form of `frontend\models\BugReport`.
 */
class BugReportSearch extends BugReport
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bug_id', 'reporter_id', 'destination_id'], 'integer'],
            [['title', 'desription', 'playback_steps', 'severity', 'priority', 'status'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = BugReport::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 15,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'bug_id' => $this->bug_id,
            'reporter_id' => $this->reporter_id,
            'destination_id' => $this->destination_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'desription', $this->desription])
            ->andFilterWhere(['like', 'playback_steps', $this->playback_steps])
            ->andFilterWhere(['like', 'severity', $this->severity])
            ->andFilterWhere(['like', 'priority', $this->priority])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}