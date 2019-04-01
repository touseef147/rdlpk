echo '<hr style="border-top: dotted 2px;"/>';
echo '<table class="divhead1" style="   page-break-inside: avoid;"><tbody>';
echo '<div class="">';
//echo '<div style="margin: 54px 0 0px 510px; position: absolute;"><img alt="RDLPK" src="http://'.$_SERVER['HTTP_HOST'].Yii::app()->request-//>baseUrl.'/barcode/barcode.php?text=RO-'.$data['rid'].$result_rpt['id'].'&print=false"  /></div>';
echo '<div style="margin: 75px 0 0px 535px;position: absolute;">'.$data['rid'].'-'.$result_rpt['id'].'</div>';
echo '<div style="margin: 90px 0 0px 40px;position: absolute;">'.date("d-m-Y", strtotime($data['mcd'] )).'</div>';
echo '<div style="margin: 88px 0 0px 535px;position: absolute; font-size:20px;"><b>'.$result_rpt['r_no'].'</b></div>';
echo '<div style="margin: 115px 0 0px 15px;position: absolute;">Received with thanks from </div>';
echo '<div style="margin: 115px 0 0px 170px;position: absolute; font-family:segoepr;">'.$result_member['name'];
$name='';
if(isset($othermember2['name'])){$name=$othermember2['name'];}
if(isset($othermember1['name'])){$name=$othermember1['name'];}
 if($result_member['name']!==$name){
	echo ' on behalf of '.$name;}
else{echo ' '.$result_member['title'].' '.$result_member['sodowo'];}
echo '</div>';
echo '<div style="margin: 140px 0 0px 15px;position: absolute;">'.$data['type'];
if($data['type']=='Cheque')
{ echo'&nbsp;*';}else { echo'';} echo '</div>';
echo '<div style="margin: 140px 0 0px 80px;position: absolute; font-family:segoepr;">'.$data['ref_no'].'</div>';
echo '<div style="margin: 140px 0 0px 200px;position: absolute;">Amounting to Rs.</div>';
echo '<div style="margin: 140px 0 0px 310px;position: absolute;font-family:segoepr;">'.number_format($data['amount']).'/-</div>';
echo '<div style="margin: 140px 0 0px 415px;position: absolute;">Dated</div>';
echo '<div style="margin: 140px 0 0px 460px;position: absolute; font-family:segoepr;">'.date("d-m-Y", strtotime($data['date'] )).'</div>';
if($result_membership['plotno']==''){
	echo '<div style="margin: 162px 0 0px 15px;position: absolute;">Form #</div>';
	echo '<div style="margin: 162px 0 0px 100px;position: absolute; font-family:segoepr;">'.$result_membership['app_no'].' &nbsp;&nbsp;('.$result_membership['plot_size'].')</div>';
	}else{
	echo '<div style="margin: 162px 0 0px 15px;position: absolute;">Membership #</div>';	
	echo '<div style="margin: 162px 0 0px 100px;position: absolute; font-family:segoepr;">'.$result_membership['plotno'].'&nbsp;&nbsp;(<span style="font-family:"Helvetica Neue", Helvetica, Arial, sans-serif">'.$result_membership['plot_size'].'</span>)</div>';
	}
