/**
 * Created by Administrator on 2016-10-25.
 */
var birthCom ;
window.addEventListener('load', function(){
    function createBirthComponent(){
        var obj = {};
        var div = document.getElementById('birthComponent');
        var yearSelect = document.createElement('select');
        var monthSelect = document.createElement('select');
        var daySelect = document.createElement('select');
        var birth = {y:'',m:'',d:''};
        obj.birth = birth;
        obj.init = function(str){
            if(str){
                //str = '19881001';
                birth['y'] =str.substr(0,4);
                birth['m'] =str.substr(4,2);
                birth['d'] =str.substr(6,2);
                obj.select(birth);
            }

            if(obj['input']){
                if(birth['y'] == '' && birth['m']== '' && birth['d']== ''){
                    obj['input'].value = '';

                }else{
                    if(birth['y']){
                        obj['input'].value = birth['y'];
                    }else{
                        obj['input'].value = '%';
                    }
                    if(birth['m']){
                        obj['input'].value = obj['input'].value + '-'+birth['m'];
                    }else{
                        obj['input'].value = obj['input'].value + '-'+'%';
                    }
                    if(birth['d']){
                        obj['input'].value = obj['input'].value + '-'+birth['d'];
                    }else{
                        obj['input'].value = obj['input'].value + '-'+'%';
                    }
                }

            }
        }
        if(div.getAttribute('post-name')){
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = div.getAttribute('post-name');
            div.appendChild(input);
            obj['input'] = input;
        }
        obj.select = function(birth){
            var ary = [yearSelect, monthSelect, daySelect];
            var temp = ['y','m','d'];
            for(var j=0 ; j < ary.length; j++){
                for(var i = 0;ary[j].children.length;i++){
                    var option = ary[j].children[i];
                    if(option.value == Number(birth[temp[j]])){
                        option.selected = true;
                        break;
                    }
                }
            }
        }
        obj.create = function(){
            function createOption(value, name, select_element){
                var option = document.createElement('option');
                option.value = value;
                option.text = name;
                select_element.appendChild(option);
                return option ;
            }
            createOption('', '请选择', yearSelect);
            createOption('', '请选择', monthSelect);
            createOption('', '请选择', daySelect);

            for(var i = 1; i < 32; i++){
                createOption(i, i, daySelect);
            }

            for(var i=1; i< 13; i++){
                createOption(i, i, monthSelect);
            }

            for(var i=1900; i<2050; i++){
                createOption(i, i, yearSelect);
            }
        }
        obj.create();
        div.appendChild(yearSelect);
        var span = document.createElement('span');
        span.textContent = '年';
        div.appendChild(span);
        div.appendChild(monthSelect);
        span = document.createElement('span');
        span.textContent = '月';
        div.appendChild(span);
        div.appendChild(daySelect);
        span = document.createElement('span');
        span.textContent = '日';
        div.appendChild(span);

        yearSelect.addEventListener("change", function(target){
            var code =   target.target.options[target.target.selectedIndex].value;
            birth['y'] = code;
        });
        monthSelect.addEventListener("change", function(target){
            var code =   target.target.options[target.target.selectedIndex].value;
            birth['m'] = code;
        });
        daySelect.addEventListener("change", function(target){
            var code =   target.target.options[target.target.selectedIndex].value;
            birth['d'] = code;
        });
        return obj;
    }

    birthCom = createBirthComponent();
});