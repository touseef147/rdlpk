<?php
$drows=NULL;

if(isset($modeldynamicrows))
{
    $drows=$modeldynamicrows;
}

    echo $this->render('_update',[
        'model' => $model,
        'modules' => $modules,
        'controllers' => $controllers,
        'actions' => $actions,
        'rights' => $rights,
        'modeldynamicrows' => $drows,
    ]); 

    $this->beginBlock('pagesidebar'); 

    echo $this->render('_sidebarinput'); 

    $this->endBlock(); 
?>
