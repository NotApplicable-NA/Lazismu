<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session Expired</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <script>
        Swal.fire({
            title: 'Session Expired',
            text: "Your session has expired. Would you like to log in again or log out?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Log In Again',
            cancelButtonText: 'Log Out',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('admin.login') }}"; // Login ulang untuk admin
            } else {
                window.location.href = "{{ route('admin.logout') }}"; // Logout
            }

        });
    </script>
</body>
</html>
