var req;
var url;
function getCompanies() {
    url = "http://criterion/companies";
    req = getXmlHttpRequest();
    req.onreadystatechange = function () {
        if(req.readyState === 4){
            if(req.status != 200){
                alert(req.status + ": " + req.statusText);
            }else{
                alert(req.getAllResponseHeaders());

            }
        }
    }
    req.open("GET", url, false);
    req.send(null);
}