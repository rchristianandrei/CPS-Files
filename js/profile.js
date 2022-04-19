$(document).ready(function(){

    let pw = document.getElementById('password');
    let sp = document.getElementById('show');

    $('#show').click(function(){
        
        if (pw.type === "password") {
            pw.type = "text";
        } else {
            pw.type = "password";
        }

        if(sp.style.color == "red"){
            sp.style.color = "black";
        }
        else{
            sp.style.color = "red";
        }
    });
});