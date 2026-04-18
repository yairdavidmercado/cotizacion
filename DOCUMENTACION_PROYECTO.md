# Documentacion Tecnica del Proyecto CotiClick

Fecha de elaboracion: 2026-04-17

## 1. Resumen general

Este repositorio implementa una aplicacion web en PHP (estilo monolito clasico) para gestionar el ciclo comercial de cotizaciones y vouchers en agencias/hoteles.

El flujo principal del negocio es:

1. Login de usuario
2. Seleccion de hotel/agencia activa en sesion
3. Creacion y consulta de cotizaciones
4. Registro de abonos (vouchers)
5. Exportacion de reportes a Excel
6. Administracion de catalogos (usuarios, hoteles, tarifas, planes, productos, motivos, metodos de pago, terminos)

## 2. Stack tecnologico

### Backend
- PHP procedural (sin framework)
- MySQL/MariaDB via `mysqli`
- Sesiones PHP (`$_SESSION`) para autenticacion y contexto de hotel

### Frontend
- HTML + CSS + JavaScript/jQuery
- Bootstrap 4
- Select2
- DataTables
- DateRangePicker + Moment.js
- Gijgo datepicker
- Cropper.js
- html2pdf + pdfmake
- SweetAlert2 (con wrapper local)

### Reporteria
- Exportacion XLS por salida tabulada
- Libreria PHPExcel embebida en `php/reports/PHPExcel/`

## 3. Estructura del proyecto

## 3.1 Entradas principales (root)
- `index.php`: pantalla de login
- `welcome.php`: seleccion y administracion inicial de hoteles/agencias
- `cotizacion.php`: modulo central de cotizaciones (alojamiento/tour/alquiler)
- `voucher.php`: gestion de vouchers y abonos
- `empresas.php`: listado publico de empresas certificadas
- `register.php`: pantalla de registro (plantilla visual)
- `menu.php`: navbar dinamica por permisos de sesion
- `image-crop.php`: recorte simple de imagen JPEG

## 3.2 Carpetas de soporte
- `assets/`: CSS, JS e imagenes
- `partials/`: inclusiones compartidas (librerias y wrapper SweetAlert)
- `php/`: endpoints backend (seleccion, guardado, eliminacion, reportes)
- `views/`: modulos CRUD separados por dominio

## 3.3 Modulos en `views/`
- `views/hoteles/`
- `views/metodo_pago/`
- `views/motivos/`
- `views/panel_control/`
- `views/planes/`
- `views/productos/`
- `views/tarifas/`
- `views/terminos_condiciones/`
- `views/usuarios/`

Cada submodulo sigue patron similar:
- `index.php`: pagina principal
- `guardar_*.php`: insercion
- `editar_*.php`: actualizacion
- `*.php` adicional para listado o endpoints del modulo

## 3.4 Metricas de codigo detectadas
- Archivos PHP de aplicacion (sin PHPExcel): 59
- Archivos PHP totales incluyendo PHPExcel embebido: 399
- Archivos PHP de modulos `views/`: 38

## 4. Arquitectura funcional

## 4.1 Arquitectura logica
La aplicacion opera como monolito con capas acopladas:

1. Capa UI: paginas PHP con HTML/CSS/JS embebido
2. Capa AJAX: llamadas jQuery a scripts en `php/` o `views/*/*.php`
3. Capa datos: consultas SQL directas con `mysqli`
4. Capa estado: variables de sesion para usuario, permisos y hotel activo

No hay separacion estricta por servicios o repositorios. Las reglas de negocio se distribuyen entre frontend JS y scripts PHP.

## 4.2 Sesion y contexto de negocio
El sistema depende de estas variables de sesion:

- Identidad: `id`, `perfil`, `codigo`, nombres/apellidos
- Permisos: `menu_general` (modulos habilitados)
- Empresa global: `dbname`, `id_db`
- Hotel activo: `id_hotel`, `nombre_hotel`, `id_terminos`, direccion/telefono/pais/depto/email/avatar

El contexto de hotel se establece desde `php/sel_hotel.php` y condiciona casi todas las operaciones de cotizacion/voucher/reportes.

## 5. Flujos principales del sistema