echo '<div style="margin: 162px 0 0px 400px;position: absolute; ">Paid Amount</div>';
echo '<div style="margin: 162px 0 0px 520px;position: absolute; color:#fff; font-size:18px;"><b>Rs:'.number_format($total).'/-</b></div>';
echo '<table style=" width:665px;page-break-inside: avoid;  margin: 115px 0 0px -15px;position: absolute; font-size:12px;"><tbody>';
$no=0;
foreach($result_plots1 as $ch1){	
if($ch1['plot_id']==$new['plot_id']){
if($ch1['paidamount']==''){$ch1['paidamount']=0;}
$no=$no+1;
echo '<tr><td style="width:20px !important;">'.$no.'</td>
<td style="width:210px !important;">'.$ch1['payment_type'].'</td>
<td style="width:210px !important;"> '.$ch1['remarks'].'</td>
<td style="width:95px !important; text-align:right;">'.number_format($ch1['amount']).'</td>
<td style="width:95px !important;text-align:right;">'.number_format($ch1['paidamount']).'</td></tr>';}
}
foreach($result_plots2 as $ch1){	
if($ch1['ref'] > 0){
$sql_ref  = "Select * from proinstallpayment where id='".$ch1['ref']."'";
$result_ref = $connection->createCommand($sql_ref)->queryRow();	
	$ch1['lab']=$result_ref['lab'];
	$ch1['due_date']=$result_ref['due_date'];
	}
if($ch1['plot_id']==$new['plot_id']){

if($ch1['paidamount']==''){$ch1['paidamount']=0;}

$no=$no+1;
echo '<tr><td style="width:20px !important;">'.$no.'</td>
<td style="width:210px !important;">'.$ch1['lab'].'</td>
<td style="width:210px !important;"> '.$ch1['remarks'].'</td>
<td style="width:95px !important; text-align:right;">'.number_format($ch1['dueamount']).'</td>
<td style="width:95px !important; text-align:right;">'.number_format($ch1['paidamount']).'</td></tr>';}
}
echo '</tbody></table>';
$totalw=word($total);
date_default_timezone_set("Asia/Karachi");
echo '<div style="margin: '.(350+$heg).'px 0 0px -22px;position: absolute; width:686px; border-top:1px solid #000;">  The Sum of Rupees:</div>';
echo '<div style="margin: '.(350+$heg).'px 0 0px 110px;position: absolute; text-transform: capitalize; font-family:segoepr;">'.$totalw.'</div>';
echo '<div style="margin: '.(350+$heg).'px 0 0px 586px;position: absolute;     text-transform: capitalize; float:right;"><b>Rs.</b>'.number_format($total).'</div>';
if($data['type']=='Cheque'){
echo '<div style="margin: '.(390+$heg).'px 0 0px 100px;position: absolute; font-size:10px;"><b>*Note &nbsp;:</b>&nbsp;&nbsp;subject to clearance of cheque</div>';} else{ echo''; }
echo '<div style="margin: '.(380+$heg).'px 0 0px 500px;position: absolute;border-top:1px solid #000; font-size:10px;"><b>Signature</b></div>';
echo '<div style="margin: '.(380+$heg).'px 0 0px -17px;position: absolute; font-size:10px;"><b>[Receipt '.$rno.' of '.count($result_plots12).']</b></div>';
echo '<div style="margin: '.(408+$heg).'px 50px 0px -22px;position: absolute; font-size:10px;"><b>Username:</b>'.$result_us['salesname'].'&nbsp;|&nbsp;'.Yii::app()->session['user_array']['firstname'].'&nbsp;'.Yii::app()->session['user_array']['middelname'].'&nbsp;'.Yii::app()->session['user_array']['lastname'].'&nbsp;|&nbsp;'.date('d-M-Y h:m:s').'</div>';
echo '</tbody></table>';
//3rd copy
echo '<hr style="border-top: dotted 2px;"/>';
echo '<table class="divhead2" style="   page-break-inside: avoid;"><tbody>';
echo '<div class="">';
//echo '<div style="margin: 54px 0 0px 510px; position: absolute;"><img alt="RDLPK" src="http://'.$_SERVER['HTTP_HOST'].Yii::app()->request-//>baseUrl.'/barcode/barcode.php?text=RO-'.$data['rid'].$result_rpt['id'].'&print=false"  /></div>';
echo '<div style="margin: 75px 0 0px 535px;position: absolute;">'.$data['rid'].'-'.$result_rpt['id'].'</div>';
echo '<div style="margin: 90px 0 0px 40px;position: absolute;">'.date("d-m-Y", strtotime($data['mcd'] )).'</div>';
echo '<div style="margin: 88px 0 0px 535px;position: absolute; font-size:20px;"><b>'.$result_rpt['r_no'].'</b></div>';
echo '<div style="margin: 115px 0 0px 15px;position: absolute;">Received with thanks from </div>';
echo '<div style="margin: 115px 0 0px 170px;position: absolute; font-family:segoepr;">'.$result_member['name'];
$name='';
if(isset($othermember2['name'])){$name=$othermember2['name'];}
if(isset($othermember1['name'])){$name=$othermember1['name'];} 
if($result_member['name']!==$name){
	echo ' on behalf of '.$name;}
else{echo ' '.$result_member['title'].' '.$result_member['sodowo'];}
echo '</div>';
echo '<div style="margin: 140px 0 0px 15px;position: absolute;">'.$data['type'];
if($data['type']=='Cheque')
{ echo'&nbsp;*';}else { echo'';} echo '</div>';
echo '<div style="margin: 140px 0 0px 80px;position: absolute; font-family:segoepr;">'.$data['ref_no'].'</div>';
echo '<div style="margin: 140px 0 0px 200px;position: absolute;">Amounting to Rs.</div>';
echo '<div style="margin: 140px 0 0px 310px;position: absolute;font-family:segoepr;">'.number_format($data['amount']).'/-</div>';
echo '<div style="margin: 140px 0 0px 415px;position: absolute;">Dated</div>';
echo '<div style="margin: 140px 0 0px 460px;position: absolute; font-family:segoepr;">'.date("d-m-Y", strtotime($data['date'] )).'</div>';
if($result_membership['plotno']==''){
	echo '<div style="margin: 162px 0 0px 15px;position: absolute;">Form #</div>';
	echo '<div style="margin: 162px 0 0px 100px;position: absolute; font-family:segoepr;">'.$result_membership['app_no'].' &nbsp;&nbsp;('.$result_membership['plot_size'].')</div>';
	}else{
	echo '<div style="margin: 162px 0 0px 15px;position: absolute;">Membership #</div>';	
	echo '<div style="margin: 162px 0 0px 100px;position: absolute; font-family:segoepr;">'.$result_membership['plotno'].'&nbsp;&nbsp;(<span style="font-family:"Helvetica Neue", Helvetica, Arial, sans-serif">'.$result_membership['plot_size'].'</span>)</div>';
	}
echo '<div style="margin: 162px 0 0px 400px;position: absolute; ">Paid Amount</div>';
echo '<div style="margin: 162px 0 0px 520px;position: absolute; color:#fff; font-size:18px;"><b>Rs:'.number_format($total).'/-</b></div>';
echo '<table style=" width:665px;page-break-inside: avoid;  margin: 115px 0 0px -15px;position: absolute; font-size:12px;"><tbody>';
$no=0;
foreach($result_plots1 as $ch1){	
if($ch1['plot_id']==$new['plot_id']){
if($ch1['paidamount']==''){$ch1['paidamount']=0;}
$no=$no+1;
echo '<tr><td style="width:20px !important;">'.$no.'</td>
<td style="width:210px !important;">'.$ch1['payment_type'].'</td>
<td style="width:210px !important;"> '.$ch1['remarks'].'</td>
<td style="width:95px !important; text-align:right;">'.number_format($ch1['amount']).'</td>
<td style="width:95px !important;text-align:right;">'.number_format($ch1['paidamount']).'</td></tr>';}
}
foreach($result_plots2 as $ch1){	
if($ch1['ref'] > 0){
$sql_ref  = "Select * from proinstallpayment where id='".$ch1['ref']."'";
$result_ref = $connection->createCommand($sql_ref)->queryRow();	
	$ch1['lab']=$result_ref['lab'];
	$ch1['due_date']=$result_ref['due_date'];
	}
if($ch1['plot_id']==$new['plot_id']){
if($ch1['paidamount']==''){$ch1['paidamount']=0;}
$no=$no+1;
echo '<tr><td style="width:20px !important;">'.$no.'</td>
<td style="width:210px !important;">'.$ch1['lab'].'</td>
<td style="width:210px !important;"> '.$ch1['remarks'].'</td>
<td style="width:95px !important; text-align:right;">'.number_format($ch1['dueamount']).'</td>
<td style="width:95px !important; text-align:right;">'.number_format($ch1['paidamount']).'</td></tr>';}
}
echo '</tbody></table>';
$totalw=word($total);
date_default_timezone_set("Asia/Karachi");
echo '<div style="margin: '.(350+$heg).'px 0 0px -22px;position: absolute; width:686px; border-top:1px solid #000;">  The Sum of Rupees:</div>';
echo '<div style="margin: '.(350+$heg).'px 0 0px 110px;position: absolute;     text-transform: capitalize; font-family:segoepr;">'.$totalw.'</div>';
echo '<div style="margin: '.(350+$heg).'px 0 0px 586px;position: absolute; float:right;"><b>Rs.</b>'.number_format($total).'</div>';
if($data['type']=='Cheque'){
echo '<div style="margin: '.(390+$heg).'px 0 0px 100px;position: absolute; font-size:10px;"><b>*Note &nbsp;:</b>&nbsp;&nbsp;subject to clearance of cheque</div>';} else{ echo''; }
echo '<div style="margin: '.(380+$heg).'px 0 0px 500px;position: absolute;border-top:1px solid #000; font-size:10px;"><b>Signature</b></div>';
echo '<div style="margin: '.(380+$heg).'px 0 0px -17px;position: absolute; font-size:10px;"><b>[Receipt '.$rno.' of '.count($result_plots12).']</b></div>';
echo '<div style="margin: '.(408+$heg).'px 50px 0px -22px;position: absolute; font-size:10px;"><b>Username:</b>'.$result_us['salesname'].'&nbsp;|&nbsp;'.Yii::app()->session['user_array']['firstname'].'&nbsp;'.Yii::app()->session['user_array']['middelname'].'&nbsp;'.Yii::app()->session['user_array']['lastname'].'&nbsp;|&nbsp;'.date('d-M-Y h:m:s').'</div>';
echo '</div>';
echo '</tbody></table>';
$page=1;