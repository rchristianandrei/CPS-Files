document.getElementById("x").addEventListener("click", function(){
    window.close();
});

let event = document.getElementById("event");
let status = document.getElementById("status");
let details = document.getElementById("details");
let date = document.getElementById("date");
let time = document.getElementById("time");
let place = document.getElementById("place");
let student = document.getElementById("student");

let add = document.getElementById("add");
let update = document.getElementById("update");
let del = document.getElementById("delete");

event.disabled = true;
status.disabled = true;
details.disabled = true;
date.disabled = true;
time.disabled = true;
place.disabled = true;
student.disabled = true;

add.disabled = true;
add.style.opacity = "50%";
update.disabled = true;
update.style.opacity = "50%";
del.disabled = true;
del.style.opacity = "50%";

document.getElementById("edit").addEventListener("click", function(){
    if(event.disabled){
        event.disabled = false;
        status.disabled = false;
        details.disabled = false;
        date.disabled = false;
        time.disabled = false;
        place.disabled = false;
        student.disabled = false;

        add.disabled = false;
        add.style.opacity = "100%";
        update.disabled = false;
        update.style.opacity = "100%";
        del.disabled = false;
        del.style.opacity = "100%";
    }else{
        event.disabled = true;
        disabled = true;
        status.disabled = true;
        details.disabled = true;
        date.disabled = true;
        time.disabled = true;
        place.disabled = true;
        student.disabled = true;

        add.disabled = true;
        add.style.opacity = "50%";
        update.disabled = true;
        update.style.opacity = "50%";
        del.disabled = true;
        del.style.opacity = "50%";
            }
});