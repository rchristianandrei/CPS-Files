$(document).ready(function(){

    let input = document.getElementsByClassName('p');
    let submit = document.getElementById('submit');
    let del = document.getElementById('delete');

    let opacity = 50;

    document.getElementById("close").addEventListener("click", function(){
        window.close();
    });

    for(let i = 0; i < input.length; i++){

        input[i].disabled = true;
    }

    submit.disabled = true;
    submit.style.opacity = '50%';
    del.disabled = true;
    del.style.opacity = '50%';
    
    $('#edit').click(function(){
        $('.p').toggleClass('hide');

        for(let i = 0; i < input.length; i++){

            input[i].disabled = !input[i].disabled;
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