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


return [

    // --- Combustible ---
    'G473001' => 'Combustible', // venta al por menor de combustibles para vehiculos y motos (cubre nivel ACTIVIDAD y SUBNIVEL)
    'G461' => 'Combustible', // intermediarios/comisionistas del comercio de combustibles, minerales, metales

    // --- Repuestos y Accesorios ---
    'G4530' => 'Repuestos y Accesorios',  // venta partes/piezas/accesorios vehiculos
    'G45400' => 'Repuestos y Accesorios', // venta partes/piezas/accesorios motocicletas

    // --- Farmacia ---
    'G464922' => 'Farmacia', // venta al por mayor de productos farmaceuticos (cubre ACTIVIDAD+SUBNIVEL)
    'G477201' => 'Farmacia', // venta al por menor de productos farmaceuticos (cubre ACTIVIDAD+SUBNIVEL)
    'C21'       => 'Farmacia', // fabricacion de productos farmaceuticos
    'G4772' => 'Farmacia', // venta al por menor de perfumes, articulos cosmeticos y de tocador (mismo grupo CIIU que farmacia)

    // --- Hospedaje ---
    'I551' => 'Hospedaje', // hoteles, hoteles de suites, apart hoteles

    // --- Seguros ---
    'K65' => 'Seguros', // seguros de vida, generales, corretaje de seguros
    'K66' => 'Seguros', // actividades auxiliares a seguros y fondos de pensiones

    // --- Papeleria y Oficina ---
    'G476103' => 'Papeleria y Oficina', // venta al por menor de articulos de oficina y papeleria (cubre ACTIVIDAD+SUBNIVEL)

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
    'M74'  => 'Honorarios Profesionales', // otras actividades profesionales, cientificas y tecnicas n.c.p.
    'M711' => 'Honorarios Profesionales', // arquitectura e ingenieria: diseno, asesoramiento tecnico, proyectos civiles/electricos/mecanicos

    // --- Transporte y Fletes ---
    'H4923' => 'Transporte y Fletes', // transporte de carga por carretera

    // --- Educacion y Capacitacion ---
    'P85' => 'Educacion y Capacitacion',

    // --- Salud y Asistencia Medica ---
    'Q86' => 'Salud y Asistencia Medica',
    'G47720102' => 'Salud y Asistencia Medica', // venta al por menor de productos ortopedicos
    'C331302' => 'Salud y Asistencia Medica', // reparacion y mantenimiento de equipo de irradiacion/electronico de uso medico
    'G477203' => 'Salud y Asistencia Medica', // venta al por menor de instrumentos y aparatos medicinales y ortopedicos

    // --- Pasajes y Transporte de Pasajeros ---
    'H49' => 'Pasajes y Transporte de Pasajeros', // ojo: H4923 ya esta tomado por Transporte y Fletes (mas especifico, gana)
    'H50' => 'Pasajes y Transporte de Pasajeros', // transporte maritimo de pasajeros
    'H51' => 'Pasajes y Transporte de Pasajeros', // transporte aereo de pasajeros
    'H522' => 'Pasajes y Transporte de Pasajeros', // transporte terrestre de pasajeros: terminales y estaciones

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
    'G463097' => 'Veterinaria y Mascotas', // venta al por mayor alimento para mascotas (cubre ACTIVIDAD+SUBNIVEL)
    'G477323' => 'Veterinaria y Mascotas', // venta al por menor de mascotas y alimento para mascotas (cubre ACTIVIDAD+SUBNIVEL)
    'G46492202' => 'Veterinaria y Mascotas', // venta al por mayor de productos veterinarios
    // --- Tecnologia ---
    'G4741' => 'Tecnologia', // venta al por menor de computadoras y equipo informatico

    // --- Electrodomesticos y Electronica (nueva, ya existia en la lista original) ---
    'C2750' => 'Electrodomesticos y Electronica', // fabricacion de aparatos electricos/termoelectricos de uso domestico

    // --- Vestimenta y Calzado ---
    'G4641' => 'Vestimenta y Calzado', // venta al por mayor de prendas de vestir y calzado
    'G478200' => 'Vestimenta y Calzado', // venta al por menor de textiles/prendas/calzado en puestos de venta y mercados
    'G4771'   => 'Vestimenta y Calzado', // venta al por menor de prendas de vestir y peleteria en establecimientos especializados

    // --- Combustible (mayorista, complementa G47300101 que es minorista) ---
    'G4661' => 'Combustible', // venta al por mayor de combustibles liquidos y aceite de petroleo

    // --- Mantenimiento Vehicular ---
    'G473002' => 'Mantenimiento Vehicular', // venta al por menor de productos lubricantes/refrigerantes para vehiculos (cubre nivel ACTIVIDAD y SUBNIVEL),
    'C192002' => 'Mantenimiento Vehicular', // fabricacion de aceites y grasas lubricantes a base de petroleo (cubre ACTIVIDAD+SUBNIVEL, incluye tanto aceites como grasas)

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

    // --- Alimentacion (extension) ---
    'G462' => 'Alimentacion', // venta al por mayor de materias primas agropecuarias (granos, semillas, frutas, flores, animales vivos)
    'G463' => 'Alimentacion', // venta al por mayor de alimentos (lacteos, carnes, pescado, bebidas, abarrotes)
    'G472' => 'Alimentacion', // venta al por menor de alimentos en establecimientos especializados (frutas, lacteos, carnes, panaderia, bebidas)
    'I559' => 'Hospedaje', // residencias estudiantiles, albergues, coches cama
    'I562' => 'Alimentacion', // catering/banquetes, concesiones de comida
    'I563' => 'Alimentacion', // bares, cafes, preparacion de bebidas para consumo inmediato
    'G478100' => 'Alimentacion', // venta al por menor de alimentos/bebidas/tabaco en puestos de mercado
    'G4663' => 'Ferreteria y Materiales', // materiales de construccion al por mayor (madera, pintura, vidrio, sanitarios)
    'G4761' => 'Papeleria y Oficina', // venta al por menor de libros, periodicos, revistas
    'G4652' => 'Tecnologia', // componentes electronicos, telefonos, medios magneticos al por mayor
    'G477311' => 'Tecnologia', // equipo fotografico
    'G474200' => 'Electrodomesticos y Electronica', // venta al por menor de radio/TV/estereo
    'G475905' => 'Electrodomesticos y Electronica', // venta al por menor de electrodomesticos
    'G477312' => 'Salud y Asistencia Medica', // opticas
    'Q87' => 'Salud y Asistencia Medica', // residencias de ancianos, atencion con alojamiento
    'Q88' => 'Salud y Asistencia Medica', // asistencia social sin alojamiento (discapacidad, ninez)
    'M732' => 'Publicidad y Marketing', // estudios de mercado, encuestas de opinion
    'J582' => 'Software y Servicios Digitales', // publicacion de software comercial
    'M701' => 'Honorarios Profesionales', // gestion/holding de otras unidades de la misma empresa
    'M712' => 'Honorarios Profesionales', // ensayos y analisis tecnicos de laboratorio
    'M721' => 'Honorarios Profesionales', // investigacion y desarrollo cientifico (ciencias naturales/ingenieria)
    'M722' => 'Honorarios Profesionales', // investigacion y desarrollo cientifico (ciencias sociales/humanidades)

    // --- Maquinaria y Equipo Industrial (categoria nueva) ---
    'G4653' => 'Maquinaria y Equipo Industrial', // venta al por mayor de maquinaria agropecuaria
    'G4659' => 'Maquinaria y Equipo Industrial', // venta al por mayor de maquinaria industrial/oficina diversa
    'G4662' => 'Maquinaria y Equipo Industrial', // venta al por mayor de metales y minerales

    // --- Insumos Quimicos e Industriales (categoria nueva) ---
    'G4669' => 'Insumos Quimicos e Industriales', // quimicos industriales, plasticos primarios, papel/carton mayoreo, chatarra/reciclaje
    'G477322' => 'Insumos Quimicos e Industriales', // venta al por menor de fertilizantes, balanceados y abonos

    // --- Hogar y Decoracion (categoria nueva) ---
    'G4751' => 'Hogar y Decoracion', // telas, merceria, textiles de hogar
    'G4753' => 'Hogar y Decoracion', // alfombras, cortinas, papel tapiz
    'G4759' => 'Hogar y Decoracion', // muebles, iluminacion, utensilios domesticos
    'G477321' => 'Hogar y Decoracion', // venta al por menor de flores y plantas

    // --- Entretenimiento y Recreacion (categoria nueva) ---
    'G4762' => 'Entretenimiento y Recreacion', // musica y video al por menor
    'G4763' => 'Entretenimiento y Recreacion', // articulos deportivos al por menor
    'G4764' => 'Entretenimiento y Recreacion', // juegos y juguetes al por menor
    'G477392' => 'Entretenimiento y Recreacion', // galerias de arte comerciales
    'G477396' => 'Entretenimiento y Recreacion', // productos para fiestas infantiles

    // --- Medios y Comunicacion (categoria nueva) ---
    'J581' => 'Medios y Comunicacion', // edicion/publicacion de libros, periodicos, revistas
    'J591' => 'Medios y Comunicacion', // produccion audiovisual (cine, video, TV)
    'J592' => 'Medios y Comunicacion', // grabacion y edicion de sonido/musica
    'J601' => 'Medios y Comunicacion', // radiodifusion
    'J602' => 'Medios y Comunicacion', // television
    'J639' => 'Medios y Comunicacion', // agencias de noticias y servicios de informacion

    // --- Alquiler de Bienes Muebles y Equipo (categoria nueva) ---
    'N771' => 'Alquiler de Bienes Muebles y Equipo', // alquiler de vehiculos sin conductor
    'N772' => 'Alquiler de Bienes Muebles y Equipo', // alquiler de bienes personales/domesticos
    'N773' => 'Alquiler de Bienes Muebles y Equipo', // alquiler de maquinaria/equipo industrial sin operador

    // --- Propiedad Intelectual y Regalias (categoria nueva) ---
    'N774' => 'Propiedad Intelectual y Regalias', // arrendamiento de PI, franquicias, regalias

    // --- Recursos Humanos y Reclutamiento (categoria nueva) ---
    'N781' => 'Recursos Humanos y Reclutamiento', // seleccion y colocacion de personal
    'N782' => 'Recursos Humanos y Reclutamiento', // suministro de trabajadores temporales
    'N783' => 'Recursos Humanos y Reclutamiento', // tercerizacion de recursos humanos

    // --- Turismo y Agencias de Viaje (categoria nueva) ---
    'N791' => 'Turismo y Agencias de Viaje', // agencias de viaje
    'N799' => 'Turismo y Agencias de Viaje', // operadores turisticos, reservas, boletos, guias

    // --- Servicios de Apoyo Empresarial (BPO) (categoria nueva) ---
    'N811' => 'Servicios de Apoyo Empresarial (BPO)', // servicios combinados de apoyo en instalaciones del cliente
    'N821' => 'Servicios de Apoyo Empresarial (BPO)', // servicios administrativos de oficina, secretaria, fotocopiado
    'N822' => 'Servicios de Apoyo Empresarial (BPO)', // call centers
    'N823' => 'Servicios de Apoyo Empresarial (BPO)', // organizacion de eventos/ferias
    'N829' => 'Servicios de Apoyo Empresarial (BPO)', // cobro de deudas, envasado/empaquetado, otros apoyo empresarial

    // --- Jardineria y Paisajismo (categoria nueva) ---
    'N813' => 'Jardineria y Paisajismo', // plantacion, cuidado y mantenimiento de parques y jardines

    // --- Combustible (extension) ---
    'G477393' => 'Combustible', // venta al por menor de gas domestico, carbon y leña

    // --- Telecomunicaciones (extension) ---
    'G477395' => 'Telecomunicaciones', // venta al por menor de recargas y tarjetas electronicas

    // --- Comercio Minorista Especializado (extension) ---
    'G477391' => 'Comercio Minorista Especializado', // recuerdos, sellos, monedas, articulos religiosos, artesania
    'G477394' => 'Comercio Minorista Especializado', // relojes y joyas
    'G477399' => 'Comercio Minorista Especializado', // productos no alimenticios n.c.p. (limpieza, armas)
    'G477401' => 'Comercio Minorista Especializado', // libros de segunda mano
    'G477402' => 'Comercio Minorista Especializado', // antiguedades
    'G477403' => 'Comercio Minorista Especializado', // casas de empeño
    'G477409' => 'Comercio Minorista Especializado', // otros articulos de segunda mano, casas de subastas
    'G478900' => 'Comercio Minorista Especializado', // otros articulos en puestos de mercado
    'G479100' => 'Comercio Minorista Especializado', // venta por correo/internet/catalogo/TV
    // --- Comercio Minorista Especializado (nueva, ya existia en la lista original) ---
    'G4799' => 'Comercio Minorista Especializado', // venta al por menor por comisionistas / casas de subastas
    'G4719' => 'Comercio Minorista Especializado', // venta al por menor gran variedad de productos, no predominan alimenticios (bazares/tiendas variadas)
    'G464'  => 'Comercio Minorista Especializado', // venta al por mayor de articulos de bazar en general
    'G469'  => 'Comercio Minorista Especializado', // venta al por mayor de diversos productos sin especializacion

    // --- Manufactura y Produccion (catch-all generico ya existente) ---
    'C2592' => 'Manufactura y Produccion', // servicios de maquinado de metales por contrato (subcontratista industrial)
    'C332001' => 'Manufactura y Produccion', // servicios de instalacion de maquinaria industrial en plantas industriales

    // --- Construccion y Obra Civil (categoria nueva) ---
    'F41' => 'Construccion y Obra Civil', // construccion de edificios residenciales y no residenciales
    'F42' => 'Construccion y Obra Civil', // obras de ingenieria civil
    'F43' => 'Construccion y Obra Civil', // actividades especializadas de construccion: pintura, electricidad, plomeria, iluminacion, ceramicas, puertas, etc.

    // --- Servicios Basicos (Agua/Luz) (extension) ---
    'D352' => 'Servicios Basicos (Agua/Luz)', // produccion, transporte y distribucion de gas por tuberia
    'D353' => 'Servicios Basicos (Agua/Luz)', // suministro de vapor, agua caliente, aire/agua refrigerada
    'E370' => 'Servicios Basicos (Agua/Luz)', // alcantarillado y tratamiento de aguas residuales

    // --- Gestion de Desechos y Reciclaje (categoria nueva) ---
    'E381' => 'Gestion de Desechos y Reciclaje', // recoleccion de desechos no peligrosos y peligrosos
    'E382' => 'Gestion de Desechos y Reciclaje', // rellenos sanitarios, tratamiento de desechos organicos/peligrosos
    'E383' => 'Gestion de Desechos y Reciclaje', // procesamiento y recuperacion de materiales reciclables
    'E390' => 'Gestion de Desechos y Reciclaje', // descontaminacion de suelos, aguas e instalaciones

    // --- Almacenamiento y Bodegaje (categoria nueva) ---
    'H521' => 'Almacenamiento y Bodegaje', // silos, bodegas, camaras frigorificas, tanques de almacenamiento

    // --- Entretenimiento y Recreacion (extension de la ya creada) ---
    'R9' => 'Entretenimiento y Recreacion', // artes escenicas, museos/bibliotecas, loterias/casinos, deportes, parques recreativos

    // --- Agricultura y Ganaderia (categoria nueva) ---
    'A01' => 'Agricultura y Ganaderia', // cultivos (cereales, hortalizas, frutas, flores), cria de animales, explotacion mixta, apoyo agricola/pecuario, caza

    // --- Silvicultura y Actividades Forestales (categoria nueva) ---
    'A02' => 'Silvicultura y Actividades Forestales', // viveros forestales, extraccion de madera, recoleccion de materiales silvestres

    // --- Jardineria y Paisajismo (extension de la ya creada) ---
    'A024004' => 'Jardineria y Paisajismo', // planificacion, diseno y cuidado de prados y jardines
    'A024005' => 'Jardineria y Paisajismo', // actividades fitosanitarias para arboles y arbustos ornamentales

    // --- Pesca y Acuicultura (categoria nueva) ---
    'A03' => 'Pesca y Acuicultura', // pesca maritima/agua dulce, acuicultura, camaroneras, criaderos de peces

    // --- Combustible (extension) ---
    'B06' => 'Combustible', // extraccion de petroleo crudo y gas natural

    // --- Mineria y Extraccion (categoria nueva) ---
    'B05' => 'Mineria y Extraccion', // extraccion de carbon de piedra y lignito
    'B07' => 'Mineria y Extraccion', // extraccion de minerales metaliferos (hierro, uranio, metales preciosos)
    'B08' => 'Mineria y Extraccion', // extraccion de otros minerales no metalicos (piedra, arena, sal, yeso)
    'B09' => 'Mineria y Extraccion', // servicios de apoyo a la extraccion minera y de canteras

    // --- Alimentacion (extension: fabricacion de alimentos, bebidas y tabaco) ---
    'C10' => 'Alimentacion', // elaboracion de carnes, pescado, frutas/hortalizas, aceites, lacteos, molineria, panaderia, azucar, cacao/chocolate, pastas, comidas preparadas, condimentos
    'C11' => 'Alimentacion', // elaboracion de bebidas alcoholicas destiladas/fermentadas, cerveza, bebidas no alcoholicas, agua embotellada, hielo
    'C12' => 'Alimentacion', // elaboracion de productos de tabaco

    // --- Veterinaria y Mascotas (extension) ---
    'C108001' => 'Veterinaria y Mascotas', // elaboracion de alimentos preparados para mascotas (perros, gatos, peces)

    // --- Agricultura y Ganaderia (extension) ---
    'C108002' => 'Agricultura y Ganaderia', // fabricacion de alimentos/balanceados para animales de granja
    'C108003' => 'Agricultura y Ganaderia', // servicios de apoyo a la elaboracion de alimentos para animales
    // --- Vestimenta y Calzado (extension: fabricacion textil/confeccion/cuero/calzado) ---
    'C13' => 'Vestimenta y Calzado', // fabricacion de hilados, tejidos, tapices, cuerdas y otros articulos textiles
    'C14' => 'Vestimenta y Calzado', // confeccion de prendas de vestir, ropa interior, sastreria a medida, gorros/sombreros
    'C15' => 'Vestimenta y Calzado', // curtido de cueros, fabricacion de maletas/bolsos/talabarteria y calzado

    // --- Ferreteria y Materiales (extension: fabricacion de productos de madera) ---
    'C16' => 'Ferreteria y Materiales', // aserrio, tableros, puertas/ventanas de madera, envases y paletas de madera, articulos de corcho/mimbre

    // --- Papeleria y Oficina (extension: fabricacion de pasta/papel/carton) ---
    'C17' => 'Papeleria y Oficina', // pasta de madera, papel, carton, envases de carton, papel higienico, cuadernos, sobres, articulos de papeleria

    // --- Medios y Comunicacion (extension: imprentas y reproduccion) ---
    'C18' => 'Medios y Comunicacion', // impresion de libros/periodicos/publicidad, encuadernacion, reproduccion de discos/CD/DVD

    // --- Combustible (extension: coque y refinacion de petroleo) ---
    'C191' => 'Combustible', // hornos de coque, brea, alquitranes
    'C192' => 'Combustible', // combustibles para motores, biocombustibles, gases de refineria

    // --- Insumos Quimicos e Industriales (extension) ---
    'C20' => 'Insumos Quimicos e Industriales', // quimicos basicos, abonos, plasticos primarios, caucho sintetico, pinturas, jabones/detergentes, fibras sinteticas
    'C222' => 'Insumos Quimicos e Industriales', // fabricacion de productos y semimanufacturas de plastico

    // --- Farmacia (extension: dentro del mismo grupo quimico C20) ---
    'C202331' => 'Farmacia', // fabricacion de perfumes y cosmeticos
    'C202332' => 'Farmacia', // fabricacion de productos para peluqueria y cuidado del cabello
    'C202339' => 'Farmacia', // fabricacion de dentifricos y productos de higiene bucal/dental

    // --- Repuestos y Accesorios (extension: caucho, principalmente neumaticos) ---
    'C221' => 'Repuestos y Accesorios', // neumaticos, llantas, camaras, bandas de rodadura

    // --- Ferreteria y Materiales (extension: vidrio, ceramica, cemento, hormigon, piedra) ---
    'C23' => 'Ferreteria y Materiales', // vidrio, ceramica, ladrillos, cemento, cal, yeso, hormigon, piedra, abrasivos
    // --- Maquinaria y Equipo Industrial (extension: metalurgia basica) ---
    'C24' => 'Maquinaria y Equipo Industrial', // industria basica de hierro/acero, metales preciosos, metales no ferrosos, fundicion

    // --- Ferreteria y Materiales (extension: productos elaborados de metal) ---
    'C25' => 'Ferreteria y Materiales', // estructuras metalicas, tanques, calderas, cuchilleria, herramientas de mano, cerraduras, tornilleria, articulos de metal domesticos

    // --- Tecnologia (extension: electronica, computadoras, instrumentos de medicion) ---
    'C26' => 'Tecnologia', // componentes electronicos, computadoras, equipo de comunicaciones, instrumentos de medicion/optica, relojes, medios magneticos

    // --- Electrodomesticos y Electronica (extension) ---
    'C264' => 'Electrodomesticos y Electronica', // fabricacion de TV, video, equipos de audio/sonido
    'C274' => 'Electrodomesticos y Electronica', // fabricacion de lamparas y equipo de iluminacion

    // --- Salud y Asistencia Medica (extension) ---
    'C266' => 'Salud y Asistencia Medica', // fabricacion de equipo electromedico (marcapasos, audifonos, equipo de electrodiagnostico)

    // --- Maquinaria y Equipo Industrial (extension) ---
    'C27' => 'Maquinaria y Equipo Industrial', // motores, generadores, transformadores, baterias, cables, dispositivos de cableado electrico
    'C28' => 'Maquinaria y Equipo Industrial', // maquinaria de uso general y especial: bombas, valvulas, cojinetes, hornos, elevadores, herramientas motorizadas, maquinaria agricola/minera/textil/alimentos/imprenta
    'C30' => 'Maquinaria y Equipo Industrial', // otro equipo de transporte: buques, material ferroviario, aeronaves, vehiculos militares, motocicletas, bicicletas

    // --- Venta de Vehiculos automotores (extension) ---
    'C29' => 'Venta de Vehiculos automotores', // fabricacion de automoviles, camiones, carrocerias, remolques

    // --- Repuestos y Accesorios (extension) ---
    'C293' => 'Repuestos y Accesorios', // fabricacion de partes, piezas y accesorios para vehiculos automotores

    // --- Hogar y Decoracion (extension) ---
    'C310' => 'Hogar y Decoracion', // fabricacion de muebles de madera, metal, plastico y otros materiales

    // --- Comercio Minorista Especializado (extension) ---
    'C321' => 'Comercio Minorista Especializado', // fabricacion de joyas, orfebreria, bisuteria
    'C329' => 'Comercio Minorista Especializado', // otras manufacturas diversas: sellos, botones, encendedores, paraguas, ataudes, velas, articulos de broma

    // --- Entretenimiento y Recreacion (extension) ---
    'C322' => 'Entretenimiento y Recreacion', // fabricacion de instrumentos musicales
    'C323' => 'Entretenimiento y Recreacion', // fabricacion de articulos deportivos
    'C324' => 'Entretenimiento y Recreacion', // fabricacion de juegos y juguetes

    // --- Salud y Asistencia Medica (extension) ---
    'C325' => 'Salud y Asistencia Medica', // instrumentos y equipo medico/odontologico, equipo quirurgico, productos oftalmicos

    // --- Papeleria y Oficina (extension) ---
    'C329012' => 'Papeleria y Oficina', // fabricacion de plumas y lapices

    // --- Limpieza (extension) ---
    'C329032' => 'Limpieza', // fabricacion de escobas y cepillos

    // --- Maquinaria y Equipo Industrial (extension) ---
    'C331' => 'Maquinaria y Equipo Industrial', // reparacion y mantenimiento de maquinaria/equipo industrial, buques, aeronaves, trenes, equipo electrico

    // --- Manufactura y Produccion (extension) ---
    'C332' => 'Manufactura y Produccion', // servicios de instalacion y desmantelamiento de maquinaria industrial en gran escala

    // --- Administracion Publica (categoria nueva) ---
    'O84' => 'Administracion Publica', // funciones ejecutivas/legislativas, hacienda, aduanas, relaciones exteriores, defensa, policia, justicia, seguridad social publica

    // --- Servicios de Apoyo Empresarial (BPO) (extension) ---
    'S941' => 'Servicios de Apoyo Empresarial (BPO)', // asociaciones empresariales, profesionales y cientificas (gremios, colegios profesionales)
    'S942' => 'Recursos Humanos y Reclutamiento', // sindicatos y defensa de intereses laborales

    // --- Servicios Comunitarios y Religiosos (categoria nueva) ---
    'S949' => 'Servicios Comunitarios y Religiosos', // organizaciones religiosas, politicas, civiles, clubes, asociaciones diversas

    // --- Reparacion y Mantenimiento de Bienes de Consumo (categoria nueva) ---
    'S951' => 'Reparacion y Mantenimiento de Bienes de Consumo', // reparacion de computadoras y equipo de comunicaciones
    'S952' => 'Reparacion y Mantenimiento de Bienes de Consumo', // reparacion de electrodomesticos, calzado, muebles, bicicletas, joyas, ropa

    // --- Limpieza (extension) ---
    'S960101' => 'Limpieza', // lavado y limpieza en seco, planchado
    'S960102' => 'Limpieza', // lavado de alfombras y tapices
    'S960103' => 'Limpieza', // suministro de ropa blanca y uniformes (lavanderias)
    'S960104' => 'Limpieza', // teñido de prendas

    // --- Entretenimiento y Recreacion (extension) ---
    'S960200' => 'Entretenimiento y Recreacion', // peluquerias y salones de belleza
    'S960901' => 'Entretenimiento y Recreacion', // spas, saunas, salones de masaje
    'S960902' => 'Entretenimiento y Recreacion', // astrologia y espiritismo
    'S960903' => 'Entretenimiento y Recreacion', // clubes nocturnos
    'S960904' => 'Entretenimiento y Recreacion', // actividades de relacion social/citas

    // --- Veterinaria y Mascotas (extension) ---
    'S960905' => 'Veterinaria y Mascotas', // residencias, peluquerias, paseo y adiestramiento de animales

    // --- Servicios Comunitarios y Religiosos (extension) ---
    'S960906' => 'Servicios Comunitarios y Religiosos', // organizaciones genealogicas

    // --- Comercio Minorista Especializado (extension) ---
    'S960907' => 'Comercio Minorista Especializado', // limpiabotas, porteadores, estacionamiento de vehiculos
    'S960908' => 'Comercio Minorista Especializado', // maquinas de servicios personales accionadas con monedas (fotomatones, basculas)

    // --- Funerarias y Servicios Mortuorios (categoria nueva) ---
    'S9603' => 'Funerarias y Servicios Mortuorios', // sepultura, incineracion, alquiler/venta de tumbas, mantenimiento de mausoleos

    // ============================================================
    // FASE 2 - Codigos que existen en el catalogo del SRI pero que,
    // por su naturaleza, NO representan un proveedor/gasto real
    // (empleados en relacion de dependencia, hogares, organismos
    // internacionales, sin actividad, o codigo de error del SRI).
    // Se dejan explicitos en "Sin clasificar" a proposito, para que
    // quede documentado que fueron revisados y no que se omitieron.
    // ============================================================

'9999999' => 'Sin clasificar', // codigo "VERIFICAR" -- placeholder/error del propio catalogo del SRI (este si se queda asi, no es una actividad real)

    // --- Servicio Domestico (categoria nueva) ---
    'T97' => 'Servicio Domestico', // personal domestico: sirvientes, cocineros, choferes, jardineros, ninneras, etc.
    'T982' => 'Servicio Domestico', // hogares como productores de servicios de subsistencia: cocina, ensenanza, cuidado familiar

    // --- Agricultura y Ganaderia (extension) ---
    'T981' => 'Agricultura y Ganaderia', // hogares como productores de bienes de subsistencia: caza, agricultura, construccion de vivienda propia, confeccion propia

    // --- Administracion Publica (extension) ---
    'U99' => 'Administracion Publica', // organismos internacionales (ONU, FMI, Banco Mundial) y misiones diplomaticas/consulares

    // --- Comercio Minorista Especializado (extension, catch-all) ---
    'V03' => 'Comercio Minorista Especializado', // RUC sin actividad economica especifica declarada -- mejor esfuerzo, suele ser proveedor informal/ocasional

    // --- Honorarios Profesionales (extension) ---
    'V03000002' => 'Honorarios Profesionales', // herederos -- procesos sucesorios, suele implicar gestion legal/notarial
    'W20' => 'Honorarios Profesionales', // servicios ocasionales facturados por personas bajo relacion de dependencia -- sector privado
    'X25' => 'Honorarios Profesionales', // servicios ocasionales facturados por personas bajo relacion de dependencia -- sector publico
];
