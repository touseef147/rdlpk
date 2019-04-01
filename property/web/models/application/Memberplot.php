<?php

namespace app\models\application;

use Yii;

/**
 * This is the model class for table "memberplot".
 *
 * @property integer $id
 * @property integer $plot_id
 * @property integer $member_id
 * @property string $create_date
 * @property string $modify_date
 * @property string $noi
 * @property integer $insplan
 * @property string $status
 * @property string $fstatus
 * @property string $user_name
 * @property string $plotno
 * @property string $comment
 * @property string $fcomment
 */
class Memberplot extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'memberplot';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['plot_id', 'member_id', 'create_date', 'modify_date', 'noi', 'insplan', 'status', 'fstatus', 'user_name', 'plotno', 'comment', 'fcomment'], 'required'],
            [['plot_id', 'member_id', 'insplan'], 'integer'],
            [['create_date', 'modify_date'], 'safe'],
            [['noi'], 'string', 'max' => 100],
            [['status'], 'string', 'max' => 256],
            [['fstatus', 'user_name', 'plotno', 'comment', 'fcomment'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'plot_id' => 'Plot ID',
            'member_id' => 'Member ID',
            'create_date' => 'Create Date',
            'modify_date' => 'Modify Date',
            'noi' => 'Noi',
            'insplan' => 'Insplan',
            'status' => 'Status',
            'fstatus' => 'Fstatus',
            'user_name' => 'User Name',
            'plotno' => 'Plotno',
            'comment' => 'Comment',
            'fcomment' => 'Fcomment',
        ];
    }

    public function updaterecord() {
        if ($this->save()) {
            return TRUE;
        }
        
        if(Yii::$app->user->identity->rawerrors ==1){
            echo "<h3>".$this->className()." Model: updaterecord</h3>";
            print_r($this->errors);
        }
            
        return FALSE;
    }
}
