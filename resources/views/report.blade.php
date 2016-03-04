<table>
  <thead>Результаты тестов</thead>
    <?php
    if(!empty($report['tests_res'])){
    ?>
    <tr>
        <td>Имя</td>
        <td>Дата</td>
        <td>Типы примеров</td>
        <td>Правильно</td>
        <td>Неправильно</td>
        <td>Результат %</td>
    </tr>
    <?
    foreach($report['tests_res'] as $rep){
    ?>
    <tr>
        <?
        foreach($rep as $r){
        ?>
        <td><?=$r ?></td>
        <?
        }
        ?>
    </tr>
    <?
    }
    }
    else echo ' - 0';
    ?>
</table>
<hr />
<table>
    <thead>Ученики не проходившие тест</thead>
    <?php
    if(!empty($report['absent'])){
    ?>
    <tr>
        <td>Имя</td>
        <td>Результат</td>
    </tr>
    <?
    foreach($report['absent'] as $rep){
    ?>
    <tr>
        <?
        foreach($rep as $r){
        ?>
        <td><?=$r ?></td>
        <?
        }
        ?>
    </tr>
    <?
    }
    }
    else echo ' - 0';
    ?>
</table>
<hr />
<table>
    <thead>Неуспевающие</thead>
    <?php
    if(!empty($report['lagging'])){
    ?>
        <tr>
            <td>Имя</td>
            <td>Кол-во результатов <= 50%</td>
        </tr>
    <?
    foreach($report['lagging'] as $rep){
    ?>
    <tr>
        <?
        foreach($rep as $r){
        ?>
        <td><?=$r ?></td>
        <?
        }
        ?>
    </tr>
    <?
    }
    }
    else echo ' - 0';
    ?>
</table>
<hr />