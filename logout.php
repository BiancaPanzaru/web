<?php
session_start(); // Începeți sesiunea sau continuați sesiunea existentă

// Distrugerea sesiunii
session_unset(); // Șterge toate variabilele din sesiune
session_destroy(); // Distrugere sesiune

// Redirecționare către pagina de autentificare sau altă pagină relevantă
header("Location: loginpage.php");
exit();
?>
