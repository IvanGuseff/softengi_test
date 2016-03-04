<!DOCTYPE html>
<html>
<head>
    <title>Softengi test</title>
    <script src="{{ asset('/js/jquery-1.12.1.min.js') }}" type="text/javascript"></script>
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('/css/styles.css') }}"/>

</head>
<body>
<div class="container">
    <div class="tab-setup">
        <div class="title">Установка</div>
        <div class="content">
            <div class="checkbox-block">
                <label>
                    <input type="checkbox" name="sum" value="+" checked>
                    Cумма "+";
                </label>
                <label>
                    <input type="checkbox" name="diff" value="-">
                    Разность "-";
                </label>
                <label>
                    <input type="checkbox" name="multi" value="*">
                    Умножить "x";
                </label>
                <label>
                    <input type="checkbox" name="degree" value="/">
                    Разделить "/";
                </label>
            </div>
            <div class="name-input">
                <p>Введи свое имя:</p>
                <input type="text" name="name" value="">
            </div>
            <div style="clear: both;"></div>
            <div class="button">Начать тест</div>
        </div>
    </div>
    <div class="tab-inspection">
        <div class="title">Проверка</div>
        <div class="content">
            <div class="count"></div>
            <div class="sample"></div>
            <p class="answer-title">Ваш ответ: </p>
            <div class="answer-input">
                <input type="text" name="answer" maxlength="4"/>
                <div class="result-icon result-yes"></div>
                <div class="result-icon result-no"></div>
            </div>
            <div class="result"><span>Правильный ответ: </span><span class="number"></span></div>
            <div class="button-block">
                <div class="button check">Проверить</div>
                <div class="button next">Далее</div>
            </div>

        </div>
    </div>
    <div class="tab-report">
        <div class="title">Отчет</div>
        <div class="content">
            <p class="date-title">Установите дату для формирования отчета:</p>
            <div class="set-date">от: <input type="date" name="datefrom"></div>
            <div class="set-date">до: <input type="date" name="dateto"></div>
            <div class="button-block">
                <div class="button do-report">Построить</div>
            </div>
            <div class="report"></div>
        </div>
    </div>
</div>
<script src="{{ asset('/js/app.js') }}" type="text/javascript"></script>
</body>
</html>
