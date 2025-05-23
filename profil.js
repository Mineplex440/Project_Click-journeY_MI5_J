function editPhoto() {
    const cell = document.getElementById('photo_information');

    cell.innerHTML = `
        <input type="file" id="photo_input" accept="image/*">
        <button onclick="uploadPhoto()">✔</button>
        <button onclick="cancelPhoto()">✖</button>
    `;
}
            
function editField(field) {
    const cell = document.getElementById(field + '_information');
    const currentValue = cell.innerText.trim();
    const buttons = document.querySelectorAll('.button-profil');

    buttons.forEach(button => {
        button.setAttribute("disabled",true);
        
    });

    var parent = document.getElementById(field+'_information');
    const frere = parent.nextElementSibling;

    if(!isNaN(parent)){
        return 0;
    }

    if(parent.lastChild.class!=="th-profil"){
        frere.remove();
    }



    cell.dataset.oldValue = currentValue;

    if(field == "password"){
        cell.innerHTML = `
        <input type="text" id="${field}_input" value="${currentValue}" minlength="4" maxlength="15">
        <button onclick="saveField('${field}')">✔</button>
        <button onclick="cancelField('${field}')">✖</button>
    `;
    }
    else if (field === 'sex') {
        cell.innerHTML = `
            <select id="${field}_input">
                <option value="H" ${currentValue === 'H' ? 'selected' : ''}>Homme</option>
                <option value="F" ${currentValue === 'F' ? 'selected' : ''}>Femme</option>
                <option value="A" ${currentValue === 'A' ? 'selected' : ''}>Autre</option>
            </select>
            <button onclick="saveField('${field}')">✔</button>
            <button onclick="cancelField('${field}')">✖</button>
        `;
    }
    else if (field === 'date_of_birth') {
        const today = new Date();
        const year = today.getFullYear() - 18;
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const day = String(today.getDate()).padStart(2, '0');
        const maxDate = `${year}-${month}-${day}`; // Max = aujourd'hui - 18 ans

        cell.innerHTML = `
            <input type="date" id="${field}_input" value="${currentValue}" max="${maxDate}">
            <button onclick="saveField('${field}')">✔</button>
            <button onclick="cancelField('${field}')">✖</button>
        `;
    }
    else{
        cell.innerHTML = `
        <input type="text" id="${field}_input" value="${currentValue}">
        <button onclick="saveField('${field}')">✔</button>
        <button onclick="cancelField('${field}')">✖</button>
    `;
    }
    

    document.getElementById(`${field}_input`).focus();
}

function saveField(field) {
    const input = document.getElementById(field + '_input');
    const newValue = input.value;

    if (newValue === "") {
        alert("Le champ ne peut pas être vide.");
        return;
    }

    if (field === "password" && (newValue.length < 4 || newValue.length > 15)) {
        alert("Le mot de passe doit contenir entre 4 et 15 caractères.");
        return;
    }

    fetch('profil_submit.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ field: field, value: newValue })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const cell = document.getElementById(field + '_information');
            cell.innerText = newValue;

            const tr = document.getElementById(field + '_change');
            if (tr.children.length > 2) tr.lastElementChild.remove();

            const new_th = document.createElement('th');
            const new_button = document.createElement('button');
            new_button.setAttribute('onclick', "editField('" + field + "')");
            new_button.setAttribute('class', 'button-profil');
            new_button.setAttribute('id', 'button-profil');
            new_button.setAttribute('type', 'button');

            const new_img = document.createElement('img');
            new_img.setAttribute('src', 'img/modif.png');
            new_img.setAttribute('alt', 'modifier');

            new_button.appendChild(new_img);
            new_th.appendChild(new_button);
            tr.appendChild(new_th);
        } else {
            alert("Erreur : " + (data.error || "modification échouée"));
            cancelField(field);
        }
    })
    .catch(err => {
        alert("Erreur AJAX");
        cancelField(field);
        console.error(err);
    });

    document.querySelectorAll('.button-profil').forEach(btn => btn.removeAttribute("disabled"));
}



function cancelField(field) {
    const cell = document.getElementById(field + '_information');
    const oldValue = cell.dataset.oldValue || '';
    cell.innerText = oldValue;

    // Supprimer le bouton précédent s’il existe déjà
    const tr = document.getElementById(field + '_change');
    if (tr.children.length > 2) {
        tr.lastElementChild.remove();
    }

    // Créer et ajouter un nouveau bouton
    const new_th = document.createElement('th');
    const new_button = document.createElement('button');
    new_button.setAttribute('onclick', "editField('" + field + "')");
    new_button.setAttribute('class', 'button-profil');
    new_button.setAttribute('id', 'button-profil');
    new_button.setAttribute('type', 'button');

    const new_img = document.createElement('img');
    new_img.setAttribute('src', 'img/modif.png');
    new_img.setAttribute('alt', 'modifier');

    new_button.appendChild(new_img);
    new_th.appendChild(new_button);
    tr.appendChild(new_th);

    // Réactiver tous les boutons
    const buttons = document.querySelectorAll('.button-profil');
    buttons.forEach(button => {
        button.removeAttribute("disabled");
    });
}


function uploadPhoto() {
    const fileInput = document.getElementById('photo_input');
    const file = fileInput.files[0];

    if (!file) {
        alert("Veuillez choisir une image.");
        return;
    }

    const formData = new FormData();
    formData.append('photo', file);

    fetch('upload_photo.php', {
        method: 'POST',
        body: formData
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            document.getElementById('photo_information').innerHTML =
                `<img class='img-profil' id='photo_preview' src='images/${data.filename}?${Date.now()}' alt='photo'>`;
        } else {
            alert(data.error || "Erreur lors du téléversement.");
        }
    })
    .catch(err => {
        console.error(err);
        alert("Erreur AJAX.");
    });
}

function cancelPhoto() {
    const cell = document.getElementById('photo_information');
    const currentEmail = `<?php echo json_encode($_SESSION["email"]); ?>`;
    cell.innerHTML = `<img class='img-profil' id='photo_preview' src='images/${currentEmail}.jpg' alt='photo'>`;
}