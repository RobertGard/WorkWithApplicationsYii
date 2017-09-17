<table border="1">
   <caption>Список запросов</caption>
   <tr>
    <th>Название запроса</th>
    <th>Дата отправки</th>
   </tr>
   <?php foreach($record as $rs){?>
    <tr>
        <td>
            <a href="<?php echo Yii::$app->urlManager->createUrl(['request/detailed','id'=>$rs->id]);?>"><?php echo $rs->name_request;?></a>
        </td>
        <td>
            <?php echo $rs->date_request;?>
        </td>
    </tr>
    <?php }?>
</table>
