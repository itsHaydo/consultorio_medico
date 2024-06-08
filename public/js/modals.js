async function showCustomSwal() {
    const { value: formValues } = await Swal.fire({
        title: "Agregar tratamiento",
        html:
            '<label for="swal-input1">Tratamiento</label> <br>' +
            '<textarea id="swal-input1" class="swal2-textarea" placeholder="Ingrese el tratamiento..."></textarea> <br>' +
            '<label for="swal-input2">Fecha inicio</label>' +
            '<input id="swal-input2" type="date" class="swal2-input"> <br>' +
            '<label for="swal-input3">Fecha fecha</label>' +
            '<input id="swal-input3" type="date" class="swal2-input"> ',
        focusConfirm: false,
        confirmButtonText: "Guardar",
        denyButtonText: `Cancelar`,
        showCancelButton: true,
        preConfirm: () => {
            const message = document.getElementById("swal-input1").value;
            const inicio = document.getElementById("swal-input2").value;
            const fin = document.getElementById("swal-input3").value;
            return { message, inicio, fin };
        },
        didOpen: () => {
            const today = new Date().toISOString().split("T")[0];
            const dateInicio = Swal.getPopup().querySelector("#swal-input2");
            const dateFin = Swal.getPopup().querySelector("#swal-input3");
            dateInicio.min = today;
            dateFin.min = today;
        },
    });

    if (formValues) {
        const { message, inicio, fin } = formValues;
        if (message && inicio && fin) {
            Swal.fire(
                `Tratamiento: ${message}`,
                `Fecha incio: ${inicio}`,
                `Fecha fin: ${fin}`
            );
        } else {
            Swal.fire("Porfavor rellene los campos.").then((result) => {
                if (result.isConfirmed) {
                    showCustomSwal();
                }
            });
        }
    }
}

if (document.getElementById("btn-tratamiento")) {
    document
        .getElementById("btn-tratamiento")
        .addEventListener("click", showCustomSwal);
}