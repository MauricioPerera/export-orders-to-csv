# Export Orders to CSV

Este plugin para WordPress permite exportar los pedidos de WooCommerce a un archivo CSV. Proporciona una interfaz cómoda en el panel de control de WordPress, donde los usuarios pueden seleccionar un rango de fechas para los pedidos a exportar. Adicionalmente, permite a los usuarios descargar o eliminar los archivos CSV generados.

## Características Principales

- Exportación de pedidos de WooCommerce a CSV.
- Interfaz en el panel de administración de WordPress para seleccionar un rango de fechas para los pedidos a exportar.
- Opción para descargar o eliminar los archivos CSV generados.
- Lista de archivos generados con opción para descargar o eliminar.

## Tablas de base de datos involucradas

Este plugin obtiene información de las siguientes tablas de la base de datos de WordPress:

- wp_posts: Para obtener los pedidos (donde post_type = 'shop_order').
- wp_postmeta: Para obtener los detalles de cada pedido.
- wp_woocommerce_order_items y wp_woocommerce_order_itemmeta: Para obtener los productos de cada pedido.

## Estructura del archivo CSV generado

El archivo CSV generado incluye la siguiente información para cada pedido:

- ID del pedido
- Fecha del pedido
- Estado del pedido
- Total del pedido
- Método de pago
- Nombre del cliente
- Email del cliente
- Dirección de facturación
- Dirección de envío
- Productos comprados (ID del producto, nombre y cantidad)

Los detalles anteriores se incluyen en cada fila del archivo CSV, donde cada fila representa un pedido.

## Cómo usar

1. Navegue hasta la página "Export Orders" en el panel de administración de WordPress.
2. Seleccione las fechas de inicio y fin para los pedidos que desea exportar.
3. Haga clic en "Export Orders" para generar el archivo CSV.
4. Una vez generado el archivo CSV, puede seleccionarlo de la lista y hacer clic en "Download Selected Files" para descargarlo.
5. Si desea eliminar archivos CSV generados anteriormente, simplemente selecciónelos y haga clic en "Delete Selected Files".

## Autor

[Mauricio Perera](https://www.linkedin.com/in/mauricioperera/)

Visite mi blog en [rckflr.party](https://rckflr.party/).

## Versión

1.0
