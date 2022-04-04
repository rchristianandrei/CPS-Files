$(document).ready(function(){
    
    let file = document.getElementById('img');
    let name = document.getElementById('filename');

    file.addEventListener('change', function(){
        if(this.files[0].size > 104857600){
            alert("File is too big!");
            this.value = "";
        }else{
            name.innerHTML = this.files[0].name;
        }
    });
});