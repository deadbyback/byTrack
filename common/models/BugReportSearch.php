<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\BugReport;

/**
 * BugReportSearch represents the model behind the search form of `common\models\BugReport`.
 */
class BugReportSearch extends BugReport
{
    /**
     * {@inheritdoc}
     */
    public $severityName;
    public $statusName;
    public $priorityName;

    public function rules()
    {
        return [
            [['bug_id'], 'integer'],
            [['title', 'description', 'playback_steps', 'severity', 'priority', 'status', 'reporter_id', 'destination_id'], 'safe'],
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
        $query->joinWith(['severityName'])
        ->joinWith(['priorityName'])
        ->joinWith(['statusName']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
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
/*        $query->andFilterWhere(['like', User::tableName(), $this->reporter])
            ->andFilterWhere(['like', User::tableName(), $this->destination]);*/

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'playback_steps', $this->playback_steps])
            ->andFilterWhere(['like', SeverityName::tableName(), $this->severityName])
            ->andFilterWhere(['like', PriorityName::tableName(), $this->priorityName])
            ->andFilterWhere(['like', StatusName::tableName(), $this->statusName]);
        //$query->andFilterWhere(['like', User::tableName(), $this->reporter]);

        return $dataProvider;
    }
}
