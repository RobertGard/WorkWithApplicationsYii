<table border="1">
   <caption>Подробнее о запросе</caption>
   <tr>
    <th>Название запроса</th>
    <th>Текст запроса</th>
    <th>Дата отправки</th>
    <th>Автор запроса</th>
    <th>Статус</th>
   </tr>
   <?php foreach($record as $rs){?>
    <tr>
        <td>
            <?php echo $rs->name_request;?>
        </td>
        <td>
            <?php echo $rs->text_request;?>
        </td>
        <td>
            <?php echo $rs->date_request;?>
        </td>
        <td>
            <?php echo $rs->auth_request;?>
        </td>
        <td>
            <?php 
            switch($rs->status)
            {
                case "1":
                    echo "Не отвечено";
                break;
                case "2":
                    echo "Принято";
                break;
                case "3":
                    echo "Отказано";
                break;
            }
            ?>
        </td>
    </tr>
    <?php }?>
</table> 

<?php 
$user_name = Yii::$app->session->get('user_name');
//Если это админ , то добавляем кнопки /принять/ и /отказать/
if($user_name == 'admin'){ ?>
    <a href="<?php echo Yii::$app->urlManager->createUrl(['request/decision','id'=>$rs->id,'status'=>2]);?>">Принять</a>
    <a href="<?php echo Yii::$app->urlManager->createUrl(['request/decision','id'=>$rs->id,'status'=>3]);?>">Отказать</a>
<?php }
?>
