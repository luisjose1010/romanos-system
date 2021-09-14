-- Fecha: 13-09-2021 17:23

INSERT INTO `product` (`id`, `name`, `multiple_ingredients`) VALUES
    (NULL, 'Pizza', '1'),
    (NULL, 'Refresco', '0'),
    (NULL, 'Servicio de tequeños', '0');

INSERT INTO `size` (`id`, `name`, `product_id`) VALUES
    (NULL, 'Personal', '1'),
    (NULL, 'Mediana', '1'),
    (NULL, 'Familiar', '1'),
    (NULL, 'Monstruo', '1'),
    (NULL, '1.5L', '2'),
    (NULL, '2L', '2');

INSERT INTO `ingredient` (`id`, `name`, `product_id`) VALUES
    (NULL, 'Doble queso', '1'),
    (NULL, 'Piña', '1'),
    (NULL, 'Remolacha', '1'),
    (NULL, 'Pepperoni', '1'),
    (NULL, 'Tocineta', '1'),
    (NULL, 'Jamón', '1'),
    (NULL, 'Coca-Cola', '2'),
    (NULL, 'Pepsi', '2'),
    (NULL, 'Chinotto', '2');
