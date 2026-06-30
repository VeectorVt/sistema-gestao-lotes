<?php

require_once '../config/Database.php';
require_once '../config/Headers.php';
configurarHeadersApi("POST");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["mensagem" => "Método não permitido."]);
    exit;
}

require_once '../models/Lote.php';

$database = new Database();
$db = $database->getConnection();
$loteModel = new Lote($db);

$data = json_decode(file_get_contents("php://input"));

if (!$data) {
    http_response_code(400);
    echo json_encode(["mensagem" => "Corpo da requisicao invalido ou ausente."]);
    exit;
}

$status_validos = ['Disponível', 'Reservado', 'Vendido', 'Indisponível'];

$quadra = isset($data->quadra) ? trim($data->quadra) : '';
$lote = isset($data->lote) ? trim($data->lote) : '';
$lote_num = $data->lote_num ?? null;
$status_lote = $data->status_lote ?? 'Disponível';
// Validações dos campos obrigatórios e tipos de dados
if ($quadra === '' || $lote === '' || $lote_num === null || $lote_num === '') {
    http_response_code(400);
    echo json_encode(["mensagem" => "Quadra, lote e lote_num sao obrigatorios."]);
    exit;
}

if (!is_numeric($lote_num)) {
    http_response_code(400);
    echo json_encode(["mensagem" => "lote_num precisa ser numerico."]);
    exit;
}

if (!in_array($status_lote, $status_validos)) {
    http_response_code(400);
    echo json_encode(["mensagem" => "status_lote invalido. Valores aceitos: " . implode(', ', $status_validos)]);
    exit;
}

if (strlen($quadra) > 50 || strlen($lote) > 50) {
    http_response_code(400);
    echo json_encode(["mensagem" => "quadra e lote devem ter no maximo 50 caracteres."]);
    exit;
}

$campos_numericos = ['area_total', 'area_fr', 'area_fu', 'area_ld', 'area_le', 'vr_metro_quadrado', 'vr_lote'];
foreach ($campos_numericos as $campo) {
    if (isset($data->$campo) && $data->$campo !== '' && !is_numeric($data->$campo)) {
        http_response_code(400);
        echo json_encode(["mensagem" => "$campo precisa ser numerico."]);
        exit;
    }
}

$dadosLote = [
    'quadra' => $quadra, 
    'lote' => $lote, 
    'lote_num' => $lote_num,
    'area_total' => $data->area_total ?? null, 
    'frente' => $data->frente ?? null,
    'area_fr' => $data->area_fr ?? null, 
    'fundo' => $data->fundo ?? null,
    'area_fu' => $data->area_fu ?? null, 
    'direito' => $data->direito ?? null,
    'area_ld' => $data->area_ld ?? null, 
    'esquerdo' => $data->esquerdo ?? null,
    'area_le' => $data->area_le ?? null, 
    'medidas' => $data->medidas ?? null,
    'vr_metro_quadrado' => $data->vr_metro_quadrado ?? null, 
    'vr_lote' => $data->vr_lote ?? null,
    'codigo_situacao' => $data->codigo_situacao ?? null, 
    'iptu' => $data->iptu ?? null,
    'iptu_desdobramento' => $data->iptu_desdobramento ?? null,
    'inscricao_municipal' => $data->inscricao_municipal ?? null, 
    'status_lote' => $status_lote
];

try {
    $novoId = $loteModel->criar($dadosLote);
    http_response_code(201);
    echo json_encode(["mensagem" => "Lote criado com sucesso.", "id" => $novoId]);
} catch (Exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo json_encode(["mensagem" => "Erro interno no servidor."]);
}
?>