const searchInput = document.querySelector("#localisation");
const searchPrix = document.querySelector("#prix");
const searchDate = document.querySelector("#date");
const searchDuree = document.querySelector("#duree");
const searchResult = document.querySelector(".boitedel");


let dataArray;

let filteredArr = [];

let filteredArr1 = [];
let filteredArr2 = []; 
let filteredArr3 = [];
let filteredArr4 = [];




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


searchInput.addEventListener("input", filterData);

searchPrix.addEventListener("input", filterPrix);

searchDate.addEventListener("input", filterPrix);

searchDuree.addEventListener("input", filterPrix);







function filterData(e) {

    searchResult.innerHTML = "";

    const searchedString = e.target.value.toLowerCase();

    filteredArr1 = dataArray.filter(el => el.titre.toLowerCase().includes(searchedString));

    common();
    
}

function filterPrix(e){

    searchPrix.innerHTML = ""

    const searchedInt = parseInt(e.target.value);

    filteredArr2 = dataArray.filter(el => el.prix_total<searchedInt);

    common();

} 

function common(){

    if(filteredArr2.length === 0){
        filteredArr2 = dataArray;
    }
    if(filteredArr1.length === 0){
        filteredArr1 = dataArray;
    }

    
    
    
    filteredArr = filteredArr1.filter(el => filteredArr2.includes(el));

    createVoyList(filteredArr);
}


