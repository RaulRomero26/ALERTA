console.log('entro');
nombre = document.getElementById('Nombre');
appaterno = document.getElementById('ApPaterno');
apmaterno = document.getElementById('ApMaterno');
alias = document.getElementById('Alias');
banda = document.getElementById('Banda');
observaciones = document.getElementById('observaciones');

placa = document.getElementById('Placa');
niv = document.getElementById('Niv');
banda_vehiculo = document.getElementById('Banda_Vehiculo');
observaciones_vehiculo = document.getElementById('observaciones_vehiculo')


const getCoincidencias =  async () => {
    var myform = new FormData()
    myform.append("Nombre", nombre.value.toUpperCase() )
    myform.append("ApPaterno", appaterno.value.toUpperCase())
    myform.append("ApMaterno", apmaterno.value.toUpperCase())
    //myform.append("Alias", alias.value.toUpperCase())
    myform.append("Banda", banda.value.toUpperCase())
    try {
        const response = await fetch( './model/coincidencias.php', {
            method: 'POST',
            mode: 'cors' ,
            body: myform
        });
        const data = await response.json();
        console.log(data);
        observaciones.style.display = 'block';
        observaciones.innerHTML = '';
        data.forEach(element => {
            if(element.Personas){
                observaciones.innerHTML += ` <strong>Persona Encontrada</strong>
                                        <hr>
                                        Nombre: ${element.Personas.Nombre} ${element.Personas.ApellidoPaterno} ${element.Personas.ApellidoMaterno}<br />
                                        Alias: ${element.Personas.Alias}<br />
                                        Banda: ${element.Personas.Banda}<br />
                                        Delitos Asociados: ${element.Personas.Delitos_Asociados}<br />
                                        Folio: ${element.Personas.Folio}<br />`;

                                        if(element.Personas.Banda!='S/D' && element.Vehiculos_Encontrados){
                                            element.Vehiculos_Encontrados.forEach(vehiculo => {
                                                observaciones.innerHTML += `<br /><strong>Vehiculo Asociado</strong><br /><hr>
                                                Vehiculo: ${vehiculo.Vehiculo}<br />
                                                Placa: ${vehiculo.Placa}<br />
                                                Niv: ${vehiculo.Niv}<br />
                                                Delitos Asociados: ${vehiculo.Delito}<br />
                                                Banda: ${vehiculo.Banda}<br />
                                                Observaciones: ${vehiculo.observaciones}<br /> `;
                                            })
                                        }

            }else {
                observaciones.innerHTML += ` <strong>Banda Encontrada</strong></br>
                <hr>`;
                console.log(element);
                element.Banda.forEach(integrante => {
                    console.log(integrante);
                    observaciones.innerHTML += `<strong>Persona Integrante</strong></br>
                                                <hr>
                                                Nombre: ${integrante.Nombre} ${integrante.ApellidoPaterno} ${integrante.ApellidoMaterno}<br />
                                                Alias: ${integrante.Alias}<br />
                                                Banda: ${integrante.Banda}<br />
                                                Delitos Asociados: ${integrante.Delitos_Asociados}<br />
                                                Folio: ${integrante.Folio}<br /><br />`;
                })
               
            }
        });

        return data;
    } catch (error) {
        console.log(error);
    }
}

const getCoincidenciasVeh =  async () => {
    var myform = new FormData()
    myform.append("Niv", niv.value )
    myform.append("Placa", placa.value)
    myform.append("Banda", banda_vehiculo.value)
    try {
        const response = await fetch( './model/coincidenciasvh.php', {
            method: 'POST',
            mode: 'cors' ,
            body: myform
        });
        const data = await response.json();
        console.log(data);
        observaciones_vehiculo.style.display = 'block';
        observaciones_vehiculo.innerHTML = '';
        data.forEach(element => {
            if(element.Vehiculo){
                observaciones_vehiculo.innerHTML += `<strong>Vehiculo Encontrado</strong>
                                                <hr>
                                                Vehiculo: ${element.Vehiculo.Vehiculo}<br />
                                                Placa: ${element.Vehiculo.Placa}<br />
                                                Niv: ${element.Vehiculo.Niv}<br />
                                                Delitos Asociados: ${element.Vehiculo.Delito}<br />
                                                Banda: ${element.Vehiculo.Banda}<br />
                                                Observaciones: ${element.Vehiculo.observaciones}<br /> `;

                                                if(element.Vehiculo.Banda!='S/D' &&  element.Personas_Encontradas){
                                                    element.Personas_Encontradas.forEach(persona => {
                                                        observaciones_vehiculo.innerHTML += `<br/><strong>Persona Asociada</strong><br /><hr>
                                                        Nombre: ${persona.Nombre} ${persona.ApellidoPaterno} ${persona.ApellidoMaterno}<br />
                                                        Alias: ${persona.Alias}<br />
                                                        Banda: ${persona.Banda}<br />
                                                        Delitos Asociados: ${persona.Delitos_Asociados}<br />
                                                        Folio: ${persona.Folio}<br />`;
                                                    })
                                                }
                                                
            }else{
                observaciones_vehiculo.innerHTML += `<strong>Banda Encontrada</strong> <br>`;
                element.Banda.forEach(auto => {
                    observaciones_vehiculo.innerHTML += `  <strong>Vehiculo Integrante</strong>
                                                            <hr>
                                                            Vehiculo: ${auto.Vehiculo}<br />
                                                            Placa: ${auto.Placa}<br />
                                                            Niv: ${auto.Niv}<br />
                                                            Delitos Asociados: ${auto.Delito}<br />
                                                            Banda: ${auto.Banda}<br />
                                                            Observaciones: ${auto.observaciones}<br /><br /> `;
                })
               
            }
            
        
        });
        return data;
    } catch (error) {
        console.log(error);
    }
}


