## 3.2. Herramientas y Tecnologías de Desarrollo

Para la correcta ejecución del proyecto, se ha seleccionado el siguiente conjunto de herramientas:

* **Diseño y Prototipado (Figma):**
  Se utilizará Figma como herramienta principal para el diseño de interfaces. Esto permitirá definir la paleta de colores, la tipografía y la disposición de los elementos antes de empezar a programar. El objetivo es crear prototipos visuales que aseguren que la aplicación sea intuitiva y sencilla de entender para el usuario final.

* **Control de Versiones (GitHub):**
  Para la gestión del código fuente se utilizará GitHub. Esta plataforma permitirá almacenar el proyecto en la nube, actuando como copia de seguridad y sistema de control de versiones. Esto garantiza que no haya pérdida de datos y permite llevar un registro detallado de todo el proceso de desarrollo y los cambios realizados.

* **Entorno de Desarrollo (Visual Studio Code):**
  La codificación del proyecto se realizará utilizando Visual Studio Code. Se ha elegido este editor por su ligereza, su amplia compatibilidad con las tecnologías web y su ecosistema de extensiones que agilizan la escritura del código.

## Módulo Cliente

Descripción breve: Interfaz orientada a la experiencia del cliente en sala. Acceso rápido desde QR, navegación cómoda, filtros de alérgenos y un flujo de pedido rápido.

- **RF-01. Acceso Directo QR**
	- El sistema identificará la mesa cuando el cliente escanee su código QR.
	- Los clientes podrán ver la carta y realizar pedidos sin iniciar sesión.

- **RF-02. Navegación Scroll**
	- Todo el menú se mostrará en una única vista vertical.
	- Las secciones (ej. Comida, Bebidas) se abrirán mediante anclajes y el sistema realizará un scroll lateral/fluido para cambiar de sección sin recargar la página.

- **RF-03. Alérgenos**
	- Habrá un filtro en una columna lateral con opciones (ej. "Sin Gluten").
	- Al marcar alérgenos, se filtrarán (eliminarán) los productos que contengan esos ingredientes.
	- No se usará un PDF pequeño e ilegible; la información de alérgenos será interactiva y accesible.

- **RF-04. Añadido rápido**
	- Cada tarjeta de producto tendrá un botón directo (+) que añade 1 unidad al carrito sin necesidad de abrir la ficha del producto.

- **RF-05. Carrito Flotante**
	- Un resumen del pedido estará siempre visible o accesible en la parte inferior.
	- Permitirá confirmar la comanda con un solo toque.

### Notas UX (sugerencias)

- Mantener botones grandes para interacción táctil.
- Animaciones suaves para el scroll y el añadido al carrito.
- Mostrar claramente indicadores de precio, alérgenos y descripción breve en la tarjeta.

---

## Módulo Cocina y Barra

Descripción breve: Panel de trabajo para personal de cocina y barra orientado a velocidad y claridad en órdenes, con estados y prioridades visuales.

- **RF-06. Tablero pedidos**
	- Los pedidos se visualizarán en un tablero organizado por columnas de estado: Pendiente, En Preparación, Listo.
	- El tablero se actualizará automáticamente sin recargar la página.

- **RF-07. Interacciones rápidas**
	- El cambio de estado de un pedido se realizará con un único toque en la tarjeta o arrastrando la tarjeta entre columnas.
	- Optimizado para pantallas táctiles y uso con manos ocupadas.

- **RF-08. Semáforo de prioridad**
	- Las tarjetas cambiarán de color según tiempo de espera acumulado:
		- Verde: Pedido reciente (dentro de tiempo óptimo).
		- Amarillo: Pedido en tiempo límite (alerta de demora).
		- Rojo: Pedido retrasado (prioridad máxima).

- **RF-09. Interacciones inteligentes**
	- El sistema resaltará visualmente notas especiales críticas (ej.: "ALERGIA", "SIN SAL") para evitar errores en cocina.

- **RF-10. Cierre de Mesa y Cálculo Automático**
	- El camarero podrá seleccionar una mesa ocupada y pulsar "Pedir la Cuenta".
	- La aplicación sumará automáticamente todos los productos consumidos en la sesión, mostrando desglose y total a cobrar.
	- El objetivo es eliminar cálculos manuales por parte del personal.

### Notas operativas

