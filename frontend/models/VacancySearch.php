<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Vacancy;

/**
 * VacancySearch represents the model behind the search form of `frontend\models\Vacancy`.
 */
class VacancySearch extends Vacancy
{
    /**
     * {@inheritdoc}
     */
    public $salary1;
    public $salary2;
    public function rules()
    {
        return [
            [['id', 'company_id', 'user_id', 'profession_id', 'job_type_id', 'region_id', 'city_id', 'count', 'salary', 'gender', 'views', 'status'], 'integer'],
            [['salary1','salary2','description_uz', 'description_ru', 'description_en', 'description_cyrl', 'image', 'experience', 'telegram', 'address', 'deadline', 'created_at', 'updated_at'], 'safe'],
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
//    public function salaryFunction()
//    {
//        if ($this->salary > $this->salary1 && $this->salary < $this->salary2){
//            return $this->salary();
//        }
//    }
    public function search($params)
    {
        $query = Vacancy::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
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
            'id' => $this->id,
            'company_id' => $this->company_id,
            'user_id' => $this->user_id,
            'profession_id' => $this->profession_id,
            'job_type_id' => $this->job_type_id,
            'region_id' => $this->region_id,
            'city_id' => $this->city_id,
            'count' => $this->count,
            'salary' => $this->salary,
            'gender' => $this->gender,
            'views' => $this->views,
            'status' => $this->status,
            'deadline' => $this->deadline,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'description_uz', $this->description_uz])
            ->andFilterWhere(['like', 'description_ru', $this->description_ru])
            ->andFilterWhere(['like', 'description_en', $this->description_en])
            ->andFilterWhere(['like', 'description_cyrl', $this->description_cyrl])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'experience', $this->experience])
            ->andFilterWhere(['like', 'telegram', $this->telegram])
            ->andFilterWhere(['like', 'address', $this->address]);

        return $dataProvider;
    }
}
