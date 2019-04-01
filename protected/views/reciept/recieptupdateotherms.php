<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<?php 
$mem=0;
$mem=$data['mid'];
?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>
<script>
$(function() {
$( "#fromdatepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });
});
$(function() {
$( "#todatepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
});
</script>
<script>
(function (global) { 
    if(typeof (global) === "undefined") {
        throw new Error("window is undefined");
    }
    var _hash = "!";
    var noBackPlease = function () {
        global.location.href += "#";
        // making sure we have the fruit available for juice (^__^)
        global.setTimeout(function () {
            global.location.href += "!";
        }, 50);
    };
    global.onhashchange = function () {
        if (global.location.hash !== _hash) {
            global.location.hash = _hash;
        }
    };
    global.onload = function () {            
        noBackPlease();
        // disables backspace on page except on input fields and textarea..
        document.body.onkeydown = function (e) {
            var elm = e.target.nodeName.toLowerCase();
            if (e.which === 8 && (elm !== 'input' && elm  !== 'textarea')) {
                e.preventDefault();
            }
            // stopping event bubbling up the DOM tree..
            e.stopPropagation();
        };          
    }
})(window);
</script>
<style>
.reg-login-text-field {
	width: 150px !important;
}
.float-left {
	float: left;
	margin: 0 1px;
}
form {
	margin: 0 0 0px !important;
}
h5 {
	margin: 0px !important;
}
hr {
	margin: 0px !important;
}
</style>
<div class="span12" > 
    <h3>Manage Instrument : Generate Receipts</h3>
  </div> 
  <!-- shadow -->
  <hr noshade="noshade" class="hr-5 ">
  <section class="reg-section margin-top-30">
  <div style="
    padding: 0 0 0 32px;
    width: 300px;"> <span style="color:#FF0000; display:block;" id="error-name"></span> <span style="color:#FF0000; display:block;" id="error-logo"></span> <span style="color:#FF0000; display:block;" id="error-remarks"></span> <span style="color:#FF0000;display:block;" id="error-abbreviation"></span> <span style="color:#FF0000;display:block;" id="error-proprietor"></span> </div>
  <div style=" display:none;border:2px solid #999; border-radius:10px; min-height:80px; background-color:#FF9; padding:10px;" >
    <?php 
if($data['fstatus']!=='Verified' && Yii::app()->session['user_array']['per18']==1){
$form=$this->beginWidget('CActiveForm', array(
 'id'=>'user_login_form',
 'enableAjaxValidation'=>false,
  'enableClientValidation'=>true,
                'method' => 'POST',
                'clientOptions'=>array(
                     'validateOnSubmit'=>true,
                     'validateOnChange'=>true,
                     'validateOnType'=>false,
  ),
));} ?>
    <div id="error-div" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>
    <div class="float-left">
      <p class="reg-left-text">CNIC<font color="#FF0000">*</font></p>
      <p class="reg-right-field-area margin-left-5">
        <input type="text"  name="cnic" id="cnic"  class="reg-login-text-field" />
        <input type="hidden" value="<?php echo $data['rid']; ?>" name="rid" id="rid" class="reg-login-text-field" />
      </p>
    </div>
    <div class="float-left">
      <p class="reg-left-text" >Date<font color="#FF0000">*</font></p>
      <p class="reg-right-field-area margin-left-5">
        <input name="fromdate" placeholder="Enter Date" type="text" style="width:120px" id="fromdatepicker" value="<?php echo $newDate = date("d-m-Y", strtotime($data['date'] )); ?>">
      </p>
    </div>
    <div class="float-left">
      <p class="reg-left-text">Type<font color="#FF0000">*</font></p>
      <p class="reg-right-field-area margin-left-5">
        <select name="type" id="type" name="type" style="width:190px;" >
        <option name="type" value="<?php echo $data['type'] ?>"><?php echo $data['type'] ?></option>
        <option name="type"  value="Cash">Cash</option>
        <option name="type" value="Cheque">Cheque</option>
        <option name="type" value="Pay Order">Pay Order</option>
        <option value="Online">Online</option>
        </select>
      </p>
    </div>
    <?php 
   $connection = Yii::app()->db; 
  $sql_payment1  = "SELECT * FROM plotpayment where r_id='".$data['rid']."'";
	$result_payments1 = $connection->createCommand($sql_payment1)->queryAll();
			$totalp=0;
			$rem=0;
			$n=0;
		foreach($result_payments1 as $row){$n=$n+1;$totalp=$totalp+$row['paidamount']+$row['paidsurcharge'];}
		$sql_payment2  = "SELECT * FROM installpayment where r_id='".$data['rid']."'";
	$result_payments2 = $connection->createCommand($sql_payment2)->queryAll();
		foreach($result_payments2 as $row2){$n=$n+1;$totalp=$totalp+$row2['paidamount']+$row2['paidsurcharge'];}
   $rem=$data['amount']-$totalp;
   $lock='';
  if($rem<$data['amount']){$lock ='readonly="readonly"';}
  ?>
    <div class="float-left">
      <p class="reg-left-text">Ref<font color="#FF0000">*</font></p>
      <p class="reg-right-field-area margin-left-5">
        <input type="text" <?php echo $lock;?> value="<?php echo $data['ref_no'] ?>" name="ref" id="ref" class="reg-login-text-field" />
      </p>
    </div>
    <div class="float-left">
      <p class="reg-left-text">Amount<font color="#FF0000">*</font></p>
      <p class="reg-right-field-area margin-left-5">
        <input type="number"  value="<?php echo $data['amount'] ?>" name="amount" class="reg-login-text-field" />
      </p>
    </div>
    <?php
  $style='';
   if($rem>0){$style='background-color:red;';}else{$style='background-color:green;';}
   echo '<div class="float-left">
     <p class="reg-left-text" >Remaining Amount<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input style=" font-weight:bold; text-align:right;  '.$style.' color:#fff;"  type="text" class="new-input" value="'.$rem.'" readonly="readonly" > 
    </p>
  </div>';?>
    <?php 
  $ch='';
  if($data['typed']==1){$ch='checked';}if($n==0){?>
    <div class="float-left">
      <p class="reg-left-text">
        <input type="checkbox"  class="" id="ifd" name="ifd" value="1" <?php echo $ch;?>>
        Instrument for Dealer </p>
    </div>
    <?php } if($data['fstatus']!=='Verified' && Yii::app()->session['user_array']['per18']==1){
   echo CHtml::ajaxSubmitButton(
                                'Update',
    array('/reciept/updatere'),
                                array(  
                'beforeSend' => 'function(){ 
                                             $("#login").attr("disabled",true);
            }',
                                        'complete' => 'function(){ 
                                             $("#user_login_form").each(function(){});
                                             $("#login").attr("disabled",false);
                                        }',
                   'success'=>'function(data){  
                                           //  var obj = jQuery.parseJSON(data); 
                                            // View login errors!
                                             if(data == 1){
												// alert("we are here");
                                         location.href = "https://rdlpk.com/index.php/user/dashboard";
                                      }
          else{
                                                $("#error-div").show();
                                                $("#error-div").html(data);$("#error-div").append("");
												return false;
                                             }
                                        }'
    ),	
	array("id"=>"login","class" => "btn" , "style"=>"margin-top:30px; margin-left:20px;")      
                ); ?>
    <?php 
