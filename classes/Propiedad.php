<?php

namespace App;

class Propiedad
{
    // Variable estática para la conexión a la base de datos
    protected static $db;

    // Lista de columnas en la base de datos que se mapean a las propiedades del objeto
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];

    //Arreglo de errores
    public static $errores = [];

    // Propiedades públicas del objeto que representan las columnas de la base de datos
    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;

    // Método estático para definir la conexión a la base de datos
    public static function setDb($database)
    {
        self::$db = $database;
    }

    // Constructor de la clase que inicializa las propiedades del objeto con los valores proporcionados
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? 'imagen.jpg';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d') ?? '';
        $this->vendedorId = $args['vendedorId'] ?? 1;
    }

    // Método para guardar la propiedad en la base de datos
    public function guardar()
    {
        // Sanitiza los datos antes de usarlos en una consulta SQL
        $atributos = $this->sanitizarAtributos();

        // Construye la consulta SQL para insertar un nuevo registro en la base de datos
        $query = "INSERT INTO propiedades ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        // Ejecuta la consulta y almacena el resultado
        $resultado = self::$db->query($query);

        // Función para depurar el resultado de la consulta
        return $resultado;
    }

    // Método para obtener los atributos del objeto que se mapearán a las columnas de la base de datos
    public function atributos()
    {
        $atributos = [];
        foreach (self::$columnasDB as $columna) {
            // Omitir la columna 'id' ya que normalmente no se establece manualmente
            if ($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    // Método para sanitizar los atributos antes de usarlos en una consulta SQL
    public function sanitizarAtributos()
    {
        $atributos = $this->atributos();
        $sanitizado = [];

        // Sanitiza cada atributo usando el método escape_string para prevenir inyecciones SQL
        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        // Función para depurar los atributos sanitizados
        // debugear($sanitizado);

        return $sanitizado;  // Asegúrate de devolver los atributos sanitizados
    }

    public function setImagen($imagen)
    {
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    //validacion
    public static function getErrores()
    {
        return self::$errores;
    }

    public function validar()
    {
        // Validaciones de los datos del formulario
        if (!$this->titulo) {
            self::$errores[] = "Debes añadir un título";
        }

        if (!$this->precio) {
            self::$errores[] = "El precio es obligatorio";
        }

        if (strlen($this->descripcion) < 50) {
            self::$errores[] = "Debes añadir una descripción que contenga al menos 50 caracteres";
        }

        if (!$this->habitaciones) {
            self::$errores[] = "El número de habitaciones es obligatorio";
        }

        if (!$this->wc) {
            self::$errores[] = "El número de baños es obligatorio";
        }

        if (!$this->estacionamiento) {
            self::$errores[] = "El número de lugares de estacionamiento es obligatorio";
        }

        if (!$this->vendedorId) {
            self::$errores[] = "Elige un vendedor";
        }

        if (!$this->imagen) {
            self::$errores[] = "La imagen es obligatoria";
        }

        // Asegúrate de devolver los errores
        return self::$errores;
    }

    //Lista todos los registros
    public static function all()
    {
        $query = "SELECT * FROM propiedades";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //Busca una registro por su id
    public static function find($id){
        $query = "SELECT * FROM propiedades WHERE id = {$id}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    public static function consultarSQL($query)
    {
        //consultar la db
        $resultado = self::$db->query($query);

        //iterar los resultados
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = self::crearObjeto($registro);
        }

        //liberar la memoria
        $resultado->free();

        //retornar los resultados
        return $array;
    }

    //se crea un objeto porque los resultados vienen como arreglo
    protected static function crearObjeto($registro)
    {
        $objeto = new self;

        foreach($registro as $key => $value) {
            if(property_exists($objeto, $key)){
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }
}
