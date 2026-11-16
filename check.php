
<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.html");
    exit();
}

$name = trim($_POST["name"] ?? "");
$age = filter_input(
    INPUT_POST,
    "age",
    FILTER_VALIDATE_INT
);

$name = htmlspecialchars(
    $name,
    ENT_QUOTES,
    "UTF-8"
);

if ($name === "" || $age === false ||
    $age === null || $age < 0) {
    $message = "Please enter valid details.";
    $authorized = false;
    $invalid = true;
} else {
    $invalid = false;
    $authorized = ($age >= 18);

    if ($authorized) {
        $message = "Welcome to this site";
    } else {
        $message = "Hello, $name, you are not authorized to visit the site";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>Verification Result</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <?php if ($invalid): ?>
        <div class="icon">⚠️</div>
        <h1>Invalid Details</h1>
    <?php elseif ($authorized): ?>
        <div class="icon">✅</div>
        <h1>Access Granted</h1>
    <?php else: ?>
        <div class="icon">🔒</div>
        <h1>Access Denied</h1>
    <?php endif; ?>

    <p class="result">
        <?php echo $message; ?>
    </p>

    <a href="index.html" class="btn">
        Go Back
    </a>

</div>

</body>
</html>
