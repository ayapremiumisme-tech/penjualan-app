<?php

include '../includes/header.php';
?>

<div class="container mt-4">

    <div class="card">

        <div class="card-body">

            <h3>Settings</h3>

            <button class="btn btn-dark"
                onclick="toggleDarkMode()">

                Toggle Dark Mode

            </button>

        </div>

    </div>

</div>

<script>

function toggleDarkMode()
{
    document.body.classList.toggle('dark-mode');
}

</script>

<?php include '../includes/footer.php'; ?>