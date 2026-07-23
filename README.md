# 📋 SICTEC — Sistema Inteligente de Clasificación Tributaria y Contable

**Herramienta local para clasificar facturas del SRI por categoría de gasto, a partir de un archivo Excel/CSV.**

> El usuario sube un archivo con facturas (columna `RUC_EMISOR`). El sistema deduplica los RUC, consulta la actividad económica de cada uno en el SRI, la mapea a una categoría de gasto (Combustible, Repuestos, Farmacia, etc.) mediante un diccionario de reglas, y devuelve el mismo archivo con una columna `ACTIVIDAD_ECONOMICA` agregada, lista para descargar.

**👤 Uso:** 1-2 usuarios, entorno local vía Docker. Sin dashboard, sin histórico entre archivos, sin autenticación — cada archivo se procesa de forma independiente.

---

## 🛠️ Stack tecnológico

| Capa | Tecnología | Detalles |
|:---|:---|:---|
| **Frontend** | ⚛️ React 19 + Vite | SPA, upload de archivo + progreso + descarga |
| **Server state** | 📡 React Query | Polling del estado del lote en proceso |
| **Routing** | 🧭 React Router v6 | Rutas para navegación |
| **Formularios** | 📋 React Hook Form + Zod | Validación del formulario de subida |
| **Estado local** | 🐻 Zustand | Estado de UI ligero |
| **Lenguaje** | 📘 TypeScript estricto | `strict: true` |
| **Backend** | 🐘 Laravel 13 | API REST + Jobs para consulta masiva al SRI |
| **PHP** | 🐘 PHP 8.4 | Mínimo requerido por Laravel 13 |
| **Base de datos** | 🐘 PostgreSQL 16 | Solo para la cola de Jobs (`QUEUE_CONNECTION=database`) — no hay histórico de facturas |
| **Queue** | 🗄️ Laravel Queue (driver `database`) | Un Job por RUC único, agrupados con `Bus::batch()` |
| **Excel/CSV** | 📊 maatwebsite/excel | Lectura y escritura de `.xlsx`/`.xls`/`.csv` |
| **Consulta SRI** | 🌐 HTTP Client de Laravel | Petición directa al endpoint del SRI (sin scraping, sin cookie/token) |
| **Contenedores** | 🐳 Docker + Docker Compose | Orquestación local |

---

## 🏗️ Estructura del proyecto

```
sictec/
├── api/                                      # 🐘 Backend Laravel
│   ├── app/
│   │   ├── Http/
│   │   │   └── Controllers/
│   │   ├── Jobs/
│   │   │   └── ConsultarRucJob.php
│   │   ├── Services/
│   │   │   ├── SriConsultaService.php
│   │   │   └── ClasificadorService.php
│   │   └── Models/
│   ├── config/
│   │   └── categorias.php                   # Diccionario actividad → categoría
│   ├── database/
│   │   └── migrations/
│   ├── routes/
│   │   └── api.php
│
├── web/                                      # ⚛️ Frontend React + Vite
│   ├── src/
│   │   ├── components/
│   │   ├── features/
│   │   │   └── upload/
│   │   ├── hooks/
│   │   ├── lib/
│   │   └── services/
│
├── docker/                                   # 🐳 Dockerfiles
│   ├── api/
│   │   └── Dockerfile
│   └── web/
│       └── Dockerfile
├── docker-compose.yaml
├── .env.example
└── README.md
```

---

## ⚙️ Variables de entorno

Copia `.env.example` a `.env` en la raíz del proyecto y ajusta los valores.

```bash
cp .env.example .env
```

`APP_KEY` se genera después de levantar el contenedor por primera vez (ver comandos útiles).

---

## 🚀 Levantar el proyecto

```bash
docker compose up --build -d
```

### 🌐 URLs disponibles

| Servicio | URL |
|:---|:---|
| 🖥️ Frontend | http://localhost:3001 |
| 🐘 API | http://localhost:8000 |

### 🔧 Comandos útiles

