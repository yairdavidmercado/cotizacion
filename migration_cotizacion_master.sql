-- =====================================================
-- SCRIPT DE MIGRACIÓN: Cotizaciones antiguas a cotizacion_master
-- Fecha: 12 de febrero de 2026
-- Descripción: Migra cotizaciones sin id_principal a la tabla cotizacion_master
-- =====================================================

-- PASO 1: Verificar cuántas cotizaciones necesitan migración
SELECT 
    COUNT(*) as total_a_migrar,
    'Cotizaciones sin id_principal que serán migradas' as descripcion
FROM cotizacion 
WHERE id_principal IS NULL OR id_principal = 0;

-- PASO 2: Ver una muestra de los datos a migrar (primeras 10)
SELECT 
    id,
    id_titular,
    id_hotel,
    cod_vendedor,
    activo,
    id_autor,
    fecha_expedicion,
    fecha_crea,
    tipo_cotizacion
FROM cotizacion 
WHERE id_principal IS NULL OR id_principal = 0
ORDER BY id DESC
LIMIT 10;

-- =====================================================
-- MIGRACIÓN PRINCIPAL
-- =====================================================

-- PASO 3: Insertar cotizaciones antiguas en cotizacion_master
-- Usamos el mismo ID de la cotización original como ID del master
INSERT INTO cotizacion_master (
    id,
    id_titular,
    id_hotel,
    cod_vendedor,
    estado,
    id_autor,
    created_at,
    update_at
)
SELECT 
    id,
    id_titular,
    id_hotel,
    cod_vendedor,
    activo,
    id_autor,
    fecha_expedicion,
    fecha_crea
FROM cotizacion
WHERE (id_principal IS NULL OR id_principal = 0)
AND id NOT IN (SELECT id FROM cotizacion_master);  -- Evitar duplicados

-- PASO 4: Actualizar el campo id_principal en cotizacion
-- Para que apunte al registro master correspondiente
-- Desactivar safe update mode temporalmente
SET SQL_SAFE_UPDATES = 0;

UPDATE cotizacion c
INNER JOIN cotizacion_master cm ON c.id = cm.id
SET c.id_principal = c.id
WHERE (c.id_principal IS NULL OR c.id_principal = 0);

-- Reactivar safe update mode
SET SQL_SAFE_UPDATES = 1;

-- PASO 4.5: Actualizar tipo_cotizacion en registros históricos
-- Todas las cotizaciones antiguas son de tipo Alojamiento (1)
UPDATE cotizacion 
SET tipo_cotizacion = 1
WHERE id = id_principal
AND (tipo_cotizacion IS NULL OR tipo_cotizacion = 0 OR tipo_cotizacion = '');

-- =====================================================
-- VERIFICACIÓN POST-MIGRACIÓN
-- =====================================================

-- PASO 5: Verificar que se completó la migración
SELECT 
    COUNT(*) as cotizaciones_sin_master,
    'Debe ser 0 si la migración fue exitosa' as estado
FROM cotizacion 
WHERE id_principal IS NULL OR id_principal = 0;

-- PASO 6: Verificar correspondencia entre cotizacion y cotizacion_master
SELECT 
    cm.id as master_id,
    cm.id_titular,
    cm.cod_vendedor,
    cm.estado,
    COUNT(c.id) as cantidad_cotizaciones_relacionadas,
    GROUP_CONCAT(c.tipo_cotizacion) as tipos
FROM cotizacion_master cm
LEFT JOIN cotizacion c ON c.id_principal = cm.id
GROUP BY cm.id
ORDER BY cm.id DESC
LIMIT 20;

-- PASO 7: Verificar integridad - Cotizaciones sin master correspondiente
SELECT 
    c.*,
    'ERROR: Cotizacion sin master' as problema
FROM cotizacion c
LEFT JOIN cotizacion_master cm ON cm.id = c.id_principal
WHERE cm.id IS NULL
AND c.id_principal IS NOT NULL 
AND c.id_principal > 0;

-- =====================================================
-- ROLLBACK (Solo ejecutar en caso de error)
-- =====================================================

-- Para revertir la migración (USAR CON PRECAUCIÓN):
-- DELETE FROM cotizacion_master WHERE id IN (
--     SELECT DISTINCT id_principal 
--     FROM cotizacion 
--     WHERE id = id_principal
-- );
-- 
-- UPDATE cotizacion 
-- SET id_principal = NULL 
-- WHERE id = id_principal;
