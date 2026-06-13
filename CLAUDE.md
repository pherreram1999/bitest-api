# bitets-api

## Institución

**ESCOM** — Escuela Superior de Cómputo, **IPN** — Instituto Politécnico Nacional.

Usar en cualquier texto institucional, encabezados de PDF, reportes, o branding de la app.

## Stack

- **Framework:** Laravel 13.8
- **PHP:** 8.3
- **DB:** libSQL/Turso (`turso/libsql`, driver custom) — requiere PHP FFI (`extension=ffi`, `ffi.enable=true`)
  - Sin `TURSO_DATABASE_URL` → archivo local `database/database.db`
  - Con `TURSO_DATABASE_URL` + `TURSO_AUTH_TOKEN` → remoto Turso puro
  - `turso/libsql-laravel` no soporta Laravel 13 (sólo ^11|^12), por eso se
    registra a mano `DB::extend('libsql', …)` en `AppServiceProvider::boot`,
    devolviendo un `SQLiteConnection` con un `LibsqlPDO` propio.
  - `App\Database\LibsqlPDO` y `App\Database\LibsqlPDOStatement` envuelven
    al PDO de `turso/libsql` y difieren los `bindValue()` hacia `execute($params)`.
    Esto evita el segfault de FFI al bindear `null`/cadenas vacías con
    `PDO::PARAM_STR` (la `CharBox` de libsql deja el puntero sin inicializar
    para strings falsy y `bindValue` no maneja `PARAM_NULL`).
- **Auth:** Laravel Sanctum — personal access tokens (bearer)

## Dominio

Esquema académico (Peter Chen, bitets.pdf):

```
Carrera → UnidadAprendizaje (N unidades por carrera)
PlanEstudio → UnidadAprendizaje (N unidades por plan)
Edificio → Salon (N salones por edificio)
Area → Profesor (N profesores por área)
UnidadAprendizaje + Profesor + Salon + User → Examen
```

`Carrera` y `PlanEstudio` **no** tienen relación directa: se conocen entre sí a
través de `unidades_aprendizaje`, que actúa como puente (`carrera_id` + `plan_estudio_id`).

`unidades_aprendizaje`: `nombre`, `semestre` (TINYINT 1-12, nullable), `carrera_id`, `plan_estudio_id`.

## Autenticación

Todos los endpoints **excepto** `/api/v1/auth/register` y `/api/v1/auth/login`
requieren `Authorization: Bearer <token>`.

### Flow

```bash
# 1. Registrar (identificador es único: boleta para alumnos, clave para administrativos)
curl -X POST http://localhost:8000/api/v1/auth/register \
  -H 'Accept: application/json' \
  -H 'Content-Type: application/json' \
  -d '{"name":"Ada","email":"ada@x.mx","identificador":"20230042","password":"secret123","password_confirmation":"secret123"}'
# → {"user":{...},"token":"1|abc..."}

# 2. Login con identificador
curl -X POST http://localhost:8000/api/v1/auth/login \
  -H 'Accept: application/json' \
  -H 'Content-Type: application/json' \
  -d '{"identificador":"20230042","password":"secret123"}'
# → {"user":{...},"token":"1|abc..."}

# 3. Usar token
TOKEN="1|abc..."
curl http://localhost:8000/api/v1/carreras \
  -H "Authorization: Bearer $TOKEN" \
  -H 'Accept: application/json'

# 4. Logout (revoca token actual)
curl -X POST http://localhost:8000/api/v1/auth/logout \
  -H "Authorization: Bearer $TOKEN"
```

## Endpoints v1

