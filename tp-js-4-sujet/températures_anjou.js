import {
    p_températures_départementales
}
from "./températures_départementales.js";

/* 
Promesse produisant les températures minimales/moyennes/maximales mensuelles en 2022
dans le département 49 à partir de la réponse de la promesse `p_températures_départementales` (voir import).
La réponse est un tableau d'objets.
A chacun des 12 mois de 2022 correspond 3 objets dans ce tableau : 
- un pour la température minimale, 
- un pour la température maximale et
- un pour la température moyenne.

Chaque objet à 4 propriétés :
    -- "date" : un objet Date correspondant au 1er jour du mois
    -- "mois" : le nom du mois en français
    -- "température" : un flottant représentant une température
    -- "classe" : l'une des chaînes "Minimales", "Maximales", "Moyennes"

La température minimale (resp. maximale) d'un mois donné sera le minimum (resp. maximum) 
des températures minimales (resp. maximales) quotidiennes relevées pour ce mois.
La température moyenne d'un mois sera la moyenne des températures moyennes 
quotidiennes relevées pour ce mois.
*/

export const p_températures_anjou =

    Promise.resolve(p_températures_départementales)
    .then(function (response) {

        const tab = []

        let Tmin = 1000;
        let Tmax = -1000;

        let sumT = 0;
        let nbT = 0;

        let moisActuel = 0

        console.log(nbT, "hello")


        Array.from(response[49]).forEach(day => {

            if(day.date.getFullYear() === 2022 || (day.date.getMonth() === 0 && day.date.getFullYear() === 2023 && day.date.getDate() === 1))
            {
                if(day.date.getMonth() !== moisActuel)
                {
                    moisActuel = day.date.getMonth()

                    const firstDate = new Date(2022, moisActuel-1, 1)
                    const monthName = firstDate.toLocaleString('default', { month: 'long'});

                    const obj = [
                    {
                        "date": firstDate,
                        "mois": monthName,
                        "température": Tmin,
                        "classe": "Minimales"
                    },

                    {
                        "date": firstDate,
                        "mois": monthName,
                        "température": Tmax,
                        "classe": "Maximales"
                    },

                    {
                        "date": firstDate,
                        "mois": monthName,
                        "température": sumT / nbT,
                        "classe": "Moyennes"
                    }]

                    tab.push(obj)

                    Tmin = 1000;
                    Tmax = -1000;

                    sumT = 0;
                    nbT = 0;
                }

                if(Tmin>day.tmin) Tmin = day.tmin
                
                if(Tmax<day.tmax) Tmax = day.tmax

                ++nbT
                sumT += day.tmoy
            }
        })

        console.log(tab)
    });