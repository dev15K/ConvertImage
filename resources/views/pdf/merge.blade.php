
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gộp PDF</title>
</head>
<body>
<h2>Gộp 2 file PDF</h2>

@if ($errors->any())
    <div style="color: red">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form action="{{ route('pdf.merge.process') }}"
      method="POST"
      enctype="multipart/form-data">
    @csrf

    <div>
        <label>File PDF thứ nhất:</label>
        <input type="file" name="pdf1" accept=".pdf,application/pdf" required>
    </div>

    <br>

    <div>
        <label>File PDF thứ hai:</label>
        <input type="file" name="pdf2" accept=".pdf,application/pdf" required>
    </div>

    <br>

    <button type="submit">Gộp và tải PDF</button>
</form>
</body>
</html>