| Método | Ruta | Auth | Descripción |
|--------|------|------|-------------|
| POST | `/api/v1/auth/register` | ❌ | Crear cuenta, obtener token |
| POST | `/api/v1/auth/login` | ❌ | Iniciar sesión, obtener token |
| POST | `/api/v1/auth/logout` | ✅ | Revocar token actual |
| GET | `/api/v1/auth/me` | ✅ | Usuario autenticado |
| GET/POST | `/api/v1/carreras` | ✅ | Listar / Crear |
| GET/PUT/DELETE | `/api/v1/carreras/{id}` | ✅ | Ver / Actualizar / Borrar (soft) |
| POST | `/api/v1/carreras/{id}/restore` | ✅ | Restaurar soft-deleted |
| GET/POST | `/api/v1/planes-estudio` | ✅ | |
| GET/PUT/DELETE | `/api/v1/planes-estudio/{id}` | ✅ | |
| POST | `/api/v1/planes-estudio/{id}/restore` | ✅ | |
| GET/POST | `/api/v1/unidades-aprendizaje` | ✅ | |
| GET/PUT/DELETE | `/api/v1/unidades-aprendizaje/{id}` | ✅ | |
| POST | `/api/v1/unidades-aprendizaje/{id}/restore` | ✅ | |
| GET/POST | `/api/v1/edificios` | ✅ | |
| GET/PUT/DELETE | `/api/v1/edificios/{id}` | ✅ | |
| POST | `/api/v1/edificios/{id}/restore` | ✅ | |
| GET/POST | `/api/v1/salones` | ✅ | |
| GET/PUT/DELETE | `/api/v1/salones/{id}` | ✅ | |
| POST | `/api/v1/salones/{id}/restore` | ✅ | |
| GET/POST | `/api/v1/areas` | ✅ | |
| GET/PUT/DELETE | `/api/v1/areas/{id}` | ✅ | |
| POST | `/api/v1/areas/{id}/restore` | ✅ | |
| GET/POST | `/api/v1/profesores` | ✅ | |
| GET/PUT/DELETE | `/api/v1/profesores/{id}` | ✅ | |
| POST | `/api/v1/profesores/{id}/restore` | ✅ | |
| GET/POST | `/api/v1/examenes` | ✅ | |
| GET/PUT/DELETE | `/api/v1/examenes/{id}` | ✅ | |
| POST | `/api/v1/examenes/{id}/restore` | ✅ | |

## Soft Deletes

Todos los modelos usan `SoftDeletes`. `DELETE` hace soft-delete, no purge.

Columnas únicas (`users.email`, `areas.email`, `profesores.email`) usan índice
compuesto `UNIQUE(email, deleted_at)` para permitir re-registro con el mismo
email tras soft-delete. Las validaciones usan `Rule::unique()->whereNull('deleted_at')`.

## Versionado

- Rutas bajo `/api/v{N}/...`
- Controllers en `app/Http/Controllers/Api/V{N}/`
- FormRequests en `app/Http/Requests/V{N}/{Modelo}/`
- Resources en `app/Http/Resources/V{N}/`
- Para añadir v2: crear nuevo namespace + `Route::prefix('v2')` en `routes/api.php`

## Estructura de archivos

```
app/
  Http/
    Controllers/Api/V1/     ← AuthController + 8 ResourceControllers
    Requests/V1/
      Auth/                  ← RegisterRequest, LoginRequest
      {Modelo}/              ← Store{Modelo}Request, Update{Modelo}Request
    Resources/V1/            ← {Modelo}Resource
  Models/                    ← 9 modelos con SoftDeletes + PHPDoc
database/
  migrations/                ← 9 tablas + personal_access_tokens
routes/
  api.php                    ← Rutas v1
```

## Panel Filament

**Filament es la interfaz principal del proyecto** — login, CRUDs y navegación se gestionan desde aquí por defecto.

URL: `/admin` — requiere `rol = admin`.

### Login

El login de Filament (`/admin/login`) usa `identificador` + `password`, igual que la API y el login web (Breeze). El campo de email del formulario estándar de Filament está reemplazado por `identificador` mediante `App\Filament\Pages\Auth\Login` (registrado en `AdminPanelProvider`).

### CRUDs

Vista de solo lectura para los 9 modelos — `canCreate/canEdit/canDelete = false`. Para crear o modificar datos usar la API REST (`/api/v1/...`) o tinker. Los CRUDs con escritura se agregan en Filament si se necesitan, no como endpoints adicionales.

