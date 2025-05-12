const searchInput = document.querySelector("#localisation");
const searchResult = document.querySelector(".boitedel");


let dataArray;




async function getVoyage() {

    const res = await fetch("voyage.json");

    const results = await res.json();

    dataArray = results

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
            ` ;
        for( var ch in VoyageList[voyage]["spécificités"]){
            
            inner += `<li>${VoyageList[voyage]["spécificités"][ch]}</li>` ;
        }
                                    
                                    
        inner += `</ul>
                        </ul>
                        <form action='Voyage.php'>
                                <input type='submit' value='Je réserve' name=${VoyageList[voyage]["id"]} id='Voyage${VoyageList[voyage]["id"]}'>
                        </form>` ;
        
        listItem.innerHTML = inner
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