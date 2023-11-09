<h1>Welcome to <?php echo $_settings->info('name') ?></h1>
<hr>
<div class="container">
    <?php
    $files = array();
    $packages = $conn->query("SELECT * FROM `packages` order by rand() ");
    while ($row = $packages->fetch_assoc()) {
        if (!is_dir(base_app . 'uploads/package_' . $row['id']))
            continue;
        $fopen = scandir(base_app . 'uploads/package_' . $row['id']);
        foreach ($fopen as $fname) {
            if (in_array($fname, array('.', '..')))
                continue;
            $files[] = validate_image('uploads/package_' . $row['id'] . '/' . $fname);
        }
    }
    ?>