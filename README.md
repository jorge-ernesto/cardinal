# cardinal
Cardinal

¿Qué es el patrón MVC?

El patrón de diseño (de software) MVC se encarga de separar la lógica de negocio de la interfaz de usuario y es el mas utilizado en aplicaciones web, framework, etc, ya que facilita la funcionalidad, mantenibilidad, y escalabilidad del sistema, de forma comoda y sencilla, a la vez que ayuda no mezclar lenguajes de programación en el mismo código, el conocido “código espagueti”.
MVC divide las aplicaciones en tres niveles de abstracción:

    Modelo: es la lógica de negocios. Es decir las clases y métodos que se comunican directamente con la base de datos.
    Vista: es la encargada de mostrar la información al usuario, con de forma gráfica y legible.
    Controlador: el intermediario entre la vista y el modelo, se encarga de controlar las interacciones del usuario en la vista, pide los datos al modelo y los devuelve de nuevo a la vista para que esta los muestre al usuario. Es decir las llamadas a clases y métodos, y los datos recibidos de formularios.

¿Como funciona el MVC?

El funcionamiento básico del patrón MVC, puede resumirse en:

    El usuario realiza una petición.
    El controlador captura la petición.
    Hace la llamada al modelo correspondiente.
    El modelo sera el encargado de interactuar con la base de datos.
    El controlador recibe la información y la enviá a la vista.
    La vista muestra la información.
