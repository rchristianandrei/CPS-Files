let width;

// Students & Parents
let email;
let sex;

// Address
let country;

// Data Entry
let mail;
let dsex;

let dcount;

$(document).ready(function(){
    width  = window.innerWidth;

    // Students  & Parents
    email = document.getElementById('email');
    sex = document.getElementById('sex');

    // Address
    country = document.getElementById('country');

    // Data Entry
    mail = document.getElementsByClassName('mail');
    dsex = document.getElementsByClassName('dsex');

    dcount = document.getElementsByClassName('dcount');

    // Initial Check
    if(width <= 1048)
        hide();

    // Check everytime window size changes
    $(window).resize(function() {
        width = window.innerWidth;

        ToggleHide();
        
      });
});

function ToggleHide(){
    if(width <= 1000)
        hide();
    else{
        
        // Students & Parents
        if(email)
            email.hidden = false;
        if(mail)
            for(let i = 0; i < mail.length; i++)
                mail[i].hidden = false;
        if(sex)
            sex.hidden = false;
        if(dsex)
            for(let i = 0; i < dsex.length; i++)
                dsex[i].hidden = false;
        
        // Address
        if(country)
            country.hidden = false;
        if(dcount)
            for(let i = 0; i < dcount.length; i++)
                dcount[i].hidden = false;
    }
}

function hide(){

    // Students & Parents
    if(email)
        email.hidden = true;
    if(mail)
        for(let i = 0; i < mail.length; i++)
            mail[i].hidden = true;
    if(sex)
        sex.hidden = true;
    if(dsex)
        for(let i = 0; i < dsex.length; i++)
            dsex[i].hidden = true;

    // Address
    if(country)
        country.hidden = true;
    if(dcount)
        for(let i = 0; i < dcount.length; i++)
            dcount[i].hidden = true;
}