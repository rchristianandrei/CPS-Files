$(document).ready(function(){
    let id = document.getElementById('id');
    let email = document.getElementById('email');
    let fname = document.getElementById('fname');
    let mname = document.getElementById('mname');
    let lname = document.getElementById('lname');
    let suffix = document.getElementById('suffix');
    let sex = document.getElementById('sex');
    let dob = document.getElementById('dob');
    let rel = document.getElementById('rel');

    let course = document.getElementById('course');
    let yr = document.getElementById('yr');
    let c = document.getElementById('c');
    let cpp = document.getElementById('cpp');
    let cs = document.getElementById('cs');
    let java = document.getElementById('java');
    let py = document.getElementById('py');
    let js = document.getElementById('js');
    let cisco = document.getElementById('cisco');

    let city = document.getElementById('city');
    let province = document.getElementById('province');
    let postal = document.getElementById('postal');
    let country = document.getElementById('country');
    let contact = document.getElementById('contact');

    let authorization = document.getElementById('authorization');
    let status = document.getElementById('status');

    let submit = document.getElementById('submit');
    let del = document.getElementById('delete');

    let opacity = 50;
    let edit = document.getElementById("edit");

    document.getElementById("close").addEventListener("click", function(){
        window.close();
    });

    if(id){
        id.disabled = true;
        if(fname){
            email.disabled = true;
            fname.disabled = true;
            mname.disabled = true;
            lname.disabled = true;
            suffix.disabled = true;
            sex.disabled = true;
        }
    }
    if(dob)
        dob.disabled = true;
    if(rel)
        rel.disabled = true;

    if(course){ 
        course.disabled = true;
        yr.disabled = true;
        c.disabled = true;
        cpp.disabled = true;
        cs.disabled = true;
        java.disabled = true;
        py.disabled = true;
        js.disabled = true;
        cisco.disabled = true;
    }

    if(city){
        city.disabled = true;
        province.disabled = true;
        postal.disabled = true;
        country.disabled = true;
        contact.disabled = true;
    }

    if(authorization){
        authorization.disabled = true;
        status.disabled = true;
    }

    submit.disabled = true;
    submit.style.opacity = '50%';
    del.disabled = true;
    del.style.opacity = '50%';

    edit.addEventListener("click", function(){
        if(id){
            id.disabled = !id.disabled;
            if(email){
                email.disabled = !email.disabled;
                fname.disabled = !fname.disabled;
                mname.disabled = !mname.disabled;
                lname.disabled = !lname.disabled;
                suffix.disabled = !suffix.disabled;
                sex.disabled = !sex.disabled;
            }
        }
        if(dob)
            dob.disabled = !dob.disabled;
        if(rel)
            rel.disabled = !rel.disabled;

        if(course){
            course.disabled = !course.disabled;
            yr.disabled = !yr.disabled;
            c.disabled = !c.disabled;
            cpp.disabled = !cpp.disabled;
            cs.disabled = !cs.disabled;
            java.disabled = !java.disabled;
            py.disabled = !py.disabled;
            js.disabled = !js.disabled;
            cisco.disabled = !cisco.disabled;
        }

        if(city){
            city.disabled = !city.disabled;
            province.disabled = !province.disabled;
            postal.disabled = !postal.disabled;
            country.disabled = !country.disabled;
            contact.disabled = !contact.disabled;
        }

        if(authorization){
            authorization.disabled = !authorization.disabled;
            status.disabled = !status.disabled;
        }

        submit.disabled = !submit.disabled;
        del.disabled = !del.disabled;

        if(opacity == 50){
            submit.style.opacity = '100%';
            del.style.opacity = '100%';
            opacity = 100;
            edit.style.color = "red";
        }
        else{
            submit.style.opacity = '50%';
            del.style.opacity = '50%';
            opacity = 50;
            edit.style.color = "black";
        }
    });
    
})