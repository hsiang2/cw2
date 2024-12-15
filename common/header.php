<?php
    $disabled = ($_SESSION['admin']) ? "" : "disabled";
?>

<nav class="navbar navbar-expand-lg  sticky-top">
    <div class="container">
        <a class="navbar-brand custom-brand" href="/cw2/index.php">Police Traffic</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/cw2/people/people.php">PEOPLE</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/cw2/vehicle/vehicle.php">VEHICLE</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/cw2/incident/incident.php">INCIDENT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  <?php echo $disabled ?>" href="/cw2/officer/officer.php">OFFICER</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  <?php echo $disabled ?>" href="/cw2/audit/audit.php">AUDIT</a>
                </li>
                <li class="nav-item me-5"><a class="nav-link" href="/cw2/account/account.php">Logged in as <b><?php echo $_SESSION['user']?></b></a></li>
                <form method="POST" action="/cw2/logout.php">
                    <input class="btn btn-outline-danger" type="submit" name="logout" value="LOGOUT" />
                </form>
            </ul>
        </div>
    </div>
</nav>