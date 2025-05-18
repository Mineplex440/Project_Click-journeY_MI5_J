const searchInput = document.querySelector("#localisation");
const searchPrix = document.querySelector("#prix");
const searchDate = document.querySelector("#date");
const searchType = document.querySelector("#type_sejour");
const searchDuree = document.querySelector("#duree");
const searchResult = document.querySelector(".boitedel");


let dataArray;



async function getVoyage() {

    const res = await fetch("voyage.json");

    const results = await res.json();

    dataArray = results;

    createVoyList(dataArray);

}

function createVoyList(VoyageList){

    console.log(VoyageList);

    for( var voyage in VoyageList){

        
        
        const listItem = document.createElement("div");
        listItem.setAttribute("class", "box-voy");


        var inner = `

            <img src='${VoyageList[voyage]["image"]}' alt='voyage${VoyageList[voyage]["id"]}'>
                    <ul>
                        <li>
                            <u>${VoyageList[voyage]["titre"]}</u>
                        </li>
                        <ul>
            `;
        for( var ch in VoyageList[voyage]["spécificités"]){
            
            inner += `<li>${VoyageList[voyage]["spécificités"][ch]}</li>` ;
        }
                                    
                                    
        inner += `</ul>
                        </ul>
                        <form action='Voyage.php'>
                                <input type='submit' value='Je réserve' name=${VoyageList[voyage]["id"]} id='Voyage${VoyageList[voyage]["id"]}'>
                        </form>` ;
        
        listItem.innerHTML = inner;
        searchResult.appendChild(listItem);

    }

}

getVoyage();


searchInput.addEventListener("input", filterData2);

searchPrix.addEventListener("input", filterData2);

searchDate.addEventListener("input", filterData2);

searchDuree.addEventListener("input", filterData2);

searchType.addEventListener("input", filterData2);


function filterData2(){

    searchResult.innerHTML = "";

    const localisation = document.getElementById("localisation").value.toLowerCase();
    const prix = parseInt(document.getElementById("prix").value);
    const date = document.querySelector("input[name='date']").value;
    const type = document.getElementById("type_sejour").value;
    const duree = parseInt(document.getElementById("duree").value);

    

    let filtered = dataArray.filter(voyage => {
        let ok = true;

        if (localisation && !voyage.titre.toLowerCase().includes(localisation)) {
            ok = false;
        }

        if (!isNaN(prix) && voyage.prix_total > prix) {
            ok = false;
        }
        if (date && voyage.dates.début !== date) {
            ok = false;
        }

        if (type !== "tout-endroit" && voyage.type !== type) {
            ok = false;
        }

        if (duree !== "toute-duree") {
            const dureeNum = voyage.dates.durée;
        
            if (duree === 7 && dureeNum >= 7) {
                ok = false;
            }
            else if (duree === 12 && (dureeNum < 7 || dureeNum > 12)) {
                ok = false; 
            }
            else if (duree === 17 && (dureeNum < 13 || dureeNum > 19)) {
                ok = false; 
            }
            else if (duree === 20 && dureeNum < 20) {
                ok = false; 
            }
        }

        return ok;
    });

    // 3. Trier les résultats (par prix, croissant)
    filtered.sort((a, b) => a.prix_total - b.prix_total);

    createVoyList(filtered);
}
  
