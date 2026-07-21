<?php

return [
    // ✅ Verificado
    'Combustible'              => ['combustible'],

    // ✅ Verificado (ejemplo real que pasaste)
    'Repuestos y Accesorios'   => ['accesorios para vehiculos automotores', 'partes, componentes'],

    // ✅ Verificado
    'Farmacia'                 => ['productos farmaceuticos'],

    // ✅ Verificado
    'Hospedaje'                => ['servicios de alojamiento', 'apart hoteles'],

    // ✅ Verificado
    'Seguros'                  => ['seguros generales', 'seguros de vida', 'polizas de seguros', 'servicios de seguros'],

    // ✅ Verificado
    'Papeleria y Oficina'      => ['articulos de papeleria', 'papel tapiz'],

    // ✅ Verificado
    'Arriendo de Inmuebles'    => ['alquiler de bienes inmuebles', 'alquiler de bienes inmobiliarios'],

    // ✅ Verificado
    'Limpieza'                 => ['limpieza general', 'limpieza especializada de edificios'],

    // ✅ Verificado
    'Publicidad y Marketing'   => ['agencias de publicidad', 'publicidad al aire libre', 'publicidad aerea'],

    // ✅ Verificado (parcial — "otras actividades de telecomunicaciones" existe; falta confirmar cómo describe el SRI a un ISP/celular específico)
    'Telecomunicaciones'       => ['actividades de telecomunicaciones'],

    // ⚠️ No verificado — "restaurante" solo aparece en descripciones de fabricación de muebles/maquinaria, no en la actividad de servicio de comidas en sí. Falta la frase real.
    'Alimentacion'             => ['servicio de comidas'],

    // ⚠️ No verificado — no encontré "reparacion de vehiculos automotores" como frase exacta en el catálogo.
    'Mantenimiento Vehicular'  => ['reparacion y mantenimiento de vehiculos'],

    // ⚠️ No verificado — "agua potable" solo aparece en contexto de administración pública, no de la actividad de distribución/venta.
    'Servicios Basicos (Agua/Luz)' => ['distribucion de agua potable', 'distribucion de energia electrica'],

    // ⚠️ No verificado — solo encontré 1 coincidencia parcial ("venta al por menor de computadoras").
    'Tecnologia'               => ['venta al por menor de computadoras'],

    // ⚠️ No verificado — "actividades de contabilidad" existe, pero como categoría de gasto (honorarios pagados a un contador externo) no confirmé el texto exacto.
    'Honorarios Profesionales' => ['actividades de contabilidad', 'actividades juridicas'],

    // ⚠️ No verificado
    'Transporte y Fletes'      => ['transporte de carga por carretera'],
];