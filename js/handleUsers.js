function deleteUser(correo){
    if(confirm(`¿Seguro que quieres borrar a ${correo} ?`)){
        $.ajax({
            type: "POST",
            url: '../php/DeleteUser.php',
            data: {email: correo },
            success: ()=>{window.location.reload()}
        });
    }
}


//Función para devolver un array con el verbo de la acción a printear y el estado al que se queira cambiar.
function printStatus(estado){
    let notStatus = [];

    if(estado == 'activo'){
        notStatus.push('banear');
        notStatus.push('baneado');
    } else{
        notStatus.push('activar');
        notStatus.push('activo')
    }
    return notStatus;
}


function changeStatus(correo, estado){
    let notStatus = printStatus(estado);
    let status = notStatus[1];
    if(confirm(`¿Seguro que quieres ${notStatus[0]} a ${correo}?`)){
        $.ajax({
            type: "POST",
            url: '../php/ChangeStatus.php',
            data: {state: status, email: correo },
            success: ()=>{window.location.reload()}
        });
    }
}