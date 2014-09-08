<?php

class AuditBehavior extends CActiveRecordBehavior {

    function beforeSave($event) {
        $owner = $this->getOwner();
        if ($owner->getIsNewRecord()) {
            $owner->created = new CDbExpression('NOW()');
            $owner->created_by = $owner->modified_by = Yii::app()->user->id;
        } else {
            $owner->modified = new CDbExpression('NOW()');
            $owner->modified_by = Yii::app()->user->id;
        }
        return true;
    }

}

?>