<?php

Class PDFCrawler
{

    private $pdf = null;
    public function __construct()
    {
        $this->pdf = new \TCPDF();
    }

    public function getPdf($url)
    {
        $this->pdf->setPrintHeader(false);
        $this->pdf->setPrintFooter(false);
        $this->pdf->SetMargins(0, 0, 0);
        $this->pdf->SetAutoPageBreak(false, 0);
        $this->pdf->AddPage();
        $this->pdf->SetFont('kozgopromedium', '', 10);
        $this->pdf->writeHTML($this->getHtml($url), true, false, true, false, '');
        $this->pdf->Output('test.pdf', 'I');
    }

    public function getHtml($url)
    {
        $html = file_get_contents($url);
        $html = str_replace('<head>', '<head><base href="'.$url.'" />', $html);
        return $html;
    }
    public function getPageImage($page =1) {

    }
}



