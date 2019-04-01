
public function actionSearchassoc()
	 	{
	 
     
	
	 $connection = Yii::app()->db; 
      
          $sql_member = "SELECT assoc.msid as msid,assoc.id,COUNT(assoc.msid) total,m.name,m.cnic,assoc.mid,sec.sector_name,s.street,pro.project_name,p.sector,p.plot_detail_address,p.plot_size,m.image,p.size2,p.street_id,mp.plotno FROM associates assoc 
	 LEFT JOIN members m ON m.id = assoc.mid
	  LEFT JOIN memberplot mp ON mp.id = assoc.msid
	  LEFT JOIN plots p ON p.id = mp.plot_id
	   LEFT JOIN projects pro ON pro.id = p.project_id
	    LEFT JOIN streets s ON s.id = p.street_id
		  LEFT JOIN sectors sec ON sec.id = p.sector
		  GROUP BY assoc.msid"; 
		$result_members = $connection->createCommand($sql_member)->query();
	$count=0;
			
		$home=Yii::app()->request->baseUrl; 
			 $i=0;
foreach($result_members as $key){ 
    $i++;
     
            $count++;
		$sql="SELECT m.name,m.cnic,associates.* FROM associates "
                          . "LEFT JOIN members m on m.id=associates.mid "
                          . "where  msid='".$key['msid']."'";
                 $ressql=$connection->CreateCommand($sql)->queryAll();
          if($key['total']>1){
			 echo '<tr><td rowspan="'.count($ressql).'">'.$i.'</td><td rowspan="'.count($ressql).'">'.$key['plotno'].'</td>';
                                foreach($ressql as $key1){ echo '<td>'.$key1['name'].'</td><td>'.$key1['cnic'].'</td></tr>';
                      
                          //   echo'<td>'.$key1['cnic'].'</td>';
                                 }
                             echo'<tr><td>'.$key['plot_size'].'</td><td>'.$key['plot_detail_address'].'</td><td>'.$key['street'].'<td>'.$key['sector_name'].'</td><td>'.$key['project_name'].'</td></tr>';
  
                        }else{
                             echo '<tr><td>'.$i.'</td><td>'.$key['plotno'].'</td><td>'.$key['name'].'</td><td>'.$key['cnic'].'</td>';
                             echo'<td>'.$key['plot_size'].'</td><td>'.$key['plot_detail_address'].'</td><td>'.$key['street'].'<td>'.$key['sector_name'].'</td><td>'.$key['project_name'].'</td></tr>';
                        }
                                         }
			
			
			
	}
	


public function actionSearchassoc()
	 	{
	 
     
	
	 $connection = Yii::app()->db; 
      
          $sql_member = "SELECT assoc.msid as msid,assoc.id,COUNT(assoc.msid) total,m.name,m.cnic,assoc.mid,sec.sector_name,s.street,pro.project_name,p.sector,p.plot_detail_address,p.plot_size,m.image,p.size2,p.street_id,mp.plotno FROM associates assoc 
	 LEFT JOIN members m ON m.id = assoc.mid
	  LEFT JOIN memberplot mp ON mp.id = assoc.msid
	  LEFT JOIN plots p ON p.id = mp.plot_id
	   LEFT JOIN projects pro ON pro.id = p.project_id
	    LEFT JOIN streets s ON s.id = p.street_id
		  LEFT JOIN sectors sec ON sec.id = p.sector
		  GROUP BY assoc.msid"; 
		$result_members = $connection->createCommand($sql_member)->query();
	$count=0;
	if ($result_members!=''){		
		$home=Yii::app()->request->baseUrl; 
			 $i=0;
foreach($result_members as $key){ $i++;
     
            $count++;
			
			 echo '<tr><td>'.$i.'</td><td>'.$key['plotno'].'</td><td><img src="'.Yii::app()->request->baseUrl.'/upload_pic/'.$key['image'].'" width="150" height="150" /></td>';
                         if($key['total']>1){
                             echo'<td>';
                             echo'&nbsp &nbsp <input type="button" value="View"  data-toggle="collapse" data-target="#demo'.$key['id'].'" >';
                  $sql="SELECT m.name,m.cnic,associates.* FROM associates "
                          . "LEFT JOIN members m on m.id=associates.mid "
                          . "where  msid='".$key['msid']."'";
                 $ressql=$connection->CreateCommand($sql)->queryAll();
             
    echo' <div id="demo'.$key['id'].'" class="collapse">';   
    foreach($ressql as $key1)
    {
  echo $key1['name'].'<br/>';
  //echo $key1['cnic'].'<br/>';
    }
                         echo'</td><td>'.$key1['cnic'].'</td>';
                         
    echo'</div>';
                         }else{ echo '<td>'.$key['name'].'</td><td>'.$key['cnic'].'</td>';}
                             echo'<td>'.$key['plot_size'].'</td><td>'.$key['plot_detail_address'].'</td><td>'.$key['street'].'<td>'.$key['sector_name'].'</td><td>'.$key['project_name'].'</td></tr>';
                      
    }
			
			
			
	}
	}<?php
public function actionSearchassoc()
	 	{
	 
     
	
	 $connection = Yii::app()->db; 
      
          $sql_member = "SELECT assoc.msid as msid,assoc.id,COUNT(assoc.msid) total,m.name,m.cnic,assoc.mid,sec.sector_name,s.street,pro.project_name,p.sector,p.plot_detail_address,p.plot_size,m.image,p.size2,p.street_id,mp.plotno FROM associates assoc 
	 LEFT JOIN members m ON m.id = assoc.mid
	  LEFT JOIN memberplot mp ON mp.id = assoc.msid
	  LEFT JOIN plots p ON p.id = mp.plot_id
	   LEFT JOIN projects pro ON pro.id = p.project_id
	    LEFT JOIN streets s ON s.id = p.street_id
		  LEFT JOIN sectors sec ON sec.id = p.sector
		  GROUP BY assoc.msid"; 
		$result_members = $connection->createCommand($sql_member)->query();
	$count=0;
			
		$home=Yii::app()->request->baseUrl; 
			 $i=0;
foreach($result_members as $key){ 
    $i++;
     
            $count++;
		$sql="SELECT m.name,m.cnic,associates.* FROM associates "
                          . "LEFT JOIN members m on m.id=associates.mid "
                          . "where  msid='".$key['msid']."'";
                 $ressql=$connection->CreateCommand($sql)->query();
          if($key['total']>1){
			 echo '<tr><td rowspan="'.count($ressql).'">'.$i.'</td><td rowspan="'.count($ressql).'">'.$key['plotno'].'</td>'
                                 . '<td></td><td>CNIC</td></tr>';
                       echo '<td></td>';
                             echo'<td>CNIC2</td><td>'.$key['plot_size'].'</td><td>'.$key['plot_detail_address'].'</td><td>'.$key['street'].'<td>'.$key['sector_name'].'</td><td>'.$key['project_name'].'</td></tr>';
  
                        }else{
                             echo '<tr><td>'.$i.'</td><td>'.$key['plotno'].'</td><td>'.$key['name'].'</td><td>'.$key['cnic'].'</td>';
                             echo'<td>'.$key['plot_size'].'</td><td>'.$key['plot_detail_address'].'</td><td>'.$key['street'].'<td>'.$key['sector_name'].'</td><td>'.$key['project_name'].'</td></tr>';
                        }
                                         }
			
			
			
	}
	
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