- Registrar timestamp de llegada de pedido para calcular colores del semáforo.
- Proveer confirmación táctil/visual al cambiar estados para evitar cambios accidentales.

---

## Módulo Administración

Descripción breve: Herramientas para gestionar el catálogo, mesas y QR.

- **RF-11. Gestión del Catálogo**
	- El administrador podrá crear/editar platos, precios y fotos.
	- Incluirá un selector obligatorio de alérgenos por producto para alimentar el filtro del cliente.

- **RF-12. Generación de QR**
	- Módulo para crear mesas y descargar sus códigos QR listos para imprimir.

### Recomendaciones de administración

- Validar formato y tamaño de imágenes al subirlas.
- Mantener un histórico de cambios de precios (audit trail) para facturación.

---

## Accesibilidad y seguridad

- Usar contrastes suficientes para semáforo y textos.
- Etiquetas ARIA en componentes interactivos (añadir, cambiar estado, filtros).
- Validación en backend de alérgenos y notas críticas para no depender solo de la visualización.

---


## Diseño Interfaces

Esto se centrara en hablar sobre la estructura tecnica, el modelo de datos y el diseño de la interfaz de Usuario, Camarero, Cocina, Admin.

	1. Frontend: 

		* Vamos a utilizar JavaScript y Tailwinds CSS

	2. Backend: 

		* Vamos a utilizar Symfony 8.
	
	3. Infraestructura:
	
		* Docker Composer.

	4. Base de Datos:

		* Vamos a utilizar MySQL 
	
	5. Tiempo real para cocina

		* Mercure

## 5.2. Diseño de la Base de Datos (Modelo de Datos)

El diseño de la base de datos es un componente crítico. Se ha diseñado un esquema relacional normalizado capaz de gestionar la casuística real del menú del restaurante (basado en el menú de "Casa Encarni"). [cite_start]El modelo soporta categorías con precios unificados, como las pizzas [cite: 11] [cite_start]o los combos, y descripciones detalladas de ingredientes.

A continuación, se describen las entidades principales del modelo Entidad-Relación:

### Descripción de Tablas

* **TABLA `MESAS`**
    * Representa las ubicaciones físicas dentro del local.
    * Almacena el `codigo_qr` único (token) que valida que el cliente está realmente en el establecimiento.

* **TABLA `CATEGORIAS`**
    * Permite agrupar los productos para facilitar la navegación.
    * [cite_start]Soporta lógica de precios por grupo (ej: Categoría "Pizzas" donde todos los ítems tienen un precio base de 11€ [cite: 11]).

* **TABLA `PRODUCTOS`**
    * Contiene el catálogo gastronómico.
    * Incluye campo `descripcion` de tipo texto largo para detallar ingredientes complejos. [cite_start]Por ejemplo, para el producto "Hamburguesa Casa Encarni", se almacenará: *"Carne de ternera 180gr, cebolla caramelizada, queso cheddar, beicon, huevo y salsa cheddar"*[cite: 36, 37].
    * Campo `activo` (booleano) para gestión de stock.

* **TABLA `ALERGENOS` y `PRODUCTO_ALERGENO`**
    * Se implementa una relación **Muchos a Muchos** (N:M).
    * Un producto puede contener múltiples alérgenos (Huevo, Lácteos, Gluten) y un alérgeno está presente en múltiples productos. Esto permite el filtrado dinámico de seguridad en el cliente.

* **TABLA `PEDIDOS`**
    * Cabecera de la comanda.
    * **Estado:** Gestiona el flujo (*Pendiente* -> *En Preparación* -> *Listo*).
    * **Timestamp:** Registra la hora exacta para el sistema de alertas visuales (semáforo) en cocina.
    * **Total:** Almacena el cálculo automático del importe final de la mesa.

* **TABLA `DETALLE_PEDIDO`**
    * Almacena las líneas individuales de cada comanda (Producto y Cantidad).
    * Incluye `notas` para personalizaciones (ej: "Sin cebolla").

	
	
![Comanda](./img/Comanda.png)

## Imagenes de Figma

** Esto es la imagen del posible Menu, esta generado con el Figma. 

![Comanda](./img/Figma_Menu.png)

** Esto es el apartado de cliente 

![Comanda](./img/Cliente.png)

** Esto es el apartado de Camarero y Cocinero 

![Comanda](./img/Camarero_Cocina.png)

** Y por ultimo el menu de Admin

![Comanda](./img/Admin.png)