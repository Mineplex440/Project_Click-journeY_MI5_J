function cpt_letter(id,size){
    /*put the number of letter in id and write this number on size the maximum size of the input */
    let elem=document.getElementById(id);
    elem.lastChild.textContent=elem.childNodes[1].value.length+"/"+size;
                
}   

function check_condition_inscription(){
    /*enable the button if the value entered in the inscripion form are right*/
    var submit=document.getElementById("submit_button");
    console.log(check_second_code());
    console.log(check_code("password"));
    if(check_code("password") || check_second_code()){
        submit.setAttribute("disabled", "true");
    }
    else{
        submit.removeAttribute("disabled", "true");
    }
        
    
}

async function check_email(mail){

    const res = await fetch("save.json");

    const results = await res.json();

    for( var profil in results){
        if(results[profil]["email"] == mail){
            return 1;
        }
    }

    return 0
    
}

function email_verif(){
    var submit=document.getElementById("submit_button");
    var elm = document.getElementById("mail_error");
    var inner1 = "";
    elm.innerHTML = inner1;

    check_email(document.getElementById("emaill").value).then(resultat => {
        if(resultat){
            document.getElementById("mail_error").innerHTML += "<p>Ce mail est déja utilisé !!</p>";
            submit.setAttribute("disabled", "true");
        }
        else{
            submit.removeAttribute("disabled", "true");
        }
    }
    );
}

function check_number(min,max,str){
    res=0
    for(const index in str){
        if(str.charCodeAt(index)<=max&&str.charCodeAt(index)>=min){
            res++;
        }
    }
    return res;
}


function check_code(str){

        var code=document.getElementById("code_n1");
        var elem=document.getElementById(str+"_error");
        var rep=0;
        var inner="<p>";
        if(check_number(65,90,code.value)<1){  //check if there is a maj char in value
            inner+="*   il faut au moins une majuscule";
            rep=1;
        }
        if(check_number(97,122,code.value)<1){
            inner+="<br>*   il faut au moins une minuscule";
            rep=1;
        }
        if(check_number(48,57,code.value)<1){
            inner+="<br>*   il faut au moins un nombre";
            rep=1;
        }
        if(code.value.length-check_number(48,57,code.value)-check_number(97,122,code.value)-check_number(65,90,code.value)<1){
            inner+="<br>*   il faut au moins un caractere spécial";
            rep=1;
        }
        if(code.value.length<4){
            inner+="<br>*   le code doit faire au moins 4 caractere";
        }
        elem.innerHTML=inner+"</p>";
        return rep;

}

function check_second_code(){
    /*check if the second code is the same as the first password  in the inscription form and write if they are not the same*/
    let code1=document.getElementById("code_n1");
    let code2=document.getElementById("code_n2");
    let elem=document.getElementById("password_error2");
    //console.log(code1.value===code2.value);
    if(code1.value===code2.value){
        elem.innerHTML="";
        return 0;
    }
    else{
        elem.innerHTML="<p>* les deux mot de passe doivent être égaux</p>";
        return 1;
    }

}




function change_mdp(id){
    var elem=document.getElementById("lock"+id);
    var code=document.getElementById("code_n"+id);
    if(elem.hasAttribute("src")&&elem.src=="http://localhost:8888/Project_Click-journeY_MI5_J/img/show_eye.png"){
        elem.src="img/hide_eye.png";
        elem.alt="notsee";
        code.type="password";
    }
    else if (elem.hasAttribute("src")&&elem.src=="http://localhost:8888/Project_Click-journeY_MI5_J/img/hide_eye.png"){
        elem.src="img/show_eye.png";
        elem.alt="see";
        code.type="text";

    }
}