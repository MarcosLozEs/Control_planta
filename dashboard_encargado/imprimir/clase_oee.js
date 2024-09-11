class Oee_calculadora {

    constructor(jorna, descanso, temps_maquina, temps_produint, total_peces) {
        this.jorna = jorna;
        this.descanso = descanso;
        this.temps_maquina = temps_maquina;
        this.temps_produint = temps_produint;
        this.produccio_planificada = this.jorna - this.descanso;
        this.temps_paraes = this.produccio_planificada - this.temps_produint;
        this.temps_funcionament = this.produccio_planificada - this.temps_paraes;
        this.disponibilitat = this.temps_funcionament / this.produccio_planificada;
        this.total_peces = total_peces;
        this.rendiment = (this.temps_maquina * this.total_peces) / this.temps_funcionament;
        this.oee = (this.disponibilitat * this.rendiment)*100;
    }
}