## 5.1 Login y permisos
1. `index.php` envia `codigo=login` a `php/sel_usuarios.php`
2. `php/sel_usuarios.php` valida usuario, carga datos y construye `menu_general`
3. `menu.php` renderiza menu dinamico segun permisos de sesion

Observacion tecnica:
- La validacion de password usa `MD5` en SQL.

## 5.2 Seleccion de hotel/agencia
1. `welcome.php` consulta hoteles vinculados por usuario
2. Al seleccionar un hotel, se invoca `php/sel_hotel.php`
3. Se guarda el hotel en sesion y se habilita operacion en cotizacion/voucher

## 5.3 Cotizaciones
1. `cotizacion.php` permite multiples tipos por cotizacion master:
   - 1: Alojamiento
   - 2: Tour
   - 3: Alquiler
2. El frontend consulta catlogos y valores por `php/sel_recursos.php`
3. El guardado principal se hace por `fetch` a `php/guardar_cotizacion.php` (payload JSON)
4. Se inserta encabezado en `cotizacion_master` y detalles en `cotizacion`

## 5.4 Vouchers y abonos
1. `voucher.php` consulta cotizaciones y estado financiero por `php/sel_recursos.php`
2. Nuevo abono se guarda por `php/guardar_vauche.php`
3. Regla aplicada: primer abono exige numero de reserva
4. Se acumulan depositos para calcular saldo pendiente

## 5.5 Reportes
- `php/reports/reporte_excel.php`: relacion de ventas (modelo historico)
- `php/reports/reporte_excel_voucher.php`: reporte basado en `cotizacion_master` y acumulado de vouchers

## 6. Endpoints backend

## 6.1 Endpoints generales en `php/`
- `php/sel_usuarios.php`
  - `login`
- `php/sel_company.php`
  - `sel_empresas`
  - `loginCompany`
  - `card_empresas`
- `php/sel_hotel.php`
  - setea contexto de hotel en sesion
- `php/sel_recursos.php`
  - endpoint principal multifuncion (catalogos, cotizaciones, vouchers, tablas, permisos)
- `php/guardar_cotizacion.php`
  - guarda master + detalles en transaccion
- `php/guardar_vauche.php`
  - guarda abonos/vouchers
- `php/eliminar.php`
  - borrado logico (`activo=false`) + insercion en `auditoria`
- `php/cerrar_sesion.php`
  - cierra sesion

## 6.2 Operaciones detectadas en `php/sel_recursos.php`
- `traer_hotel`
- `card_hotel`
- `traer_titulares`
- `traer_tarifas`
- `traer_motivos`
- `traer_planes`
- `traer_productos`
- `traer_cotizacion`
- `traer_abonos_voucher`
- `traer_tabla_cotizacion`
- `traer_paises`
- `traer_deptos`
- `traer_terminos`
- `traer_metodo_pago`
- `traer_tabla_voucher`
- `traer_menu_acciones`
- `traer_perfiles`

Nota: este script concentra gran parte de la logica y es un punto critico del sistema.

## 7. Base de datos

## 7.1 Conexion y multi-base
- `php/conectCompany.php`: conecta a base global `coticlic_company`
- `php/conexion.php`: conecta a base del cliente usando `$_SESSION['dbname']`
- Host/credenciales actuales en codigo:
  - host: `host.docker.internal`
  - user/pass: `root/root`
  - port: `3306`

## 7.2 Evolucion del modelo de cotizaciones
Se observa migracion a esquema master-detalle:

- `new_data_base.sql`:
  - crea tabla `cotizacion_master`
  - agrega `id_principal` en `cotizacion`
  - agrega `tipo_cotizacion` en `cotizacion`
  - define FK opcional `cotizacion -> cotizacion_master`
  - agrega `id_tipo_plan` en `planes`

- `migration_cotizacion_master.sql`:
  - migra cotizaciones antiguas sin `id_principal`
  - crea registros master historicos
  - actualiza `tipo_cotizacion` historico
  - incluye consultas de verificacion post-migracion

## 7.3 Entidades funcionales relevantes (inferidas por consultas)
- usuarios
- empresas
- hoteles
- permiso_hotel
- cotizacion_master
- cotizacion
- vaucher
- tarifas
- planes
- tipo_plan
- productos
- motivos
- terminos_condiciones
- metodo_pago
- pais
- estado
- auditoria
- tablas de control de app (`app_modulos`, `app_perfil`, `app_permisos`, `app_accion`)

