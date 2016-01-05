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