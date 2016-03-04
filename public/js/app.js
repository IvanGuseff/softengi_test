$(document).ready(function(){

    function isChecked(arr) {
        var sum = 0;
        for(var prop in arr){
            sum += arr[prop];
        }
        return sum;
    }

    $('.tab-setup .button').click(function(){
        var actionsType = ['sum','diff','multi','degree'], actions = [], pupil = '';
        for(var i=0; i<actionsType.length; i++){
            actions[actionsType[i]] = $('input[name="' + actionsType[i] + '"]').prop("checked") ? 1 : 0;
        }
        pupil = $('input[name="name"]').val();
        if(pupil != '' && isChecked(actions)){
            Test.init(actions, pupil);
            $('.tab-setup').hide();
            $('.tab-inspection').show();
        }
        else if(!isChecked(actions)){
            alert('Вы не выбрали тип действий!');
        }
        else {
            alert('Вы не ввели имя!')
        }
    });

    $('.tab-inspection .check').click(function(){
        var pupilRes = $('input[name="answer"]').val();
        if(!isNaN(parseFloat(pupilRes))){
            Test.checked(parseFloat(pupilRes));
        }
        else {
            alert('Ответ должен быть числом!')
        }
    });

    $('.tab-inspection .next').click(function(){
        if(Test.samplesNumber){
            $('.result-icon').hide();
            $('.result').hide();
            $('input[name="answer"]').val('');
            Test.generate();
        }
        else{
            $('.tab-inspection').hide();
            $('.tab-report').show();
        }
    });

    $('.do-report').click(function(){
        Report.init();
    });
});

var Test = {
    pupil: '',
    pupilId: 0,
    testId: 0,
    actions: [],
    genResult: 0,
    sample: '',
    samplesNumber: 10,
    init: function(actions, pupil){
        this.pupil = pupil;
        if(typeof(actions) == 'object'){
            for(var prop in actions){
                if(actions[prop]){
                    this.actions.push(prop);
                }
            }
        }
        this.postQuery('/setPupil', JSON.stringify([this.pupil, this.actions]), true);
        this.generate();
    },
    generate: function(){
        var i, j, a, result = 0, sample = '', isInteger = true;
        do{
            a = this.getRandom(Test.actions.length, 1);
            i = this.getRandom(100, 1);
            j = this.getRandom(100, 1);
            switch(this.actions[a]) {
                case 'sum':
                    result = i + j;
                    sample = i + ' + ' + j;
                    break;
                case 'diff':
                    result = i - j;
                    sample = i + ' - ' + j;
                    break;
                case 'multi':
                    result = i * j;
                    sample = i + ' * ' + j;
                    break;
                case 'degree':
                    result = i / j;
                    sample = i + ' / ' + j;
                    isInteger = ((result ^ 0) === result);
                    if(!isInteger) result = 999;
                    break;
                default:
                    console.log('error of type action');
                    break;
            }
        }while(result > 100);
        this.samplesNumber--;
        $('.sample').text(sample + ' = ?')
        this.sample = sample;
        $('.count').text('Пример №' + (10 - this.samplesNumber) + ' из 10');
        this.genResult = result;
    },
    getRandom: function(max, min){
        return Math.round(Math.random()*(max - min));
    },
    postQuery: function(adr, data){
        $.post(adr, {data: data}, function(data){
            if(typeof(data) == 'string'){
                if(data.indexOf('<table>') != -1){
                    $('.report').append(data);
                }
            }
            if(data['pupilId']){
                Test.pupilId = data['pupilId'];
                Test.testId = data['testId'];
            }
            else return data;
        })
    },
    checked: function(result){
        if(result == this.genResult){
            $('.result-icon.result-yes').show();
            this.postQuery('/editTestCorrect', JSON.stringify(this.testId));
        }
        else {
            $('.result-icon.result-no').show();
            $('.result .number').text(this.genResult);
            $('.result').show();
            this.postQuery('/createMistake', JSON.stringify([this.testId, this.sample, result]));
        }
    }
};

var Report = {
    dateFrom: '',
    dateTo: '',
    init: function(){
        this.dateFrom = $('input[name="datefrom"]').val();
        this.dateTo = $('input[name="dateto"]').val();
        Test.postQuery('/getReport', JSON.stringify([this.dateFrom, this.dateTo]));
    }
};