$this->endWidget(); }?>
    <div class="clearfix"></div>
    <div style=" width:100%;">Member Name: &nbsp;<b><?php echo $data['name']; ?></b></div>
  </div>
  <input type="text" name="otherms" id="otherms" onblur="Select_Plots()"   placeholder="Please Enter CNIC"/>
  
   <?php if($data['comm']!==''){?>
  <b style="color:red;">Remarks By Finance</b>:<?php echo $data['comm'];}?>
  <a style="float:right;" href="updatereciept?id=<?php echo $_REQUEST['id']?>">Back</a>
  <h5>Charges</h5>
  <div id="error-div1" style="color:#F00; font-weight:bold;"></div>
  <hr noshade="noshade" class="hr-5 ">
  <table class="table table-striped table-new table-bordered">
    <thead  style="color:#FFF">
    <th>MS #/App #</th>
      <th>Title</th>
      <th>Due Date</th>
      <th>Due Amount</th>
      <th>Paid Amount</th>
      <th>Due Surcharge</th>
      <th>Paid Surcharge</th>
      <th>Remarks</th>
      <th>Action</th>
      <th>Receipt no</th>
        </thead>
    <tbody>
      <?php  
$sql_plot1  = "SELECT *,plotpayment.id as cid from plotpayment 
Left join memberplot on (memberplot.plot_id=plotpayment.plot_id)
where plotpayment.r_id='".$_REQUEST['id']."' ";
$result_plots1 = $connection->createCommand($sql_plot1)->queryAll();
count($result_plots1);
foreach($result_plots1 as $ch){
$sql_rpt  = "Select * from rpt_print where rid='".$_REQUEST['id']."' and msid='".$ch['plot_id']."'  ";
$result_rpt = $connection->createCommand($sql_rpt)->queryRow();	
	if($ch['amount']==''){$ch['amount']=0;}
	if($ch['paidamount']==''){$ch['paidamount']=0;}
	if($ch['surcharge']==''){$ch['surcharge']=0;}
	if($ch['paidsurcharge']==''){$ch['paidsurcharge']=0;}
echo '<tr>
<td>'.$ch['plotno'].'/'.$ch['app_no'].'</td>
<td>'.$ch['payment_type'].'</td>
<td>'.$ch['duedate'].'</td>
<td style="text-align:right;">'.number_format($ch['amount']).'</td>
<td style="text-align:right;">'.number_format($ch['paidamount']).'</td>
<td style="text-align:right;">'.number_format($ch['surcharge']).'</td>
<td style="text-align:right;">'.number_format($ch['paidsurcharge']).'</td>
<td>'.$ch['remarks'].'</td>
<td>'; 
if($data['fstatus']!=='Verified' && Yii::app()->session['user_array']['per18']==1){
echo '<a href="deletechar?id='.$ch['cid'].'&&rid='.$_REQUEST['id'].'">Delete</a> ';
}
echo '</td>
<td>'.$result_rpt['r_no'].'</td>
</tr>';}
?>
    </tbody>
  </table>
  <?php 
if($rem>0 && Yii::app()->session['user_array']['per18']==1){
$form=$this->beginWidget('CActiveForm', array(
 'id'=>'user_login_form1',
 'enableAjaxValidation'=>false,
  'enableClientValidation'=>true,
                'method' => 'POST',
                'clientOptions'=>array(
                     'validateOnSubmit'=>true,
                     'validateOnChange'=>true,
                     'validateOnType'=>false,
  ),
)); ?>
  <select style="width: 150px;" name="plots" id="plots">
  </select>
    <?php 
?>
  </td>
  <td><select style="width: 150px;" id="charge" placeholder="charge" name="charge">
    </select></td>
  <input type="text" style="text-align:right;width: 130px;" readonly placeholder="Due Amount"  name="due"  id="duech" />
  <input type="text" style="text-align:right;width: 130px;" placeholder="Paid Amount"  name="paid" id="paidch" />
  <input type="text" style="text-align:right;width: 140px;" readonly placeholder="Surcharge"  name="surchargech" id="surchargech"  />
  <input type="text" style="text-align:right;width: 140px;" placeholder="Paid Surcharge"  name="paidsurchargech" id="paidsurchargech"  />
  <input type="text" style="width: 120px;" placeholder="Remarks" name="remarks"  />
  <input type="hidden" name="type" value="<?php echo $data['type'] ?>"  />
  <input type="hidden" name="ref" value="<?php echo $data['ref_no'] ?>"  />
  <input type="hidden" name="refid" value="<?php echo $data['rid'] ?>"  />
  <input type="hidden" name="mem_id" id="mem_id" value="<?php echo $data['mem_id'] ?>"  />
  <input type="hidden" name="date" value="<?php echo $data['date'] ?>"  />
  </td>
  <td><?php echo CHtml::ajaxSubmitButton(
                                'Save',
    array('/reciept/updatereq'),
                                array(  
                'beforeSend' => 'function(){ 
                                             $("#login1").attr("disabled",true);
            }',
                                        'complete' => 'function(){ 
                                             $("#user_login_form1").each(function(){});
                                             $("#login1").attr("disabled",false);
                                        }',
                   'success'=>'function(data){  
                                           //  var obj = jQuery.parseJSON(data); 
                                            // View login errors!
                                             if(data == 1){
												// alert("we are here");
                                         location.href = "https://rdlpk.com/index.php/user/dashboard";
                                      }
          else{
                                                $("#error-div1").show();
                                                $("#error-div1").html(data);$("#error-div1").append("");
												return false;
                                             }
                                        }'
    ),
	array("id"=>"login1","class" => "btn")      
                ); ?></td>
  <?php $this->endWidget(); }?>
  <h5>Installment </h5>
  <hr noshade="noshade" class="hr-5 ">
  <div id="error-div2" style="color:#F00; font-weight:bold;"></div>
  <table class="table table-striped table-new table-bordered">
    <thead  style="color:#FFF">
    <th>MS #/App #</th>
      <th>Title</th>
      <th>Due Date</th>
      <th>Due Amount</th>
      <th>Paid Amount</th>
      <th>Due Surcharge</th>
      <th>Paid Surcharge</th>
      <th>Remarks</th>
      <th>Action</th>
      <th>Receipt no</th>
        </thead>
    <tbody>
      <?php  $connection = Yii::app()->db; 
 $sql_plot2  = "SELECT *,installpayment.id as iid from installpayment 
