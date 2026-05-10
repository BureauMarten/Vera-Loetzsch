<?php
declare(strict_types=1);

// ─── Konfiguration ────────────────────────────────────────────────────────────
const EMPFAENGER   = 'kontakt@vera-loetzsch.de';
const ABSENDER_NAME = 'Kontaktformular vera-loetzsch.de';
const ERLAUBTE_ORIGIN = 'https://vera-loetzsch.de';

// ─── Hilfsfunktionen ─────────────────────────────────────────────────────────
function sanitize(string $value): string {
    return htmlspecialchars(strip_tags(trim($value)), ENT_QUOTES, 'UTF-8');
}

function isValidEmail(string $email): bool {
    return (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
}

function jsonResponse(bool $success, string $message): never {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['success' => $success, 'message' => $message]);
    exit;
}

// ─── CORS / Methoden-Check ────────────────────────────────────────────────────
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
if ($origin === ERLAUBTE_ORIGIN) {
    header('Access-Control-Allow-Origin: ' . ERLAUBTE_ORIGIN);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(false, 'Ungültige Anfrage.');
}

// ─── Felder auslesen & validieren ────────────────────────────────────────────
$name      = sanitize($_POST['name']      ?? '');
$email     = sanitize($_POST['email']     ?? '');
$betreff   = sanitize($_POST['betreff']   ?? '');
$nachricht = sanitize($_POST['nachricht'] ?? '');
$datenschutz = isset($_POST['datenschutz']) ? true : false;

if (!$name || !$email || !$betreff || !$nachricht) {
    jsonResponse(false, 'Bitte alle Pflichtfelder ausfüllen.');
}

if (!isValidEmail($email)) {
    jsonResponse(false, 'Bitte eine gültige E-Mail-Adresse angeben.');
}

if (!$datenschutz) {
    jsonResponse(false, 'Bitte der Datenschutzerklärung zustimmen.');
}

// Einfacher Honeypot-Schutz: Falls ein verstecktes Feld gefüllt ist → Spam
if (!empty($_POST['website'])) {
    jsonResponse(true, 'Vielen Dank für Ihre Nachricht.');
}

// ─── E-Mail zusammenbauen ────────────────────────────────────────────────────
$subject = 'Kontaktanfrage: ' . $betreff;

$body  = "Neue Kontaktanfrage über vera-loetzsch.de\n";
$body .= str_repeat('─', 40) . "\n\n";
$body .= "Name:    {$name}\n";
$body .= "E-Mail:  {$email}\n";
$body .= "Betreff: {$betreff}\n\n";
$body .= "Nachricht:\n{$nachricht}\n";

$headers  = "From: " . ABSENDER_NAME . " <noreply@vera-loetzsch.de>\r\n";
$headers .= "Reply-To: {$name} <{$email}>\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";

// ─── Senden ──────────────────────────────────────────────────────────────────
$sent = mail(EMPFAENGER, $subject, $body, $headers);

if ($sent) {
    jsonResponse(true, 'Vielen Dank! Ihre Nachricht wurde erfolgreich gesendet.');
} else {
    jsonResponse(false, 'Leider konnte Ihre Nachricht nicht gesendet werden. Bitte versuchen Sie es später erneut oder schreiben Sie direkt an kontakt@vera-loetzsch.de.');
}
