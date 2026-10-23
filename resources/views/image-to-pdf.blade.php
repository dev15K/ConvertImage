<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image to PDF Converter</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f3f4f6;
            font-family: Arial, sans-serif;
        }

        .container {
            width: 100%;
            max-width: 480px;
            padding: 32px;
            margin: 20px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        }

        h2 {
            margin-top: 0;
            text-align: center;
            color: #111827;
        }

        .file-input {
            display: block;
            width: 100%;
            padding: 20px;
            margin: 24px 0 12px;
            border: 2px dashed #d1d5db;
            border-radius: 10px;
            background: #f9fafb;
        }

        .file-name {
            margin-bottom: 20px;
            color: #6b7280;
            overflow-wrap: anywhere;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 8px;
            background: #2563eb;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #1d4ed8;
        }

        button:disabled {
            background: #9ca3af;
            cursor: wait;
        }

        .error {
            margin-bottom: 16px;
            color: #dc2626;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Image to PDF Converter</h2>

    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form
        id="convertForm"
        action="{{ route('image-to-pdf.convert') }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf

        <input
            class="file-input"
            type="file"
            id="image"
            name="image"
            accept=".jpg,.jpeg,.png,image/jpeg,image/png"
            required
        >

        <div class="file-name" id="fileName">
            No file selected
        </div>

        <button type="submit" id="convertButton">
            Convert to PDF
        </button>
    </form>
</div>

<script>
    const imageInput = document.getElementById('image');
    const fileName = document.getElementById('fileName');
    const form = document.getElementById('convertForm');
    const button = document.getElementById('convertButton');

    imageInput.addEventListener('change', function () {
        fileName.textContent = this.files.length
            ? this.files[0].name
            : 'No file selected';
    });
</script>
</body>
</html>
