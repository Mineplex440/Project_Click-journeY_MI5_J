async function submiting(id){

    let nom;
    let prenom;
    let email;
    let date;
    let sex;
    let password;

    switch(id.name){
        case "nom_change":
            nom=document.getElementById("input_change").value;

            prenom=document.getElementById("prenom_information").textContent;
            email=document.getElementById("email_information").textContent;
            date=document.getElementById("date_information").textContent;
            sex=document.getElementById("sex_information").textContent;
            password=document.getElementById("password_information").textContent;
            break;
        case "prenom_change":
            prenom=document.getElementById("input_change").value;
            console.log(prenom);

            nom=document.getElementById("nom_information").textContent;
            email=document.getElementById("email_information").textContent;
            date=document.getElementById("date_information").textContent;
            sex=document.getElementById("sex_information").textContent;
            password=document.getElementById("password_information").textContent;
            break;
        case "email_change":
            email=document.getElementById("input_change").value;

            nom=document.getElementById("nom_information").textContent;
            prenom=document.getElementById("prenom_information").textContent;
            date=document.getElementById("date_information").textContent;
            sex=document.getElementById("sex_information").textContent;
            password=document.getElementById("password_information").textContent;
            break;
        case "date_change":
            date=document.getElementById("input_change").value;

            nom=document.getElementById("nom_information").textContent;
            prenom=document.getElementById("prenom_information").textContent;
            email=document.getElementById("email_information").textContent;
            sex=document.getElementById("sex_information").textContent;
            password=document.getElementById("password_information").textContent;
            break;
        case "sex_change":
            sex=document.getElementById("input_change").value;

            nom=document.getElementById("nom_information").textContent;
            prenom=document.getElementById("prenom_information").textContent;
            email=document.getElementById("email_information").textContent;
            date=document.getElementById("date_information").textContent; 
            password=document.getElementById("password_information").textContent;
            break;
        case "password_change":
            password=document.getElementById("input_change").value;

            nom=document.getElementById("nom_information").textContent;
            prenom=document.getElementById("prenom_information").textContent;
            email=document.getElementById("email_information").textContent;
            date=document.getElementById("date_information").textContent;
            sex=document.getElementById("sex_information").textContent;
            break;
    }
    var profil ={
        nom: nom,
        prenom: prenom,
        email: email,
        date_of_birth: date,
        sex: sex,
        password: password
    }

    const response =await fetch("http://localhost:8080/profil_submit.php",{
        method:"POST",
        body: JSON.stringify(profil),
        headers: {
            "Content-Type": "application/json"
        }
    });
    const resp =await response.text();
    console.log(resp);
    let readresp=JSON.parse(resp);
    switch(id.name){
    case "nom_change":
            back(id,readresp.nom);
            break;
        case "prenom_change":
            back(id,readresp.prenom);
            break;
        case "email_change":
            back(id,readresp.email);
            break;
        case "date_change":
            back(id,readresp.date_of_birth);
            break;
        case "sex_change":
            back(id,readresp.sex);
            break;
        case "password_change":
            back(id,readresp.password);
            break;
    }
    
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
    /*check the value in the password input and enable the submit button if the password is right*/

    var submit=document.getElementById("submit_button");    //submit button
    submit.toggleAttribute("disabled",!check_code("password"));
}

function check_second_code(){
    /*check if the second code is the same as the first password  in the inscription form and write if they are not the same*/

    let code1=document.getElementById("code_n1");   //first password input
    let code2=document.getElementById("code_n2");   //second password input
    let elem=document.getElementById("password_error2");    //to write the error message

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
    /*enable the button if the value entered in the inscripion form are right*/
    var submit=document.getElementById("submit_button");
    submit.toggleAttribute("disabled",!(check_code("password")&&check_second_code()));
    
}

function cpt_letter(id,size){
    /*put the number of letter in id and write this number on size the maximum size of the input */
    let elem=document.getElementById(id);
    elem.lastChild.textContent=elem.childNodes[1].value.length+"/"+size;
                
}   

function submit_button(id){
    /*create a submit button when an input is pressed */
    console.log(id);
    if( (id.hasAttribute('name'))&&id.parentNode.lastChild.textContent!='submit' ){ //check if there is already a submit button
        new_button=document.createElement('button');
        id.parentNode.appendChild(new_button);
        new_button.textContent='submit';
        new_button.setAttribute("id","submit_button");
        new_button.setAttribute("type","button");
        new_button.setAttribute("onclick",'submiting('+id.name+')');    
    }
}

