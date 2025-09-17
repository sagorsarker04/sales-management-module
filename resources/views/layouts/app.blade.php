<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Management</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @stack('scripts')

    <script>
        // Attach handler for delete forms with class .js-delete-form
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('form.js-delete-form').forEach(function(form) {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    if (!confirm('Delete this item?')) return;

                    const action = form.getAttribute('action');
                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    fetch(action, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({})
                    }).then(res => {
                        if (res.ok) {
                            // on success reload the page
                            window.location.reload();
                        } else {
                            return res.json().then(data => { throw data; });
                        }
                    }).catch(err => {
                        alert('Delete failed.');
                        console.error(err);
                    });
                });
            });
        });
    </script>
</body>
</html>