# Tienda online Merch Romero Proyecto Segundo año Grado superior Desarrollo Web

#### Iñigo Romero 15/01/2019

#### Desarrollo Web Entorno Servidor

#### Plaiaundi


## Índice

#### 1. Introducción

#### 2. Finalidad

#### 3. Descripción

## Introducción

#### En este documento se verá la explicación, descripción y funcionamiento de la

#### página.

#### Es una tienda online dedicada a vender merchandising, en la cual habrá dos tipos

#### de usuarios el cliente y el administrador.

## Finalidad

#### Conseguir una tienda online totalmente funcional y práctica en la cual los clientes

#### puedan hacer sus compras perfectamente y el administrador manejar los usuarios y

#### los artículos.

## Descripción

### Interfaz→

Dispone de 6 vistas
Login:


Registro:
Vista del administrador:


Inicio del cliente:
Carrito:


Historial de compras:

### Clases

#### Contiene 1 controlador 1 model y 6 vistas.

### Funcionamiento

#### El controlador contiene extendido el CI_Controller. Lo primero que hace es cargar

#### todos lo necesario los helper ‘form’ , ‘url’ y ‘cookie’, el modelo en este caso

#### Tienda_model, y las librerías ‘session’, ‘form_validation’ y ‘cart’. Cada vista tiene una

#### función para ser cargada. El controlador se encarga de que al introducir, ver o editar

#### datos en la vista lo conecta con el model y este se conecta a la base de datos para

#### realizar las operaciones.

## Mejoras

#### Me ha faltado introducir la confirmación de la cuenta mediante el correo. El sistema

#### de compras todavía se puede mejorar mucho más.


## Autoevaluación

### Dificultades

He tenido algún problema a la hora de comprender alguna librería, pero el mayor problema
ha sido el no saber organizar bien el tiempo.

## Cosas nuevas aprendidas

#### He aprendido a usar bastante mejor las librerías y el sistema model-view-controller.

## Tiempo invertido

Aproximadamente 30 horas.
4 horas en esquemas y planificación.
25 horas en código.
1 hora en documentación.

## Bibliografía

https://www.codeigniter.com/user_guide/


