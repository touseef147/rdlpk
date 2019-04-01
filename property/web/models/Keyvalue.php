<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class Keyvalue extends Model {

    private $_id;
    private $_secid;
    private $_value;
    private $_tag;
    private $_tag2;
    private $_tag3;
    private $_total;
    private $_totalsec;

    public function getId() {
        return $this->_id;
    }

    public function setId($value) {
        $this->_id = $value;
    }

    public function getsecId() {
        return $this->_secid;
    }

    public function setsecId($value) {
        $this->_secid = $value;
    }

    public function getValue() {
        return $this->_value;
    }

    public function setValue($value) {
        $this->_value = $value;
    }

    public function getTag() {
        return $this->_tag;
    }

    public function setTag($value) {
        $this->_tag = $value;
    }

    public function getTag2() {
        return $this->_tag2;
    }

    public function setTag2($value) {
        $this->_tag2 = $value;
    }

    public function getTag3() {
        return $this->_tag3;
    }

    public function setTag3($value) {
        $this->_tag3 = $value;
    }

    public function getTotal() {
        return $this->_total;
    }

    public function setTotal($value) {
        $this->_total = $value;
    }

    public function getTotalsec() {
        return $this->_totalsec;
    }

    public function setTotalsec($value) {
        $this->_totalsec = $value;
    }

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            [['id'], 'required'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
        ];
    }

    public function daysofmonth($month, $year) {
        $model = [];
        $totaldays = 28;

        if ($month == 2) {
            if ($year % 4 == 0)
                $totaldays = 28;
            else
                $totaldays = 29;
        }
        elseif ($month == 1 || $month == 3) {
            $totaldays = 31;
        } else {
            $totaldays = 30;
        }

        for ($i = 1; $i <= $totaldays; $i++) {
            $model[] = new \app\models\Keyvalue();

            $model[$i - 1]->id = $i;
            $model[$i - 1]->value = $i;
            $model[$i - 1]->total = 0;
        }

        return $model;
    }

    public function monthsofyear() {
        $model = [];

        for ($i = 1; $i <= 12; $i++) {
            $model[] = new \app\models\Keyvalue();

            $model[$i - 1]->id = $i;
            $model[$i - 1]->value = $this->getmonthname($i);
            $model[$i - 1]->total = 0;
        }

        return $model;
    }

    public function monthsindates($startdate, $enddate,$combineyear=1,$monthabr=1) {
        $model = [];

        $start = new DateTime($startdate);
        $start->modify('first day of this month');
        $end = new DateTime($enddate);
        $end->modify('first day of next month');
        $interval = DateInterval::createFromDateString('1 month');
        $period = new DatePeriod($start, $interval, $end);

        foreach ($period as $dt) {
            $model[] = new \app\models\Keyvalue();

            $model[$i - 1]->id = $dt->format("m");
            $model[$i - 1]->secid = $dt->format("Y");
            
            $monthname = ($monthabr==1 ? date("M", mktime(0, 0, 0, $dt->format("m"), 1)) : date("F", mktime(0, 0, 0, $dt->format("m"), 1)));
            if($combineyear==1)
            {
                $model[$i - 1]->value = $monthname."-".$dt->format("Y");
            }
            else
            {
                $model[$i - 1]->value = $monthname;
            }
                
            $model[$i - 1]->tag = $dt->format("m");
            $model[$i - 1]->tag2 = $dt->format("Y");
            $model[$i - 1]->total = 0;
        }

        return $model;
    }

    public function yearsindates($startdate, $enddate) {
        $model = [];

        $start = new DateTime($startdate);
        $start->modify('first day of this month');
        $end = new DateTime($enddate);
        $end->modify('first day of next month');
        $interval = DateInterval::createFromDateString('1 year');
        $period = new DatePeriod($start, $interval, $end);

        foreach ($period as $dt) {
            $model[] = new \app\models\Keyvalue();

            $model[$i - 1]->id = $dt->format("Y");
            $model[$i - 1]->value = $dt->format("Y");
            $model[$i - 1]->total = 0;
        }

        return $model;
    }

    public function getmonthname($monthno, $abbr = 1) {
        switch ($monthno) {
            case 1:
                return ($abbr == 1 ? "Jan" : "January");
                break;
            case 2:
                return ($abbr == 1 ? "Feb" : "February");
                break;
            case 3:
                return ($abbr == 1 ? "Mar" : "March");
                break;
            case 4:
                return ($abbr == 1 ? "Apr" : "April");
                break;
            case 5:
                return ($abbr == 1 ? "May" : "May");
                break;
            case 6:
                return ($abbr == 1 ? "Jun" : "June");
                break;
            case 7:
                return ($abbr == 1 ? "Jul" : "July");
                break;
            case 8:
                return ($abbr == 1 ? "Aug" : "August");
                break;
            case 9:
                return ($abbr == 1 ? "Sep" : "September");
                break;
            case 10:
                return ($abbr == 1 ? "Oct" : "October");
                break;
            case 11:
                return ($abbr == 1 ? "Nov" : "November");
                break;
            case 12:
                return ($abbr == 1 ? "Dec" : "December");
                break;
        }
    }

    //type 1 month, 2 months, 3 months, 4 months, 6 months,
    public function monthsfromdate($date, $type) {
        $model = [];
        $totaldays = 28;

        $datetime1 = date_create(date("Y-m-d"));
        $datetime2 = date_create(date("Y-m-d", strtotime($date)));
        $interval = date_diff($datetime1, $datetime2);
        //echo $months->format("%m months");
        $months = ($interval->y * 12) + $interval->m + ($interval->d==0? 0: 1);

        $count=0;
        $i=0;
        
        while($i < $months) {
            $model[] = new \app\models\Keyvalue();

            $datetime1->modify("+".$type." months");
            
            $model[$count]->id = $datetime1->format("m");
            $model[$count]->secid = $datetime1->format("Y");
            $model[$count]->value = $datetime1->format("M")."-".$datetime1->format("Y"); //date_add(, $i." months");
            //$model[$count]->tag = $datetime1->format("Y"); //date_add(, $i." months");
            $model[$count]->total = 0;
            
            $count++;
            $i+=$type;
        }

        return $model;
    }

}
