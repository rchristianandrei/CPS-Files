document.getElementById("x").addEventListener("click", function(){
    window.close()
});

let mail = document.getElementById("mail");
let fname = document.getElementById("fname");
let mname = document.getElementById("mname");
let lname = document.getElementById("lname");
let suffix = document.getElementById("suffix");

let city = document.getElementById("city");
let postal = document.getElementById("postal");
let province = document.getElementById("province");
let country = document.getElementById("country");
let contact = document.getElementById("contact");

let submit = document.getElementById("submit");
let del = document.getElementById("delete");

disable();

document.getElementById("edit").addEventListener("click", function(){
    if(mail.disabled){
        mail.disabled = false;
        fname.disabled = false;
        mname.disabled = false;
        lname.disabled = false;
        suffix.disabled = false;

        city.disabled = false;
        postal.disabled = false;
        province.disabled = false;
        country.disabled = false;
        contact.disabled = false;

        submit.disabled = false;
        submit.style.opacity = "100%";
        del.disabled = false;
        del.style.opacity = "100%";
    }else{
        disable();
    }
});

function disable(){
    mail.disabled = true;
    fname.disabled = true;
    mname.disabled = true;
    lname.disabled = true;
    suffix.disabled = true;

    city.disabled = true;
    postal.disabled = true;
    province.disabled = true;
    country.disabled = true;
    contact.disabled = true;

    submit.disabled = true;
    submit.style.opacity = "50%";
    del.disabled = true;
    del.style.opacity = "50%";
}