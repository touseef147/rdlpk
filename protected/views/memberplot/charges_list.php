
<style>
.td{text-align:right;}
</style>
<div class="shadow">

  <h3>Charges List Detail
</h3>
</div>
<hr noshade="noshade" class="hr-5">
<span style="float:right;">
	<h4>Member Details</h4>
<?php $res=array();
$msid=0; 
    foreach($members as $mem){             
	echo '<b>Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</b>' .$mem['name'].'<br/>';
    echo '<b>CNIC &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</b>' .$mem['cnic'].'<br/>';
	echo '<b>Membership # :&nbsp;</b>' .$mem['plotno'].'<br/>';
	  $msid=$mem['id'];
	} ?> 
	</span><?php $numbers=0;?>
    <hr noshade="noshade" class="hr-5">
<section class="reg-section margin-top-30" style="font-size:11px;">

</div>

<br />
<table class="table table-striped table-new table-bordered" style="font-size:12px;">

            	<thead style="background:#666; border-color:#ccc; color:#fff; ">

<tr>

        	<th><b>Sr.# </b></th>

			<th><b>Account Head </b></th>

            <th><b>Due Amount</b></th>
			 <th><b>Paid Amount</b></th>
<th><b>Discount</b></th>
              <th><b>Balance Amount</b></th>
			<th><b>Due Date</b></th>
              <th><b>Paid Date</b></th>
			
			<th><b>Due Surcharge</b></th>
			<th><b>Paid Surcharge</b></th>

            <th><b>Ref No.</b></th>
               <th><b>Paid By</b></th>

            <th><b>Status</b></th>
			 <th><b>Action</b></th>
	</tr>		

        </thead>

		<tbody>
<?php
 $connection = Yii::app()->db;
  $member= "SELECT * FROM memberplot mp where plot_id='".$_REQUEST['id']."'";
		$members = $connection->createCommand($member)->queryRow();
		$member_id=$members['member_id'];
	$bsurcharge=0;
    	
	//$paidsurcharge=0;
	$bsur=0;
	$res=array();
		$ndis=0;
		$ii=0;
		$i=0;
		$due=0;
		$paid=0;
		$duesurcharge=0;
		$paidsurcharge=0;
		$tbalance=0;
    foreach($payments as $row)
 
	{	
$ii=$ii+1;	
	
	
$old_date = $row['create_date'];            
$middle = strtotime($old_date);             
$new_date = date('d-m-Y', $middle);
		$i++;

		$due=$due+$row['amount'];
		$paid=$paid+$row['paidamount'];
		$duesurcharge=$duesurcharge+$row['surcharge'];
		$paidsurcharge=$paidsurcharge+$row['paidsurcharge'];
		$bsur=$row['amount']-$row['paidamount'];
		$ndis=$ndis+$row['discount'];
	//	if($row['']
		if($row['discount']==''){$row['discount']=0;}
  echo '<tr><td>';
  echo $ii;
  echo '</td>
 <td>' .$row['payment_type']. '</td>
 <td style="text-align:right;">' .$row['amount']. '</td>
 <td style="text-align:right;">' .$row['paidamount']. '</td>
 
  <td style="text-align:right;">'.number_format($row['discount']).' </td>
 <td style="text-align:right;">'.number_format($bsur-$row['discount']).'</td>
  <td>' . $row['duedate']. '</td>
  <td>' . $row['date'] . '</td>
  <td style="text-align:right;">' . $row['surcharge'] . '</td>
    <td style="text-align:right;">' . $row['paidsurcharge'] . '</td>
   <td>';
if($row['r_id']>0){
    $connection = Yii::app()->db;
	  $re1 = "SELECT * FROM rpt_print where rid='".$row['r_id']."' and msid='".$row['plot_id']."'";
		$rec1=$connection->createCommand($re1)->queryRow();	
		echo $rec1['slipno'].'/<b style="color:blue;">'.$rec1['r_no'];
		if($rec1['jvno'] > 1 ){echo 'JV-'.$rec1['jvno'];}
		echo '</b>';
		}elseif($row['re_id']>0){
  		$re = "SELECT * FROM rpt_print where id='".$row['re_id']."'";
		$rec=$connection->createCommand($re)->queryRow();
		echo $rec['slipno'].'/<b style="color:blue;">'.$rec['r_no'];
		if($rec['jvno'] > 1 ){echo 'JV-'.$rec['jvno'];}
		echo '</b>';
		}else{echo $row['detail'];}
echo '</td><td>'.$row['name'].'</td>
<td>';if(!empty($row['fstatus'])){if($row['fstatus']=='approved'){ echo '<b style="color:Green;">Verified</b>';}else{echo '<b style="color:Green;">'.$row['fstatus'].'</b>';}}else{ 
if($row['r_id']==0 and $row['re_id']==0){
echo'<a href="up_charges?pid='.$_REQUEST['id'].'&&id='.$row['id'].'&&mem_id='.$mem['member_id'].'">Edit</a>/ <a href="update_charges?pid='.$_REQUEST['id'].'&&id='.$row['id'].'&&mem_id='.$mem['member_id'].'">Pay</a>';
}
echo '</td>';}
echo'<td>'.$row['mem_id'];
if(($members['member_id']==$row['mem_id']) )
{
	echo'';
}else{ echo '<a href="updatemem?id='.$row['id'].'&&member_id='.$member_id.'&&plot_id='.$row['plot_id'].'">Change Payer </a>';}
echo'</td></tr>	'; 
  
$tbalance=$tbalance+$bsur;

//$bsur=$bsur+$bsur;
}
?>
</tbody></table>



</section>

 

  

<hr noshade="noshade" class="hr-5"><hr noshade="noshade" class="hr-5">

<hr noshade="noshade" class="hr-5"><hr noshade="noshade" class="hr-5">

<hr noshade="noshade" class="hr-5"><hr noshade="noshade" class="hr-5">

<hr noshade="noshade" class="hr-5"><hr noshade="noshade" class="hr-5">

<hr noshade="noshade" class="hr-5"><hr noshade="noshade" class="hr-5">