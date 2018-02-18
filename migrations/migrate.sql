ALTER TABLE `empresas_carnes` 
CHANGE COLUMN `rsId` `rsId` INT(11) NOT NULL DEFAULT 0 ;

ALTER TABLE `empresas_carnes` 
CHANGE COLUMN `rsId` `ecPago` INT(11) NOT NULL DEFAULT 0 ;

ALTER TABLE `Infox`.`registrocategorias` 
ADD COLUMN `conId` INT NOT NULL DEFAULT 0 AFTER `rcDescontaCaixa`;

ALTER TABLE `Infox`.`registrocategorias` 
ADD COLUMN `TaxaPagamento` DECIMAL(5,2) NOT NULL AFTER `conId`;

ALTER TABLE `Infox`.`registrocategorias` 
CHANGE COLUMN `TaxaPagamento` `TaxaPagamento` INT(11) NOT NULL DEFAULT 0.0 ;

ALTER TABLE `Infox`.`registrocategorias` 
ADD COLUMN `rcIdTaxa` INT NOT NULL AFTER `TaxaPagamento`;

ALTER TABLE `Infox`.`registrocategorias` 
CHANGE COLUMN `rcIdTaxa` `rcIdTaxa` INT(11) NOT NULL DEFAULT 0 ;

ALTER TABLE `Infox`.`registrosaidas` 
ADD COLUMN `rsCreatedAt` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP AFTER `turId`;

ALTER TABLE `Infox`.`registroentradas` 
ADD COLUMN `reCreatedAt` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP;


