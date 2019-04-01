

<style>



.black-bg {

	background:#333; color:#fff; width:20%; float:left; padding:5px 10px; margin:2px 0px;

	}



.grey-bg {

	background:#CCC; color:#000; width:71%; padding:5px 10px; float:left; margin:2px 0px;

	}

	

.left-box {

	float:left;

	border:1px solid #ccc;

	padding:0 5px;

	margin:0 5px;

	}

	

.bot-box {

	background: none repeat scroll 0 0 #6699FF;

    border-radius: 10px;

    clear: both;

    color: #FFFFFF;

    height: 164px;

    margin: 30px auto;

    padding: 20px;

    position: relative;

    top: 30px;

    width: 55%;

	}

	

	

.new-box-01 {

    float: left;

    width: 50%;

	margin-bottom:40px;

}



</style>







<div class="shadow">

  <h3>Query Detail</h3>

</div>
<hr noshade="noshade" class="hr-5 ">

<section class="reg-section margin-top-30">
<?php	

            $res=array();

            foreach($register_member_query_detail as $key){
?>
<div class="span12 left-box"> 
  <div class="panel panel-default">
 <div class="panel-body">
   <h4 style="text-align:center; color:#0CC;">Plot Details</h4>
  </div>
  <!-- Table -->
    <table class="table" style="width:100%;">
     <tbody><tr><td>MS No.</td><td><?php echo $key['plotno'];?></td></tr>
    <tr><td>File/Plot No.</td><td><?php echo $key['plot_detail_address'];?></td></tr>
     <tr><td>Street/Lane.</td><td><?php echo $key['street'];?></td></tr>
     <tr><td>Block</td><td><?php echo $key['sector_name'];?></td></tr>
      <tr><td>Project Name</td><td><?php echo $key['project_name'];?></td></tr>
      <tr><td>Property Type</td><td><?php echo $key['com_res'];?></td></tr>
      <tr><td>Allotment Type</td><td><?php echo $key['atype'];?></td></tr>

  </tbody></table>

</div>
<hr>
 </div>
<!-- shadow -->



<?php 



?>



  <?php          echo '

           





<div class="span12" style="">

   	

    <div class="">

  	<div class="black-bg">Member Name:</div><div class="grey-bg">'.$key['name'].'</div>

	<br>

    <div class="black-bg">Subject:</div><div class="grey-bg">'.$key['subject'].'</div>

    <br>

  	<div class="black-bg">Mesage:</div><div class="grey-bg">'.$key['message'].'</div>

    <br>

	<div class="black-bg">Date:</div><div class="grey-bg">'.$key['create_date'].'</div>

    <br>

  	 </div>

</div>

 <h5 style="text-align:right;">';}?>
 
 <a class="login-btn" href="<?php echo Yii::app()->request->baseUrl ?>/index.php/user/reply_member?id=<?php echo $key['user_id'];?>&& qid=<?php echo $key['id'];?>"><input id="login" class="login-btn" type="submit" name="" value="Reply"></a> 





   

 <div class="clearfix"></div>



 

 </section>

<!-- section 3 --> 

 <div class="clearfix"></div>