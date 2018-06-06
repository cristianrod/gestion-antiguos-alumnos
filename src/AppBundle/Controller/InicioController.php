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
        if(!$this->isGranted('ROLE_ADMIN')){
            return $this->redirectToRoute('fos_user_profile_show');
        }

        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/profile/pdf/crear", name="profile_pdf")
     * @throws \Mpdf\MpdfException
     */
    public function pdfAction()
    {
        if (!$this->getUser()->getCurriculum()){
            return $this->redirectToRoute('fos_user_profile_show');
        }

        $user = $this->getUser();
        $html = $this->renderView('pdf/profile.html.twig');

        $mpdf = new \Mpdf\Mpdf();

        $mpdf->AddFontDirectory('../web/fonts/');

        $fontdata = [
            'handsean' => [
                'R' => 'handsean_2.ttf',
            ],
            'lemon' => [
                'R' => 'DKLemonYellowSun.ttf'
            ],
            'handy' => [
                'R' => 'wg_handy_icons_1.ttf'
            ],
            'handyvol' => [
                'R' => 'wg_handy_icons_vol2_0.ttf'
            ]
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
        $mpdf->SetTitle($user->getNombre() . $user->getApellido1() . $user->getApellido2() . 'CV');

        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($html,2);

        $mpdf->Output($user->getNombre() . $user->getApellido1() . $user->getApellido2() . 'CV.pdf', 'I');
    }
}
