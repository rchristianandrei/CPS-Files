let id, email, fname, mname, lname, suffix, sex, cs, it, skills, street, city, province, postal, country, contact, submit,
cpp, csharp, c, java, py, js, cisco;

(function(){
    id = document.getElementById('student_id');
    email = document.getElementById('email');
    fname = document.getElementById('first_name');
    mname = document.getElementById('middle_name');
    lname = document.getElementById('last_name');
    suffix = document.getElementById('suffix');
    // sex = document.getElementById('email');
    cs = document.getElementById('cs');
    it = document.getElementById('it');
    // skills = document.getElementById('email');
    street = document.getElementById('street');
    city = document.getElementById('city');
    province = document.getElementById('province');
    postal = document.getElementById('postal_code');
    country = document.getElementById('country');
    contact = document.getElementById('contact');
    submit = document.getElementById('submit');

    cpp = document.getElementById('cpp');
    csharp = document.getElementById('csharp');
    c = document.getElementById('c');
    java = document.getElementById('java');
    py = document.getElementById('py');
    js = document.getElementById('js');
    cisco = document.getElementById('cisco');

    id.disabled = true;
    email.disabled = true;
    fname.disabled = true;
    mname.disabled = true;
    lname.disabled = true;
    suffix.disabled = true;

    cs.disabled = true;
    it.disabled = true;

    cpp.disabled = true;
    csharp.disabled = true;
    c.disabled = true;
    java.disabled = true;
    py.disabled = true;
    js.disabled = true;
    cisco.disabled = true;

    street.disabled = true;
    city.disabled = true;
    province.disabled = true;
    postal.disabled = true;
    country.disabled = true;
    contact.disabled = true;
    submit.disabled = true;
    submit.style.opacity = "50%";
})();

let edit = document.getElementById('edit');

edit.addEventListener("click", enableAll);

function enableAll(){
    if(id.disabled == true){

        id.disabled = false;
        email.disabled = false;
        fname.disabled = false;
        mname.disabled = false;
        lname.disabled = false;
        suffix.disabled = false;

        cs.disabled = false;
        it.disabled = false;

        cpp.disabled = false;
        csharp.disabled = false;
        c.disabled = false;
        java.disabled = false;
        py.disabled = false;
        js.disabled = false;
        cisco.disabled = false;

        street.disabled = false;
        city.disabled = false;
        province.disabled = false;
        postal.disabled = false;
        country.disabled = false;
        contact.disabled = false;
        submit.disabled = false;
        submit.style.opacity = "100%";
    }else{

        id.disabled = true;
        email.disabled = true;
        fname.disabled = true;
        mname.disabled = true;
        lname.disabled = true;
        suffix.disabled = true;

        cs.disabled = true;
        it.disabled = true;

        cpp.disabled = true;
        csharp.disabled = true;
        c.disabled = true;
        java.disabled = true;
        py.disabled = true;
        js.disabled = true;
        cisco.disabled = true;

        street.disabled = true;
        city.disabled = true;
        province.disabled = true;
        postal.disabled = true;
        country.disabled = true;
        contact.disabled = true;
        submit.disabled = true;
        submit.style.opacity = "50%";
    }
}
