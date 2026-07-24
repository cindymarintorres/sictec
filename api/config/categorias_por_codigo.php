<?php

// Mapa: prefijo de codigo CIIU+SRI => categoria.
// El orden de este array NO importa (ClasificadorService lo reordena
// por longitud de prefijo, del mas especifico al mas general).
//
// FASE 1 (verificado contra Codigo_actividad_economica.txt): categorias
// de gasto de uso diario. Cubre las categorias que ya habiamos revisado
// como texto suelto (Combustible, Farmacia, Seguros, etc.) pero ahora
// por codigo real, no por keyword.
//
// FASE 2 (pendiente): el resto de categorias industriales/sectoriales
// (~125) que quedan por mapear.

return [

    // --- Combustible ---
    'G47300101' => 'Combustible', // venta al por menor de combustibles para vehiculos y motos

    // --- Repuestos y Accesorios ---
    'G4530' => 'Repuestos y Accesorios',  // venta partes/piezas/accesorios vehiculos
    'G45400' => 'Repuestos y Accesorios', // venta partes/piezas/accesorios motocicletas

    // --- Farmacia ---
    'G46492201' => 'Farmacia', // venta al por mayor de productos farmaceuticos
    'G47720101' => 'Farmacia', // venta al por menor de productos farmaceuticos
    'C21'       => 'Farmacia', // fabricacion de productos farmaceuticos

    // --- Hospedaje ---
    'I551' => 'Hospedaje', // hoteles, hoteles de suites, apart hoteles

    // --- Seguros ---
    'K65' => 'Seguros', // seguros de vida, generales, corretaje de seguros
    'K66' => 'Seguros', // actividades auxiliares a seguros y fondos de pensiones

    // --- Papeleria y Oficina ---
    'G47610301' => 'Papeleria y Oficina', // venta al por menor articulos de papeleria
    'G47610302' => 'Papeleria y Oficina', // venta al por menor articulos de oficina

    // --- Arriendo de Inmuebles ---
    'L681'    => 'Arriendo de Inmuebles', // compra-venta, alquiler y explotacion de bienes inmuebles propios
    'L682'    => 'Arriendo de Inmuebles', // actividades inmobiliarias a cambio de retribucion (incluye alquiler)

    // --- Limpieza ---
    'N812' => 'Limpieza', // limpieza general y especializada de edificios

    // --- Publicidad y Marketing ---
    'M731' => 'Publicidad y Marketing', // agencias de publicidad y actividades conexas

    // --- Telecomunicaciones ---
    'J61' => 'Telecomunicaciones',

    // --- Alimentacion ---
    'I561' => 'Alimentacion', // restaurantes y servicio de comidas

    // --- Mantenimiento Vehicular ---
    'G4520' => 'Mantenimiento Vehicular',

    // --- Servicios Basicos (Agua/Luz) ---
    'D351'  => 'Servicios Basicos (Agua/Luz)', // generacion, transmision y distribucion de energia electrica
    'E3600' => 'Servicios Basicos (Agua/Luz)', // captacion, tratamiento y distribucion de agua

    // --- Honorarios Profesionales ---
    'M6920' => 'Honorarios Profesionales', // actividades de contabilidad
    'M6910' => 'Honorarios Profesionales', // actividades juridicas / representacion
    'M702'  => 'Honorarios Profesionales', // actividades de asesoramiento empresarial

    // --- Transporte y Fletes ---
    'H4923' => 'Transporte y Fletes', // transporte de carga por carretera

    // --- Educacion y Capacitacion ---
    'P85' => 'Educacion y Capacitacion',

    // --- Salud y Asistencia Medica ---
    'Q86' => 'Salud y Asistencia Medica',

    // --- Pasajes y Transporte de Pasajeros ---
    'H49' => 'Pasajes y Transporte de Pasajeros', // ojo: H4923 ya esta tomado por Transporte y Fletes (mas especifico, gana)
    'H50' => 'Pasajes y Transporte de Pasajeros', // transporte maritimo de pasajeros
    'H51' => 'Pasajes y Transporte de Pasajeros', // transporte aereo de pasajeros

    // --- Software y Servicios Digitales ---
    'J62'      => 'Software y Servicios Digitales', // programacion, consultoria informatica
    'J6311'    => 'Software y Servicios Digitales', // hosting, procesamiento de datos
    'J6312'    => 'Software y Servicios Digitales', // portales web
    'G4651'    => 'Software y Servicios Digitales', // venta al por mayor de programas informaticos

    // --- Seguridad y Vigilancia ---
    'N80' => 'Seguridad y Vigilancia',

    // --- Gastos Financieros ---
    'K64' => 'Gastos Financieros', // intermediacion monetaria: bancos, cooperativas, banca comercial y central

    // --- Ferreteria y Materiales ---
    'G4752' => 'Ferreteria y Materiales',

    // --- Correos y Courier ---
    'H53' => 'Correos y Courier',

    // --- Veterinaria y Mascotas ---
    'M75'       => 'Veterinaria y Mascotas', // actividades veterinarias
    'G46309701' => 'Veterinaria y Mascotas', // venta al por mayor alimento para mascotas
    'G47732301' => 'Veterinaria y Mascotas', // venta al por menor de mascotas
    'G47732302' => 'Veterinaria y Mascotas', // venta al por menor alimento para mascotas
// --- Tecnologia ---
    'G4741' => 'Tecnologia', // venta al por menor de computadoras y equipo informatico
 
    // --- Electrodomesticos y Electronica (nueva, ya existia en la lista original) ---
    'C2750' => 'Electrodomesticos y Electronica', // fabricacion de aparatos electricos/termoelectricos de uso domestico
 
    // --- Vestimenta y Calzado ---
    'G4641' => 'Vestimenta y Calzado', // venta al por mayor de prendas de vestir y calzado
 
    // --- Combustible (mayorista, complementa G47300101 que es minorista) ---
    'G4661' => 'Combustible', // venta al por mayor de combustibles liquidos y aceite de petroleo
 
    // --- Mantenimiento Vehicular ---
    'G47300201' => 'Mantenimiento Vehicular', // venta al por menor de productos de limpieza/lubricantes para vehiculos
    'C19200202' => 'Mantenimiento Vehicular', // fabricacion de grasas lubricantes -- se puede mover a Combustible si prefieres
 
    // --- Venta de Vehiculos automotores (nueva, ya existia en la lista original) ---
    'G4510' => 'Venta de Vehiculos automotores', // venta de vehiculos nuevos y usados (todo tipo)
 
    // --- Hospedaje ---
    'I552' => 'Hospedaje', // espacios/instalaciones para vehiculos de recreo (camping) -- clase hermana de I551 (hoteles)
 
    // ============================================================
    // Las 3 siguientes NO tenian categoria clara -- se asignaron a la
    // mas parecida que ya existia, tal como pediste. Revisalas cuando
    // puedas y me dices si las quieres mover:
    // ============================================================
 
    // --- Alimentacion ---
    'G4711' => 'Alimentacion', // venta al por menor en supermercados (variedad, predominan alimentos/bebidas)
 
    // --- Comercio Minorista Especializado (nueva, ya existia en la lista original) ---
    'G4799' => 'Comercio Minorista Especializado', // venta al por menor por comisionistas / casas de subastas
 
    // --- Manufactura y Produccion (catch-all generico ya existente) ---
    'C2592' => 'Manufactura y Produccion', // servicios de maquinado de metales por contrato (subcontratista industrial)

];