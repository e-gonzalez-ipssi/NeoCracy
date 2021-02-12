function apiInscription(){

   let lName = document.getElementById("lName").value;
   let fName = document.getElementById("fName").value;
   let eMail = document.getElementById("eMail").value;
   let password = document.getElementById("password").value;

    //alert(lName +"" + fName +""+ eMail +""+password );
    var http = new XMLHttpRequest();
    var url = 'http://localhost:8000/api/register?';
    var params = 'nom=' + lName + '&'+ 'prenom=' + fName + '&'+ 'mail=' + eMail + '&'+ 'password=' + password + '&'+ 'confirmPassword=' + password ;
    var urlFull = url + params ;
    http.open('POST', urlFull, true);

    http.onload = function(event){
        var json = http.responseText; // Response, yay!
        console.log(json);
    }
    //Send the proper header information along with the request
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    http.onreadystatechange = function() {//Call a function when the state changes.
        if(http.readyState == 4 && http.status == 200) {
            alert(http.responseText);
        }
        if(http.status == 500) {
            console.log(http.responseText);
        }
    }
    http.send(params);

    var file = new ActiveXObject("Scripting.FileSystemObject");
    var a = file.CreateTextFile("D:\IPPSI\projet\NeoCracy\static\js\test.txt", true);
    a.WriteLine("Salut cppFrance !");
    a.Close();


}