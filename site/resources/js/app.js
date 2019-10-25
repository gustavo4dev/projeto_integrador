function validarCPF(cpf) {
    var valido = true;
    cpf = cpf.replace(/[^\d]+/g, '');
    if (cpf == '')
        valido = false;
    // Elimina CPFs invalidos conhecidos    
    if (cpf.length != 11 ||
            cpf == "00000000000" ||
            cpf == "11111111111" ||
            cpf == "22222222222" ||
            cpf == "33333333333" ||
            cpf == "44444444444" ||
            cpf == "55555555555" ||
            cpf == "66666666666" ||
            cpf == "77777777777" ||
            cpf == "88888888888" ||
            cpf == "99999999999")
        valido = false;
    // Valida 1o digito 
    add = 0;
    for (i = 0; i < 9; i ++)
        add += parseInt(cpf.charAt(i)) * (10 - i);
    rev = 11 - (add % 11);
    if (rev == 10 || rev == 11)
        rev = 0;
    if (rev != parseInt(cpf.charAt(9)))
        valido = false;
    // Valida 2o digito 
    add = 0;
    for (i = 0; i < 10; i ++)
        add += parseInt(cpf.charAt(i)) * (11 - i);
    rev = 11 - (add % 11);
    if (rev == 10 || rev == 11)
        rev = 0;
    if (rev != parseInt(cpf.charAt(10)))
        valido = false;
    //valido = true;

    if (valido == false) {
         document.getElementById("alertCpf").innerHTML="CPF inválido";
    } else {
        document.getElementById("alertCpf").innerHTML="";
    }
}

function validaEmail(field) {
    //console.log(field);
    usuario = field.substring(0, field.indexOf("@"));
    dominio = field.substring(field.indexOf("@") + 1, field.length);

    if ((usuario.length >= 1) &&
            (dominio.length >= 3) &&
            (usuario.search("@") == -1) &&
            (dominio.search("@") == -1) &&
            (usuario.search(" ") == -1) &&
            (dominio.search(" ") == -1) &&
            (dominio.search(".") != -1) &&
            (dominio.indexOf(".") >= 1) &&
            (dominio.lastIndexOf(".") < dominio.length - 1)) {
        document.getElementById("alertEmail").innerHTML="";
    } else {
        document.getElementById("alertEmail").innerHTML="E-mail inválido";
    }
}

function validaSenha(senha){
    if(senha.length < 8){
      document.getElementById("alertSenha").innerHTML="A senha deve conter pelo menos 8 caracteres";
    } else {
        document.getElementById("alertSenha").innerHTML="";
    }
}

function confirmaSenha(confSenha){
    var senha = document.getElementById("senha");
    if(confSenha.length <8 || senha.value !== confSenha){
        document.getElementById("alertConfSenha").innerHTML="As senhas nao correspondem";
    } else {
        document.getElementById("alertConfSenha").innerHTML="";
    }
}
