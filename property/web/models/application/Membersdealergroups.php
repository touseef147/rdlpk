<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "members_dealer_groups".
 *
 * @property integer $group_id
 * @property string $group_title
 * @property integer $default_dealer
 */
class Membersdealergroups extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'members_dealer_groups';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_title'], 'required'],
            [['default_dealer'], 'integer'],
            [['group_title'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'group_id' => 'Group ID',
            'group_title' => 'Group Title',
            'default_dealer' => 'Default Dealer',
        ];
    }
}
