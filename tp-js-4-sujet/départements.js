import {
    p_fetch
}
from "./utils.js";

import {
    p_régions
}
from "./régions.js";

/* 
Fichier XML listant les départements français.
Définition des balises :
    https://www.insee.fr/fr/information/3363419#titre-bloc-23
*/
const url = "./data/départements.xml";

/* 
Promesse construite à partir des 2 promesses extrayant
- le contenu du fichier XML accessible à l'URL `url` en utilisant `p_fetch` (voir import),
- les régions du fichier CSV (voir `p_régions` dans l'import).

*/

const parser = new DOMParser()

const promiseRegion = p_régions
const promiseXML = Promise.resolve(p_fetch(url, "xml")
                                        .then(function (resp) { 
                                            return parser.parseFromString(resp, "application/xml")
                                        }))

/*
Les promesses sont résolues en parallèle.
Si elles sont toutes deux tenues, la réponse est un objet dont les propriétés sont 
des objets correspondant aux éléments `département` du document XML.
La clé d'une propriété est la chaîne correspondant au code du département (p. ex. 
"2A", "49").
Chaque objet a les propriétés suivantes
- "nom" : contenu du sous-élément NCCENR (chaîne)
- "chef_lieu" : contenu du sous-élément CHEFLIEU (entier)
- "région" : nom de la région du département (chaîne).
*/
export const p_départements =

    Promise.all([promiseRegion, promiseXML])
        .then(function (response) {
            let departements = {}

            console.log(response[0])

            Array.from(response[1].children).forEach(child => {
                Array.from(child.children).forEach(subChild => {

                    const REGION = subChild.children[0].textContent
                    const NOM_REGION = response[0].filter(region => region[0] === REGION)[0][3]

                    const CODE = subChild.children[1].textContent

                    const CHEF_LIEU = subChild.children[2].textContent
                    const NOM = subChild.children[5].textContent


                    departements[CODE] = {
                        "nom": NOM,
                        "chef_lieu": CHEF_LIEU,
                        "région": NOM_REGION
                    }
                })
            })

            console.log(departements)

            return departements
        })
        .catch(e => console.log("Soucis dans p_departements"))