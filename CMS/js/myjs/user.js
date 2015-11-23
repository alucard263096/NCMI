myjs_aftersave = function (data) {
    if (data == "login_id_duplicate") {
        warningDialog("Login name has been used");
        return false;
    }
    return true;
};