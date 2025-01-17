function fc_decimal(campo, separador_milhar, separador_decimal, tecla, tamMax) {
    var sep = 0;
    var key = '';
    var i = j = 0;
    var len = len2 = 0;
    var strCheck = '0123456789';
    var aux = aux2 = '';
    var whichCode = (window.Event) ? tecla.which : tecla.keyCode;

    if (whichCode == 13) return true; // Tecla Enter
    if (whichCode == 8) return true; // Tecla Delete
    key = String.fromCharCode(whichCode); // Pegando o valor digitado
    if (strCheck.indexOf(key) == -1) return false; // Valor inválido (não inteiro)
    len = campo.value.length;
    for(i = 0; i < len; i++)
    if ((campo.value.charAt(i) != '0') && (campo.value.charAt(i) != separador_decimal)) break;
    aux = '';
    for(; i < len; i++)
    if (strCheck.indexOf(campo.value.charAt(i))!=-1) aux += campo.value.charAt(i);
    aux += key;
    len = aux.length;
    if (len == 0) campo.value = '';
    if (len == 1) campo.value = '0'+ separador_decimal + '0' + aux;
    if (len == 2) campo.value = '0'+ separador_decimal + aux;

    if (len > 2) {
        aux2 = '';

        for (j = 0, i = len - 3; i >= 0; i--) {
            if (j == 3) {
                aux2 += separador_milhar;
                j = 0;
            }
            aux2 += aux.charAt(i);
            j++;

        }

        // TAMANHO MÁXIMO
        if(len > tamMax) {
            return false;

        }

        campo.value = '';
        len2 = aux2.length;

        for (i = len2 - 1; i >= 0; i--)
        campo.value += aux2.charAt(i);
        campo.value += separador_decimal + aux.substr(len - 2, len);

    }

    return false;
}
