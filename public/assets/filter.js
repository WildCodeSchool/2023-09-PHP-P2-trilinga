document.querySelector('#recherche').addEventListener('keyup', function() { // On ajoute un gestionnaire "keyup" sur ton champ "#recherche"
    const that = this; // On garde en mémoire le context ("#recherche") dans une variable
    const elements = Array.from(document.querySelectorAll('.element')); // On récupère les éléments ".element" et on place la NodeList dans un Array pour pouvoir utiliser "filter"
    elements.forEach(element => { // Pour chaque ".element"...
        element.style.display = null; // ... on réinitialise le "style.display"
    });
    elements.filter(element => // On filtre l'array d'".element"...
                !element.innerText.toLowerCase().includes(that.value.toLowerCase()) // ... en vérifiant que "innerText" (et pas innerHTML) ne contient pas la valeur de "#recherche" (contenu dans la variable "that")
            ) 
            .forEach(element =>  // Pour chaque éléments retenu (c'est à dire quand le test précédent a renvoyé "true" et que l'élément n'inclue pas la recherche)...
                element.style.display = 'none' // ... on définit la propriété "style.display" sur "none"
            );
});