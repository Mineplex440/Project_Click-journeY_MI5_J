function cpt_letter(id,size){
    let elem=document.getElementById(id);
    elem.lastChild.textContent=elem.childNodes[1].value.length+"/"+size;
                
}  

function check_condition_connexion(){
    //elem=document.getElementsByTagNameNS("input");
    var submit=document.getElementById("submit_button");

    rightmdp(document.getElementById("code_n1").value).then(result => {
        if (result){
            submit.setAttribute("disabled", "true");
        }
        else{
            submit.removeAttribute("disabled", "true");
        }
    });

}

async function  rightmdp(mdp){

    const res = await fetch("save.json");

    const results = await res.json();

    var mail = document.getElementById("emailll").value;

    

    for( var profil in results){
        if(results[profil]["email"] == mail && results[profil]["password"] == mdp){
            return 0;
        }
    }

    return 1;



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