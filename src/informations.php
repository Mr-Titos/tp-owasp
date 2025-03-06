<?php
require_once('functions.php');
session_start();
$user = null;
if (isset($_SESSION['user']) && isset($_GET['id'])) {
    $loggedInUserId = $_SESSION['user']->id;
    $requestedUserId = $_GET['id'];

    if ($loggedInUserId === $requestedUserId) {
        $users = getUser($requestedUserId);
        if (!empty($users)) {
            $user = $users[0];
        }
    } else {
        echo "You are not authorized to view this information.";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}
?>

<?php if($user): ?>
<h1>Information de l'utilisateur <?= $user->email ?></h1>
<table>
    <tr>
        <td>username</td>
        <td><?= $user->username ?></td>
    </tr>
    <tr>
        <td>email</td>
        <td><?= $user->email ?></td>
    </tr>
</table>
<?php else: ?>
    L'utilisateur recherché n'existe pas
<?php endif; ?>
<br/>
<br/>
<a href="index.php">Accueil</a>
