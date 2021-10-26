
<?php

require_once dirname(__FILE__)."/../library/fpdf/fpdf.php";


class PDF extends FPDF {

	public $titulo = "sin titulo";
	public $numero = "";
	public $venta = [];
	public $detalle = [];
	public $barcode=0;
	public $subtotal =0;
	public $total =0;
	public $iva = 0;
	public $office = [];
	public $nameoffice = "";
	public $subbase = 0;
	public $subcero =0;



	function PrintChapter(){
	    $this->AddPage();
	    $this->cabecero();
	    $this->tabledetalle();
	    $this->imprimirMonto();
	}


	function Header(){
		foreach ($this->office as $key => $value) {
			$this->nameoffice =$value['name'];
			$this->iva =$value['iva'];
		}

	    global $title;

	    // Arial bold 15
	    $this->SetFont('Arial','B',8);
	    // Calculamos ancho y posición del título.
	    $w = round($this->GetStringWidth($title),1,1);

	    $this->SetX(3);
	    // Colores de los bordes, fondo y texto
	    $this->SetDrawColor(0,80,180);
	    $this->SetFillColor(239,232,232);
	    $this->SetTextColor(0,0,0);
	    // Ancho del borde (1 mm)
	    $this->SetLineWidth(0.5);
	    // Título
	    $this->Cell(0,9,$this->utf($this->nameoffice),0,1,'C',true);
	    
	    // linea en el cabecero
	    $this->Cell(0,0,'','T');
	    $this->Ln(4);
	    

	}
	
	function cabecero(){

		// Información del negocio	
		foreach ($this->office as $key => $value) {

			$this->SetFont('Helvetica','',8);
			$this->Cell(0,4,'RUC: '.$this->utf($value['ruc']),0,1,'C');
			// CELL(0,) PARA CENTRADO
			$this->Cell(0,4,$this->utf($value['address']),0,1,'C');
			$this->Cell(0,4,'TLF: '.$this->utf($value['phone']),0,1,'C');
			$this->Cell(0,4,'Correo:'.$this->utf($value['email']),0,1,'C');
			$this->Cell(0,4,$this->utf('Comprometidos con su satisfacción'),0,1,'C');
			$this->Ln();
	
		}		
	    

		foreach ($this->venta  as $key => $value) {		
			
			// informacion del cliente y factura
	   	 	$this->Cell(0,4,$this->utf('N°').' '.$this->utf($value['code']),0,1,'C');
			$this->Cell(0,4,'Cliente: '.$this->utf($value['customer']),0,1,'C');
			$this->Cell(0,4,'Fecha: '.$this->utf($value['fecha']),0,1,'C');
			$this->Cell(0,4,'Vendedor: '.$this->utf($value['worker']),0,1,'C');

			// linea en el cabecero
	   	 	$this->Cell(0,0,'','T');
			
		}
		

		
	}

	function tabledetalle(){
		$this->Ln(2);
		$this->SetFont('Helvetica','B',6);
		//Cabecero de la tabla
		$this->Cell(4,4,'#',0,0,'L');
		$this->Cell(40,4,'DETALLE',0,0,'L');
		$this->Cell(7,4,'UD',0,0,'L');
		$this->Cell(10,4,'VALOR',0,0,'L');
		$this->Cell(10,4,'MONTO',0,1,'L');

		$i=1;
		//detalle de la tabla
		$this->SetFont('Helvetica','',6);
		foreach ($this->detalle  as $key => $value) {
			
			$total = number_format(($value['canty']*$value['price']),2,'.','');

			$this->subtotal = $this->subtotal +$total;
			if($value['impuesto']>0){
				$this->subbase = $this->subbase +$total;
			}else{
				$this->subcero = $this->subcero +$total;
			}
			

			$this->Cell(4,4,$i,0,0,'L');
			//$this->Multicell(35,4,$this->utf($value['name']),1,'T');
			$this->Cell(40,4,substr($this->utf($value['name']),0,30),0,0,'L');			
			$this->Cell(7,4,$value['canty'],0,0,'L');
			$this->Cell(10,4,$value['price'],0,0,'L');
			$this->Cell(10,4,$total,0,1,'L');
			

			$i++;
		}

		$this->Ln(2);
	}

	function imprimirMonto(){
		$this->Cell(0,0,'','T');
		$this->Ln(1);
		//subtotal
		$this->SetFont('Helvetica','B',6);
		$this->Cell(50,4,'SUBTOTAL:',0,0,'L');
		$this->Cell(20,4,"$".$this->subtotal,0,1,'R');
		//base cero
		$this->Cell(50,4,'BASE (0 %):',0,0,'L');
		$this->Cell(20,4,$this->subcero,0,1,'R');
		//base cero 12%
		$igv = number_format(($this->iva*100),0,'.','');
		$this->Cell(50,4,'BASE ('.$igv.'%):',0,0,'L');
		$this->Cell(20,4,$this->subbase,0,1,'R');

		//iva 12%
		$impuesto = number_format(($this->subbase*$this->iva),2,'.','');
		$this->Cell(50,4,'IMPUESTO ('.$igv.'%):',0,0,'L');		
		$this->Cell(20,4,$impuesto,0,1,'R');

		//imprimir monto total
		$montopagar = number_format(($impuesto+$this->subbase+$this->subcero),2,'.','');
		$this->Cell(50,4,'MONTO A PAGAR:',0,0,'L');		
		$this->Cell(20,4,"$".$montopagar,0,1,'R');
		$this->Ln(1);
		$this->Cell(0,0,'','T');
		$this->Ln(1);
	}

	function utf($texto){
		return utf8_decode($texto);
	}

	
	//numeracion de la pagina
	function Footer(){		    
	    // Arial itálica 8
	    $this->SetFont('Arial','I',7);
	    $this->SetTextColor(0);
	    // Número de página
	    $this->Cell(0,10, $this->utf('Página #').$this->PageNo(),0,0,'C');
	}
}

$idventa = $_GET['idventa'];

$pdf = new PDF('P','mm',array(80,150));
$pdf->SetMargins(3.35, 3.35, 3.35);
if($idventa!=""){

	require_once dirname(__FILE__).'/../models/Sales.php';
	require_once dirname(__FILE__)."/../models/Business.php";
	
	$business = new Business();
	$sale = new Sales();
	
	$pdf->office = $business->listForPrintByIdPerson();
	//var_dump($pdf->office);
	$res = $sale->saleById($idventa);
	$pdf->venta = $res;
	//var_dump($res);
	
	$det =  $sale->listDetailSales($idventa);
	$pdf->detalle =$det;

}


$title = 'Comprobante';
$pdf->SetTitle($title);
$pdf->SetAuthor('Julio Verne');
$pdf->PrintChapter();


$pdf->Output();


?>