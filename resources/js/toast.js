import Swal from "sweetalert2";

export function showToast({ type = "success", message = "", title = "" } = {}) {
    if (!message && !title) return;

    Swal.fire({
        toast: true,
        position: "top-end",
        icon: type, // success | error | warning | info | question
        title: title || message,
        text: title ? message : undefined,
        showConfirmButton: false,
        timer: 2200,
        timerProgressBar: true,
        showCloseButton: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });
}

// Auto-run if backend flashed a toast
if (window.__toast) {
    showToast(window.__toast);
}
