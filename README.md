# Tipos personalizados en el blog
Este plugin permitirá que en el bucle de la plantilla del blog se incluyan, además de las entradas normales, las publicaciones de los tipos de datos personalizados seleccionados por el administrador, todo en orden cronológico inverso.
# Activar el plugin
- Ve al panel de administración de WordPress, navega a "Plugins" y activa "Tipos Personalizados en Bucle del Blog".
# Configurar el plugin
- Después de activar el plugin, ve a "Ajustes" > "Tipos en Blog".
- Selecciona los tipos de publicaciones que deseas incluir en el bucle principal del blog.
- Haz clic en "Guardar cambios".
# Verificar en el sitio
- Visita la página principal de tu blog y verifica que ahora se muestran las publicaciones de los tipos de datos personalizados seleccionados, junto con las entradas normales, todo en orden cronológico inverso.
# Tipos de datos personalizados públicos
- El plugin obtiene todos los tipos de datos personalizados que sean públicos ('public' => true). Si tienes tipos de datos personalizados que no son públicos, no aparecerán en la lista de selección.
# Exclusión de 'attachment'
- Se excluyen los adjuntos ('attachment') de la lista de tipos de publicaciones disponibles para evitar mostrar archivos adjuntos en el bucle principal.
# Seguridad
- Se utilizan funciones de sanitización y validación para asegurar que solo se guarden y utilicen tipos de publicaciones válidos.
# Personalización
- Puedes modificar el código según tus necesidades, por ejemplo, cambiar el texto de la interfaz o ajustar los parámetros de la consulta.
# Advertencia
- Asegúrate de probar el plugin en un entorno de desarrollo antes de implementarlo en un sitio en producción, para verificar que funciona correctamente y no interfiere con otros plugins o temas que estés utilizando.
# Compatibilidad con el plugin Seriously Simple Podcasting
- Si usas el plugin "Tipos personalizados en el blog", puedes deshabilitar la opción del plugin "Seriously Simple Podcasting" para mostrar los episodios del podcast en el blog y activar el tipo de datos "Episodes" en los ajustes de administración del plugin "Tipos de datos personalizados".
