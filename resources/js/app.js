require('./bootstrap');
$(function (){
    alert('JS Included Successfully ! ');
});

function validateBirthDay()
{
    var birthday=document.getElementById('date_naissance').value;
    var ageDifMs = Date.now() - birthday.getTime();
    var ageDate = new Date(ageDifMs); // miliseconds from epoch
    console.log('age='+ageDate);
}

function validateMail() {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var email=document.getElementById('email').value;
    var  result=re.test(String(email).toLowerCase());
    if(!result){ alert('Mail invalidé');}
    return result;
}
