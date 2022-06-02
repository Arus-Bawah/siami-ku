/**
 * Initialize
 */
window.onbeforeunload = function (event) {
    $('.modal').modal('hide');
    showLoading();
};
window.onpageshow = function (e) {
    console.log('loaded document ' + (Math.random()));

    setTimeout(() => {
        hideLoading();
    }, 1);
}

const notification = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

/**
 * Helpers
 */
function info(message) {
    notification.fire({
        icon: 'info',
        title: message
    });
}

function success(message) {
    notification.fire({
        icon: 'success',
        title: message
    });
}

function warning(message) {
    notification.fire({
        icon: 'warning',
        title: message
    });
}

function danger(message) {
    notification.fire({
        icon: 'error',
        title: message
    });
}

function logout() {
    Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success ml-2',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    }).fire({
        title: 'Apakah anda yakin?',
        text: "Anda akan keluar dari halaman panel.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Logout',
        cancelButtonText: 'Tidak',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            showLoading();
            axios({
                method: "GET",
                url: "/auth/logout",
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                data: {}
            }).then((response) => {
                if (response.data.status) { // direct to dashboard
                    console.log(response.data.message);
                    window.location.href = "/auth/login";
                } else { // alert failed
                    hideLoading();
                    warning(response.data.message);
                }
            }).catch((error) => {
                hideLoading();
                if (typeof error.response.data.status === "undefined") {
                    danger("Terjadi kesalahan, silakan coba beberapa saat lagi.");
                } else {
                    warning(error.response.data.message);
                }
                console.log(error); // show error logs
            });
        }
    })
}

function hideLoading() {
    let loading = document.getElementById("loading");
    loading.style.opacity = "0";
    setTimeout(() => {
        loading.style.height = "0";
    }, 1000);
}

function showLoading() {
    let loading = document.getElementById("loading");
    loading.style.height = "100vh";
    loading.style.opacity = "1";
}
