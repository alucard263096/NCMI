function validatemobile(mobile) {
    if (mobile.length == 0) {
        return false;
    }
    if (mobile.length != 11) {
        return false;
    }

    var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
    if (!myreg.test(mobile)) {
        return false;
    }
    return true;
}
function checkURL(URL) {
    var str = URL;
    //�ж�URL��ַ��������ʽΪ:http(s)?://([\w-]+\.)+[\w-]+(/[\w- ./?%&=]*)?
    //����Ĵ�����Ӧ����ת���ַ�"\"���һ���ַ�"/"
    var Expression = /http(s)?:\/\/([\w-]+\.)+[\w-]+(\/[\w- .\/?%&=]*)?/;
    var objExp = new RegExp(Expression);
    if (objExp.test(str) == true) {
        return true;
    } else {
        return false;
    }
}