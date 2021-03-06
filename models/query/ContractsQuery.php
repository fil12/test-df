<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\Contract]].
 *
 * @see \app\models\Contract
 */
class ContractsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\Contract[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Contract|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
