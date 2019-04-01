<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<?php 
$mem=0;
$mem=$data['mid'];
?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script> 
<div class="span12" style=" display:none;" >
<div class="shadow">
<a href="reciept_lis" class="btn" style="float:right" >Back</a>
<img alt="RDLPK" src="<?php echo Yii::app()->request->baseUrl;?>/barcode/barcode.php?text=RO-<?php $data['rid']?>&print=false"  style=" height:25px;float:right"/>
</div>
<div id="error-div2" style="color:#F00; font-weight:bold;"></div>
 </div>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<style>
	@page { margin: 0px; }
td{border:none !important;
padding:0px !important;}

	.divhead{
		border:3px inset #000;
		margin:20px 0px 30px 0px;
		z-index: -1;
		min-height:380px;
	    background-image: url('<?php echo Yii::app()->baseUrl; ?>/dompdf/recbg.jpg') ;
		background-repeat:no-repeat;
		width:700px;}			
	body {
		font-size:10;
margin: 0px;
background-size: cover;
background-repeat:no-repeat;
	}
</style>
</head>
<?php 
   $connection = Yii::app()->db; 
$sql_plot2  = "SELECT *,installpayment.id as iid from installpayment 
Left join memberplot on (memberplot.plot_id=installpayment.plot_id)
where installpayment.r_id='".$_REQUEST['id']."' ";
$result_plots2 = $connection->createCommand($sql_plot2)->queryAll();
$sql_plot1  = "SELECT *,plotpayment.id as cid from plotpayment 
Left join memberplot on (memberplot.plot_id=plotpayment.plot_id)
where plotpayment.r_id='".$_REQUEST['id']."' ";
$result_plots1 = $connection->createCommand($sql_plot1)->queryAll();
$connection = Yii::app()->db; 
$sql_us  = "Select *,sales_center.name as salesname from user 
left join sales_center on(user.sc_id=sales_center.id)
where user.id ='".Yii::app()->session['user_array']['id']."'";
$result_us = $connection->createCommand($sql_us)->queryRow();
$sql_plot12  = "
SELECT plot_id FROM installpayment where r_id='".$_REQUEST['id']."'
UNION DISTINCT 
SELECT plot_id FROM plotpayment where r_id='".$_REQUEST['id']."'";
$result_plots12 = $connection->createCommand($sql_plot12)->queryAll();
$page=0;
$pa=0;
$rno=0;
foreach($result_plots12 as $new){
$rno=$rno+1;
	if($page>0){
		echo '<div style="page-break-before: always;"></div>';
		}
$sql_rpt  = "Select * from rpt_print where rid='".$_REQUEST['id']."' and msid='".$new['plot_id']."'  ";
$result_rpt = $connection->createCommand($sql_rpt)->queryRow();	
$sql_member  = "Select * from members where cnic='".$data['cnic']."'";
$result_member = $connection->createCommand($sql_member)->queryRow();	
$sql_membership  = "Select * from plots
Left Join memberplot on (memberplot.plot_id=plots.id)
Left Join size_cat on (plots.size2=size_cat.id)
 where plots.id='".$result_rpt['msid']."'";
$result_membership = $connection->createCommand($sql_membership)->queryRow();	
$total=0;
$totalw='';
foreach($result_plots2 as $ch1){	

if($ch1['plot_id']==$new['plot_id']){
$total=$total+$ch1['paidamount'];}}
foreach($result_plots1 as $ch1){	
if($ch1['plot_id']==$new['plot_id']){
$total=$total+$ch1['paidamount'];
}
if($ch1['plot_id']==$new['plot_id']){}}
$othemember  = "Select * from memberplot
left join members on(memberplot.member_id=members.id)
 where memberplot.plot_id='".$new['plot_id']."'";
$othermember1 = $connection->createCommand($othemember)->queryRow();	
echo '<div class="divhead">';
echo '<div style="margin: 32px 0 0px 532px; position: absolute;"><img alt="RDLPK" src="http://'.$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl.'/barcode/barcode.php?text=RO-'.$data['rid'].$result_rpt['id'].'&print=false"  /></div>';
echo '<div style="margin: 48px 0 0px 557px;position: absolute; font-size:8px; ">'.$data['rid'].'-'.$result_rpt['id'].'</div>';
echo '<div style="margin: 68px 0 0px 62px;position: absolute;">'.date("d-m-Y", strtotime($data['rcd'] )).'</div>';
echo '<div style="margin: 66px 0 0px 557px;position: absolute; font-size:20px;"><b>'.$result_rpt['r_no'].'</b></div>';
echo '<div style="margin: 93px 0 0px 37px;position: absolute;">Received with thanks from </div>';
echo '<div style="margin: 93px 0 0px 224px;position: absolute; font-family:segoepr;">'.$result_member['name'].' '.$result_member['title'].' '.$result_member['sodowo'];
if($result_member['name']!==$othermember1['name']){echo ' on behalf of '.$othermember1['name'];}
echo '</div>';
if(($data['fstatus']=='Cancelled') )
{
	echo '<div style="margin: 248px 0 0px 157px;position: absolute; font-size:25px; color:red; ">Cancelled Receipt</div>';
}
echo '<div style="margin: 118px 0 0px 37px;position: absolute;">'.$data['type'].'</div>';
echo '<div style="margin: 118px 0 0px 132px;position: absolute; font-family:segoepr;">'.$data['ref_no'].'</div>';
echo '<div style="margin: 118px 0 0px 222px;position: absolute;">Amounting to Rs.</div>';
echo '<div style="margin: 118px 0 0px 332px;position: absolute;font-family:segoepr;">'.number_format($data['amount']).'/-</div>';
echo '<div style="margin: 118px 0 0px 437px;position: absolute;">Dated</div>';
echo '<div style="margin: 118px 0 0px 482px;position: absolute; font-family:segoepr;">'.date("d-m-Y", strtotime($data['date'] )).'</div>';
if($result_membership['plotno']==''){
	echo '<div style="margin: 140px 0 0px 37px;position: absolute;">Form #</div>';
	echo '<div style="margin: 140px 0 0px 140px;position: absolute; font-family:segoepr;">'.$result_membership['app_no'].' &nbsp;&nbsp;('.$result_membership['size'].')</div>';
	}else{
	echo '<div style="margin: 140px 0 0px 37px;position: absolute;">Membership #</div>';	
	echo '<div style="margin: 140px 0 0px 140px;position: absolute; font-family:segoepr;">'.$result_membership['plotno'].'</div>';
	}
echo '<div style="margin: 140px 0 0px 410px;position: absolute; ">Paid Amount</div>';
echo '<div style="margin: 140px 0 0px 520px;position: absolute; color:#fff; font-size:18px;"><b>Rs:'.number_format($total).'/-</b></div>';
echo '<table style=" width:665px;page-break-inside: avoid;  margin: 195px 0 0px 12px;position: absolute; font-size:12px;"><tbody>';
$no=0;
foreach($result_plots1 as $ch1){	
if($ch1['plot_id']==$new['plot_id']){
if($ch1['paidamount']==''){$ch1['paidamount']=0;}
$no=$no+1;
echo '<tr><td style=width:20px !important;">'.$no.'</td>
<td style="width:210px !important;">'.$ch1['payment_type'].'</td>
<td style="width:210px !important;"> '.$ch1['remarks'].'</td>
<td style="width:95px !important; text-align:right;">'.number_format($ch1['amount']).'</td>
<td style="width:95px !important;text-align:right;">'.number_format($ch1['paidamount']).'</td></tr>';}
}
foreach($result_plots2 as $ch1){	
if($ch1['ref'] > 0){
$sql_ref  = "Select * from installpayment where id='".$ch1['ref']."'";
$result_ref = $connection->createCommand($sql_ref)->queryRow();	
	$ch1['lab']=$result_ref['lab'];
	$ch1['due_date']=$result_ref['due_date'];
	}
if($ch1['plot_id']==$new['plot_id']){
if($ch1['paidamount']==''){$ch1['paidamount']=0;}
$no=$no+1;
echo '<tr><td style=width:20px !important;">'.$no.'</td>
<td style="width:210px !important;">'.$ch1['lab'].'</td>
<td style="width:210px !important;"> '.$ch1['remarks'].'</td>
<td style="width:95px !important; text-align:right;">'.number_format($ch1['dueamount']).'</td>
<td style="width:95px !important; text-align:right;">'.number_format($ch1['paidamount']).'</td></tr>';}
}
echo '</tbody></table>';
$totalw=word($total);
date_default_timezone_set("Asia/Karachi");
echo '<div style="margin: 320px 0 0px 1px;position: absolute; width:698px; border-top:1px solid #000;">  The Sum of Rupees:</div>';
echo '<div style="margin: 321px 0 0px 153px;position: absolute; font-family:segoepr;">'.$totalw.'</div>';
echo '<div style="margin: 322px 0 0px 625px;position: absolute; float:right;"><b>Rs.</b>'.number_format($total).'</div>';
echo '<div style="margin: 347px 0 0px 500px;position: absolute;border-top:1px solid #000; font-size:10px;"><b>Signature</b></div>';
echo '<div style="margin:362px 0 0px 10px;position: absolute; font-size:10px;"><b>[Receipt '.$rno.' of '.count($result_plots12).']</b></div>';
echo '</div>';
$page=1;
}
?>
</html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<style>
	@page { margin: 0px; }
td{border:none !important;
padding:0px !important;}

	.divhead{
		border:3px inset #000;
		margin:20px 0px 30px 0px;
		z-index: -1;
		min-height:380px;
	    background-image: url('<?php echo Yii::app()->baseUrl; ?>/dompdf/recbg.jpg') ;
		background-repeat:no-repeat;
		width:700px;}			
	body {
		font-size:10;
margin: 0px;
background-size: cover;
background-repeat:no-repeat;
	}
</style>
</head>
<?php 
   $connection = Yii::app()->db; 
$sql_plot2  = "SELECT proinstallpayment.payment_type,proinstallpayment.dueamount,proinstallpayment.paidamount,proinstallpayment.surcharge,proinstallpayment.paidsurcharge,
   property.id as plot_id,
   property.plotno,
   proinstallpayment.ref,
   proinstallpayment.remarks,
   proinstallpayment.id as iid
    from proinstallpayment
   left join property on proinstallpayment.plot_id=property.id
where proinstallpayment.r_id='".$_REQUEST['id']."' ";
$result_plots2 = $connection->createCommand($sql_plot2)->queryAll();
$sql_plot1  = "SELECT *,propertypayment.id as cid from propertypayment 
Left join property on (propertypayment.plot_id=propertypayment.plot_id)
where propertypayment.r_id='".$_REQUEST['id']."' ";
$result_plots1 = $connection->createCommand($sql_plot1)->queryAll();
$connection = Yii::app()->db; 
$sql_us  = "Select *,sales_center.name as salesname from user 
left join sales_center on(user.sc_id=sales_center.id)
where user.id ='".Yii::app()->session['user_array']['id']."'";
$result_us = $connection->createCommand($sql_us)->queryRow();
$sql_plot12  = "
SELECT plot_id FROM proinstallpayment where r_id='".$_REQUEST['id']."'
UNION DISTINCT 
SELECT plot_id FROM propertypayment where r_id='".$_REQUEST['id']."'";
$result_plots12 = $connection->createCommand($sql_plot12)->queryAll();
$page=0;
$pa=0;
$rno=0;
foreach($result_plots12 as $new){
$rno=$rno+1;
	if($page>0){
		echo '<div style="page-break-before: always;"></div>';
		}
$sql_rpt  = "Select * from rpt_print where rid='".$_REQUEST['id']."' and msid='".$new['plot_id']."'  ";
$result_rpt = $connection->createCommand($sql_rpt)->queryRow();	
$sql_member  = "Select * from members where cnic='".$data['cnic']."'";
$result_member = $connection->createCommand($sql_member)->queryRow();	
$sql_membership  = "Select * from property where id=".$result_rpt['msid']."";
$result_membership = $connection->createCommand($sql_membership)->queryRow();	
$total=0;
$totalw='';
foreach($result_plots2 as $ch1){	

if($ch1['plot_id']==$new['plot_id']){
$total=$total+$ch1['paidamount'];}}
foreach($result_plots1 as $ch1){	
if($ch1['plot_id']==$new['plot_id']){
$total=$total+$ch1['paidamount'];
}
if($ch1['plot_id']==$new['plot_id']){}}
$othemember  = "Select * from property left join members on(property.member_id=members.id) where property.id=".$new['plot_id']."";
$othermember1 = $connection->createCommand($othemember)->queryRow();	
echo '<div class="divhead">';
echo '<div style="margin: 32px 0 0px 532px; position: absolute;"><img alt="RDLPK" src="http://'.$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl.'/barcode/barcode.php?text=RO-'.$data['rid'].$result_rpt['id'].'&print=false"  /></div>';
echo '<div style="margin: 48px 0 0px 557px;position: absolute; font-size:8px; ">'.$data['rid'].'-'.$result_rpt['id'].'</div>';
echo '<div style="margin: 68px 0 0px 62px;position: absolute;">'.date("d-m-Y", strtotime($data['rcd'] )).'</div>';
echo '<div style="margin: 66px 0 0px 557px;position: absolute; font-size:20px;"><b>'.$result_rpt['r_no'].'</b></div>';
echo '<div style="margin: 93px 0 0px 37px;position: absolute;">Received with thanks from </div>';
echo '<div style="margin: 93px 0 0px 224px;position: absolute; font-family:segoepr;">'.$result_member['name'].' '.$result_member['title'].' '.$result_member['sodowo'];
if($result_member['name']!==$othermember1['name']){echo ' on behalf of '.$othermember1['name'];}
echo '</div>';
if(($data['fstatus']=='Cancelled') )
{
	echo '<div style="margin: 248px 0 0px 157px;position: absolute; font-size:25px; color:red; ">Cancelled Receipt</div>';
}
echo '<div style="margin: 118px 0 0px 37px;position: absolute;">'.$data['type'].'</div>';
echo '<div style="margin: 118px 0 0px 132px;position: absolute; font-family:segoepr;">'.$data['ref_no'].'</div>';
echo '<div style="margin: 118px 0 0px 222px;position: absolute;">Amounting to Rs.</div>';
echo '<div style="margin: 118px 0 0px 332px;position: absolute;font-family:segoepr;">'.number_format($data['amount']).'/-</div>';
echo '<div style="margin: 118px 0 0px 437px;position: absolute;">Dated</div>';
echo '<div style="margin: 118px 0 0px 482px;position: absolute; font-family:segoepr;">'.date("d-m-Y", strtotime($data['date'] )).'</div>';
if($result_membership['plotno']==''){
	echo '<div style="margin: 140px 0 0px 37px;position: absolute;">Form #</div>';
	echo '<div style="margin: 140px 0 0px 140px;position: absolute; font-family:segoepr;">'.$result_membership['app_no'].' &nbsp;&nbsp;('.$result_membership['size'].')</div>';
	}else{
	echo '<div style="margin: 140px 0 0px 37px;position: absolute;">Membership #</div>';	
	echo '<div style="margin: 140px 0 0px 140px;position: absolute; font-family:segoepr;">'.$result_membership['plotno'].'</div>';
	}
echo '<div style="margin: 140px 0 0px 410px;position: absolute; ">Paid Amount</div>';
echo '<div style="margin: 140px 0 0px 520px;position: absolute; color:#fff; font-size:18px;"><b>Rs:'.number_format($total).'/-</b></div>';
echo '<table style=" width:665px;page-break-inside: avoid;  margin: 195px 0 0px 12px;position: absolute; font-size:12px;"><tbody>';
$no=0;
foreach($result_plots1 as $ch1){	
if($ch1['plot_id']==$new['plot_id']){
if($ch1['paidamount']==''){$ch1['paidamount']=0;}
$no=$no+1;
echo '<tr><td style=width:20px !important;">'.$no.'</td>
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
echo '<tr><td style=width:20px !important;">'.$no.'</td>
<td style="width:210px !important;">'.$ch1['lab'].'</td>
<td style="width:210px !important;"> '.$ch1['remarks'].'</td>
<td style="width:95px !important; text-align:right;">'.number_format($ch1['dueamount']).'</td>
<td style="width:95px !important; text-align:right;">'.number_format($ch1['paidamount']).'</td></tr>';}
}
echo '</tbody></table>';
$totalw=word($total);
date_default_timezone_set("Asia/Karachi");
echo '<div style="margin: 320px 0 0px 1px;position: absolute; width:698px; border-top:1px solid #000;">  The Sum of Rupees:</div>';
echo '<div style="margin: 321px 0 0px 153px;position: absolute; font-family:segoepr;">'.$totalw.'</div>';
echo '<div style="margin: 322px 0 0px 625px;position: absolute; float:right;"><b>Rs.</b>'.number_format($total).'</div>';
echo '<div style="margin: 347px 0 0px 500px;position: absolute;border-top:1px solid #000; font-size:10px;"><b>Signature</b></div>';
echo '<div style="margin:362px 0 0px 10px;position: absolute; font-size:10px;"><b>[Receipt '.$rno.' of '.count($result_plots12).']</b></div>';
echo '</div>';
$page=1;
}
?>
</html>
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
            $hundreds   = ( $hundreds ? ' ' . $list1[$hundreds] . ' Hundred' . ( $hundreds == 1 ? '' : 's' ) . ' ' : '' );
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
       
        
       
        return $words;
    }
    else if( ! ( ( int ) $num ) )
    {
        return 'Zero';
    }
    return '';}

?>
