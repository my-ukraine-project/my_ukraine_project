var aux = {
    template: function (templateid, data) {
        return document.getElementById(templateid).innerHTML.replace(/{(\w*)}/g, function (m, key) {
            return data.hasOwnProperty(key) ? data[key] : "";
        });
    }
};

JSON.isjson = function (s) {
    try {
        JSON.parse(s);
    } catch (e) {
        return false;
    }
    return true;
};