## 8. Frontend y UX

## 8.1 Navegacion
- Menu superior generado por `menu.php`
- Menus por rol/perfil cargados en login
- Bloqueo de paginas por sesion y hotel activo

## 8.2 Componentes de UI destacados
- Formularios multiparte de cotizacion por tipo de servicio
- Modales para creacion de clientes/hoteles
- DataTables para grillas administrativas
- Exportacion PDF en cotizacion/voucher
- Notificaciones unificadas via SweetAlert wrapper

## 8.3 Assets
`assets/` contiene librerias duplicadas o en multiples variantes (`jquery`, `bootstrap`, min/no-min), lo cual impacta mantenimiento y carga.

## 9. Seguridad y riesgos tecnicos

## 9.1 Riesgos observados
- SQL dinamico sin prepared statements en muchos endpoints
- Uso de `MD5` para password
- Credenciales de DB hardcodeadas
- Dependencia fuerte de sesion sin controles adicionales (CSRF/rate limiting no visibles)
- Endpoints multiproposito con alta complejidad (`sel_recursos.php`)
- Libreria PHPExcel embebida (legada y pesada)

## 9.2 Riesgos operativos
- Acoplamiento entre frontend y codigos string (`codigo=...`)
- Alta logica de negocio en scripts largos dificulta pruebas
- Falta de estructura de entorno (`.env`, composer, tests automatizados)

## 10. Hallazgos funcionales recientes (conocimiento del repo)

- En alquiler, la duracion debe guardarse en dias calculados (no `N/A`) y mostrarse como `X dia(s)`.
- En tablas/descripcion de tarifas, no ocultar fila cuando total=0 si cantidad > 0 (caso ninos gratis).
- Para reset de selects Tom Select en cotizacion, usar API de Tom Select (no solo `.val('').change()`).
- En reportes, evitar depender de `mysqli_stmt_get_result()` por compatibilidad de hosting sin `mysqlnd`.
- Notificaciones CRUD compartidas fueron centralizadas en `menu.php` para `views/*` y `welcome.php`.

## 11. Guia de puesta en marcha (entorno local)

## 11.1 Requisitos
- PHP 7.x/8.x con `mysqli`
- MySQL/MariaDB accesible desde `host.docker.internal:3306`
- Servidor web (Apache/Nginx o builtin de PHP)

## 11.2 Pasos sugeridos
1. Crear base global `coticlic_company` con tablas de usuarios/permisos/empresas
2. Crear base(s) de cliente y cargar esquema de negocio
3. Aplicar `new_data_base.sql` para estructura master-detalle
4. Ejecutar `migration_cotizacion_master.sql` si existen datos historicos
5. Configurar virtual host apuntando a la carpeta del proyecto
6. Iniciar sesion por `index.php`

## 12. Recomendaciones de evolucion

1. Migrar autenticacion a hash seguro (`password_hash/password_verify`)
2. Parametrizar todas las consultas SQL criticas
3. Mover configuracion a variables de entorno
4. Separar `sel_recursos.php` en endpoints por dominio
5. Agregar capa de servicios/repositorios y pruebas
6. Estandarizar assets (eliminar duplicados)
7. Documentar esquema DB completo (ERD + llaves foraneas)

## 13. Inventario resumido por areas

### Area comercial
- Cotizaciones multi-servicio
- Vouchers y abonos
- Reportes de ventas y saldos

### Area catalogos
- Hoteles/agencias
- Planes, productos y tarifas
- Motivos, metodos de pago, terminos
- Usuarios titulares y permisos de hotel

### Area control
- Panel de perfiles/modulos/acciones
- Borrado logico con auditoria

## 14. Conclusion

El proyecto es funcional y cubre todo el ciclo comercial principal de cotizacion a voucher con administracion de catalogos. Tecnologicamente es una base PHP/jQuery clasica y operativa, con un avance importante hacia modelo `cotizacion_master` para soportar cotizaciones compuestas. La principal oportunidad tecnica esta en seguridad, modularidad del backend y estandarizacion de infraestructura.
