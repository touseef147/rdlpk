<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "centers_permissions".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $center_id
 */
class Centerspermissions extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'centers_permissions';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['user_id', 'center_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'center_id' => 'Center ID',
        ];
    }

    public static function mycenters() {
        return \app\models\application\Salescenter::find()->joinWith("permissions")->orderBy("sales_center.name")->where(['centers_permissions.user_id' => Yii::$app->user->identity->id])->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCenter() {
        return $this->hasOne(Salescenter::className(), ['id' => 'center_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(\app\modules\security\models\User::className(), ['id' => 'user_id']);
    }

    public function updaterecord() {
        if ($this->save()) {
            return TRUE;
        }

        if (Yii::$app->user->identity->rawerrors == 1) {
            echo "<h3>" . $this->className() . " Model: updaterecord</h3>";
            print_r($this->errors);
        }

        return FALSE;
    }

    public static function saveList($list, $parentid) {
        $valid = true;

        Centerspermissions::findAll(['user_id' => $parentid])->delete();

        foreach ($list as $val) {
            $newcat = new \app\models\application\Centerspermissions();

            $newcat->center_id = $val;
            $newcat->user_id = $parentid;


            if (!$newcat->save()) {

                $valid = false;
                if (Yii::$app->user->identity->rawerrors == 1) {
                    echo "<h3>" . $this->className() . " Model: savelist</h3>";
                    print_r($newcat->errors);
                }
            }
        }
        return $valid;
    }

    public static function saveuserList($list, $parentid) {
        $dbitems = Centerspermissions::find()->where(['user_id' => $parentid])->select(['center_id'])->all();
        $arritems = array_map(create_function('$arr', 'return $arr["center_id"];'), $dbitems);

        $newitems = array();
        $removeditems = array();
        $valid = true;

        if (isset($list)) {
            $newitems = array_diff($list, $arritems);
        }
        if (isset($list)) {
            $removeditems = array_diff($arritems, $list);
        } else {
            $removeditems = $arritems;
        }

        foreach ($removeditems as $item) {
            $myUpdate = "delete from centers_permissions where user_id=" . $parentid . " and center_id=" . $item . ";";
            \Yii::$app->db->createCommand($myUpdate)->execute();
        }

        foreach ($list as $val) {
            if ($val) {
                $newcat = new \app\models\application\Centerspermissions();

                $newcat->center_id = $val;
                $newcat->user_id = $parentid;


                if (!$newcat->save()) {
                    $valid = false;
//                    print_r($newcat);
                }
            }
        }
        return $valid;
    }

}
