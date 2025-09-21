console.log("JS cargado correctamente");

document.getElementById("btn-agregar").addEventListener("click", () => {
    const titulo = document.getElementById("nueva-tarea").value.trim();

    if (titulo !== "") {
        fetch("crear_tareas.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ titulo: titulo })
        })
        .then(response => response.json())
        .then(data => {
            if (data.exito) {
                listarTareas();
                document.getElementById("nueva-cita").value = "";
            } else {
                alert(data.mensaje);
            }
        });
    } else {
        alert("El titulo no puede estar vacio");
    }
});


function listarTareas() {
    fetch ("citas_r.php")
    .then (response => response.json())
    .then (tareas => {
        const contenedor = document.getElementById("lista-citas");
        contenedor.innerHTML = "";

        tareas.forEach(tarea => {
            const li = document.createElement("li");
            li.classList.add("cita-item");
        
            li.innerHTML = `<span class="tarea-texto">${tarea.titulo} - ${tarea.estado}</span>
            <div class="botones">
                <button class="btn btn-accion" onClick="cambiarEstado(${tarea.id}, '${tarea.estado}')">
                    ${tarea.estado === 'pendiente' ? 'Completar' : 'Reabrir'}
                </button>
                <button class="btn btn-accion btn-eliminar" onClick="eliminarTarea(${tarea.id})">Eliminar</button>
            </div>`;

            contenedor.appendChild(li);


        });
    });
}

function eliminarTarea(id) {
    fetch ("eliminar_tarea.php", {
        method: "POST",
        headers: {"Content-Type": "application/json"
        },
        body: JSON.stringify({id: id},)
    })
    .then (response => response.json())
    .then (data => {
        if (data.exito) {
            listarTareas();
        } else {
            alert(data.mensaje);
        }
    });
}

function cambiarEstado(id, estado) {
    fetch ("cambiar_estado.php", {
        method: "POST",
        headers: {"Content-Type": "application/json"
        },
        body: JSON.stringify({id: id, estado: estado},)
    })
    .then (response => response.json())
    .then (data => {
        if (data.exito) {
            listarTareas();
        } else {
            alert(data.mensaje);
        }
    });

    listarTareas();
}