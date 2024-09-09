<?php
require('vendor/autoload.php'); // Certifique-se de que a biblioteca FPDF está instalada e carregada corretamente

use Fpdf\Fpdf;

class PDF extends Fpdf
{
    // Cabeçalho da página
    function Header()
    {
        // Adiciona uma imagem no cabeçalho (opcional)
        $this->Image('logo.png', 10, 6, 30); // Substitua 'logo.png' pelo caminho da sua imagem
        $this->SetFont('Arial', 'B', 12);
        // Muda para a direita
        $this->Cell(80);
        // Título
        $this->Cell(30, 10, 'Relatório de Vendas', 0, 0, 'C');
        // Linha quebra
        $this->Ln(20);
    }

    // Rodapé da página
    function Footer()
    {
        // Posição a 1,5 cm do fim da página
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        // Número da página
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }

    // Tabela com os dados
    function Tabela($header, $data)
    {
        // Larguras das colunas
        $w = array(40, 35, 40, 45);
        // Cabeçalhos
        for ($i = 0; $i < count($header); $i++) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C');
        }
        $this->Ln();
        // Dados
        foreach ($data as $row) {
            $this->Cell($w[0], 6, $row[0], 1);
            $this->Cell($w[1], 6, $row[1], 1);
            $this->Cell($w[2], 6, $row[2], 1, 0, 'R');
            $this->Cell($w[3], 6, $row[3], 1, 0, 'R');
            $this->Ln();
        }
    }
}

// Criação do objeto PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Cabeçalhos da tabela
$header = array('Produto', 'Categoria', 'Quantidade', 'Preço');

// Dados da tabela (exemplo de dados)
$data = [
    ['Produto 1', 'Categoria A', '10', 'R$ 25,00'],
    ['Produto 2', 'Categoria B', '5', 'R$ 15,00'],
    ['Produto 3', 'Categoria C', '8', 'R$ 30,00'],
    ['Produto 4', 'Categoria A', '12', 'R$ 20,00'],
];

// Adiciona a tabela ao PDF
$pdf->Tabela($header, $data);

// Saída do PDF
$pdf->Output('I', 'relatorio_vendas.pdf'); // 'I' para abrir no navegador, 'D' para download

?>
