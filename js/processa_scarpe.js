function ConfermaCancellazione() {
    var annulla = window.confirm("Se elimini questo prodotto ne eliminerai anche tutte le taglie. Vuoi procedere?");
    if (annulla) {
    return annulla;
    }
    else {
    window.alert("Scarpa e relative taglie eliminate");
    }
}