```bash
# Generar APP_KEY (primera vez, con el contenedor ya levantado)
docker exec -it sictec_api php artisan key:generate --show
# Copiar el valor devuelto dentro de APP_KEY en el .env, y reiniciar:
docker compose restart api worker

# Ver logs de un servicio
docker compose logs -f api
docker compose logs -f worker

# Acceder al contenedor de la API
docker exec -it sictec_api sh

# Correr migraciones manualmente
docker exec -it sictec_api php artisan migrate

# Detener sin eliminar volúmenes
docker compose stop
```

---

## 📡 Endpoints de la API

```
👤 Consulta RUC en SRI
  GET   /api/sri/valida/{ruc}        # Valida RUC mediante API del SRI
  GET   /api/sri/consulta/{ruc}      # Consulta RUC mediante API del SRI

📤 Lotes
  POST   /api/lotes                  # Sube el Excel/CSV, dispara el batch de Jobs
  GET    /api/lotes/{id}             # Estado del batch (procesados / total)
  GET    /api/lotes/{id}/descargar   # Descarga el archivo con la columna ACTIVIDAD_ECONOMICA agregada

❤️ Health
  GET    /up                         #Ruta proporcionada por Laravel
```

---

## 🧭 Decisiones técnicas

### 📄 Un solo `.env` en la raíz
Docker Compose lo inyecta en los contenedores `api`, `worker` y `web` mediante el bloque YAML anclado (`&api_env`), evitando duplicar las mismas variables entre servicios.

### 🔗 Symlink de `.env` dentro de `api/`
Laravel busca `.env` en la raíz de su propio directorio (`api/.env`) cuando se ejecuta localmente sin Docker (por ejemplo, para correr `artisan` o `composer` sueltos). Para evitar duplicar variables entre el `.env` raíz y uno propio de `api/`, se crea un symlink:
```bash
cd api
ln -s ../.env .env
```
Esto no afecta a Docker: dentro de los contenedores las variables llegan vía `environment: &api_env` en `docker-compose.yaml`, no por lectura de archivo. El symlink es solo para conveniencia en desarrollo local fuera de contenedores.

### 🚫 Sin Redis
Con 1-2 usuarios y unos cientos/miles de RUC por lote, el driver `database` de Laravel Queue es suficiente. Se evita un servicio adicional que mantener; se puede migrar a Redis después sin reescribir los Jobs, solo cambiando `QUEUE_CONNECTION`.

### 🧑‍🏭 Worker en un contenedor separado
El procesamiento de la cola (`php artisan queue:work`) corre en su propio servicio (`worker`), no como proceso en segundo plano dentro del contenedor de la API. Así, si el worker falla, Docker lo reinicia de forma independiente (`restart: unless-stopped`) sin afectar la disponibilidad de la API.

### 🚫 Sin caché persistente de RUC entre archivos
El alcance real del proyecto es transformar un archivo por corrida (Excel entra → Excel con columna de categoría sale), sin dashboard ni histórico acumulado. La deduplicación de RUC ocurre solo dentro de la misma corrida (batch de Jobs), no persiste entre archivos distintos.

### 🗂️ Motor de clasificación por diccionario, sin IA
La clasificación de `actividadEconomicaPrincipal` → categoría de gasto se resuelve con un diccionario de palabras clave (`config/categorias.php`), sin depender de un modelo de IA externo. Se descartó el uso de IA para mantener el sistema 100% predecible, gratuito y sin dependencia de servicios de terceros.

## 🔐 Autenticación de la API

Los endpoints bajo `/api/*` (excepto `/api/health`) requieren el header `X-API-KEY`.

En **desarrollo local**, el frontend no maneja la key directamente: el proxy
de Vite la inyecta a cada petición antes de reenviarla a Laravel, así el
valor nunca llega al navegador ni queda expuesto en el bundle de JS. La key
vive solo en variables de entorno del proceso Node (`SICTEC_API_KEY`), no en
variables `VITE_*` (esas sí terminan visibles en el cliente).

**Fuera de este entorno de desarrollo** (si se sirve la app detrás de un
proxy real como Nginx, o el frontend deja de correr con `vite dev`), este
mecanismo no aplica — el header tendría que inyectarse en ese proxy en su
lugar, o resolverse en el backend que sirve el frontend.

---

## 📋 Estado del proyecto

Este proyecto está en desarrollo activo como parte de un portafolio de ingeniería de software. La arquitectura, decisiones de diseño y progreso de implementación están documentados en el historial de commits.