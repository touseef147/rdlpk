<?php

echo $this->render('_update', [
    'model' => $model,
    'appform' => $appform,
    'modeljointmembers' => $modeljointmembers,
    'modelinstallmentplan' => $modelinstallmentplan,
    'instpaymentrights' => $instpaymentrights,
]);

$this->beginBlock('pagesidebar');

echo $this->render('_sidebarinput');

$this->endBlock();
?>
