<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Curriculum;
use AppBundle\Entity\Pdf;
use AppBundle\Form\PdfType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PdfController extends Controller
{
    /**
     * @Route("/pdf/generar", name="pdf_generar")
     * @param Request $request
     * @return string
     * @throws \Mpdf\MpdfException
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function generarAction(Request $request)
    {
        $pdf = new Pdf();

        $form = $this->createForm(PdfType::class, $pdf)
            ->add('crearcv', SubmitType::class, [
                'label' => 'Obtener PDF',
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $pdf = $form->getData();

            $repository = $this->getDoctrine()
                ->getRepository(Curriculum::class);

            if ($pdf->getPdfde()){
                $query = $repository->createQueryBuilder('c')
                    ->where('c.puntuacion >= ' . $pdf->getPdfde())
                    ->getQuery();
            }
            else{
                $query = $repository->createQueryBuilder('c')
                    ->getQuery();
            }

            $curriculums = $query->getResult();

            if (count($curriculums) > 0){
                $mpdf = new \Mpdf\Mpdf();

                $html = $this->renderView('pdf/alumnos.html.twig', [
                    'curriculums' => $curriculums,
                    'mpdf' => $mpdf
                ]);

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

                $mpdf->SetTitle('alumnosCV');

                $mpdf->WriteHTML($stylesheet,1);
                $mpdf->WriteHTML($html,2);

                $mpdf->Output('alumnosCV.pdf', 'I');
            }
        }

        return $this->render('pdf/puntuacion.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
