<?php

namespace AppBundle\Controller;

use Mpdf\Mpdf;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class InicioController extends Controller
{
    /**
     * @Route("/", name="inicio")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/profile/pdf/crear", name="profile_pdf")
     * @throws \Mpdf\MpdfException
     */
    public function pdfAction()
    {
        $user = $this->getUser();
        $html = $this->renderView('pdf/profile.html.twig', [
            'alumno' => $user,
        ]);

        $mpdf = new \Mpdf\Mpdf();

        $mpdf->AddFontDirectory('../web/fonts/');

        $fontdata = [
            'handsean' => [
                'R' => 'handsean_2.ttf',
            ],
        ];

        foreach ($fontdata as $f => $fs) {
            $mpdf->fontdata[$f] = $fs;

            foreach (['R', 'B', 'I', 'BI'] as $style) {
                if (isset($fs[$style]) && $fs[$style]) {
                    $mpdf->available_unifonts[] = $f . trim($style, 'R');
                }
            }
        }

        $mpdf->default_available_fonts = $mpdf->available_unifonts;

        $stylesheet = file_get_contents('../web/css/pdf.css');

        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($html,2);

        $mpdf->Output();
    }
}
