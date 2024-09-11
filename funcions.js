function camps_complets(elements) { 
      
    for (var i = 0; i < elements.length; i++) {

        if (elements[i] === "") {
           return false;
        }     
    }
    return true
}

function sanititzar(input) {
   const expresion = /^[a-zA-ZñÑ]+$/; //
    return expresion.test(input);
}
