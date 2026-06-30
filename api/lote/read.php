<?php
require_once '../config/Database.php';
require_once '../config/Headers.php';
configurarHeadersApi("GET");

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(["mensagem" => "Método não permitido."]);
    exit;
}
require_once '../models/Lote.php';

$database = new Database();
$db = $database->getConnection();
$loteModel = new Lote($db);

try {
    if (isset($_GET['id'])) {
        $loteEncontrado = $loteModel->buscarPorId($_GET['id']);
        if ($loteEncontrado) {
            http_response_code(200);
            echo json_encode($loteEncontrado);
        } else {
            http_response_code(404);
            echo json_encode(["mensagem" => "Lote nao encontrado."]);
        }
        exit;
    }

    $todosLotes = $loteModel->listarTodos();
    http_response_code(200);
    echo json_encode($todosLotes);

} catch (Exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo json_encode(["mensagem" => "Erro ao procurar os lotes."]);
}
?>