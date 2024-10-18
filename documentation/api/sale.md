# Sale

Ventas a las cuales luego se les puede asociar ordenes.

## Rutas

`/sale`

Utilizar el parametro "all" para utilizar todos los subrecursos: `/sale/all`.

## Get

### /sale/all

Obtiene todas las ventas con todos sus subrecursos

## POST

### /sale

Agrega ordenes incluyendo todos sus subrecursos, especificandose los parámetros necesarios.

Estos parametros pueden estar de la siguiente forma:

```json
{
  "ivaRate": 1.2
}
```

## PUT

### /sale/{id}

Modifica una venta determinada

El parámetro id en la ruta es un número obligatorio

Los parámetros pueden estar de la siguiente forma:

```json
{
  "paid": true
}
```

'paid' indica que la venta está pagada.
