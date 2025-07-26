<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Experts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Available Experts</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Expert ID</th>
                    <th>Name</th>
                    <th>Specialization</th>
                    <th>Contact Info</th>
                </tr>
            </thead>
            <tbody id="customerExpertTableBody">
                <!-- Data will be inserted here using JavaScript -->
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        fetch("get_experts.php") 
            .then(response => response.json())
            .then(data => {
                let tableBody = document.getElementById("customerExpertTableBody");
                tableBody.innerHTML = ""; 

                if (data.length > 0) {
                    data.forEach(expert => {
                        let row = `<tr>
                                    <td>${expert.expert_id}</td>
                                    <td>${expert.name}</td>
                                    <td>${expert.specialization}</td>
                                    <td>${expert.contact_info}</td>
                                  </tr>`;
                        tableBody.innerHTML += row;
                    });
                } else {
                    tableBody.innerHTML = `<tr><td colspan="4" class="text-center">No experts found</td></tr>`;
                }
            })
            .catch(error => console.error("Error fetching experts:", error));
    });
</script>

</body>
</html>
