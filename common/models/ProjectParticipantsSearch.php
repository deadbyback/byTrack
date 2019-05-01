<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ProjectParticipantsSearch represents the model behind the search form of `common\models\ProjectParticipants`.
 */
class ProjectParticipantsSearch extends ProjectParticipants
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'project_id', 'user_id'], 'integer'],
            [['user_role', 'last_update'], 'safe'],
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
        $id = Yii::$app->user->id;

        $subquery = ProjectParticipants::find()
            ->select('project_id')
            ->innerJoin('{{project}}', '{{project_participants}}.[[project_id]] = {{project}}.[[id]]' )
            ->andWhere('{{project_participants}}.[[user_id]] = :id', [':id' => $id]);

        $query = ProjectParticipants::find()
            ->where(['in', 'project_id', $subquery]);

        $memberDataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $memberDataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'project_id' => $this->project_id,
            'user_id' => $this->user_id,
            'last_update' => $this->last_update,
        ]);

        $query->andFilterWhere(['like', 'user_role', $this->user_role]);

        return $memberDataProvider;
    }
}
