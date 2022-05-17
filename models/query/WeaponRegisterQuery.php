<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\WeaponRegister]].
 *
 * @see \app\models\WeaponRegister
 */
class WeaponRegisterQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\WeaponRegister[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\WeaponRegister|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
