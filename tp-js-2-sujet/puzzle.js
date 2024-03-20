let puzzle = null;

fetch('puzzle.json', {
        method: 'GET'
    })
    .then((response) => response.json())
    .then((puzzles) => {
        // Extraction du premier puzzle et construction du générateur
        console.log('dzad:', puzzles);
        puzzle = puzzles[0];
        let generator = new PuzzleGenerator(puzzle);

        // Q1.1 Injection de l'auteur
        // generator.insertAuthor();

        const body = document.querySelector('body');
        const firstParagraphe = body.querySelector('p')
        const autorLink = document.createElement('a');

        autorLink.href = puzzle.url
        autorLink.innerText = puzzle.auteur

        firstParagraphe.appendChild(autorLink)

        // Q1.2 Injection des images
        // generator.insertImages();

        const divImages = document.getElementById("images")

        puzzle.images.forEach(img => {

            const pathToImg = "img/" + img.src
            
            const newRequest = new Request(pathToImg)

            fetch(newRequest)
            .then(response => {
                if(response.ok) {
                    return response.blob()
                }
                else {
                    console.log("Erreur : " + response.status)
                }
            })
            .then(myBlob => {
                let objURL = URL.createObjectURL(myBlob)
                let image = document.createElement('img')
                image.src = objURL
                image.alt = img.alt
                image.height = 50
                image.width = 30

                divImages.appendChild(image)
            })
            .catch(e => {
                console.log("Erreur dans la requete HTTP : " + e.message)
            })
        })
        // Q1.3 Injection de l'énoncé
        // generator.insertStatement();

        const divEnonce = divImages.nextElementSibling;
        const textDiv = divEnonce.children[0]
        textDiv.innerHTML = puzzle.énoncé

        // Injection des en-têtes du tableau (ne pas faire cette question)
        generator.insertTableHeaders();

        // Q1.4 Injection des indices
        // generator.insertHints();

        const formulaire = document.querySelector("form")
        const listeIndices = formulaire.querySelector("ol")

        puzzle.indices.forEach((indice, index) => {
            const newIndice = document.createElement("li");

            const newCheckBoxIndice = document.createElement("input")
            newCheckBoxIndice.type = "checkbox"
            newCheckBoxIndice.name="indices[]"
            newCheckBoxIndice.id = "indice" + (index+1)
            newCheckBoxIndice.value = "indice" + (index+1)

            const newCheckBoxLabel = document.createElement("label")
            newCheckBoxLabel.textContent = indice

            newIndice.appendChild(newCheckBoxIndice)
            newIndice.appendChild(newCheckBoxLabel)

            listeIndices.appendChild(newIndice)
        })

        // Q1.5 Injection des menus déroulants
        // generator.insertDropDowns();

        const table = formulaire.querySelector('table')

                        
        Array.from(table.rows).forEach((row, rowIndex) => {

            if(rowIndex == 0) {
                puzzle.facettes.forEach((facette,index) => {
                    row.cells[index].innerHTML = facette.nom.charAt(0).toUpperCase() + facette.nom.slice(1)
                })
            }

            else {

                Array.from(row.cells).forEach((cell, cellIndex) => {
                    if(cellIndex == 0) cell.innerHTML = puzzle.facettes[0].valeurs[rowIndex - 1]
                    
                    else{

                        const menuDeroulant = document.createElement("select")
                        const newOptionVide = document.createElement("option")

                        menuDeroulant.name = puzzle.facettes[0].valeurs[rowIndex - 1] + "_" + puzzle.facettes[cellIndex].nom

                        newOptionVide.value = "vide";

                        menuDeroulant.appendChild(newOptionVide)

                        puzzle.facettes[cellIndex].valeurs.forEach((facValeur, i) => {

                            console.log(facValeur)

                            
                                const newOption = document.createElement("option")
                                newOption.value = facValeur;
                                newOption.innerHTML = facValeur;
                                
                                menuDeroulant.appendChild(newOption)
            
                        })

                        cell.appendChild(menuDeroulant)
                    }
                })
            }
        })

        // Q2.1 Clic sur cellules
        // generator.handleClicks();

        const helpDiv = document.getElementById("aide")
        const helpTable = helpDiv.querySelector("table")

        Array.from(helpTable.rows).forEach((row, rowIndex) => {
            if(rowIndex >= 2)
            {
                Array.from(row.cells).forEach((cell, cellIndex) => {
                    if((rowIndex + 1) % 3 == 0 ? cellIndex >= 2 : cellIndex >= 1)
                    {
                        cell.addEventListener('click', () => {
                            if(cell.innerHTML == "0")
                            {
                                cell.style.backgroundColor = "transparent";
                                cell.innerHTML = ""
                            }

                            else if(cell.innerHTML == "X")
                            {
                                cell.style.backgroundColor = "green";
                                cell.innerHTML = "0"
                            }

                            else {
                                cell.style.backgroundColor = "red";
                                cell.innerHTML = "X"
                            }
                        })
                    }
                })
            }
        })

        // Q2.2 Cochage des indices
        //generator.handleHints();

        const indicesList = listeIndices.querySelectorAll("li")
        indicesList.forEach(indice => {
            indice.firstChild.addEventListener('change', () => {
                if(indice.firstChild.checked) {
                    indice.lastChild.style.textDecoration = "line-through"
                }

                else indice.lastChild.style.textDecoration = "none"
            })
        })

        // Q3 Gestion du formulaire
        // generator.handleDropDowns();

        return puzzle;
    })
    .catch((error) => {
        console.error('Error:', error);
    });



// Q4 Minuteur

const minuteurDiv = document.getElementById("minuteur")

minuteurDiv.innerText = 300

function setMinuteur() {
    setTimeout(() => {

        if(minuteurDiv.innerText <= 0) {
            const body = document.querySelector("body")
            body.innerHTML = "C'est fini !"
        }

        else {
            minuteurDiv.innerText = minuteurDiv.innerText - 1
            setMinuteur()
        }
    }, 1000)
}

setMinuteur()
