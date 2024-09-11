class Enviar {

    constructor(valor_elemento, enviar_a) {
        this.valor_elemento = valor_elemento;
        this.enviar_a = enviar_a;
    }

    prepararConsulta() {
        var consulta_prepara = this.valor_elemento.map(function (par) {
            return encodeURIComponent(par[0]) + "=" + encodeURIComponent(par[1]);
        }).join('&');
            console.log(consulta_prepara)
        return consulta_prepara;
    }

    enviarDades() {
        var enviarA = this.enviar_a;
        var enviarDades = this.prepararConsulta();
      
        return new Promise(function (resolve, reject) {
            var peticio_http = new XMLHttpRequest();

            peticio_http.open('POST', enviarA, true);
            peticio_http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            peticio_http.onload = function() {
                if (this.status == 200) {
                    resolve(this.responseText);
                } else {
                    reject("Error en la petición: "+this.status);
                }
            };
            peticio_http.send(enviarDades);
        });
    }
}
    













