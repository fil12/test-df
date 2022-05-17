<?php

namespace app\behaviors;

use yii\base\Behavior;
use yii\db\ActiveRecord;

class TrimBehavior extends Behavior
{

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
        ];
    }

    public function beforeValidate($event)
    {
        $attributes = $this->owner->attributes;
        foreach($attributes as $key => $value) { //For all model attributes
            $this->owner->$key = trim($this->owner->$key);
        }
    }
}