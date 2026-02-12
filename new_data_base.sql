CREATE TABLE cotizacion_master (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

  -- Relación principal
  id_titular INT UNSIGNED NOT NULL,
  id_hotel INT UNSIGNED NOT NULL,

  -- Datos comerciales
  cod_vendedor VARCHAR(50) NOT NULL,
  estado ENUM('1','0') NOT NULL DEFAULT '1', -- 1=Activo, 0=Inactivo

  -- Auditoría
  id_autor INT UNSIGNED NOT NULL,
  id_autor_at INT UNSIGNED NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  update_at DATETIME NULL ON UPDATE CURRENT_TIMESTAMP,
  

  -- Índices
  INDEX idx_titular (id_titular),
  INDEX idx_hotel (id_hotel),
  INDEX idx_estado (estado)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;
  
  ALTER TABLE cotizacion
ADD COLUMN id_principal INT UNSIGNED NOT NULL AFTER id,
ADD INDEX idx_principal (id_principal);

ALTER TABLE cotizacion
ADD COLUMN tipo_cotizacion INT UNSIGNED NOT NULL AFTER id_terminos,
ADD INDEX idx_tipo_cotizacion (tipo_cotizacion);

-- OPCIONAL: Si quieres asegurar la integridad referencial entre cotizacion y cotizacion_master, puedes agregar una clave foránea:
ALTER TABLE cotizacion
ADD CONSTRAINT fk_cotizacion_master
FOREIGN KEY (id_principal)
REFERENCES cotizacion_master(id)
ON DELETE CASCADE;