Left join memberplot on (memberplot.plot_id=installpayment.plot_id)
where installpayment.r_id='".$_REQUEST['id']."' ";
$result_plots2 = $connection->createCommand($sql_plot2)->queryAll();
foreach($result_plots2 as $ch){
$sql_rpt  = "Select * from rpt_print where rid='".$_REQUEST['id']."' and msid='".$ch['plot_id']."'  ";
$result_rpt = $connection->createCommand($sql_rpt)->queryRow();	
if($ch['dueamount']==''){$ch['dueamount']=0;}
	if($ch['paidamount']==''){$ch['paidamount']=0;}
	if($ch['surcharge']==''){$ch['surcharge']=0;}
	if($ch['paidsurcharge']==''){$ch['paidsurcharge']=0;}
if($ch['ref'] > 0){
$sql_ref  = "Select * from installpayment where id='".$ch['ref']."'";
$result_ref = $connection->createCommand($sql_ref)->queryRow();	
	$ch['lab']=$result_ref['lab'];
	}
echo '<tr>
<td>'.$ch['plotno'].'/'.$ch['app_no'].'</td>
<td>'.$ch['lab'].'</td>
<td>'.$ch['due_date'].'</td>
<td style="text-align:right;">'.number_format($ch['dueamount']).'</td>
<td style="text-align:right;">'.number_format($ch['paidamount']).'</td>
<td style="text-align:right;">'.number_format($ch['surcharge']).'</td>
<td style="text-align:right;">'.number_format($ch['paidsurcharge']).'</td>
<td>'.$ch['remarks'].'</td>
<td>';
if($data['fstatus']!=='Verified' && Yii::app()->session['user_array']['per18']==1){
echo '<a href="deleteins?id='.$ch['iid'].'&&rid='.$_REQUEST['id'].'">Delete</a>';
}
echo '</td>
<td>'.$result_rpt['r_no'].'</td>
</tr>';}
?>
      <tr> </tr>
    </tbody>
  </table>
  <?php if($rem>0 && Yii::app()->session['user_array']['per18']==1){
 $form=$this->beginWidget('CActiveForm', array(
 'id'=>'user_login_form2',
 'enableAjaxValidation'=>false,
  'enableClientValidation'=>true,
                'method' => 'POST',
                'clientOptions'=>array(
                     'validateOnSubmit'=>true,
                     'validateOnChange'=>true,
                     'validateOnType'=>false,
  ),
)); 
?>
  <select style="width: 150px;" name="plots1" id="plots1">
  </select>
        <?php 
$connection = Yii::app()->db; 
?>
  </td>
  <td><select style="width: 150px;" id="install" name="install">
    </select></td>
  <input type="text" style="text-align:right;width: 130px;" readonly placeholder="Due Amount"  name="due" id="duein"  />
  <input type="text" style="text-align:right;width: 130px;" placeholder="Paid Amount"  name="paid"  id="paidin"  />
  <input type="text" style="text-align:right;width: 140px;" readonly placeholder="Surcharge"  name="surchargein" id="surchargein"  />
  <input type="text" style="text-align:right;width: 140px;" placeholder="Paid Surcharge"  name="paidsurchargein"  id="paidsurchargein"  />
  <input type="text" style="width: 120px;" placeholder="Remarks" name="remarks"  />
  <input type="hidden" name="refid" value="<?php echo $data['id'] ?>"  />
  <input type="hidden" name="mem_id" id="mem_id1" value="<?php echo $data['mem_id'] ?>"  />
  <input type="hidden" name="refid" value="<?php echo $data['rid'] ?>"  />
  <input type="hidden" name="type" value="<?php echo $data['type'] ?>"  />
  <input type="hidden" name="ref_no" value="<?php echo $data['ref_no'] ?>"  />
  <input type="hidden" name="date" value="<?php echo $data['date'] ?>"  />
  <td><?php echo CHtml::ajaxSubmitButton(
                                'Save',
    array('/reciept/updatereqin'),
                                array(  
                'beforeSend' => 'function(){ 
                                             $("#login2").attr("disabled",true);
            }',
                                        'complete' => 'function(){ 
                                             $("#user_login_form2").each(function(){});
                                             $("#login2").attr("disabled",false);
                                        }',
                   'success'=>'function(data){  
                                           //  var obj = jQuery.parseJSON(data); 
                                            // View login errors!
                                             if(data == 1){
												// alert("we are here");
                                         location.href = "https://rdlpk.com/index.php/user/dashboard";
                                      }
          else{
                                                $("#error-div2").show();
                                                $("#error-div2").html(data);$("#error-div2").append("");
												return false;
                                             }
                                        }'
    ),	
	array("id"=>"login2","class" => "btn")      
                ); ?></td>
  <?php $this->endWidget(); }
  //////////////////////////////////////////////////////END NORMAL PLOTS SECTION//////////////////////////////////////////////////////
  ?>
 
  <div style="background-color:#099; width:auto; height:30px; text-align:center;"><strong style="color:white; ">Property Payments (Charges/Installments)</strong></div>
