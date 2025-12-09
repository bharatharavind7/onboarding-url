<!DOCTYPE html>
<html>
<head>
    <title>WSP URL Onboarding System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">

<h2>WSP - URL Onboarding Module</h2>
<p>Add a new agency and URL to auto-generate Prometheus Blackbox monitoring.</p>

<form action="save.php" method="POST">
    <input type="text" name="agency" placeholder="Agency Name (example: pepsico)" required><br>
    <input type="text" name="url" placeholder="Website URL (https://example.com)" required><br>
    <button type="submit">Add URL</button>
</form>

<hr>

<h3>Current Onboarded URLs</h3>

<table>
    <tr>
        <th>Agency</th>
        <th>URL</th>
    </tr>

<?php
$data = json_decode(file_get_contents("../wsp-agencies.json"), true);

foreach ($data as $entry) {
    $agency = $entry["labels"]["agency"];
    foreach ($entry["targets"] as $url) {
        echo "<tr>
                <td>$agency</td>
                <td class='url-box'>$url</td>
              </tr>";
    }
}
?>

</table>

<p style="margin-top:20px;">
JSON Feed for Prometheus:  
<a href="/wsp-agencies.json" target="_blank">https://bharath.com/wsp-agencies.json</a>
</p>

</div>

</body>
</html>
