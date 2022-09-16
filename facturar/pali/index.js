
let parameters = []


/*function limpiarRegistro(){
    let url = 'eliminar_data.php?r=1';

    $.ajax({
        url: url,
        method: 'POST'
    }).done(function(elemento){
        if(parseInt(elemento) == 1)
            divAlertaParticipantes.innerHTML = "<center><span style='color:red'>Registro de participantes eliminado con &eacute;xito </span></center>";
        
    })

    window.reload('index.php');

}*/


function cambioOpcionesCheck(){
    const propietario = document.getElementById("p").value;
    const divCheck = document.getElementById("divCheck");
    let url = 'crear_conjunto_check.php?v='+ propietario;
    let url_integro = 'crear_conjunto_integro.php?v='+ propietario;

    //console.log(url)
    //console.log(divCheck)

        $.ajax({
            url: url,
            method: 'POST'
        }).done(function(elemento){
            //console.log(elemento)
            divCheck.innerHTML = elemento;
            
        })

        $.ajax({
            url: url_integro,
            method: 'POST'
        }).done(function(elemento){
            //console.log(elemento)
            divCheck_integro.innerHTML = elemento;
            
        })
 
}



function removeElement(event, position) {
    event.target.parentElement.remove()
    delete parameters[position]
}

const addJsonElement = json => {
    parameters.push(json)
    return parameters.length - 1
}

function valores(f, cual) {
     todos = new Array();

     //console.log(f[cual][0].value);
     //console.log(f[cual][1].value);

     for (var i = 0, total = f[cual].length; i < total; i++)

       if (f[cual][i].checked) todos[todos.length] = f[cual][i].value;

      return todos;
}

function insertar_factura(no_factura,detalle,propietario,fecha_factura,gestor){

    const $divElements = document.getElementById("divAlertas");
    let url = 'insertar_factura.php?n='+ no_factura + '&d=' + detalle + '&p=' + propietario + '&f=' + fecha_factura + '&g=' + gestor;
        
    //console.log(url)

        $.ajax({
            url: url,
            method: 'GET'
        }).done(function(insertado){
     
            $divElements.innerHTML = "<b> FACTURA NO. "+ no_factura +" A NOMBRE DE "+propietario+" SE HA GUARDADO CON EXITO</b>";
            
            
        })

}

(function load(){
    const $form = document.getElementById("frmUsers")
    const $divElements = document.getElementById("divElements")
    const $btnSave = document.getElementById("btnSave")
    const $btnAdd = document.getElementById("btnAdd")


    //console.log($btnAdd);


    const templateElement = (data, position) => {
        return (`<button onclick="removeElement(event, ${position})"></button>
            <strong> Detalle  - </strong> ${data} <br><br>`)
    }

    if($btnAdd){
        $btnAdd.addEventListener("click", (event) => {

            resultado = valores($form, 'dividir[]');

            //console.log(resultado);

            deudor = resultado.join(",");
            cantidad_dividir = resultado.length + 1;

            //cuando no va nadie con el propietario no se divide el monto se paga integro quien debe
            if(deudor === ""){
                integro = valores($form, 'integro[]');
                deudor = integro.join(",");
                cantidad_integro = integro.length + 1;
            }


            //calculando a ver si tiene descuento
            descuento = $form.descuento.value;
            if(descuento == 1){
                //calculo 10 % del costo del producto
                let x = parseInt($form.precio.value) * 10 / 100;
                //console.log(x);
                //resto al valor del producto el 10 %
                let xd = parseInt($form.precio.value) - x;
                //console.log(xd);
                //divido el descuento entre cantidad de participantes en el producto
                monto = xd/(parseInt(cantidad_dividir))
                //console.log(monto);
            }else{
                monto = ((parseInt($form.precio.value))/(parseInt(cantidad_dividir)))
                //console.log(monto);
            }


            

            
            if($form.producto.value != "" && $form.precio.value != ""){
                let index = addJsonElement({
                    producto: $form.producto.value,
                    precio: $form.precio.value,
                    monto : monto,
                    deudor : deudor
                })
                const $div = document.createElement("div")
                $div.classList.add("notification", "is-link", "is-light", "py-2", "my-1")
                $div.innerHTML = templateElement(`Producto: ${$form.producto.value}, Precio: ${$form.precio.value}, Monto a pagar: ${monto}, Deudor(es): ${deudor}`, index)

                $divElements.insertBefore($div, $divElements.firstChild)

                $form.reset()
            }else{

               //alert("Complete los campos")
            }
        })
    }


    if($btnSave){
        $btnSave.addEventListener("click", (event) =>{

            parameters = parameters.filter(el => el != null)
            const $jsonDiv     = document.getElementById("jsonDiv")
            let no_factura     = document.getElementById("n").value
            let detalle        = JSON.stringify(parameters)
            let propietario    = document.getElementById("p").value
            let fecha_factura  = document.getElementById("f").value
            let gestor         = document.getElementById("gestor").value

            console.log(gestor);

            if(gestor != "" && no_factura != "" && detalle !="" && propietario != "" && fecha_factura != ""){

                insertar_factura(no_factura,detalle,propietario,fecha_factura,gestor);

                $jsonDiv.innerHTML = `JSON: ${JSON.stringify(parameters)}`
                $divElements.innerHTML = ""
                parameters = []
                document.getElementById("n").value = ""
                document.getElementById("p").value = ""
                document.getElementById("f").value = ""

            }else{
                alert("Complete los campos")
            }


        })
    }

    if($btnDelete){
        $btnSave.addEventListener("click", (event) =>{

            parameters = parameters.filter(el => el != null)
            const $jsonDiv     = document.getElementById("jsonDiv")
            let no_factura     = document.getElementById("n").value
            let detalle        = JSON.stringify(parameters)
            let propietario    = document.getElementById("p").value
            let fecha_factura  = document.getElementById("f").value
            let gestor         = document.getElementById("gestor").value

            console.log(gestor);

            if(gestor != "" && no_factura != "" && detalle !="" && propietario != "" && fecha_factura != ""){

                insertar_factura(no_factura,detalle,propietario,fecha_factura,gestor);

                $jsonDiv.innerHTML = `JSON: ${JSON.stringify(parameters)}`
                $divElements.innerHTML = ""
                parameters = []
                document.getElementById("n").value = ""
                document.getElementById("p").value = ""
                document.getElementById("f").value = ""

            }else{
                alert("Complete los campos")
            }


        })
    }
    
})()