<!-------//////////////////////////START:Property CHARGES and Installments//////////////////********************---->
<h5>Property Charges</h5>
  <div id="error-div3" style="color:#F00; font-weight:bold;"></div>
  <hr noshade="noshade" class="hr-5 ">
  <table class="table table-striped table-new table-bordered">
    <thead  style="color:#FFF">
    <th>MS #/App #</th>
      <th>Title</th>
      <th>Due Date</th>
      <th>Due Amount</th>
      <th>Paid Amount</th>
      <th>Due Surcharge</th>
      <th>Paid Surcharge</th>
      <th>Remarks</th>
      <th>Action</th>
      <th>Receipt no</th>
        </thead>
    <tbody>
      <?php  
   $sql_plot1  = "SELECT *,propertypayment.id as cid,
   property.plotno,
   property.app_no 
   from propertypayment 
  left join property on property.id=propertypayment.plot_id
where propertypayment.r_id='".$_REQUEST['id']."' ";




$result_plots147 = $connection->createCommand($sql_plot1)->queryAll();

//print_r($result_plots147);
count($result_plots147);
foreach($result_plots147 as $ch){
 $sql_rpt  = "Select * from rpt_print where rid='".$_REQUEST['id']."' and msid='".$ch['id']."'  ";
$result_rpt = $connection->createCommand($sql_rpt)->queryRow();	
	if($ch['amount']==''){$ch['amount']=0;}
	if($ch['paidamount']==''){$ch['paidamount']=0;}
	if($ch['surcharge']==''){$ch['surcharge']=0;}
	if($ch['paidsurcharge']==''){$ch['paidsurcharge']=0;}
echo '<tr>
<td>';if(empty($ch['plotno'])) { echo $ch['app_no'];} else{ echo $ch['plotno'];}echo '</td>
<td>'.$ch['payment_type'].'</td>
<td>'.$ch['duedate'].'</td>
<td style="text-align:right;">'.number_format($ch['amount']).'</td>
<td style="text-align:right;">'.number_format($ch['paidamount']).'</td>
<td style="text-align:right;">'.number_format($ch['surcharge']).'</td>
<td style="text-align:right;">'.number_format($ch['paidsurcharge']).'</td>
<td>'.$ch['remarks'].'</td>
<td>'; 
if($data['fstatus']!=='Verified' && Yii::app()->session['user_array']['per18']==1){
echo '<a href="delpropchar?id='.$ch['cid'].'&&rid='.$_REQUEST['id'].'">Delete</a> ';
}
echo '</td>
<td>'.$result_rpt['r_no'].'</td>
</tr>';}
?>
    </tbody>
  </table>
  <?php 
if($rem>0 && Yii::app()->session['user_array']['per18']==1){
$form=$this->beginWidget('CActiveForm', array(
 'id'=>'user_login_form3',
 'enableAjaxValidation'=>false,
  'enableClientValidation'=>true,
                'method' => 'POST',
                'clientOptions'=>array(
                     'validateOnSubmit'=>true,
                     'validateOnChange'=>true,
                     'validateOnType'=>false,
  ),
)); ?>
   <select style="width: 150px;" name="propplots" id="propplots">
    <?php 
 
echo '<option value="">Select Plot</option>';

?>
  </select>
  </td>
  <td><select style="width: 150px;" id="propcharge" placeholder="Property charge" name="propcharge">
    </select></td>
  <input type="text" style="text-align:right;width: 130px;" readonly placeholder="Due Amount"  name="propdue"  id="propduech" />
  <input type="text" style="text-align:right;width: 130px;" placeholder="Paid Amount"  name="paid" id="paidch" />
  <input type="text" style="text-align:right;width: 140px;"  placeholder="Property Surcharge"  name="propsurchargech" id="propsurchargech"  />
  <input type="text" style="text-align:right;width: 140px;" placeholder="Paid Surcharge"  name="paidsurchargech" id="paidsurchargech"  />
  <input type="text" style="width: 120px;" placeholder="Remarks" name="remarks"  />
  <input type="hidden" name="type" value="<?php echo $data['type'] ?>"  />
  <input type="hidden" name="ref" value="<?php echo $data['ref_no'] ?>"  />
  <input type="hidden" name="refid" value="<?php echo $data['rid'] ?>"  />
  <input type="hidden" name="mem_id" value="<?php echo $data['mid'] ?>"  />
  <input type="hidden" name="date" value="<?php echo $data['date'] ?>"  />
  </td>
  <td><?php echo CHtml::ajaxSubmitButton(
                                'Save Charges',
    array('/reciept/addpropcharge'),
                                array(  
                'beforeSend' => 'function(){ 
                                             $("#login3").attr("disabled",true);
            }',
                                       'complete' => 'function(){ 
                                             $("#user_login_form3").each(function(){});
                                             $("#login3").attr("disabled",false);
                                        }',
                   'success'=>'function(data){  
                                           //  var obj = jQuery.parseJSON(data); 
                                            // View login errors!
                                             if(data == 1){
												// alert("we are here");
                                         location.href = "https://rdlpk.com/index.php/user/dashboard";
                                      }
          else{
                                                $("#error-div3").show();
                                                $("#error-div3").html(data);$("#error-div3").append("");
												return false;
                                             }
                                        }'
    ),
	array("id"=>"login3","class" => "btn")      
                ); ?></td>
  <?php $this->endWidget(); }?>
  <h5>Property Installments </h5>
  <hr noshade="noshade" class="hr-5 ">
  <div id="error-div4" style="color:#F00; font-weight:bold;"></div>
  <table class="table table-striped table-new table-bordered">
    <thead  style="color:#FFF">
    <th>MS #/App #</th>
      <th>Title</th>
      <th>Due Date</th>
      <th>Due Amount</th>
      <th>Paid Amount</th>
      <th>Due Surcharge</th>
      <th>Paid Surcharge</th>
      <th>Remarks</th>
      <th>Action</th>
      <th>Receipt no</th>
        </thead>
    <tbody>
      <?php  $connection = Yii::app()->db; 
    $sql_plot2  = "SELECT proinstallpayment.lab,proinstallpayment.due_date,proinstallpayment.payment_type,proinstallpayment.dueamount,proinstallpayment.paidamount,proinstallpayment.surcharge,proinstallpayment.paidsurcharge,
   property.id as plot_id,
   property.plotno,
   proinstallpayment.ref,
   proinstallpayment.remarks,
   proinstallpayment.id as iid
    from proinstallpayment
   left join property on proinstallpayment.plot_id=property.id
