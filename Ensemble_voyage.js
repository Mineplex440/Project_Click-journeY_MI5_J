const searchInput = document.querySelector("#localisation");
const searchResult = document.querySelector(".boitedel");


let dataArray;

let filteredArr;


async function getVoyage() {

    const res = await fetch("voyage.json");

    const results = await res.json();

    dataArray = results

    createVoyList(dataArray);

}

function createVoyList(VoyageList) {

    for (let voyageKey in VoyageList) {

        const voyage = VoyageList[voyageKey];

        const listItem = document.createElement("div");
        listItem.classList.add("box-voy");

        
        const img = document.createElement("img");
        img.src = voyage.image;
        img.alt = `voyage${voyage.id}`;
        listItem.appendChild(img);

        
        const mainList = document.createElement("ul");


        const titreLi = document.createElement("li");
        const titreU = document.createElement("u");
        titreU.textContent = voyage.titre;
        titreLi.appendChild(titreU);
        mainList.appendChild(titreLi);


        const subList = document.createElement("ul");
        for (let spec of voyage.spécificités) {
            const li = document.createElement("li");
            li.textContent = spec;
            subList.appendChild(li);
        }
        mainList.appendChild(subList);
        listItem.appendChild(mainList);

        
        const form = document.createElement("form");
        form.action = "Voyage.php";

        const input = document.createElement("input");
        input.type = "submit";
        input.value = "Je réserve";
        input.name = voyage.id;
        input.id = `Voyage${voyage.id}`;

        form.appendChild(input);
        listItem.appendChild(form);

        
        searchResult.appendChild(listItem);
    }
}

getVoyage();

searchInput.addEventListener("input", filterData);

function filterData(e) {

    searchResult.innerHTML = "";

    const searchedString = e.target.value.toLowerCase();

    const filteredArr1 = dataArray.filter(el => el.titre.toLowerCase().includes(searchedString));

    for( var elm in dataArray){

        
        let filteredArr2 = dataArray[elm]["étapes"].filter(el => el.toLowerCase().includes(searchedString));
        

    }

    createVoyList(filteredArr2);
}