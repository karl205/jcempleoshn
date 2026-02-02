document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('guardarPerfilBtn');
    if (!btn) return;

    btn.addEventListener('click', () => {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: 'Perfil guardado correctamente',
            showConfirmButton: false,
            timer: 2000
        });
    });
});
