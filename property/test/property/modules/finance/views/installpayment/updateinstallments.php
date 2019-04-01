<?php

    echo $this->render('_updateinstallments',[
        'model' => $model,
//        'modelmember' => $modelmember,
        'modelreceipts' => $modelreceipts,
        'modelreceiptdetail' => $modelreceiptdetail,
    ]); 

    $this->beginBlock('pagesidebar'); 

    echo $this->render('_sidebarinput'); 

    $this->endBlock(); 
?>
