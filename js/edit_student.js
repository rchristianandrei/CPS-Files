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

edit.addEventListener("click", () => {
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
cs.addEventListener("change", () => {
    edit.disabled = true;
    submit.style.backgroundColor = "red";
    document.getElementById("itl").style.color = "red";
    document.getElementById("csl").style.color = "red";
});
it.addEventListener("change", () => {
    edit.disabled = true;
    submit.style.backgroundColor = "red";
    document.getElementById("csl").style.color = "red";
    document.getElementById("itl").style.color = "red";
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

cpp.addEventListener("change", () => {
    edit.disabled = true;
    submit.style.backgroundColor = "red";
    document.getElementById("cppl").style.color = "red";
});
csharp.addEventListener("change", () => {
    edit.disabled = true;
    submit.style.backgroundColor = "red";
    document.getElementById("csharpl").style.color = "red";
});
c.addEventListener("change", () => {
    edit.disabled = true;
    submit.style.backgroundColor = "red";
    document.getElementById("cl").style.color = "red";
});
java.addEventListener("change", () => {
    edit.disabled = true;
    submit.style.backgroundColor = "red";
    document.getElementById("javal").style.color = "red";
});
py.addEventListener("change", () => {
    edit.disabled = true;
    submit.style.backgroundColor = "red";
    document.getElementById("pyl").style.color = "red";
});
js.addEventListener("change", () => {
    edit.disabled = true;
    submit.style.backgroundColor = "red";
    document.getElementById("jsl").style.color = "red";
});
cisco.addEventListener("change", () => {
    edit.disabled = true;
    submit.style.backgroundColor = "red";
    document.getElementById('ciscol').style.color = "red";
});