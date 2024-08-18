<?php

/**
 * Devuleve una respuesta JSON con cuerpo predeterminado
 * @param int $status
 * @param string $description
 * @param array $content
 */
function responseJson(
    $status,
    $description,
    $content,
) {
    return response()->json(
        [
            'status_api' => $status,
            'description' => $description,
            'content' => $content,
        ],
        $status
    );
}
