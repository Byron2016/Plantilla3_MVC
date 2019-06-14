<?php 

//V4

    //http://nuevaplantilla_mvc.net/pdf/pdf2/Byron/Gustavo
    $this->_pdf->AddPage();                                             //V4
    $this->_pdf->SetFont('Arial','B',16);                               //V4
    $this->_pdf->Cell(40,10, utf8_decode($nombre . ' ' . $apellido));   //V4
    $this->_pdf->Output();                                              //V4

?>