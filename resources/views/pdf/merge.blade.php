<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gộp PDF</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 40px 15px;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI",
            Roboto, Arial, sans-serif;
            background: #f4f6f9;
            color: #212529;
        }

        .container {
            max-width: 600px;
            margin: 30px auto;
        }

        .card {
            background: #fff;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .card-header {
            padding: 22px 25px;
            background: #0d6efd;
            color: #fff;
        }

        .card-header h2 {
            margin: 0;
            font-size: 23px;
            font-weight: 600;
        }

        .card-body {
            padding: 25px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 15px;
            font-weight: 600;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: 10px 12px;
            font-size: 15px;
            line-height: 1.5;
            color: #212529;
            background: #fff;
            border: 1px solid #ced4da;
            border-radius: 6px;
            transition: border-color .15s, box-shadow .15s;
        }

        .form-control:focus {
            outline: none;
            border-color: #86b7fe;
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.2);
        }

        input[type="file"] {
            padding: 7px;
        }

        input[type="file"]::file-selector-button {
            margin-right: 12px;
            padding: 7px 12px;
            border: 0;
            border-radius: 4px;
            background: #e9ecef;
            color: #212529;
            cursor: pointer;
        }

        .alert {
            padding: 14px 16px;
            margin-bottom: 22px;
            border: 1px solid transparent;
            border-radius: 6px;
            font-size: 14px;
        }

        .alert-danger {
            color: #842029;
            background: #f8d7da;
            border-color: #f5c2c7;
        }

        .alert p {
            margin: 4px 0;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 12px 18px;
            border: 1px solid #0d6efd;
            border-radius: 6px;
            background: #0d6efd;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background .15s, border-color .15s;
        }

        .btn:hover {
            background: #0b5ed7;
            border-color: #0a58ca;
        }

        .btn:active {
            background: #0a58ca;
        }

        .description {
            margin: 8px 0 0;
            color: #6c757d;
            font-size: 13px;
        }

        @media (max-width: 576px) {
            body {
                padding: 15px;
            }

            .container {
                margin: 15px auto;
            }

            .card-header,
            .card-body {
                padding: 20px;
            }

            .card-header h2 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Gộp 2 file PDF</h2>
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('pdf.merge.process') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="pdf1">File PDF thứ nhất</label>
                    <input
                        type="file"
                        id="pdf1"
                        name="pdf1"
                        class="form-control"
                        accept=".pdf,application/pdf"
                        required
                    >
                    <p class="description">Chọn file PDF đầu tiên.</p>
                </div>

                <div class="form-group">
                    <label for="pdf2">File PDF thứ hai</label>
                    <input
                        type="file"
                        id="pdf2"
                        name="pdf2"
                        class="form-control"
                        accept=".pdf,application/pdf"
                        required
                    >
                    <p class="description">Nội dung file này sẽ được nối sau file thứ nhất.</p>
                </div>

                <div class="form-group">
                    <label for="file_name">Tên file sau khi gộp</label>
                    <input
                        type="text"
                        id="file_name"
                        name="file_name"
                        class="form-control"
                        placeholder="Ví dụ: NguyenVanA"
                    >
                    <p class="description">
                        Có thể để trống nếu muốn sử dụng tên mặc định.
                    </p>
                </div>

                <button type="submit" class="btn">
                    Gộp và tải PDF
                </button>
            </form>

        </div>
    </div>
</div>

</body>
</html>
