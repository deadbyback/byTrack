<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\BugReport;

/**
 * BugReportSearch represents the model behind the search form of `backend\models\BugReport`.
 */
class BugReportSearch extends BugReport
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bug_id', 'severity', 'priority', 'status', 'reporter_id', 'destination_id'], 'integer'],
            [['title', 'description', 'playback_steps'], 'safe'],
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
            'severity' => $this->severity,
            'priority' => $this->priority,
            'status' => $this->status,
            'reporter_id' => $this->reporter_id,
            'destination_id' => $this->destination_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'playback_steps', $this->playback_steps]);

        return $dataProvider;
    }
}
