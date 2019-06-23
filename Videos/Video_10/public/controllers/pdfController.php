<?php

//V4

class pdfController extends Controller {                                      //V4
    
    private $_pdf;                                                            //V4

    public function __construct()                                             //V4
    {
        parent::__construct();                                                //V4
        $this->getLibrary('fpdf','fpdf');                                     //V4 //que esté disponible controlador completo
        $this->_pdf = new FPDF;                                               //V4
    }
    
    public function index()                                                   //V4
    {
        
    }
    
    public function pdf1($nombre = '¡Hola Mundo!', $apellido  = 'b')          //V4
    {
        //http://nuevaplantilla201990612_mvc.net/pdf/pdf1/byron/gustavo
        $this->_pdf->AddPage();                                               //V4
        $this->_pdf->SetFont('Arial','B',16);                                 //V4
        $this->_pdf->Cell(40,10, utf8_decode($nombre . ' ' . $apellido));     //V4
        $this->_pdf->Output();                                                //V4
    }

    public function pdf2($nombre, $apellido)                                  //V4
    {
        //http://nuevaplantilla201990612_mvc.net/pdf/pdf2/Byron/Gustavo
        $this->_pdf->AddPage();                                               //V4
        $this->_pdf->SetFont('Arial','B',16);                                 //V4
        $this->_pdf->Cell(40,10, utf8_decode($nombre . ' ' . $apellido));     //V4
        $this->_pdf->Output();                                                //V4
    }
    
    public function pdf3($nombre, $apellido)                                  //V4
    {
        //requerir de un archivo externo.
        require_once ROOT . 'public' . DS . 'files' . DS . 'pdf3.php';        //V4
    }
 }

?>