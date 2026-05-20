<?php

require_once '../../config/config.php';

include '../../includes/header.php';

?>

<div class="container mt-4">

    <div class="card">

        <div class="card-body">

            <h3>Appearance Settings</h3>

            <hr>

            <div class="mb-3">

                <label>
                    Mode Tampilan
                </label>

                <select id="themeSelect"
                    class="form-control">

                    <option value="light">
                        Light Mode
                    </option>

                    <option value="dark">
                        Dark Mode
                    </option>

                </select>

            </div>

            <button class="btn btn-dark"
                onclick="saveTheme()">

                Simpan Tampilan

            </button>

        </div>

    </div>

</div>

<script>

function saveTheme()
{
    let theme = document.getElementById('themeSelect').value;

    localStorage.setItem('theme', theme);

    if(theme === 'dark')
    {
        document.body.classList.add('dark-mode');
    }
    else
    {
        document.body.classList.remove('dark-mode');
    }

    Swal.fire({
        icon:'success',
        title:'Berhasil',
        text:'Theme berhasil disimpan'
    });
}

document.addEventListener("DOMContentLoaded", function(){

    let theme = localStorage.getItem('theme');

    if(theme === 'dark')
    {
        document.body.classList.add('dark-mode');

        document.getElementById('themeSelect').value = 'dark';
    }

});

</script>

<?php include '../../includes/footer.php'; ?>