function back(id,text){
    /*creat a button to go back on the input and show the information*/
    let elem;
    let new_text= document.createElement("th");
    new_text.setAttribute("class","th-profil");

    let new_button=document.createElement("button");
    new_button.setAttribute("class","button-profil");
    new_button.setAttribute("type","button");
    new_button.innerHTML="<img src='img/modif.png' alt='modifier'>";

    let new_button_th=document.createElement("th");
    new_button_th.appendChild(new_button);

    switch (id.parentNode.id){
        case "prenom_change":
            elem=document.getElementById("prenom_change");
            new_button.setAttribute("onclick",'change(\'prenom\')');
            new_text.setAttribute("id","prenom_information");
            id.remove();
            document.getElementById("back_button").remove();
            new_text.textContent=text;
            elem.appendChild(new_text);
            elem.appendChild(new_button_th);
            break;

        case "nom_change":
            elem=document.getElementById("nom_change");
            new_button.setAttribute("onclick",'change(\'nom\')');
            new_text.setAttribute("id","nom_information");
            id.remove();
            document.getElementById("back_button").remove();
            new_text.textContent=text;
            elem.appendChild(new_text);
            elem.appendChild(new_button_th);
            break;
        case "email_change":
            elem=document.getElementById("email_change");
            new_button.setAttribute("onclick",'change(\'email\')');
            new_text.setAttribute("id","email_information");
            id.remove();
            document.getElementById("back_button").remove();
            new_text.textContent=text;
            elem.appendChild(new_text);
            elem.appendChild(new_button_th);
            break;
        case "date_change":
            elem=document.getElementById("date_change");
            new_button.setAttribute("onclick",'change(\'date\')');
            new_text.setAttribute("id","date_information");
            id.remove();
            document.getElementById("back_button").remove();
            new_text.textContent=text;
            elem.appendChild(new_text);
            elem.appendChild(new_button_th);
            break;
        case "password_change":
            elem=document.getElementById("password_change");
            new_button.setAttribute("onclick",'change(\'password\')');
            new_text.setAttribute("id","password_information");
            id.remove();
            document.getElementById("back_button").remove();
            new_text.textContent=text;
            elem.appendChild(new_text);
            elem.appendChild(new_button_th);
            break;
        case "photo_change":
            elem=document.getElementById("photo_change");
            new_button.setAttribute("onclick",'change(\'photo\')');
            new_text.setAttribute("id","photo_information");
            id.remove();
            document.getElementById("back_button").remove();
            new_text.textContent=text;
            elem.appendChild(new_text);
            elem.appendChild(new_button_th);
            break;

    }
    //remove the submit button if there is one 
    let submit=document.getElementById("submit_button");
    if(isNaN(submit)){
        submit.remove();
    }
    //enable the button for the modification on the page
    let parc=document.getElementsByClassName("button-profil");
    for(let index in parc){
        if(parc[index] instanceof HTMLElement){
        parc[index].toggleAttribute("disabled",false);
        }
    }

}

function change(str){
    /*create an input to change the information str in the profil*/
    let elem=document.getElementById(str+"_change");
    let information=document.getElementById(str+"_information");    //get the information already stocked
    //delete 
    document.querySelector("#"+str+"_change"+" button.button-profil").parentNode.remove();   
    document.querySelector("#"+str+"_change #"+str+"_information").remove();
    //create the new element put into the document
    let new_input=document.createElement('input');
    let back_button=document.createElement("button");
    new_input.value=information.textContent;
    //set the new input in the document
    elem.appendChild(new_input);
    new_input.setAttribute('oninput','submit_button('+str+"_change"+')');
    new_input.setAttribute('name',str+"_change");
    new_input.setAttribute("id","input_change");
    //set the button to go back in the document
    elem.appendChild(back_button);
    back_button.textContent="back";
    back_button.setAttribute("type","button");
    back_button.setAttribute("onclick",'back('+str+"_change"+',\"'+information.textContent+'\")');
    back_button.setAttribute("id","back_button");

    switch(str){
        case "email":
            new_input.setAttribute("type","text");
            break;
        case "password":
            new_input.setAttribute("type","password");
            break;
        case "date":
            new_input.setAttribute("type","date");
            break;
        case"photo":
            new_input.setAttribute("type","file");
    }
    //disable all the other edit button
    let parc=document.getElementsByClassName("button-profil");
    for(let index in parc){
        parc[index].toggleAttribute("disabled",true);
    }
}

function change_photo(){
    /*create an input to change the profil photo*/

    let elem=document.getElementById("photo_change");
    let information=document.getElementById("photo_information");
    //remove
    document.querySelector("#photo_change button.button-profil").parentNode.remove();   
    document.querySelector("#photo_change #photo_information").remove();
    //create the new element put into the document
    let submit_button=document.createElement("button");
    let hid_input=document.createElement("input");
    let new_input=document.createElement("input");
    //set the 
    hid_input.setAttribute("type","hidden");
    hid_input.setAttribute("name","MAX_FILE_SIZE");
    hid_input.setAttribute("value","30000");
    elem.appendChild(hid_input);

    new_input.setAttribute('oninput','submit_button('+"photo_change"+')');
    new_input.setAttribute('name',"photo_change");
    new_input.setAttribute("type","file");
    elem.appendChild(new_input);

}

function change_sex(){
    console.log("sex");
    let elem=document.getElementById("sex_change");
    let information=document.getElementById("sex_information");
    //deleting the old element
    document.querySelector("#sex_change button.button-profil").parentNode.remove();   
    document.querySelector("#sex_change #sex_information").remove();

    //creating the new element 
    let submit_button=document.createElement("button");
    let new_th=document.createElement("th");


    new_th.innerHTML="<input type='radio' id='Homme' name='sex_change' value='H'/>Homme<input type='radio' id='Femme' name='sex_change' value='F'/>Femme<input type='radio' id='Autre' name='sex_change' value='A'/>Autre";
    elem.appendChild(new_th);
    elem.appendChild(submit_button);
    submit_button.textContent="submit";
    submit_button.setAttribute("id","submit_button");

    let parc=document.getElementsByClassName("button-profil");
    for(let index in parc){
        parc[index].toggleAttribute("disabled",true);
    }
    
}

function modif(bool,email){
    let admin= document.getElementById(email+"_admin");
    let banni= document.getElementById(email+"_banni");
    let standard= document.getElementById(email+"_standard");
    admin.toggleAttribute("disabled",bool);
    banni.toggleAttribute("disabled",bool);
    standard.toggleAttribute("disabled",bool);
    if(bool===true){
    setTimeout(modif,1000,false,email);
    }
}