### Usuarios de prueba (via seeder)

`php artisan migrate:fresh --seed` crea automáticamente:

| Identificador | Password | Rol | Acceso |
|---------------|----------|-----|--------|
| `admin` | `1205` | admin | `/admin` + `/dashboard` |
| `20230001` | `password` | alumno | solo `/dashboard` |

### Catálogo académico (via seeder)

- 1 carrera: **Ingeniería en Sistemas Computacionales**
- 1 plan: **ISC 2020** (2020-08-01 → 2030-12-31)
- **46 UAs obligatorias** del mapa curricular ISC 2020, con `semestre` 1-8 (50 celdas en el mapa, 4 son slots de optativa A1, A2, B1, B2 que se llenan desde el catálogo optativo)
- **24 UAs optativas** (catálogo) con `semestre = 6` por default, para los slots A1, A2, B1, B2 de semestres 6 y 7

Origen de los datos: `resources/docs/mapaCurricularISC2020.pdf` y
`resources/docs/mapaCurricularISC2020_optativas.pdf`.

### Grupos de navegación

| Grupo | Modelos |
|-------|---------|
| Auth | User |
| Académico | Carrera, PlanEstudio, UnidadAprendizaje |
| Infraestructura | Edificio, Salon |
| Personal | Area, Profesor |
| Evaluación | Examen |

### Estructura Filament

```
app/Filament/
  Pages/Auth/Login.php                  ← login custom (identificador en lugar de email)
  Resources/
    {Modelo}s/{Modelo}Resource.php      ← canCreate/canEdit/canDelete = false
    {Modelo}s/Pages/List{Modelo}.php    ← sin CreateAction
    {Modelo}s/Pages/View{Modelo}.php    ← sin EditAction
    {Modelo}s/Tables/{Modelo}sTable.php ← solo ViewAction, sin BulkActions
    {Modelo}s/Schemas/{Modelo}Form.php
    {Modelo}s/Schemas/{Modelo}Infolist.php
```

## Auth web (Breeze + Blade)

Frontend público en rutas web. Coexiste con Filament (`/admin`) y la API Sanctum.

| Ruta | Descripción |
|------|-------------|
| `GET /login` | Form login |
| `POST /login` | Submit login |
| `GET /register` | Form registro |
| `POST /register` | Submit registro |
| `GET /forgot-password` | Solicitar reset |
| `GET /dashboard` | Dashboard (requiere auth) |
| `GET /profile` | Editar perfil (requiere auth) |
| `POST /logout` | Logout web |

Stack: Tailwind v3 + Alpine.js + Vite (`npm run build`).

## OpenAPI / Spec para LLMs

Spec estático público (sin auth):

```
GET /api.json          → OpenAPI 3.1.0, 28 paths, 27 schemas
GET /docs/api          → UI Stoplight Elements (solo local, RestrictedDocsAccess)
```

Regenerar tras cambios de API:

```bash
php artisan scramble:export --path=public/api.json
```

Generador: `dedoc/scramble` v0.13 — infiere desde FormRequests + Resources + tipos de retorno.
Seguridad: `MiddlewareAuthSecurityStrategy` — rutas con `auth:sanctum` → bearer requerido; `auth/register` y `auth/login` → públicas.

> **Regla:** cada vez que cambie la API (nuevo endpoint, nuevo campo, cambio de validación) regenerar el spec:
> ```bash
> php artisan scramble:export --path=public/api.json
> ```

## Comandos

```bash
php artisan serve                         # Levantar servidor
php artisan migrate:fresh --seed          # Reset + recrear schema + seed admin
php artisan route:list --path=api         # Ver todas las rutas API
php artisan route:list --path=admin       # Ver rutas Filament
php artisan tinker                        # REPL
vendor/bin/pint                           # Formatear código
npm run build                             # Compilar assets Breeze
npm run dev                               # Servidor Vite (HMR)
```
