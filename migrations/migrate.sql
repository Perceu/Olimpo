ALTER TABLE `empresas_carnes` 
CHANGE COLUMN `rsId` `rsId` INT(11) NOT NULL DEFAULT 0 ;

ALTER TABLE `empresas_carnes` 
CHANGE COLUMN `rsId` `ecPago` INT(11) NOT NULL DEFAULT 0 ;

ALTER TABLE `Infox`.`registrocategorias` 
ADD COLUMN `conId` INT NOT NULL DEFAULT 0 AFTER `rcDescontaCaixa`;

ALTER TABLE `Infox`.`registrocategorias` 
ADD COLUMN `TaxaPagamento` DECIMAL(5,2) NOT NULL AFTER `conId`;
