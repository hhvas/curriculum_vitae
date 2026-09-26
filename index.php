<?php
require __DIR__ . '/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$name = 'Hugo Valencia Samaniego';
$role = 'Ingeniero en Tecnologías de la Información y Comunicación';
$role2 ='SISTEMAS INFORMÁTICOS • DESARROLLO • INFRAESTRUCTURA • BASES DE DATOS';
$roles3='Ingeniero en Tecnologías de la Información y Comunicación, especializado en Sistemas Informáticos, con experiencia en
desarrollo de aplicaciones web y móviles, programación, bases de datos, administración de servidores, soporte técnico e
infraestructura tecnológica. Experiencia desarrollando soluciones orientadas a procesos empresariales, reportes, comercio
electrónico, plataformas web y aplicaciones móviles.';
$location = 'San Mateo Atenco, Méx. 52107';
$phone = '+52 722 449 6785';
$email = 'hugovalenciasamaniego@hotmail.com';
$photo = __DIR__ . '/imagenes/imagen.png';

$experience = [
    ['period' => 'Jul 2019 — Ago 2026', 
    'title' => 'Programador Analista',
         'company' => 'Truck Body Shop || Grupo Xell Trucks || Imperia Truck Pars', 
            'location' => 'Toluca, Méx.', 
                'items' => [
                    [
                        'text' => 'Gerente de Sucursal | Xelltrucks',
                        'subitems' => ['Gestión Operativa y de Almacén: Administración integral de la sucursal, supervisando el control de inventarios (refacciones/unidades Volvo) y la gestión logística de almacén.',
                                       'Coordinación de Mantenimiento: Programación y seguimiento del ingreso y salida de unidades asignadas a taller/reparación, asegurando tiempos óptimos de entrega.',
                                       'Administración y Compras: Elaboración y control de reportes de gastos, así como la gestión del ciclo de compras para el abastecimiento oportuno de la unidad de negocio.',
                                       'Estrategia Comercial: Liderazgo del equipo de ventas, impulsando la captación de clientes y el cumplimiento de metas comerciales.'
                                       ],
                    ],
                    [
                        'text' => 'Gerente de Sistemas y Logística',
                        'subitems' => [
                            'Liderazgo de Equipo: Dirección y supervisión de un equipo multidisciplinario de 4 personas (2 Programadores, 1 Especialista en Soporte Técnico y 1 Monitorista).',
                            'Análisis Financiero y Ventas: Generación de reportes directivos de ventas, cálculo preciso de comisiones para el fuerza de ventas y administración del sistema de cartera de clientes con crédito.',
                            'Soporte de Infraestructura y Servidores: Diagnóstico, resolución de incidencias y mantenimiento operativo de sistemas contables y de nómina (COI y NOI) en servidores.',
                            'Control Presupuestal y Plataformas: Administración integral de fondos y dispersion de tarjetas de corporativas (SIVALE), tanto en la plataforma del proveedor como en el sistema interno de la empresa.',
                            'Logística Multi-sucursal: Coordinación de la logística operativa y control de flujos de compras y ventas para la red de sucursales.'
                            ],
                    ],
                    [
                        'text' => 'Desarrollo de la App SOS Colisión con Android Studio, PHP y MySQL',
                        'subitems' => [],
                        
                    ],
                    [
                        'text' => 'Desarrollo de backend para tienda Imperia Trucks Parts con PHP y MySQL',
                        'subitems' => [],
                        
                    ],
                    [
                        'text' => 'Administración de servidores y respaldos',
                        'subitems' => [],
                        
                    ],
                    [
                        'text' => 'Administración del catálogo de partes Volvo en Grupo XTI.',
                        'subitems' => [],
                        
                    ],
                    [
                        'text' => 'Desarrollo de reportes web para ventas de XELL TRUCKS.',
                        'subitems' => [],
                        
                    ]
                ],
        ],
    ['period' => 'Jul 2015 — Jun 2019', 'title' => 'Sistemas Computacionales / Soporte Técnico', 'company' => 'Tapetes Tufan', 'location' => 'Lerma, Méx.', 'items' => [
        'Programación de módulos en FoxPro y PHP.',
        'Administración de www.tapetestufan.com y www.tufanrugs.com.',
        'Instalación y mantenimiento de cámaras de seguridad de la empresa.',
        'Programación de APP TUFAN en Android Studio con Java y bases de datos MySQL; utilizada en Expo WTC CDMX.',
    ]],
    ['period' => 'Ago 2012 — Ene 2013', 'title' => 'Webmaster', 'company' => 'Grupo Mundo Ejecutivo', 'location' => 'Ciudad de México', 'items' => [
        'Webmaster en Editorial Grupo Mundo Ejecutivo.',
        'Manejo de las plataformas Joomla y E-planning.',
    ]],
    ['period' => 'Mar 2007 — May 2011', 'title' => 'Programador Analista', 'company' => 'Krismar Computación Toluca', 'location' => 'Metepec, Méx.', 'items' => [
        'Impartición de cursos en línea con Moodle.',
        'Desarrollo de páginas en www.krismar.com.mx y plataformas Moodle.',
        'Implementación de seguridad en programas multimedia.',
        'Conferencias en la Feria del Libro en Guatemala.',
    ]],
];

