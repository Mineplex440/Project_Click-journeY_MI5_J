
function true_modif(email, isAdmin) {
    fetch('admin_action.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            email: email,
            action: isAdmin ? 'admin' : 'standard'
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert("Statut mis à jour.");
            location.reload(); // ou rafraîchir dynamiquement si tu préfères
        } else {
            alert("Erreur : " + data.error);
        }
    })
    .catch(err => {
        console.error(err);
        alert("Erreur AJAX");
    });
}

function supr(email) {
    if (!confirm("Voulez-vous vraiment bannir cet utilisateur ?")) return;

    fetch('admin_action.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            email: email,
            action: 'delete'
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert("Utilisateur supprimé.");
            location.reload(); // ou mise à jour dynamique
        } else {
            alert("Erreur : " + data.error);
        }
    })
    .catch(err => {
        console.error(err);
        alert("Erreur AJAX");
    });
}