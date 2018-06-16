<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Usuario;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/alumnos")
 * Class AlumnoController
 * @package AppBundle\Controller
 */
class AlumnoController extends Controller
{
    /**
     * @Route("/", name="alumnos_index")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function indexAction(Request $request)
    {
        $alumnos = $this->getDoctrine()->getRepository(Usuario::class);
        $pagina = $request->query->getInt('p', 1);
        $alumno = $request->query->get('a');
        $tipo = $request->query->get('tipo');
        if ($alumno && $tipo){
            $alumnos = $alumnos->findAlumnoByUsuario($pagina, $alumno, $tipo);
        }
        else{
            $alumnos = $alumnos->findAlumnoByNombre($pagina);
        }
        return $this->render("alumno/index.html.twig", [
            'alumnos' => $alumnos,
        ]);
    }

    /**
     * @Route("/ver/{id}", name="alumnos_show")
     * @param Usuario $alumno
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function showAction(Usuario $alumno)
    {
        if (!$alumno->getEsAlumno()){
            return $this->redirectToRoute('alumnos_index');
        }

        return $this->render(":alumno:show.html.twig", [
            'alumno' => $alumno,
        ]);
    }

    /**
     * @Route("/enviar/mensaje")
     * @param \Swift_Mailer $mailer
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function emailAction(\Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message('Hola Email'))
            ->setFrom('enviar@gmail.com')
            ->setTo('recibir@gmail.com')
            ->setBody('<h3>¡Te has registrado correctamente!</h3>');

        $mailer->send($message);

        return $this->redirectToRoute('alumnos_index');
    }

    /**
     * @Route("/pdf/{id}", name="alumnos_pdf")
     * @param Usuario $alumno
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Mpdf\MpdfException
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function pdfAlumnoAction(Usuario $alumno)
    {
        if (!$alumno->getEsAlumno()){
            return $this->redirectToRoute('alumnos_index');
        }

        if (!$alumno->getCurriculum()){
            return $this->redirectToRoute('alumnos_index');
        }

        $html = $this->renderView('alumno/pdf.html.twig', [
            'alumno' => $alumno,
        ]);

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
        $mpdf->SetTitle($alumno->getNombre() . $alumno->getApellido1() . $alumno->getApellido2() . 'CV');

        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($html,2);

        $mpdf->Output($alumno->getNombre() . $alumno->getApellido1() . $alumno->getApellido2() . 'CV.pdf', 'I');
    }
}
