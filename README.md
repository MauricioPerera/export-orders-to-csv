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

El plugin genera cuatro archivos CSV distintos, cada uno conteniendo información relacionada con los pedidos:

### orders.csv

Este archivo contendrá información sobre los pedidos en sí. Las columnas de este archivo son:

- ID
- post_author
- post_date
- post_date_gmt
- post_content
- post_title
- post_excerpt
- post_status
- comment_status
- ping_status
- post_password
- post_name
- to_ping
- pinged
- post_modified
- post_modified_gmt
- post_content_filtered
- post_parent
- guid
- menu_order
- post_type
- post_mime_type
- comment_count
- meta_id
- post_id
- meta_key
- meta_value

### customer_data.csv

Este archivo contendrá información específica del cliente para cada pedido. Las columnas de este archivo son:

- meta_id
- post_id
- meta_key
- meta_value

### order_items.csv

Este archivo contendrá información sobre los elementos individuales de cada pedido. Las columnas de este archivo son:

- order_item_id
- order_item_name
- order_item_type
- order_id

### order_meta.csv

Este archivo contendrá los metadatos asociados a cada pedido. Estos metadatos pueden incluir información como la dirección de envío y facturación, el método de pago, y más. Las columnas de este archivo son:

- meta_id
- post_id
- meta_key
- meta_value

Para cada mes en el rango de fechas seleccionado, se generará un archivo separado para cada uno de los cuatro tipos de archivos mencionados anteriormente.

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
