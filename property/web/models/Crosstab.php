<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class Crosstab extends Model
{
    private $_row_id;
    private $_column_id;
    private $_value;

    public function getRowid() {
        return $this->_row_id;
    }

    public function setRowid($value) {
        $this->_row_id = $value;
    }

    public function getColumnid() {
        return $this->_column_id;
    }

    public function setColumnid($value) {
        $this->_column_id = $value;
    }

    public function getValue() {
        return $this->_value;
    }

    public function setValue($value) {
        $this->_value = $value;
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['rowid'], 'required'],
            [['columnid'], 'required'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'rowid' => 'Row',
            'columnid' => 'Column',
        ];
    }
}
