<?php

require_once '../config/Database.php';
require_once '../config/Headers.php';
configurarHeadersApi("DELETE");

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    http_response_code(405);
    echo json_encode(["mensagem" => "Método não permitido."]);
    exit;
}
require_once '../models/Lote.php';

$database = new Database();
$db = $database->getConnection();
$loteModel = new Lote($db);

$data = json_decode(file_get_contents("php://input"));
$id = $data->id ?? ($_GET['id'] ?? null);

if (empty($id)) {
    http_response_code(400);
    echo json_encode(["mensagem" => "ID do lote eh obrigatorio para deletar."]);
    exit;
}

try {
    $linhasAfetadas = $loteModel->deletar($id);
    
    if ($linhasAfetadas > 0) {
        http_response_code(200);
        echo json_encode(["mensagem" => "Lote removido com sucesso."]);
    } else {
        http_response_code(404);
        echo json_encode(["mensagem" => "Lote nao encontrado."]);
    }
} catch (Exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo json_encode(["mensagem" => "Erro interno no servidor."]);
}
?>