$skills = ['PHP','Android Studio','Python','Node.js', 'MySQL','SQLite','SQL Server','Firebird', 'CCTV', 'Soporte técnico', 'Microsoft Office','HTML5 / CSS / Bootstrap','COI - NOI','Java',];
$education = [
    'degree' => 'Ingeniería en Tecnologías de la Información y Comunicación',
    'focus' => 'Área de Sistemas Informáticos',
    'school' => 'Universidad Tecnológica del Valle de Toluca'
];

if (isset($_POST['generate_pdf'])) {
    $photoDataUri = '';
    if (file_exists($photo)) {
        $photoDataUri = 'data:image/png;base64,' . base64_encode(file_get_contents($photo));
    }

    $experienceMarkup = '';
    foreach ($experience as $job) {
        $jobItems = '';
        foreach ($job['items'] as $item) {
            $itemText = is_array($item) ? ($item['text'] ?? '') : $item;
            $jobItems .= '<li>' . htmlspecialchars($itemText, ENT_QUOTES, 'UTF-8');

            foreach (is_array($item) ? ($item['subitems'] ?? []) : [] as $subitem) {
                $jobItems .= '<ul><li class="subitem">' . htmlspecialchars($subitem, ENT_QUOTES, 'UTF-8') . '</li></ul>';
            }

            $jobItems .= '</li>';
        }

        $experienceMarkup .= '<article class="job"><div class="period">' . htmlspecialchars($job['period'], ENT_QUOTES, 'UTF-8') . '</div><div><h3>' . htmlspecialchars($job['title'], ENT_QUOTES, 'UTF-8') . '</h3><p class="company">' . htmlspecialchars($job['company'], ENT_QUOTES, 'UTF-8') . ' <span>· ' . htmlspecialchars($job['location'], ENT_QUOTES, 'UTF-8') . '</span></p><ul>' . $jobItems . '</ul></div></article>';
    }

    $skillMarkup = '';
    foreach ($skills as $skill) {
        $skillMarkup .= '<span class="skill">' . htmlspecialchars($skill, ENT_QUOTES, 'UTF-8') . '</span>';
    }

    $pdfHtml = <<<HTML
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>{$name} — CV</title>
    <style>
        :root{--ink:#172126;--muted:#617077;--paper:#f4f1ea;--card:#fffdf8;--line:#d8d4ca;--accent:#d65a3a;--accent-dark:#a53d26;--teal:#1f7770;--shadow:0 22px 60px rgba(37,45,42,.1)}
        *{box-sizing:border-box}body{margin:0;padding:24px;background:#f4f1ea;color:var(--ink);font-family:Arial,Helvetica,sans-serif;line-height:1.5}.page{max-width:100%;padding:0}.topbar,.nav,.export-btn,.print-hidden{display:none !important}.hero{display:grid;grid-template-columns:1.4fr .6fr;gap:30px;padding:24px 18px;border:1px solid var(--line);background:var(--card);border-radius:18px;box-shadow:var(--shadow)}.eyebrow{margin:0 0 10px;color:var(--teal);font-size:11px;letter-spacing:.12em;text-transform:uppercase}.h1{margin:0;font-size:26px;letter-spacing:-.04em;line-height:1.1}.hero-lead{margin:12px 0 0;color:var(--muted);font-size:13px}.contact{padding-top:8px}.portrait{width:185px;height:185px;margin:0 0 18px;padding:7px;border:1px solid rgba(214,90,58,.45);border-radius:50%;background:var(--card);box-shadow:0 0 0 8px rgba(214,90,58,.08)}.portrait img{display:block;width:100%;height:100%;object-fit:cover;border-radius:22%}.contact-title{margin:0 0 12px;color:var(--accent);font-size:11px;letter-spacing:.12em;text-transform:uppercase}.contact p{margin:6px 0;font-size:12px}.main{display:grid;grid-template-columns:1.5fr .5fr;gap:30px;margin-top:26px}.section-heading{display:flex;align-items:baseline;gap:12px;margin:0 0 18px}.section-heading span{color:var(--accent);font-size:10px;letter-spacing:.12em}.section-heading h2{margin:0;font-size:18px;letter-spacing:-.04em}.job{display:grid;grid-template-columns:120px 1fr;gap:24px;padding:0 0 21px;margin-bottom:18px;border-bottom:1px solid var(--line)}.job:last-child{margin-bottom:0}.period{color:var(--muted);font-size:10px;line-height:1.6}.job h3{margin:0;font-size:18px;letter-spacing:-.03em}.company{margin:4px 0 12px;color:var(--accent-dark);font-weight:700;font-size:12px}.company span{color:var(--muted);font-weight:500}.job ul{margin:0;padding-left:18px;color:var(--muted);font-size:12px}.job li{margin:4px 0}.aside-block{margin-bottom:20px}.education{border-left:3px solid var(--teal);padding-left:14px}.education p{margin:0 0 7px;font-size:12px}.education .degree{font-weight:700}.education .school{color:var(--muted)}.skill-list{display:flex;flex-wrap:wrap;gap:8px}.skill{padding:7px 10px;border:1px solid var(--line);color:var(--muted);font-size:10px;background:#fff}.availability{padding:18px;background:linear-gradient(135deg,#1f7770,#123f43);color:#edf9f8;border-radius:14px}.availability strong{display:block;margin-bottom:6px;font-size:14px}.availability p{margin:0;font-size:12px}.footer{margin-top:24px;padding-top:16px;border-top:1px solid var(--line);color:var(--muted);font-size:10px}
    </style>
</head>
<body>
    <div class="page">
        <section class="hero">
            <div>
                <p class="eyebrow">Sistemas · Desarrollo · Infraestructura</p>
                <h1 class="h1">{$name}</h1>
                <p class="hero-lead">{$role} {$role2}<br>SISTEMAS INFORMÁTICOS • DESARROLLO • INFRAESTRUCTURA • BASES DE DATOS.</p>
                <h5></h5>
            </div>
            <div class="contact">
                <div class="portrait"><img src="{$photoDataUri}" alt="Fotografía de {$name}"></div>
                <p class="contact-title">Datos de contacto</p>
                <p>{$location}</p>
                <p>{$phone}</p>
                <p>{$email}</p>
            </div>
        </section>
        <main class="main">
            <section>
                <div class="section-heading"><span>01</span><h2>Experiencia laboral</h2></div>
                {$experienceMarkup}
            </section>
            <aside>
                <section class="aside-block">
                    <div class="section-heading"><span>02</span><h2>Formación</h2></div>
                    <div class="education">
                        <p class="degree">{$education['degree']}</p>
                        <p>{$education['focus']}</p>
                        <p class="school">{$education['school']}</p>
                    </div>
                </section>
                <section class="aside-block">
                    <div class="section-heading"><span>03</span><h2>Habilidades</h2></div>
                    <div class="skill-list">{$skillMarkup}</div>
                </section>
                <section class="availability"><strong>Perfil técnico</strong><p>Desarrollo de soluciones que conectan operación, datos y experiencia de usuario.</p></section>
                
                <section class="div">asasas
                </section>
            </aside>
        </main>
        <footer class="footer">{$name} · Toluca, México</footer>
    </div>
</body>
</html>
HTML;

    $options = new Options();
    $options->set('defaultFont', 'Helvetica');
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true);

    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($pdfHtml);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream('curriculum-hugo-valencia.pdf', ['Attachment' => true]);
    exit;
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Currículum vitae de Hugo Valencia Samaniego.">
    <title><?= htmlspecialchars($name) ?> — CV</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root{--ink:#172126;--muted:#617077;--paper:#f4f1ea;--card:#fffdf8;--line:#d8d4ca;--accent:#d65a3a;--accent-dark:#a53d26;--teal:#1f7770;--shadow:0 22px 60px rgba(37,45,42,.1)}
        *{box-sizing:border-box}html{scroll-behavior:smooth}body{margin:0;color:var(--ink);background:var(--paper);font-family:'Manrope',sans-serif;line-height:1.65}a{color:inherit}.page{max-width:1320px;margin:0 auto;padding:28px 34px 70px}.topbar{position:sticky;top:0;z-index:20;display:flex;justify-content:space-between;align-items:center;padding:18px 26px;background:rgba(244,241,234,.88);backdrop-filter:blur(12px);border-bottom:1px solid rgba(23,33,38,.08)}.mark{font-family:'DM Mono',monospace;font-size:13px;letter-spacing:.16em;color:var(--accent);text-transform:uppercase}.nav{display:flex;gap:25px;font-size:13px;font-weight:700}.nav a{text-decoration:none;color:var(--muted)}.nav a:hover{color:var(--accent)}
        .hero{position:relative;display:grid;grid-template-columns:minmax(0,1.35fr) minmax(300px,.65fr);gap:70px;padding:68px 70px 78px;overflow:hidden;background:var(--card);box-shadow:var(--shadow)}.hero:after{content:'';position:absolute;width:270px;height:270px;right:-70px;top:-82px;border:1px solid rgba(214,90,58,.34);border-radius:50%;box-shadow:0 0 0 26px rgba(214,90,58,.06),0 0 0 52px rgba(214,90,58,.035)}.eyebrow{margin:0 0 18px;color:var(--teal);font-family:'DM Mono',monospace;font-size:12px;letter-spacing:.14em;text-transform:uppercase}h1{max-width:720px;margin:0;font-size:clamp(44px,6vw,88px);letter-spacing:-.07em;line-height:.98;font-weight:800}.hero-lead{max-width:620px;margin:27px 0 0;color:var(--muted);font-size:18px}.contact{position:relative;z-index:1;align-self:end;padding-top:0}.contact-title{margin:0 0 17px;font-family:'DM Mono',monospace;font-size:12px;color:var(--accent);letter-spacing:.12em;text-transform:uppercase}.contact p{margin:7px 0;font-size:14px}.contact a{text-decoration:none}.contact a:hover{color:var(--accent)}.portrait{position:relative;z-index:1;width:210px;height:210px;margin:0 0 28px;padding:7px;border:1px solid rgba(214,90,58,.45);border-radius:50%;background:var(--card);box-shadow:0 0 0 8px rgba(214,90,58,.08)}.portrait img{display:block;width:100%;height:100%;object-fit:cover;border-radius:20%;filter:saturate(.9)}
        .main{display:grid;grid-template-columns:minmax(0,1.5fr) minmax(270px,.5fr);gap:70px;margin-top:76px}.section-heading{display:flex;align-items:baseline;gap:18px;margin:0 0 30px}.section-heading span{color:var(--accent);font-family:'DM Mono',monospace;font-size:12px}h2{margin:0;font-size:27px;letter-spacing:-.04em}.job{display:grid;grid-template-columns:150px 1fr;gap:35px;padding:0 0 42px;margin-bottom:38px;border-bottom:1px solid var(--line)}.job:last-child{margin-bottom:0}.period{color:var(--muted);font-family:'DM Mono',monospace;font-size:12px;line-height:1.5}.job h3{margin:0;font-size:21px;letter-spacing:-.035em}.company{margin:3px 0 16px;color:var(--accent-dark);font-weight:700}.company span{color:var(--muted);font-weight:500}.job ul{margin:0;padding-left:19px;color:var(--muted);font-size:14px}.job li{margin:6px 0;padding-left:4px}.aside-block{margin-bottom:48px}.aside-block h2{margin-bottom:19px;font-size:20px}.education{border-left:3px solid var(--teal);padding-left:20px}.education p{margin:0 0 7px;font-size:14px}.education .degree{font-weight:800}.education .school{color:var(--muted)}.skill-list{display:flex;flex-wrap:wrap;gap:8px}.skill{padding:7px 11px;border:1px solid var(--line);color:var(--muted);font-family:'DM Mono',monospace;font-size:11px;background:rgba(255,255,255,.35)}.availability{padding:22px;background:var(--teal);color:#f9f5e9}.availability p{margin:0;font-size:14px}.availability strong{display:block;margin-bottom:6px;font-size:17px}.footer{display:flex;justify-content:space-between;gap:20px;margin-top:75px;padding-top:20px;border-top:1px solid var(--line);color:var(--muted);font-family:'DM Mono',monospace;font-size:11px}.export-btn{display:inline-flex;align-items:center;justify-content:center;padding:10px 16px;border:1px solid var(--accent);background:var(--accent);color:#fff;border-radius:999px;cursor:pointer;font-family:'DM Mono',monospace;font-size:12px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;box-shadow:0 12px 28px rgba(214,90,58,.25)}.export-btn:hover{transform:translateY(-1px);box-shadow:0 16px 32px rgba(214,90,58,.32)}
        @media(max-width:800px){.page{padding:20px 18px 45px}.topbar{padding-bottom:22px}.nav{gap:12px}.nav a{font-size:11px}.hero{display:block;padding:42px 28px 39px}.portrait{width:165px;height:165px;margin-bottom:25px}h1{font-size:clamp(44px,13vw,67px)}.hero-lead{font-size:16px}.contact{padding-top:35px}.main{display:block;margin-top:50px}.aside{display:grid;grid-template-columns:1fr 1fr;gap:35px 22px;margin-top:55px}.aside-block{margin:0}.availability{grid-column:1/-1}.job{grid-template-columns:1fr;gap:10px;padding-bottom:30px;margin-bottom:30px}.export-btn{padding:9px 12px;font-size:10px}}
        @media print{@page{size:A4 portrait;margin:12mm}html,body{background:#f4f1ea !important}.page{max-width:none;margin:0;padding:0;background:transparent;box-shadow:none}.topbar,.nav,.export-btn,.footer{display:none !important}.hero{background:linear-gradient(135deg,rgba(255,255,255,.96),rgba(255,255,255,.5));box-shadow:none;border:1px solid var(--line);border-radius:18px;padding:30px 32px 34px;-webkit-print-color-adjust:exact;print-color-adjust:exact}.hero:after{display:none}.main{gap:40px;margin-top:28px}.job{break-inside:avoid;page-break-inside:avoid;padding-bottom:26px;margin-bottom:26px}.skill,.availability,.education{-webkit-print-color-adjust:exact;print-color-adjust:exact}}
    </style>
</head>
<body>
<div class="page">
    <header class="topbar">
        <div class="mark">CV / 2026</div>
        <nav class="nav" aria-label="Navegación principal">
            <a href="#experiencia">Experiencia</a>
            <a href="#formacion">Formación</a>
            <a href="#contacto">Contacto</a>
        </nav>
        
    </header>

    <section class="hero" id="contacto">
        <div>
            <p class="eyebrow"><?=  $role2;?></p>
            <h1><?= htmlspecialchars($name) ?></h1>
            <p class="hero-lead"><?= htmlspecialchars($role) ?> </p>
            <h5 style="text-align: justify; color: #222344; text-shadow: 0.5px 0.5px 0.5px rgba(0,0,0,0.0  );">
    <?= $roles3; ?>
</h5>
        </div>
        <div class="contact">
            <?php if (file_exists($photo)): ?>
                <div class="portrait">
                    <img src="imagenes/imagen.png" alt="Fotografía de <?= htmlspecialchars($name) ?>">
                </div>
            <?php endif; ?>
            <p class="contact-title">Datos de contacto</p>
            <p><?= htmlspecialchars($location) ?></p>
            <p><a href="tel:+527224496785"><?= htmlspecialchars($phone) ?></a></p>
            <p><a href="mailto:<?= htmlspecialchars($email) ?>"><?= htmlspecialchars($email) ?></a></p>
        </div>
    </section>

    <main class="main">
        <section id="experiencia">
            <div class="section-heading"><span>01</span><h2>Experiencia laboral</h2></div>
            <?php foreach ($experience as $job): ?>
                <article class="job">
                    <div class="period"><?= htmlspecialchars($job['period']) ?></div>
                    <div>
                        <h3><?= htmlspecialchars($job['title']) ?></h3>
                        <p class="company"><?= htmlspecialchars($job['company']) ?> <span>· <?= htmlspecialchars($job['location']) ?></span></p>
                        <ul>
                            <?php foreach ($job['items'] as $item): ?>
                                <?php $itemText = is_array($item) ? ($item['text'] ?? '') : $item; ?>
                                <li>
                                    <?= htmlspecialchars($itemText) ?>
                                    <?php if (is_array($item) && !empty($item['subitems'])): ?>
                                        <ul>
                                            <?php foreach ($item['subitems'] as $subitem): ?>
                                                <li class="subitem"><?= htmlspecialchars($subitem) ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </article>
            <?php endforeach; ?>
        </section>

        <aside class="aside">
            <section class="aside-block" id="formacion">
                <div class="section-heading"><span>02</span><h2>Formación</h2></div>
                <div class="education">
                    <p class="degree"><?= htmlspecialchars($education['degree']) ?></p>
                    <p><?= htmlspecialchars($education['focus']) ?></p>
                    <p class="school"><?= htmlspecialchars($education['school']) ?></p>
                </div>
            </section>

            <section class="aside-block">
                <div class="section-heading"><span>03</span><h2>Habilidades</h2></div>
                <div class="skill-list">
                    <?php foreach ($skills as $skill): ?>
                        <span class="skill"><?= htmlspecialchars($skill) ?></span>
                    <?php endforeach; ?>
                </div>
            </section>

            <section class="availability">
                <strong>Perfil técnico</strong>
                <p>Desarrollo de soluciones que conectan operación, datos y experiencia de usuario.</p>
            </section>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>

            <section class="availability">
                <strong>Competencias Profesionales</strong>
                Desarrollo y Gestión de TI
                <small>
                <ul>
                    <li>Desarrollo de Software: Diseño y desarrollo de aplicaciones web y móviles para soluciones empresariales.</li>
                    <li>Bases de Datos: Diseño, modelado y administración de sistemas de bases de datos relacionales.</li>
                    <li>Sistemas Administrativos: Diagnóstico y soporte técnico especializado en plataformas contables y de nómina (COI y NOI).</li>
                    <li>Mejora Continua: Automatización de procesos operativos y desarrollo de herramientas de reporte empresarial.</li>
                </ul>
                </small>
                Infraestructura y Redes
                <small>
                <ul>
                    <li>Servidores y Respaldos: Administración, mantenimiento de servidores y ejecución de políticas de respaldo de información.</li>
                    <li>Infraestructura y Soporte: Soporte técnico a equipos de cómputo, diagnóstico de redes y resolución de incidencias en TI.</li>
                    <li>Seguridad Electrónica: Instalación, configuración y mantenimiento de sistemas de videovigilancia (CCTV).</li>
                </ul>
                </small>
                
                Gestión Operativa y Liderazgo
                <small>
                <ul>
                    <li>Liderazgo de Equipos: Dirección de personal técnico y operativo (programación, soporte y monitoreo).</li>
                    <li>Gestión de Proyectos y Logística: Supervisión de procesos de compras, inventarios y logística multi-sucursal.</li>
                    <li>Capacitación: Entrenamiento, apoyo continuo y atención técnica a usuarios finales.</li>
                </ul>
                </small>
            </section>
        </aside>
    </main>

    <footer class="footer">
        <span><?= htmlspecialchars($name) ?> · Toluca, México</span>
    </footer>
</div>
</body>
</html>
