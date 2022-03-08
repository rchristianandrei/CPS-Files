(function(){
    id = document.getElementById('student_id');
    email = document.getElementById('email');
    fname = document.getElementById('first_name');
    mname = document.getElementById('middle_name');
    lname = document.getElementById('last_name');
    suffix = document.getElementById('suffix');
    street = document.getElementById('street');
    city = document.getElementById('city');
    province = document.getElementById('province');
    postal = document.getElementById('postal_code');
    country = document.getElementById('country');
    contact = document.getElementById('contact');
    submit = document.getElementById('submit');
    del = document.getElementById('delete');

    id.disabled = true;
    email.disabled = true;
    fname.disabled = true;
    mname.disabled = true;
    lname.disabled = true;
    suffix.disabled = true;

    street.disabled = true;
    city.disabled = true;
    province.disabled = true;
    postal.disabled = true;
    country.disabled = true;
    contact.disabled = true;
    submit.disabled = true;
    submit.style.opacity = "50%";
    del.disabled = true;
    del.style.opacity = "50%";
})();

let edit = document.getElementById('edit');

edit.addEventListener("click", () => {
    if(id.disabled == true){

        id.disabled = false;
        email.disabled = false;
        fname.disabled = false;
        mname.disabled = false;
        lname.disabled = false;
        suffix.disabled = false;

        street.disabled = false;
        city.disabled = false;
        province.disabled = false;
        postal.disabled = false;
        country.disabled = false;
        contact.disabled = false;
        submit.disabled = false;
        submit.style.opacity = "100%";
        del.disabled = false;
        del.style.opacity = "100%";
    }else{

        id.disabled = true;
        email.disabled = true;
        fname.disabled = true;
        mname.disabled = true;
        lname.disabled = true;
        suffix.disabled = true;

        street.disabled = true;
        city.disabled = true;
        province.disabled = true;
        postal.disabled = true;
        country.disabled = true;
        contact.disabled = true;
        submit.disabled = true;
        submit.style.opacity = "50%";
        del.disabled = true;
        del.style.opacity = "50%";
    }
});

id.addEventListener("change", () => {
    edit.disabled = true;
    submit.style.backgroundColor = "red";
    id.style.color = "red";
});

email.addEventListener("change", () => {
    edit.disabled = true;
    submit.style.backgroundColor = "red";
    email.style.color = "red";
});
fname.addEventListener("change", () => {
    edit.disabled = true;
    submit.style.backgroundColor = "red";
    fname.style.color = "red";
});
mname.addEventListener("change", () => {
    edit.disabled = true;
    submit.style.backgroundColor = "red";
    mname.style.color = "red";
});
lname.addEventListener("change", () => {
    edit.disabled = true;
    submit.style.backgroundColor = "red";
    lname.style.color = "red";
});
suffix.addEventListener("change", () => {
    edit.disabled = true;
    submit.style.backgroundColor = "red";
    suffix.style.color = "red";
});
street.addEventListener("change", () => {
    edit.disabled = true;
    submit.style.backgroundColor = "red";
    street.style.color = "red";
});
city.addEventListener("change", () => {
    edit.disabled = true;
    submit.style.backgroundColor = "red";
    city.style.color = "red";
});
province.addEventListener("change", () => {
    edit.disabled = true;
    submit.style.backgroundColor = "red";
    province.style.color = "red";
});
postal.addEventListener("change", () => {
    edit.disabled = true;
    submit.style.backgroundColor = "red";
    postal.style.color = "red";
});
country.addEventListener("change", () => {
    edit.disabled = true;
    submit.style.backgroundColor = "red";
    country.style.color = "red";
});
contact.addEventListener("change", () => {
    edit.disabled = true;
    submit.style.backgroundColor = "red";
    contact.style.color = "red";
});