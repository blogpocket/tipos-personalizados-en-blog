<?php
/*
Plugin Name: Tipos Personalizados en Bucle del Blog
Description: Incluye tipos de datos personalizados seleccionados en el bucle principal del blog.
Version: 1.0
Author: A. Cambronero Blogpocket.com
*/

// Evitar el acceso directo al archivo
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Agregar menú de configuración en el administrador
add_action( 'admin_menu', 'tpib_agregar_menu_admin' );
function tpib_agregar_menu_admin() {
    add_options_page(
        'Tipos Personalizados en Blog',
        'Tipos en Blog',
        'manage_options',
        'tpib-configuracion',
        'tpib_pagina_configuracion'
    );
}

// Registrar configuraciones
add_action( 'admin_init', 'tpib_registrar_configuraciones' );
function tpib_registrar_configuraciones() {
    register_setting( 'tpib_opciones_grupo', 'tpib_tipos_seleccionados', array(
        'type' => 'array',
        'sanitize_callback' => 'tpib_sanitizar_tipos_seleccionados',
        'default' => array( 'post' ),
    ) );
}

function tpib_sanitizar_tipos_seleccionados( $input ) {
    $tipos_validos = get_post_types( array( 'public' => true ), 'names' );
    $output = array();

    if ( is_array( $input ) ) {
        foreach ( $input as $tipo ) {
            if ( in_array( $tipo, $tipos_validos ) ) {
                $output[] = $tipo;
            }
        }
    }

    return $output;
}

// Página de configuración
function tpib_pagina_configuracion() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    // Obtener los tipos de datos personalizados públicos
    $args = array(
        'public'   => true,
    );
    $tipos_personalizados = get_post_types( $args, 'objects' );

    // Excluir tipos no deseados
    unset( $tipos_personalizados['attachment'] );

    // Obtener los tipos seleccionados
    $tipos_seleccionados = get_option( 'tpib_tipos_seleccionados', array( 'post' ) );

    ?>
    <div class="wrap">
        <h1>Configuración de Tipos Personalizados en el Blog</h1>
        <form method="post" action="options.php">
            <?php settings_fields( 'tpib_opciones_grupo' ); ?>
            <?php do_settings_sections( 'tpib_opciones_grupo' ); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Selecciona los tipos de publicaciones a incluir en el blog:</th>
                    <td>
                        <?php foreach ( $tipos_personalizados as $tipo ) : ?>
                            <label>
                                <input type="checkbox" name="tpib_tipos_seleccionados[]" value="<?php echo esc_attr( $tipo->name ); ?>" <?php checked( in_array( $tipo->name, $tipos_seleccionados ) ); ?> />
                                <?php echo esc_html( $tipo->labels->singular_name ); ?>
                            </label><br />
                        <?php endforeach; ?>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Modificar el bucle principal
add_action( 'pre_get_posts', 'tpib_modificar_consulta_principal' );
function tpib_modificar_consulta_principal( $query ) {
    if ( is_home() && $query->is_main_query() && ! is_admin() ) {
        $tipos_seleccionados = get_option( 'tpib_tipos_seleccionados', array( 'post' ) );
        if ( ! empty( $tipos_seleccionados ) ) {
            $query->set( 'post_type', $tipos_seleccionados );
            $query->set( 'orderby', 'date' );
            $query->set( 'order', 'DESC' );
        }
    }
}
?>
