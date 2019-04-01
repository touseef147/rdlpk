<?php

    echo $this->render('_update', [
        'model' => $model,
        'modelmember' => $modelmember,
        'modeljointmembers' => $modeljointmembers,
//        'modelvoucher' => $modelvoucher,
  //      'modelvoucherfee' => $modelvoucherfee,
    //    'modelvoucherbooking' => $modelvoucherbooking,
//        'modelnewnominee' => $modelnewnominee,
        'modelpcateg' => $modelpcateg,
        'selectedcategories' => $selectedcategories,

  //      'modelphoto' => $modelphoto,
    //    'modelcnic' => $modelcnic,
//        'modelbankdoc' => $modelbankdoc,
    ]);

    $this->beginBlock('pagesidebar'); 

    echo $this->render('_sidebarinput'); 

    $this->endBlock(); 
?>
