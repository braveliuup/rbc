// js创建行政区划选择组件
function createAreaComponent(name, initCallback, genInput){
    var areaComp = {};
    var div = document.getElementById('areaComponent');
    if(div == null || div.tagName != 'DIV'){
        return;
    }
    var input;
    var pcode = "";
    var ccode = "";
    var rcode = "";
    if(genInput){
        input = document.createElement('input');
        input.type = 'hidden';
        input.name = name.substr(0, name.indexOf('['));
        div.appendChild(input);
    }

    var province = document.createElement("select");
    var city = document.createElement("select");
    var region = document.createElement("select");
    areaComp.province = province;
    areaComp.city = city;
    areaComp.region = region;
    areaComp.initCallback = initCallback;
    areaComp.initCity = initCity;
    areaComp.initRegion = initRegion;
    if(!genInput){
        province.name= city.name = region.name = name;
    }
    province.style.marginRight = city.style.marginRight = 6;
    createOption('', '请选择', province);
    createOption('', '请选择', city);
    createOption('', '请选择', region);
    div.appendChild(province);
    div.appendChild(city);
    div.appendChild(region);
    province.addEventListener("change", function(target){
        var code =   target.target.options[target.target.selectedIndex].value;
        initCity(code);
        pcode = code;
    });
    city.addEventListener("change", function(target){
        var code =   target.target.options[target.target.selectedIndex].value;
        initRegion(code);
        ccode = code;
    });
    region.addEventListener("change", function(target){
        var code =   target.target.options[target.target.selectedIndex].value;
        rcode = code;
        if(input){
            input.value = pcode+'-'+ccode+'-'+rcode;
        }
    });

    function createOption(value, name, parent, defaultSelected){
        var option = document.createElement('option');
        option.value=  value;
        option.text = name;
        if(defaultSelected){
            option.selected = true;
        }
        parent.appendChild(option);
        return option;
    }
    Ajax.call('area.php?act=province', "", initProvince, "GET", "JSON");

    function initSelect(result, select_element, select_item){
        for(var i = 0 ; i< result.content.length; i++){
            var code = result.content[i].code;
            var name = result.content[i].name;
            if(name == select_item){
                createOption(code, name, select_element, true);
            }else{
                createOption(code, name, select_element);
            }
        }
    }
    function initProvince(result, select_item){
        initSelect(result, province, select_item);
        if(areaComp.initCallback && typeof(areaComp.initCallback) == 'function'){
            areaComp.initCallback();
        }
    }

    function clearSelect(theSelect){
        for(var i=theSelect.options.length-1;i>=1;i--)

            theSelect.options.remove(i);
    }
    function initCity(code, select_item){
        clearSelect(city);
        clearSelect(region);
        Ajax.call('area.php?act=city', "code="+code, function(result){
            initSelect(result, city, select_item);
        }, "GET", "JSON");
    }

    function initRegion(code, select_item){
        clearSelect(region);
        Ajax.call('area.php?act=region', "code="+code, function(result){
            initSelect(result, region, select_item);
        }, "GET", "JSON");
    }
    return areaComp;
}

function createAreaTextInput(name){
    var input = document.getElementById(name);
    if(input == null){
        return;
    }
    Ajax.call('area.php?act=parse_code','code='+encodeURIComponent(input.value), function(result){
        input.value = result.content;
    },'GET', 'JSON');
}

function setSelectChecked(selele, checkValue){
    // var select = document.getElementById(selectId);
    for(var i=0; i<selele.options.length; i++){
        if(selele.options[i].innerHTML == checkValue){
            selele.options[i].selected = true;
            break;
        }
    }
};

window.addEventListener('load',function(){

    var data = document.getElementById('areaComponent').getAttribute('data');
    var genInput = document.getElementById('areaComponent').getAttribute('gen-input');
    if(data == null){
        data = 'partnersAddress';
    }
    if(typeof(initAreaComp) != 'undefined'){
        areaCom = createAreaComponent(data+'[]', initAreaComp, genInput);
    }else{
        areaCom = createAreaComponent(data+'[]', null, genInput);
    }
    createAreaTextInput(data);
});

