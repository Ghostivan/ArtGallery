/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function insertParamToUrl(name,value){
    var url = window.location.href;
    if(url.indexOf("#") > 0){
        url = url.substring(0,url.indexOf("#"));
        window.location.href = url;
    }
    if (url.indexOf(name + "=") >= 0)
    {
        var prefix = url.substring(0, url.indexOf(name));
        var suffix = url.substring(url.indexOf(name));
        suffix = suffix.substring(suffix.indexOf("=") + 1);
        suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
        url = prefix + name + "=" + value + suffix;
    }
    else
    {
        if (url.indexOf("?") < 0)
            url += "?" + name + "=" + value;
        else
            url += "&" + name + "=" + value;
    }
    window.location.href = url;
}