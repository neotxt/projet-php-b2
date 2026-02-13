<?php

namespace Validators;

use Exception;

class ArticleImageValidator
{
    private const MAX_SIZE = 2 * 1024 * 1024; // 2 Mo
    private const ALLOWED_EXTENSIONS = ['jpg', 'jpeg', 'png', 'webp'];

    public function validateImage(array $imageData)
    {
        if ($imageData['error'] !== UPLOAD_ERR_OK) {
            if ($imageData['error'] === UPLOAD_ERR_NO_FILE) {
                throw new Exception("Veuillez sélectionner une image.");
            }
            throw new Exception("Erreur lors du transfert de l'image.");
        }

        $this->validateImageSize($imageData['size']);
        $this->validateImageExtension($imageData['name']);
    }

    public function validateImageSize(int $imageSize)
    {
        if ($imageSize > self::MAX_SIZE) {
            throw new Exception("Le fichier est trop lourd.");
        }
    }

    public function validateImageExtension(string $fileName)
    {
        $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        if (!in_array($extension, self::ALLOWED_EXTENSIONS)) {
            throw new Exception("Format non supporté. Utilisez JPG, PNG ou WEBP.");
        }
    }

}