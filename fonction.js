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
    let code=document.getElementById("code_n1");
    let elem=document.getElementById(str+"_error");
    let rep=1;
    let inner="<p>";
    if(check_number(65,90,code.value)<1){  //check if there is a maj char in value
        inner+="*   il faut au moins une majuscule";
        rep=0;
    }
    if(check_number(97,122,code.value)<1){
        inner+="<br>*   il faut au moins une minuscule";
        rep=0;
    }
    if(check_number(48,57,code.value)<1){
        inner+="<br>*   il faut au moins un nombre";
        rep=0;
    }
    if(code.value.length-check_number(48,57,code.value)-check_number(97,122,code.value)-check_number(65,90,code.value)<1){
        inner+="<br>*   il faut au moins un caractere spéciale";
        rep=0;
    }
    if(code.value.length<4){
        inner+="<br>*   le code doit faire au moins 4 caractere"
    }
    elem.innerHTML=inner+"</p>";
    return rep;
}

function change_mdp(id){
    var elem=document.getElementById("lock"+id);
    var code=document.getElementById("code_n"+id);
    if(elem.hasAttribute("src")&&elem.src=="http://localhost:8080/img/show_eye.png"){
        elem.src="/img/hide_eye.png";
        code.type="password";
    }
    else{
        elem.src="/img/show_eye.png"
        code.type="text";
    }
}

function check_condition_connexion(){
    //elem=document.getElementsByTagNameNS("input");
    var submit=document.getElementById("submit_button");
    submit.toggleAttribute("disabled",!check_code("password"));
    /*if(check_code()){
        console.log("oui1");
        if(submit.hasAttribute("disabled")){
            console.log("oui2");
            submit.removeAttribute("disabled");
            console.log(submit.innerHTML);
        }
       

    }
    else{
        submit.setAttribute(disabled);
    }*/
}

function check_second_code(){
    let code1=document.getElementById("code_n1");
    let code2=document.getElementById("code_n2");
    let elem=document.getElementById("password_error2");
    console.log(code1.value===code2.value);
    if(code1.value===code2.value){
        elem.innerHTML="";
        return 1;
    }
    else{
        elem.innerHTML="<p>* les deux mot de passe doivent être égaux</p>";
        return 0;
    }

}

function check_condition_inscription(){
    var submit=document.getElementById("submit_button");
    submit.toggleAttribute("disabled",!(check_code("password")&&check_second_code()));
    
}

function cpt_letter(id,size){
    let elem=document.getElementById(id);
    elem.lastChild.textContent=elem.childNodes[1].value.length+"/"+size;
                
}   