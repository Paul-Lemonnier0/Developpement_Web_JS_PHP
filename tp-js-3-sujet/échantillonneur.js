import {
    points
} from "./échantillonneur_proto.js";

export class Echantillon {
    constructor(f, n, minMaxX) {
        // La fonction (callback) à échantillonner
        this.f = f;

        // Le nombre de points de l'échantillon
        this.n = n;

        // Abscisses min (u) et max (v) : minMaxX = {"min":u, "max": v}
        this.minMaxX = minMaxX;

        /*
        Renvoie le tableau de points [[x,f(x)] | i=1..n, x=Echantillon.abscisse(i,n,minMaxX)].
        Selon la fonction et son domaine de définition (p. ex. log, sqrt), l'évaluation
        de la fonction native JS sur des valeurs hors domaine retournera NaN ou +/-Infinity.
        Le code appelant devra gérer ces points.
        */

        this.points = function () {

            const tab = []

            for(let i = 1; i<=n; ++i)
            {
                const x = Echantillon.abscisse(i,this.n, this.minMaxX)
                tab.push([x, f(x)])
            }
                console.log("POINTS");
                console.table(tab);
            return tab
        }.call(this);
    }

    /*
    Renvoie l'abscisse du k-ième point de sorte que :
    - abscisse(1,n,Mx) == minMaxX.min et 
    - abscisse(n,n,Mx) == minMaxX.max
    */
    static abscisse(k, n, minMaxX) {
        if (minMaxX.max * minMaxX.min < 0) {
            return minMaxX.min + (((k - 1) * (Math.abs(minMaxX.max - minMaxX.min))) / (n - 1));
        } else {
            return minMaxX.min + (((k - 1) * (Math.abs(minMaxX.max + minMaxX.min))) / (n - 1));
        }
    }
}