where proinstallpayment.r_id='".$_REQUEST['id']."'";
$result_plots2 = $connection->createCommand($sql_plot2)->queryAll();
foreach($result_plots2 as $ch){
 $sql_rpt  = "Select * from rpt_print where rid='".$_REQUEST['id']."'and msid='".$ch['plot_id']."'  ";
$result_rpt = $connection->createCommand($sql_rpt)->queryRow();	
if($ch['dueamount']==''){$ch['dueamount']=0;}
	if($ch['paidamount']==''){$ch['paidamount']=0;}
	if($ch['surcharge']==''){$ch['surcharge']=0;}
	if($ch['paidsurcharge']==''){$ch['paidsurcharge']=0;}
if($ch['ref'] > 0){
$sql_ref  = "Select * from proinstallpayment where id='".$ch['ref']."'";
$result_ref = $connection->createCommand($sql_ref)->queryRow();	
	$ch['lab']=$result_ref['lab'];
	$ch['due_date']=$result_ref['due_date'];
	}
echo '<tr>
<td>'.$ch['plotno'].'</td>
<td>'.$ch['lab'].'</td>
<td>'.$ch['due_date'].'</td>
<td style="text-align:right;">'.number_format($ch['dueamount']).'</td>
<td style="text-align:right;">'.number_format($ch['paidamount']).'</td>
<td style="text-align:right;">'.floatval($ch['surcharge']).'</td>
<td style="text-align:right;">'.number_format($ch['paidsurcharge']).'</td>
<td>'.$ch['remarks'].'</td>
<td>';
if($data['fstatus']!=='Verified' && Yii::app()->session['user_array']['per18']==1){
echo '<a href="delpropins?id='.$ch['iid'].'&&rid='.$_REQUEST['id'].'">Delete</a>';
}
echo '</td>
<td>'.$result_rpt['r_no'].'</td>
</tr>';}
?>
      <tr> </tr>
    </tbody>
  </table>
  <?php if($rem>0 && Yii::app()->session['user_array']['per18']==1){
 $form=$this->beginWidget('CActiveForm', array(
 'id'=>'user_login_form4',
 'enableAjaxValidation'=>false,
  'enableClientValidation'=>true,
                'method' => 'POST',
                'clientOptions'=>array(
                     'validateOnSubmit'=>true,
                     'validateOnChange'=>true,
                     'validateOnType'=>false,
  ),
)); 
$sql_plot  = "SELECT property.id as pid,property.plotno,property.app_no from property
 where property.member_id='".$mem."'and property.mstatus!=2 ";
$result_plots = $connection->createCommand($sql_plot)->queryAll();

?>
  <select style="width: 150px;" name="property1" id="property1">
    <?php 
$connection = Yii::app()->db; 
$sql_plot  = "SELECT *,plots.id as pid from plots
Left join memberplot on (plots.id=memberplot.plot_id)
Left join projects on (projects.id=plots.project_id)
Left join streets on (streets.id=plots.street_id)
Left join sectors on (sectors.id=plots.sector)
 where memberplot.member_id='".$mem."' and memberplot.mstatus !=2 ";
  $sql_t  = "SELECT *,plots.id as pid from plots
Left join transferproperty on (plots.id=transferproperty.plot_id)
Left join memberplot on (plots.id=memberplot.plot_id)
Left join projects on (projects.id=plots.project_id)
 where transferproperty.transferto_id='".$mem."'  and memberplot.mstatus!=2";
$result_t = $connection->createCommand($sql_t)->queryAll();
echo '<option value="">Select Plot</option>';
foreach($result_plots as $po){
	echo '<option value="'.$po['pid'].'">'.$po['plotno'].'/'.$po['app_no'].'</option>';
}
	foreach($result_t as $t){
echo '<option value="'.$t['pid'].'">'.$t['plotno'].'/'.$t['app_no'].'(Transfer Request)</option>';	}
?>
  </select>
  </td>
  <td><select style="width: 150px;" id="propertyinstall" name="propertyinstall">
    </select></td>
  <input type="text" style="text-align:right;width: 130px;" readonly placeholder="Due Amount"  name="duepropins" id="duepropins"  />
  <input type="text" style="text-align:right;width: 130px;" placeholder="Paid Amount"  name="paidpropin"  id="paidpropin"  />
  <input type="text" style="text-align:right;width: 140px;" placeholder="Surcharge"  name="surchargepropins" id="surchargepropins"  />
  <input type="text" style="text-align:right;width: 140px;" placeholder="Paid Surcharge"  name="paidsurchargepropins"  id="paidsurchargepropins"  />
  <input type="text" style="width: 120px;" placeholder="Remarks" name="remarks"  />
  <input type="hidden" name="refid" value="<?php echo $data['id'] ?>"  />
  <input type="hidden" name="mem_id" value="<?php echo $data['mid'] ?>"  />
  <input type="hidden" name="refid" value="<?php echo $data['rid'] ?>"  />
  <input type="hidden" name="type" value="<?php echo $data['type'] ?>"  />
  <input type="hidden" name="ref_no" value="<?php echo $data['ref_no'] ?>"  />
  <input type="hidden" name="date" value="<?php echo $data['date'] ?>"  />
  <td><?php echo CHtml::ajaxSubmitButton(
                                'Save',
    array('/reciept/addpropinstallment'),
                                array(  
                'beforeSend' => 'function(){ 
                                             $("#login4").attr("disabled",true);
            }',
                                        'complete' => 'function(){ 
                                             $("#user_login_form4").each(function(){});
                                             $("#login4").attr("disabled",false);
                                        }',
                   'success'=>'function(data){  
                                           //  var obj = jQuery.parseJSON(data); 
                                            // View login errors!
                                             if(data == 1){
												// alert("we are here");
                                         location.href = "https://rdlpk.com/index.php/user/dashboard";
                                      }
          else{
                                                $("#error-div4").show();
                                                $("#error-div4").html(data);$("#error-div4").append("");
												return false;
                                             }
                                        }'
    ),
	array("id"=>"login4","class" => "btn")      
                ); ?></td>
  <?php $this->endWidget(); }?>
