let edit = document.getElementById("edit");
let submit = document.getElementById("submit");
let del = document.getElementById("delete");
    
let mail = document.getElementById("mail");
let fName = document.getElementById("fname");
let mName = document.getElementById("mname");
let lName = document.getElementById("lname");
let suffix = document.getElementById("suffix");

let street = document.getElementById("street");
let city = document.getElementById("city");
let postal = document.getElementById("postal");
let province = document.getElementById("province");
let country = document.getElementById("country");
let contact = document.getElementById("contact");

submit.disabled = true;
submit.style.opacity = "50%";
del.disabled = true;
del.style.opacity = "50%";

mail.disabled = true;
fName.disabled = true;
mName.disabled = true;
lName.disabled = true;
suffix.disabled = true;

street.disabled = true;
city.disabled = true;
postal.disabled = true;
province.disabled = true;
country.disabled = true;
contact.disabled = true;

edit.addEventListener("click", function(){
    if(mail.disabled){
        submit.disabled = false;
        submit.style.opacity = "100%";
        del.disabled = false;
        del.style.opacity = "100%";

        mail.disabled = false;
        fName.disabled = false;
        mName.disabled = false;
        lName.disabled = false;
        suffix.disabled = false;

        street.disabled = false;
        city.disabled = false;
        postal.disabled = false;
        province.disabled = false;
        country.disabled = false;
        contact.disabled = false;
    }else{
        submit.disabled = true;
        submit.style.opacity = "50%";
        del.disabled = true;
        del.style.opacity = "50%";

        mail.disabled = true;
        fName.disabled = true;
        mName.disabled = true;
        lName.disabled = true;
        suffix.disabled = true;

        street.disabled = true;
        city.disabled = true;
        postal.disabled = true;
        province.disabled = true;
        country.disabled = true;
        contact.disabled = true;
    }
});