# Order

Ordenes asociadas a una venta determinada.

## Rutas

`/order`

Utilizar el parametro "all" para utilizar todos los subrecursos: `/order/all`.

## Get

### /order/all

Obtiene todas las ordenes con todos sus subrecursos

## Post

### /order/all

Agrega ordenes incluyendo todos sus subrecursos, especificandose los parámetros necesarios.

Estos parametros pueden estar de la siguiente forma:

```json
{
  "quantity": 3,
  "sale":{
    "id": 1
  },
  "product":{
    "id": 1
  },
  "ingredients":[
    {
      "id": 1
    },
    {
      "id": 2
    }
  ],
  "size": {
    "id": 3
  }
}
```

Siendo los parámetros "size" e "ingredients" opcionales.
