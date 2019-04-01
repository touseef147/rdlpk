<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "property_transfer_fees".
 *
 * @property integer $transfer_fee_id
 * @property integer $project_id
 * @property integer $plot_size
 * @property double $amount
 */
class Propertytransferfees extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'property_transfer_fees';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'plot_size', 'amount'], 'required'],
            [['project_id', 'plot_size'], 'integer'],
            [['amount'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'transfer_fee_id' => 'Transfer Fee ID',
            'project_id' => 'Project ID',
            'plot_size' => 'Plot Size',
            'amount' => 'Amount',
        ];
    }

    public function getProject() {
        return $this->hasOne(Projects::className(), ['id' => 'project_id']);
    }

    public function getPlotsize() {
        return $this->hasOne(Sizecat::className(), ['id' => 'plot_size']);
    }
}
