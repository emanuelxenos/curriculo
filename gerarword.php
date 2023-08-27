<?php 

$nome = $_POST['nome'];
$naturalidade = $_POST['naturalidade'];
$endereco = $_POST['endereco'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$idade = $_POST['idade'];
$escv = $_POST['escv'];
$telefone = $_POST['telefone'];
$cnh = $_POST['cnh'];
//Escolaridade
$instituicao = $_POST['instituicao'];
$concluiu = $_POST['concluiu'];
$cidadeins = $_POST['cidadeins'];

$cursos = $_POST['cursos']; 

$experiencia = $_POST['experiencia'];

$objetivo = $_POST['objetivo'];

    $rand = "imagem";
    if($_FILES['imagem']['type'] == "image/jpeg"){
        @$tipo = ".jpg";
    }else if($_FILES['imagem']['type'] == "image/png"){
        @$tipo = ".png";
    }    

    @$nomeimg = $rand.$tipo;
    move_uploaded_file($_FILES['imagem']['tmp_name'], "imagens/".$nomeimg);



require_once 'vendor/autoload.php';

$phpWord = new \PhpOffice\PhpWord\PhpWord();

$section = $phpWord->addSection();

$imageStyle = array(
    'width' => 113,
    'height' => 152,
    'wrappingStyle' => 'square',
    'positioning' => 'absolute',
    'posHorizontal'    => \PhpOffice\PhpWord\Style\Image::POSITION_HORIZONTAL_RIGHT,
    'posHorizontalRel' => 'margin',
    'posVerticalRel' => 'line',
);

$fontStyle = new \PhpOffice\PhpWord\Style\Font();
$fontStyle->setBold(true);
$fontStyle->setName('Arial');
$fontStyle->setSize(22);
$myTextElement = $section->addText(strtoupper($nome));
$myTextElement->setFontStyle($fontStyle);

$lineStyle = array('weight' => 1.5, 'width' => 600, 'height' => 0, 'color' => 000);
$section->addLine($lineStyle);

if(isset($_FILES['imagem']) && !empty($_FILES['imagem']['name'])){
   
       $section->addImage(
        'imagens/'.$nomeimg,
        $imageStyle
    );

}

$section->addText(
    'Naturalidade: '.$naturalidade,
     array('name' => 'Arial', 'size' => 12)
);

$section->addText(
    'Endereço: '.$endereco,
    array('name' => 'Arial', 'size' => 12)
);

$section->addText(
    'Bairro: '.$bairro,
     array('name' => 'Arial', 'size' => 12)
);
$section->addText(
    'Cidade: '.$cidade,
     array('name' => 'Arial', 'size' => 12)
);
$section->addText(
    'Idade: '.$idade,
     array('name' => 'Arial', 'size' => 12)
);
$section->addText(
    'Telefone: '.$telefone,
     array('name' => 'Arial', 'size' => 12)
);
$section->addText(
    'CNH: '.$cnh,
     array('name' => 'Arial', 'size' => 12)
);


$fontStyle = new \PhpOffice\PhpWord\Style\Font();
$fontStyle->setBold(true);
$fontStyle->setName('Arial');
$fontStyle->setSize(12);
$section->addText();
$myTextElement = $section->addText('ESCOLARIDADE');
$myTextElement->setFontStyle($fontStyle);
//Adicionando linha
$lineStyle = array('weight' => 1.5, 'width' => 600, 'height' => 0, 'color' => 000);
$section->addLine($lineStyle);

$section->addText($concluiu,
    array('name' => 'Arial', 'size' => 12 )
);

$section->addText(
    'Instituição: '.$instituicao,
     array('name' => 'Arial', 'size' => 12)
);

$section->addText($cidadeins,
    array('name' => 'Arial', 'size' => 12 )
);

if(!empty($cursos)){
    // Curso Opcional
    $fontStyle = new \PhpOffice\PhpWord\Style\Font();
    $fontStyle->setBold(true);
    $fontStyle->setName('Arial');
    $fontStyle->setSize(12);
    $section->addText();
    $myTextElement = $section->addText('CURSOS');
    $myTextElement->setFontStyle($fontStyle);
    //Adicionando linha
    $lineStyle = array('weight' => 1.5, 'width' => 600, 'height' => 0, 'color' => 000);
    $section->addLine($lineStyle);

    $curso = nl2br($cursos);
    $cursq = str_replace("<br />", "<w:br/>", $curso);

         $section->addText($cursq,
            array('name' => 'Arial', 'size' => 12 )
        );
}

if(!empty($experiencia)){
    // Curso Opcional
    $fontStyle = new \PhpOffice\PhpWord\Style\Font();
    $fontStyle->setBold(true);
    $fontStyle->setName('Arial');
    $fontStyle->setSize(12);
    $section->addText();
    $myTextElement = $section->addText('EXPERIÊNCIAS PROFISSIONAIS');
    $myTextElement->setFontStyle($fontStyle);
    //Adicionando linha
    $lineStyle = array('weight' => 1.5, 'width' => 600, 'height' => 0, 'color' => 000);
    $section->addLine($lineStyle);

    $experiencias = nl2br($experiencia);
    $experienciaq = str_replace("<br />", "<w:br/>", $experiencias);

    $section->addText($experienciaq,
    array('name' => 'Arial', 'size' => 12 )
    );
}

if(!empty($objetivo)){
    // Curso Opcional
    $fontStyle = new \PhpOffice\PhpWord\Style\Font();
    $fontStyle->setBold(true);
    $fontStyle->setName('Arial');
    $fontStyle->setSize(12);
    $section->addText();
    $myTextElement = $section->addText('OBJETIVO PROFISSIONAL');
    $myTextElement->setFontStyle($fontStyle);
    //Adicionando linha
    $lineStyle = array('weight' => 1.5, 'width' => 600, 'height' => 0, 'color' => 000);
    $section->addLine($lineStyle);

    $objetivos = nl2br($objetivo);
    $objetivoq = str_replace("<br />", "<w:br/>", $objetivos);

    $section->addText($objetivoq,
    array('name' => 'Arial', 'size' => 12 )
    );
}
/*

BAixar arquivo produzido autmotaicamente

$file = 'HelloWorld.docx';
header("Content-Description: File Transfer");
header('Content-Disposition: attachment; filename="' . $file . '"');
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Expires: 0');
$xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$xmlWriter->save("php://output");
*/

$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save("arquivos/".strtoupper($nome).date(" d_m_y h i s").".docx");

if($objWriter){
	header('Location:index.php?msg=ok');
}

@unlink("imagens/".$nomeimg);

?>