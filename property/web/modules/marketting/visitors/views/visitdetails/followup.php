<?php
    $vd=NULL;
    $bd=NULL;
    $fd=NULL;
    
    if(isset($modelvisits))
        $vd=$modelvisits;
    
    if(isset($modelbookings))
        $bd=$modelbookings;

    if(isset($modelfollowup))
        $fd=$modelfollowup;
    
    echo $this->render('_followup',[
        'model' => $model,
        'modelfollowup' => $fd,
        'modelvisits' => $vd,
        'modelbookings' => $bd,
    ]); 

    $this->beginBlock('pagesidebar'); 

    echo $this->render('_sidebarinput'); 

    $this->endBlock(); 
?>