</div>
</section>
<!-- section 3 --> 
<script>
 $(document).ready(function()
     {  	
       $("#charge").change(function()
           {
         	select_amounts($(this).val());
		   });
		   
		   $("#property1").change(function()
           {
         	select_propinstall($(this).val());
		   });
     });
	 function select_propinstall(id)
{
$.ajax({
      type: "POST",
      url:    "ajaxRequestins?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
	var listItems='';
	listItems+= "<option value=''>Select </option>";
	$(json).each(function(i,val){
//alert(val.dueamount);
//alert(val.paidamount);
		if(val.dueamount != val.paidamount){
	listItems+= "<option value='" + val.id + "'>" + val.lab + "(" +val.dueamount +")</option>";
}
});listItems+="";
$("#propertyinstall").html(listItems);
          }
    });
}
function select_amounts(id)
{
$.ajax({
      type: "POST",
      url:    "propchargesam?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var newv='';
	$(json).each(function(i,val){
	var pre='';
	newv= val.amount - val.paidamount;
});
var elem = document.getElementById("duech");
elem.value = newv;
var elem1 = document.getElementById("paidch");
elem1.value = newv;
//$("#plotno").value(newv);
          }
    });
	$.ajax({
      type: "POST",
      url:    "propsurcharge?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var newv='';
	$(json).each(function(i,val){
	var pre='';
	newv= val
});
var elem = document.getElementById("propsurchargech");
elem.value = newv;
//$("#plotno").value(newv);
          }
    });
}
$(document).ready(function()
     {  	
       $("#install").change(function()
           {
         	select_installa($(this).val());
		   });
     })
	 $(document).ready(function()
     {  	
       $("#propertyinstall").change(function()
           {
         	select_installprop($(this).val());
		   });
     });
