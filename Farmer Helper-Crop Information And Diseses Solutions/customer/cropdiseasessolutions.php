<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crop Diseases List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 20px;
        }
        table {
            width: 80%;
            margin: auto;
            border-collapse: collapse;
            background: #fff;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h2>Crop Diseases List</h2>
    <table id="diseaseTable">
        <thead>
            <tr>
                <th>Disease ID</th>
                <th>Name</th>
                <th>Symptoms</th>
                <th>Solution ID</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data will be inserted dynamically -->
        </tbody>
    </table>

    <script>
        // Function to fetch data from PHP script
        function loadDiseases() {
            fetch('fetch_data.php')
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.querySelector("#diseaseTable tbody");
                    tableBody.innerHTML = ""; // Clear previous data
                    data.forEach(disease => {
                        const row = `<tr>
                            <td>${disease.id}</td>
                            <td>${disease.name}</td>
                            <td>${disease.symptoms}</td>
                            <td>${disease.solution_id}</td>
                        </tr>`;
                        tableBody.innerHTML += row;
                    });
                })
                .catch(error => console.error("Error fetching data:", error));
        }

        // Load diseases on page load
        window.onload = loadDiseases;
    </script>

</body>
</html>
