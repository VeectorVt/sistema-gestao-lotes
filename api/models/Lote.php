<?php
class Lote {
    private $conn;
    private $tabela = "lotes";

    public function __construct($db) {
        $this->conn = $db;
    }
    // Todas as consultas utilizam prepared statements para evitar SQL Injection
    public function listarTodos() {
        $query = "SELECT * FROM {$this->tabela} ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $query = "SELECT * FROM {$this->tabela} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function criar($dados) {
        $query = "INSERT INTO {$this->tabela} 
                  (quadra, lote, lote_num, area_total, frente, area_fr, fundo, area_fu, direito, area_ld, esquerdo, area_le, medidas, vr_metro_quadrado, vr_lote, codigo_situacao, iptu, iptu_desdobramento, inscricao_municipal, status_lote) 
                  VALUES 
                  (:quadra, :lote, :lote_num, :area_total, :frente, :area_fr, :fundo, :area_fu, :direito, :area_ld, :esquerdo, :area_le, :medidas, :vr_metro_quadrado, :vr_lote, :codigo_situacao, :iptu, :iptu_desdobramento, :inscricao_municipal, :status_lote)";

        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":quadra", $dados['quadra']);
        $stmt->bindParam(":lote", $dados['lote']);
        $stmt->bindParam(":lote_num", $dados['lote_num']);
        $stmt->bindValue(":area_total", $dados['area_total']);
        $stmt->bindValue(":frente", $dados['frente']);
        $stmt->bindValue(":area_fr", $dados['area_fr']);
        $stmt->bindValue(":fundo", $dados['fundo']);
        $stmt->bindValue(":area_fu", $dados['area_fu']);
        $stmt->bindValue(":direito", $dados['direito']);
        $stmt->bindValue(":area_ld", $dados['area_ld']);
        $stmt->bindValue(":esquerdo", $dados['esquerdo']);
        $stmt->bindValue(":area_le", $dados['area_le']);
        $stmt->bindValue(":medidas", $dados['medidas']);
        $stmt->bindValue(":vr_metro_quadrado", $dados['vr_metro_quadrado']);
        $stmt->bindValue(":vr_lote", $dados['vr_lote']);
        $stmt->bindValue(":codigo_situacao", $dados['codigo_situacao']);
        $stmt->bindValue(":iptu", $dados['iptu']);
        $stmt->bindValue(":iptu_desdobramento", $dados['iptu_desdobramento']);
        $stmt->bindValue(":inscricao_municipal", $dados['inscricao_municipal']);
        $stmt->bindValue(":status_lote", $dados['status_lote']);

        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    public function atualizar($id, $dados) {
        $query = "UPDATE {$this->tabela} SET
                    quadra = :quadra, lote = :lote, lote_num = :lote_num,
                    area_total = :area_total, frente = :frente, area_fr = :area_fr,
                    fundo = :fundo, area_fu = :area_fu, direito = :direito,
                    area_ld = :area_ld, esquerdo = :esquerdo, area_le = :area_le,
                    medidas = :medidas, vr_metro_quadrado = :vr_metro_quadrado,
                    vr_lote = :vr_lote, codigo_situacao = :codigo_situacao,
                    iptu = :iptu, iptu_desdobramento = :iptu_desdobramento,
                    inscricao_municipal = :inscricao_municipal, status_lote = :status_lote
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":quadra", $dados['quadra']);
        $stmt->bindParam(":lote", $dados['lote']);
        $stmt->bindParam(":lote_num", $dados['lote_num']);
        $stmt->bindValue(":area_total", $dados['area_total']);
        $stmt->bindValue(":frente", $dados['frente']);
        $stmt->bindValue(":area_fr", $dados['area_fr']);
        $stmt->bindValue(":fundo", $dados['fundo']);
        $stmt->bindValue(":area_fu", $dados['area_fu']);
        $stmt->bindValue(":direito", $dados['direito']);
        $stmt->bindValue(":area_ld", $dados['area_ld']);
        $stmt->bindValue(":esquerdo", $dados['esquerdo']);
        $stmt->bindValue(":area_le", $dados['area_le']);
        $stmt->bindValue(":medidas", $dados['medidas']);
        $stmt->bindValue(":vr_metro_quadrado", $dados['vr_metro_quadrado']);
        $stmt->bindValue(":vr_lote", $dados['vr_lote']);
        $stmt->bindValue(":codigo_situacao", $dados['codigo_situacao']);
        $stmt->bindValue(":iptu", $dados['iptu']);
        $stmt->bindValue(":iptu_desdobramento", $dados['iptu_desdobramento']);
        $stmt->bindValue(":inscricao_municipal", $dados['inscricao_municipal']);
        $stmt->bindValue(":status_lote", $dados['status_lote']);

        $stmt->execute();
        return $stmt->rowCount();
    }

    public function deletar($id) {
        $query = "DELETE FROM {$this->tabela} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->rowCount();
    }
}
?>