function select_installprop(id)
{
$.ajax({
      type: "POST",
      url:    "installprop?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var newv='';
$(json).each(function(i,val){
var pre='';
	newv= val.dueamount - val.paidamount;
});
var elem = document.getElementById("duepropins");
elem.value = newv;
var elem1 = document.getElementById("paidpropin");
elem1.value = newv;

//$("#plotno").value(newv);
          }

    });
	$.ajax({
      type: "POST",
      url:    "surpropinstall?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var newv='';
	$(json).each(function(i,val){
	var pre='';	newv= val
});
var elem = document.getElementById("surchargepropins");
elem.value = newv;
//$("#plotno").value(newv);
          }
    });
		  
}
function select_installa(id)
{
$.ajax({
      type: "POST",
      url:    "installam?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var newv='';
	$(json).each(function(i,val){
	var pre='';
	newv= val.dueamount - val.paidamount;
});
var elem = document.getElementById("duein");
elem.value = newv;
var elem1 = document.getElementById("paidin");
elem1.value = newv;
//$("#plotno").value(newv);
          }
    });
	$.ajax({
      type: "POST",
      url:    "surinstall?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var newv='';
	$(json).each(function(i,val){
	var pre='';
		newv= val

});



var elem = document.getElementById("surchargein");

elem.value = newv;



//$("#plotno").value(newv);

          }

    });

		  

}

 $(document).ready(function()
     {  	
       $("#plots").change(function()
           {
         	select_chrges($(this).val());
		   });
		    $("#propplots").change(function()
           {
         		select_propchrges($(this).val());
		   });
		    $("#propcharge").change(function()
           {
         	select_propamounts($(this).val());
		   });
     });
	 
	 function select_propamounts(id)
{
$.ajax({
      type: "POST",
      url:    "propchargesam?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var newv='';
	$(json).each(function(i,val){
	var pre='';
	newv= val.amount - val.paidamount;
});
var elem = document.getElementById("propduech");
elem.value = newv;
var elem1 = document.getElementById("paidch");
elem1.value = newv;
//$("#plotno").value(newv);
          }
    });
	$.ajax({
      type: "POST",
      url:    "propsurcharge?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var newv='';
	$(json).each(function(i,val){
	var pre='';
	newv= val
});
var elem = document.getElementById("propsurchargech");
elem.value = newv;
//$("#plotno").value(newv);
          }
    });
		  
}
	 function select_propchrges(id)
{
$.ajax({
      type: "POST",
      url:    "ajaxRequestprop?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
listItems+= "<option value=''>Select</option>";
	$(json).each(function(i,val){
		if(val.amount != val.paidamount)
	listItems+= "<option value='" + val.id + "'>" + val.payment_type + "(" +val.amount +")</option>";
});listItems+="";
$("#propcharge").html(listItems);
          }
    });
}
function select_propchrges(id)
{
$.ajax({
      type: "POST",
      url:    "ajaxRequestprop1?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
listItems+= "<option value=''>Select</option>";
	$(json).each(function(i,val){
	
	listItems+= "<option value='" + val.id + "'>" + val.payment_type + "(" +val.amount +")</option>";
});listItems+="";
$("#propcharge").html(listItems);
          }
    });
}
function Select_Plots(id){
var elem=document.getElementById("otherms").value;
$.ajax({
      type: "POST",
      url:    "othermsplots?val1="+elem,
	  contenetType:"json",
       success: function(jsonList){var json = $.parseJSON(jsonList);	  
		var listItems='';
	 listItems+= "<option value=''>Select Plot</option>";
	$(json).each(function(i,val){
	
	listItems+= "<option value='" + val.pid + "'>" + val.plotno +" ("+val.app_no+")</option>";

});listItems+="";

$("#plots").html(listItems);
$("#plots1").html(listItems);


 }

    });
$.ajax({
      type: "POST",
      url:    "otherms?val1="+elem,
	  contenetType:"json",
       success: function(jsonList){var json = $.parseJSON(jsonList);	  
		var listItems='';
	 listItems+= "<option value=''>Select Plot</option>";
	$(json).each(function(i,val){
	
	listItems+= "<option value='" + val.pid + "'>" + val.plotno +" ("+val.app_no+")</option>";

});listItems+="";


$("#propplots").html(listItems);
$("#property1").html(listItems);

 }

    });

}
function select_chrges(id)

