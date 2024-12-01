<?php 
require_once __DIR__.'/../helpers/functions.php'; // Importa funciones auxiliares.

// Manejo de solicitudes POST
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    clean_post_inputs(); // Limpia las entradas del formulario para mayor seguridad.
    if(isset($_GET['career_id'])){ 
        update(filter_input(INPUT_GET, 'career_id', FILTER_SANITIZE_STRING)); // Si se recibe un ID, actualiza la carrera.
    }else{
        store(); // Si no hay ID, guarda una nueva carrera.
    }
}

// Obtiene la lista de carreras.
function index()
{
    $pdo = getPDO(); // Obtiene la conexión PDO.

    try {
        $sql = "SELECT id, name, abbreviation, description, year FROM careers"; // Consulta SQL para obtener las carreras.
        $stmt = $pdo->query($sql);
        $careers = $stmt->fetchAll(PDO::FETCH_ASSOC); // Obtiene las filas como un arreglo asociativo.
        return $careers; // Retorna las carreras.
    } catch (PDOException $e) {
        error_log("Error al consultar la base de datos". $e->getMessage()); // Registra el error en el log.
        return []; // Retorna un arreglo vacío en caso de error.
    }
}

// Muestra los detalles de una carrera específica.
function show($id) 
{
    $id = htmlspecialchars($id); // Escapa caracteres para evitar inyecciones de HTML/JS.

    if ($id === null) {
        return []; // Retorna un arreglo vacío si el ID no es válido.
    }

    $pdo = getPDO(); // Obtiene la conexión PDO.

    try {
        $sql = "SELECT * FROM careers WHERE id = :id LIMIT 1"; // Consulta SQL para buscar una carrera específica.
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]); // Ejecuta la consulta con el ID.
        $careerData = $stmt->fetch(PDO::FETCH_ASSOC); // Obtiene el resultado.

        if (!$careerData) {
            return []; // Si no encuentra datos, retorna un arreglo vacío.
        }

        return $careerData; // Retorna los datos de la carrera.
    } catch (PDOException $e) {
        error_log("Error al consultar la base de datos: " . $e->getMessage());
        return []; // En caso de error, retorna un arreglo vacío.
    }
}

// Almacena una nueva carrera en la base de datos.
function store() {
    $imageName = saveImage(); // Guarda la imagen y obtiene su nombre.
    
    $pdo = getPDO(); // Obtiene la conexión PDO.

    try {
        $sql = "INSERT INTO careers (name, abbreviation, description, year, mission, vision, image_url) VALUES (:name, :abbreviation, :description, :year, :vision, :mission, :image_url)";
        $stmt = $pdo->prepare($sql); // Prepara la consulta SQL.
        $data = [
            'abbreviation' => $_POST['abbreviation'], // Datos del formulario.
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'mission' => $_POST['mission'],
            'vision' => $_POST['vision'],
            'year' => $_POST['year'],
            'image_url' => $imageName != null ? 'careers/'.$imageName : null // Guarda la URL de la imagen si existe.
        ];

        $stmt->execute($data); // Ejecuta la consulta.
        
        set_success_message('Se ha agregado la carrera.'); // Mensaje de éxito.
        cache_careers(); // Actualiza la caché (si aplica).
        redirect_back(); // Redirige al usuario.
    } catch (PDOException $e) {
        error_log("Error al consultar la base de datos: " . $e->getMessage()); // Registra el error.
        set_error_message_redirect($e->getMessage()); // Mensaje de error.
    }
}

// Actualiza una carrera existente.
function update($id) {
    $pdo = getPDO(); // Obtiene la conexión PDO.
    $careerData = show($id); // Obtiene los datos de la carrera existente.
    $imageName = saveImage(); // Guarda la nueva imagen si se subió.

    try {
        $sql = "UPDATE careers SET 
                    name = :name, 
                    abbreviation = :abbreviation, 
                    description = :description, 
                    year = :year, 
                    vision = :vision, 
                    mission = :mission,
                    image_url = :image_url
                WHERE id = :id"; // Consulta para actualizar la carrera.
        $stmt = $pdo->prepare($sql);
        $data = [
            'id' => $id, 
            'abbreviation' => $_POST['abbreviation'],
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'mission' => $_POST['mission'],
            'vision' => $_POST['vision'],
            'year' => $_POST['year'],
            'image_url' => $imageName ? 'careers/'.$imageName : $careerData['image_url'] // Usa la nueva imagen si existe.
        ];

        $stmt->execute($data); // Ejecuta la consulta.
        // Borra la imagen previa si se subió una nueva.
        if ($imageName && $careerData['image_url']) {
            $oldImagePath = __DIR__ . '/../../public/assets/img/' . $careerData['image_url'];
            if (file_exists($oldImagePath)) 
                unlink($oldImagePath); // Elimina la imagen antigua.
        }
        
        set_success_message('Se han guardado los cambios.'); // Mensaje de éxito.
        redirect_back(); // Redirige al usuario.
    } catch (PDOException $e) {
        error_log("Error al consultar la base de datos: " . $e->getMessage()); // Registra el error.
        set_error_message_redirect($e->getMessage()); // Mensaje de error.
    }

    
}

// Guarda una imagen en el servidor.
function saveImage()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image'];

        // Validar tipo de archivo (solo imágenes).
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($image['type'], $allowedTypes)) {
            set_error_message_redirect('Solo se permiten imágenes JPEG, PNG o GIF.');
        }

        // Validar tamaño (máximo 2 MB).
        if ($image['size'] > 2 * 1024 * 1024) {
            set_error_message_redirect("El tamaño de la imagen no debe exceder los 2 MB.");
        }

        // Crear una carpeta para las imágenes si no existe.
        $uploadDir = __DIR__ . '/../../public/assets/img/careers/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true); // Crea la carpeta con permisos.
        }

        // Generar un nombre único para la imagen.
        $imageName = uniqid('img_', true) . '.' . pathinfo($image['name'], PATHINFO_EXTENSION);

        // Mover la imagen a la carpeta de destino.
        $imagePath = $uploadDir . $imageName;
        if (!move_uploaded_file($image['tmp_name'], $imagePath)) {
            set_error_message_redirect("Error al mover la imagen.");
        }

        return $imageName; // Retorna el nombre de la imagen.
    }
    
    return null; // Si no se subió imagen, retorna null.
}