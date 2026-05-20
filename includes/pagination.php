<?php

function pagination($total_data, $limit, $current_page)
{
    $total_page = ceil($total_data / $limit);

    echo '<nav>';
    echo '<ul class="pagination">';

    for($i = 1; $i <= $total_page; $i++)
    {
        $active = ($i == $current_page) ? 'active' : '';

        echo "<li class='page-item $active'>
                <a class='page-link' href='?page=$i'>$i</a>
              </li>";
    }

    echo '</ul>';
    echo '</nav>';
}