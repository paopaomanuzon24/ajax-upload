<!DOCTYPE html>
<html>

<head>
    <title>AJAX Image Upload</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

    <form id="uploadForm" enctype="multipart/form-data">
        <input type="file" name="image" id="image" accept="image/*"><br><br>
        <button type="submit">Upload</button>
    </form>

    <div id="preview">

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $('#uploadForm').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('image.upload') }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            $('#preview').html('<img src="' + response.image_url +
                                '" width="300"/>');
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        alert("Upload failed.");
                    }
                });
            });
        });
    </script>

</body>

</html>
