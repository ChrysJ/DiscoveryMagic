<nav class="filter-nav">
    <!-- Select -->
    <ul>
        <li><span class="btn-filter allParks active">Tous les parcs</span></li>
        <li><span class="btn-filter notValidated">A validé</span></li>
    </ul>
</nav>

<main>
    <?php
    if (SessionFlash::exist()) {
        echo '<p class="message">' . SessionFlash::get() . '</p>';
    }
    ?>
    <table>
        <thead>
            <tr class="first-row">
                <th>Id</th>
                <th>Nom</th>
                <th>Theme</th>
            </tr>
        </thead>
        <tbody class="tableBody">

        </tbody>
    </table>
</main>