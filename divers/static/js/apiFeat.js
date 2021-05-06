function apiInscription(){
    event.preventDefault();

    let lName = document.getElementById("lName").value;
    let fName = document.getElementById("fName").value;
    let eMail = document.getElementById("eMail").value;
    let password = document.getElementById("pass").value;
    let modal = document.getElementById("register");

    var url = 'http://localhost:8000/api/register?';
    var params = 'nom=' + lName + '&'+ 'prenom=' + fName + '&'+ 'mail=' + eMail + '&'+ 'password=' + password + '&'+ 'confirmPassword=' + password ;
    var urlFull = url + params ;
    // var urltest = "http://localhost:8000/api/register?nom=Gonzalez&prenom=Esteban&mail=test@test.com&password=0123456Az&confirmPassword=0123456Az";

    fetch(urlFull  ,{method:"post",mode: "no-cors"})
        .then(
            function(response) {
                if (response.status !== 500){
                    alert("Bravo vous faites désormais partie de la team Neocracy");
                    return;
                }
                // Ce qui il ya dans le json
                response.json().then(function(data){
                    console.log(data);
                });
            }
        )
        .catch(function(err){
            console.log(err);
        });

    modal.style.display = "none";
}

function apiConnexion(){
    event.preventDefault();

    let email = document.getElementById("mailCo").value;
    let password = document.getElementById("passCo").value;

    const rand=()=>Math.random(0).toString(36).substr(2);
    const token=(length)=>(rand()+rand()+rand()+rand()).substr(0,length);
    const myToken = token(64);

    var url = 'http://localhost:8000/api/connect?';
    var params = 'mail=' + email + '&'+ 'password=' + password;
    //var params = `mail=${email}&password=${password}&token=${myToken}`;

    var urlFull = url + params ;

    var urlInfosUser = "http://localhost:8000/api/me";
    // var urltest = "http://localhost:8000/api/register?nom=Gonzalez&prenom=Esteban&mail=test@test.com&password=0123456Az&confirmPassword=0123456Az";


    fetch(urlFull  ,{method:"post"})
        .then(
            function(response) {
                console.log(response);
                if (response.status == 200){
                    console.log(response.status);
                    alert("Connexion réussi " );
                    location.replace("../../static/vue/assets/home.html");
                }
                else if (response.status == 500 ){
                    console.log(response);
                    alert("Connexion pas réussi");
                }
            }
        )
        .catch(function(err){
            console.log(err);
    });

    //fetch(urlInfosUser, {method:""})

    document.cookie = "userToken=" + myToken ;
    sessionStorage.setItem('userMail' , email);
}

function apiDeconnexion(){
    event.preventDefault();

    let lName = document.getElementById("lName").value;
    let fName = document.getElementById("fName").value;
    let eMail = document.getElementById("eMail").value;
    let password = document.getElementById("pass").value;
    let modal = document.getElementById("register");

    var url = 'http://localhost:8000/api/disconnect?';
    var params = 'nom=' + lName + '&'+ 'prenom=' + fName + '&'+ 'mail=' + eMail + '&'+ 'password=' + password + '&'+ 'confirmPassword=' + password ;
    var urlFull = url + params ;
    // var urltest = "http://localhost:8000/api/register?nom=Gonzalez&prenom=Esteban&mail=test@test.com&password=0123456Az&confirmPassword=0123456Az";

    fetch(urlFull  ,{method:"post",mode: "no-cors"})
        .then(
            function(response) {
                if (response.status !== 500){
                    alert("Bravo vous faites désormais partie de la team Neocracy");
                    return;
                }
                // Ce qui il ya dans le json
                response.json().then(function(data){
                    console.log(data);
                });
            }
        )
        .catch(function(err){
            console.log(err);
        });

    modal.style.display = "none";
}





