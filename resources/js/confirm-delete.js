import Swal from "sweetalert2";

// Global delete confirmation for any form that has data-confirm-delete attribute
document.addEventListener(
    "submit",
    function (e) {
        const form = e.target;

        if (!form.matches("form[data-confirm-delete]")) return;

        e.preventDefault();

        const title =
            form.getAttribute("data-confirm-title") || "Confirm Delete";
        const text =
            form.getAttribute("data-confirm-delete") ||
            "Are you sure you want to delete this item?";
        const confirmText =
            form.getAttribute("data-confirm-button") || "Yes, delete";
        const cancelText = form.getAttribute("data-cancel-button") || "Cancel";

        Swal.fire({
            title,
            text,
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: confirmText,
            cancelButtonText: cancelText,
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    },
    true
);
