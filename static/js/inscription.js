function apiInscription(){

   event.preventDefault();

   let lName = document.getElementById("lName").value;
   let fName = document.getElementById("fName").value;
   let eMail = document.getElementById("eMail").value;
   let password = document.getElementById("pass").value;

    var url = 'http://localhost:8000/api/register?';
    var params = 'nom=' + lName + '&'+ 'prenom=' + fName + '&'+ 'mail=' + eMail + '&'+ 'password=' + password + '&'+ 'confirmPassword=' + password ;
    var urlFull = url + params ;
    // var urltest = "http://localhost:8000/api/register?nom=Gonzalez&prenom=Esteban&mail=test@test.com&password=0123456Az&confirmPassword=0123456Az";

    fetch(urlFull  ,{
        method:"post",
    },(req , res) => {
        console.log(res);
    })
    .then((data) => data.json())
    .then((json) => console.log(json))
    .catch((err) => console.error(err))

    
}