// $("#username").keypress(function(){
//
//    var v = $(this).val();
//    // alert(v);
//
//    v = v.replace(/(\d{3})(\d)/,"$1.$2");
//    v = v.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
//    // if(v.length < 11){
//    //    v = v.replace(/(\d{3})(\d)/,"$1.$2");
//    // }else{
//    //    v = v.replace(/(\d{3})(\d)/,"$1-$2");
//    // }
//    $(this).val(v);
//
// });

// $("#username").keyup(function(){
//
//    setTimeout(100);
//    var v = $(this).val();
//    // alert(v);
//    if(v.length >= 1){
//       v =
//    }
//
//    $(this).val(v);
//
// });

function mask(o) {
   obj = o;
   setTimeout("cpfMask()", 1);
}

function cpfMask() {
   obj.value = cpf(obj.value);
}

function cpf(v) {
   v = v.replace(/\D/g, "");                    //Remove tudo o que não é dígito
   v = v.replace(/(\d{3})(\d)/, "$1.$2");       //Coloca um ponto entre o terceiro e o quarto dígitos
   v = v.replace(/(\d{3})(\d)/, "$1.$2");      //Coloca um ponto entre o terceiro e o quarto dígitos
   //de novo (para o segundo bloco de números)
   v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2"); //Coloca um hífen entre o terceiro e o quarto dígitos
   return v;
}
