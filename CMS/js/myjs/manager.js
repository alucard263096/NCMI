var arrprovinceID = new Array();
arrprovinceID[0] = "Beijing";
arrprovinceID[1] = "Tianjin";
arrprovinceID[2] = "Hebei";
arrprovinceID[3] = "Shaanxi";
arrprovinceID[4] = "Mongol";
arrprovinceID[5] = "Liaoning";
arrprovinceID[6] = "Jilin";
arrprovinceID[7] = "Heilongjiang";
arrprovinceID[8] = "Shanghai";
arrprovinceID[9] = "Jiangsu";
arrprovinceID[10] = "Zhejiang";
arrprovinceID[11] = "Anhui";
arrprovinceID[12] = "Fujian";
arrprovinceID[13] = "Jiangxi";
arrprovinceID[14] = "Shandong";
arrprovinceID[15] = "Henan";
arrprovinceID[16] = "Hubei";
arrprovinceID[17] = "Hunan";
arrprovinceID[18] = "Guangdong";
arrprovinceID[19] = "Guangxi";
arrprovinceID[20] = "Hainan";
arrprovinceID[21] = "Chongqing";
arrprovinceID[22] = "Sichuan";
arrprovinceID[23] = "Guizhou";
arrprovinceID[24] = "Yunnan";
arrprovinceID[25] = "Xizang";
arrprovinceID[26] = "Shanxi";
arrprovinceID[27] = "Gansu";
arrprovinceID[28] = "Qinghai";
arrprovinceID[29] = "Ningxia";
arrprovinceID[30] = "Xinjiang";
arrprovinceID[31] = "Xianggang";
arrprovinceID[32] = "Aomen";
arrprovinceID[33] = "Taiwan";

var arrprovince = new Array();
arrprovince["Beijing"] = "北京市";
arrprovince["Tianjin"] = "天津市";
arrprovince["Hebei"] = "河北省";
arrprovince["Shaanxi"] = "山西省";
arrprovince["Mongol"] = "内蒙古自治区";
arrprovince["Liaoning"] = "辽宁省";
arrprovince["Jilin"] = "吉林省";
arrprovince["Heilongjiang"] = "黑龙江省";
arrprovince["Shanghai"] = "上海市";
arrprovince["Jiangsu"] = "江苏省";
arrprovince["Zhejiang"] = "浙江省";
arrprovince["Anhui"] = "安徽省";
arrprovince["Fujian"] = "福建省";
arrprovince["Jiangxi"] = "江西省";
arrprovince["Shandong"] = "山东省";
arrprovince["Henan"] = "河南省";
arrprovince["Hubei"] = "湖北省";
arrprovince["Hunan"] = "湖南省";
arrprovince["Guangdong"] = "广东省";
arrprovince["Guangxi"] = "广西省";
arrprovince["Hainan"] = "海南省";
arrprovince["Chongqing"] = "重庆市";
arrprovince["Sichuan"] = "四川省";
arrprovince["Guizhou"] = "贵州省";
arrprovince["Yunnan"] = "云南省";
arrprovince["Xizang"] = "西藏自治区";
arrprovince["Shanxi"] = "陕西省";
arrprovince["Gansu"] = "甘肃省";
arrprovince["Qinghai"] = "青海省";
arrprovince["Ningxia"] = "宁夏回族自治区";
arrprovince["Xinjiang"] = "新疆维吾尔自治区";
arrprovince["Xianggang"] = "香港特别行政区";
arrprovince["Aomen"] = "澳门特别行政区";
arrprovince["Taiwan"] = "台湾省";




var myjs_afterResultLoad = function () {

    $(".result_provinces").each(function () {
        var provincestr = $(this).text();
        var arr = provincestr.split(",");
        var nstr = "";
        var isFirst = true;
        for (var i = 0; i < arr.length; i++) {
            if ($.trim(arr[i]) !="" ) {
                if (isFirst == false) {
                    nstr = nstr + ",";
                }
                isFirst = false;
                nstr = nstr + arrprovince[arr[i]];
            }
        }
        $(this).text(nstr);
    });


};




var myjs_detailPageLoad = function () {

    $("#content_provinces").attr("type", "hidden");
   
    for (i = 0; i < arrprovinceID.length; i++) {

        var code = arrprovinceID[i];
        var name = arrprovince[code];
        $("#content_provinces").after("<input class='uniform_on multicheckbox provinces_check' type='checkbox' id='procode_" + code + "' value='" + code + "'>" + name);
    }

    var provincestr = $("#content_provinces").val();

    var arr = provincestr.split(",");
    var isFirst = true;
    for (var i = 0; i < arr.length; i++) {
        if ($.trim(arr[i]) != "") {
            $("#procode_" + $.trim(arr[i])).prop("checked", "checked");
        }
    }
    if (provincestr == "") {
        $("#content_provinces").val("aa-dara");
    }
};


var myjs_saveClick = function (json) {
    var isfirst = true;
    var provinces = "";
    $(".provinces_check:checked").each(function () {
        if (isfirst == false) {
            provinces = provinces + ",";
        }
        isfirst = false;
        provinces = provinces + $(this).val();
    });
    json.provinces = provinces;
    return json;
};

var myjs_aftersave = function (data) {
    
    return true;
};