<!-- resources/views/frontend/show.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <title>Form Data</title> --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Include your CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

        .table-container {
            margin: 20px 50px;
            padding: 0 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border: 2px solid black;
            box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.4);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #374371;
            color: #fff;
        }
        img {
            max-width: 150px;
            height: auto;
        }
        .pagination {
            justify-content: center;
            margin-top: 20px;
        }
        .table-container h2 {
            background: linear-gradient(#a82f2f, #2b2020);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        @media (max-width: 1200px) {
            .table-container {
                margin: 50px 10px;
            }
        }
        @media (max-width: 850px) {
            .table-container {
                min-width: 850px;
                margin: 50px 0px;
            }
        }
    </style>
</head>
<body>
    <div class="container table-container">
        {{-- <h1>Form Data</h1> --}}

        <table id="dataTable">
            <thead>
                <tr>
                    <th>S.N.</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>Social Media</th>
                    <th>Content Types</th>
                    <th>Thumbnail Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($formData as $index => $form)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $form->first_name }}</td>
                        <td>{{ $form->last_name }}</td>
                        <td>{{ $form->email }}</td>
                        <td>{{ $form->contact_number }}</td>
                        <td>
                            @foreach(json_decode($form->social_media, true) as $platform => $handle)
                                <div><strong>{{ ucfirst($platform) }}:</strong> {{ $handle }}</div>
                            @endforeach
                        </td>
                        <td>
                            @foreach(explode(',', $form->content_types) as $type)
                                <div>{{ $type }}</div>
                            @endforeach
                        </td>
                        <td>
                            @if($form->thumbnail_img)
                                <img src="{{ $form->thumbnail_img }}" alt="Thumbnail Image">
                            @else
                                No image uploaded
                            @endif
                        </td>
                        <td>
                            <form action="" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination">
            <button id="prevBtn" class="btn btn-primary" style="display: none">Previous</button>
            <button id="nextBtn" class="btn btn-primary">Next</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const rowsPerPage = 10;
            let currentPage = 1;
            const table = document.getElementById("dataTable");
            const prevBtn = document.getElementById("prevBtn");
            const nextBtn = document.getElementById("nextBtn");
            const rows = table.querySelectorAll("tbody tr");

            function showPage(page) {
                const start = (page - 1) * rowsPerPage;
                const end = start + rowsPerPage;

                rows.forEach((row, index) => {
                    if (index >= start && index < end) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                });

                prevBtn.style.display = currentPage === 1 ? "none" : "inline-block";
                nextBtn.style.display = end >= rows.length ? "none" : "inline-block";
            }

            prevBtn.addEventListener("click", function () {
                if (currentPage > 1) {
                    currentPage--;
                    showPage(currentPage);
                }
            });

            nextBtn.addEventListener("click", function () {
                if (currentPage * rowsPerPage < rows.length) {
                    currentPage++;
                    showPage(currentPage);
                }
            });

            showPage(currentPage);
        });
    </script>
</body>
</html>