{

$.ajax({

      type: "POST",

      url:    "ajaxRequest?val1="+id,

	  contenetType:"json",

      success: function(jsonList){var json = $.parseJSON(jsonList);

var listItems='';

listItems+= "<option value=''>Select</option>";

	$(json).each(function(i,val){

		if(val.amount > val.paidamount)

	listItems+= "<option value='" + val.id + "'>" + val.payment_type + "(" +val.amount +")</option>";

});listItems+="";

$("#charge").html(listItems);

          }

    });

}



 $(document).ready(function()

     {  	

       $("#plots1").change(function()

           {

         	select_install($(this).val());

		   });

     });





function select_install(id)

{

$.ajax({

      type: "POST",

      url:    "ajaxRequest1?val1="+id,

	  contenetType:"json",

      success: function(jsonList){var json = $.parseJSON(jsonList);

	var listItems='';

	listItems+= "<option value=''>Select </option>";

	$(json).each(function(i,val){

		if(val.dueamount > val.paidamount)

	listItems+= "<option value='" + val.id + "'>" + val.lab + "(" +val.dueamount +")</option>";

});listItems+="";

$("#install").html(listItems);

          }

    });

Get_new_member(id);
}
function Get_new_member(id){
var elem=document.getElementById("otherms").value;

$.ajax({
      type: "POST",
      url:    "othermemberid?val1="+elem,
	  contenetType:"json",
      success: function(response){
		 document.getElementById("mem_id").value=response;
		 document.getElementById("mem_id1").value=response;
		 
		}

    });

}


</script>
<div class="clearfix"></div>

<?php 

function word( $num = '' )

{

    $num    = ( string ) ( ( int ) $num );

   

    if( ( int ) ( $num ) && ctype_digit( $num ) )

    {

        $words  = array( );

       

        $num    = str_replace( array( ',' , ' ' ) , '' , trim( $num ) );

       

        $list1  = array('','one','two','three','four','five','six','seven',

            'eight','nine','ten','eleven','twelve','thirteen','fourteen',

            'fifteen','sixteen','seventeen','eighteen','nineteen');

       

        $list2  = array('','ten','twenty','thirty','forty','fifty','sixty',

            'seventy','eighty','ninety','hundred');

       

        $list3  = array('','thousand','million','billion','trillion',

            'quadrillion','quintillion','sextillion','septillion',

            'octillion','nonillion','decillion','undecillion',

            'duodecillion','tredecillion','quattuordecillion',

            'quindecillion','sexdecillion','septendecillion',

            'octodecillion','novemdecillion','vigintillion');

       

        $num_length = strlen( $num );

        $levels = ( int ) ( ( $num_length + 2 ) / 3 );

        $max_length = $levels * 3;

        $num    = substr( '00'.$num , -$max_length );

        $num_levels = str_split( $num , 3 );

       

        foreach( $num_levels as $num_part )

        {

			$levels--;
            $hundreds   = ( int ) ( $num_part / 100 );
            $hundreds   = ( $hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ( $hundreds == 1 ? '' : 's' ) . ' ' : '' );
            $tens       = ( int ) ( $num_part % 100 );
            $singles    = '';
            if( $tens < 20 )
            {
                $tens   = ( $tens ? ' ' . $list1[$tens] . ' ' : '' );
            }
            else
            { 
                $tens   = ( int ) ( $tens / 10 );
                $tens   = ' ' . $list2[$tens] . ' ';
                $singles    = ( int ) ( $num_part % 10 );
                $singles    = ' ' . $list1[$singles] . ' ';
            }
            $words[]    = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_part ) ) ? ' ' . $list3[$levels] . ' ' : '' );
        }
        $commas = count( $words );
        if( $commas > 1 )
        {
            $commas = $commas - 1;
        }
        $words  = implode( ' ' , $words );
   return $words.' Only';

    }

    else if( ! ( ( int ) $num ) )

    {

        return 'Zero';

    }

    return '';}



?>
<?php if(($data['sub_date']=='0000-00-00' && Yii::app()->session['user_array']['per18']==1)or Yii::app()->session['user_array']['per9']==1){?>
<a href="Deleteinstru?id=<?php echo $_REQUEST['id']; ?>" style="margin-top:30px; float:right;" class="btn" >Delete Instrument</a>
<?php }?>
