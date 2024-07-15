import "./bootstrap";
import "~resources/scss/app.scss";
import.meta.glob(["../img/**"]);
import * as bootstrap from "bootstrap";


//PHOTO PREVIEW 

// troviamo il pulsante per il caricamento dell' immagine e il riquadro della preview
const photoInput = document.getElementById('photo');
const photoPrewiewElem = document.getElementById('photo-preview');

// con l'if restringiamo la visualizzazione solo nelle pagine in cui sono presenti gli elementi
if (photoInput && photoPrewiewElem) {
    // verifico in console se prendo gli elementi in modo corretto
    // console.log(imageInput, imagePrewiewElem);

    // verifico il cambio del valore nell' input
    photoInput.addEventListener('change', function(){
        // verifico in console
        // console.log('input change');

        // prelevo il valore dell'input
        const photoFiles = photoInput.files;
        // verifico in console
        // console.log(photoFiles);

        // se nell'input c'è un file
        if(photoFiles && photoFiles.length > 0) {
            // verifico in console
            // console.log('file trovato', photoFiles[0]);

            // prelevo l'URL del file
            const photoUrl = URL.createObjectURL(photoFiles[0]);
            // verifico in console
            // console.log(photoUrl);

            //inseriamo nel src l'URL del file appena estrapolato
            photoPrewiewElem.src = photoUrl;

            //mostro l'immagine
            photoPrewiewElem.classList.remove('d-none');

            //una volta che la preview viene visualizzata rilasciamo la memoria dal processo di lettura dell' immagine
            photoPrewiewElem.onload = () =>
                URL.revokeObjectURL(photoPrewiewElem.src);
        } else {
            // verifico in console
            // console.log('nessun file selezionato');

            // tolgo URL dell'elemento image
            photoPrewiewElem.src = "";

            //nascondo l'immagine
            photoPrewiewElem.classList.add('d-none');
        }
    })
}

//PHOTO PREVIEW 

// --------------------------------------------------------------------------------------------------------------------------------------

//CV PREVIEW 

// troviamo il pulsante per il caricamento dell' immagine e il riquadro della preview
const cvInput = document.getElementById('CV');
const cvPrewiewElem = document.getElementById('cv-preview');

// con l'if restringiamo la visualizzazione solo nelle pagine in cui sono presenti gli elementi
if (cvInput && cvPrewiewElem) {
    // verifico in console se prendo gli elementi in modo corretto
    // console.log(imageInput, imagePrewiewElem);

    // verifico il cambio del valore nell' input
    cvInput.addEventListener('change', function(){
        // verifico in console
        // console.log('input change');

        // prelevo il valore dell'input
        const cvFiles = cvInput.files;
        // verifico in console
        // console.log(photoFiles);

        // se nell'input c'è un file
        if(cvFiles && cvFiles.length > 0) {
            // verifico in console
            // console.log('file trovato', photoFiles[0]);

            // prelevo l'URL del file
            const cvUrl = URL.createObjectURL(cvFiles[0]);
            // verifico in console
            // console.log(photoUrl);

            //inseriamo nel src l'URL del file appena estrapolato
            cvPrewiewElem.src = cvUrl;

            //mostro l'immagine
            cvPrewiewElem.classList.remove('d-none');

            //una volta che la preview viene visualizzata rilasciamo la memoria dal processo di lettura dell' immagine
            cvPrewiewElem.onload = () =>
                URL.revokeObjectURL(cvPrewiewElem.src);
        } else {
            // verifico in console
            // console.log('nessun file selezionato');

            // tolgo URL dell'elemento image
            cvPrewiewElem.src = "";

            //nascondo l'immagine
            cvPrewiewElem.classList.add('d-none');
        }
    })
}
//CV PREVIEW 




